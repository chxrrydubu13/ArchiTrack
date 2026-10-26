<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Project;
use App\Models\ProjectRevision;
use App\Notifications\ProjectActivityNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArchitectProjectRevisionController extends Controller
{
    private function getProjectForArchitect($projectId, array $with = [])
    {
        abort_unless(
            auth()->check()
            && auth()->user()->role === 'architect'
            && auth()->user()->status === 'active',
            403
        );

        return Project::where('id', $projectId)
            ->whereHas('architect', function ($leadQuery) {
                $leadQuery->where('role', 'architect')
                    ->where('status', 'active');
            })
            ->where(function ($query) {
                $query
                    ->where('architect_id', auth()->id())
                    ->orWhereHas('projectArchitects', function ($teamQuery) {
                        $teamQuery->where('architect_id', auth()->id());
                    });
            })
            ->with($with)
            ->firstOrFail();
    }

    public function update(Request $request, $id, $revision)
    {
        $project = $this->getProjectForArchitect($id, ['client']);

        $projectRevision = ProjectRevision::where('id', $revision)
            ->where('project_id', $project->id)
            ->firstOrFail();

        $request->validate([
            'status' => [
                'required',
                'in:pending,in_progress,resolved',
            ],
            'architect_response' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'revised_file' => [
                'nullable',
                'file',
                'max:102400',
                'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            ],
        ], [
            'revised_file.file' => 'The revised file must be a valid file.',
            'revised_file.max' => 'Images can be up to 100 MB. Documents can be up to 10 MB.',
            'revised_file.mimes' => 'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.',
        ]);

        if ($request->hasFile('revised_file')) {
            $uploadedFile = $request->file('revised_file');
            $extension = strtolower($uploadedFile->getClientOriginalExtension());

            $imageExtensions = ['jpg', 'jpeg', 'png'];
            $isImage = in_array($extension, $imageExtensions, true);

            if (!$isImage && $uploadedFile->getSize() > (10 * 1024 * 1024)) {
                return back()
                    ->withErrors([
                        'revised_file' => 'Documents cannot be larger than 10 MB.',
                    ])
                    ->withInput();
            }
        }

        $oldStatus = $projectRevision->status;
        $oldArchitectResponse = $projectRevision->architect_response;
        $oldArchitectFilePath = $projectRevision->architect_file_path;

        $projectRevision->status = $request->status;
        $projectRevision->architect_response = $request->filled('architect_response')
            ? trim($request->architect_response)
            : null;

        if ($request->status === 'resolved') {
            if (!$projectRevision->resolved_at) {
                $projectRevision->resolved_at = now();
            }
        } else {
            $projectRevision->resolved_at = null;
        }

        $newFilePath = null;

        try {
            if ($request->hasFile('revised_file')) {
                $uploadedFile = $request->file('revised_file');
                $originalName = $uploadedFile->getClientOriginalName();
                $extension = strtolower($uploadedFile->getClientOriginalExtension());

                $safeBaseName = Str::slug(
                    pathinfo($originalName, PATHINFO_FILENAME),
                    '_'
                );

                if ($safeBaseName === '') {
                    $safeBaseName = 'revised_file';
                }

                $fileName =
                    time()
                    . '_'
                    . Str::random(8)
                    . '_'
                    . $safeBaseName
                    . '.'
                    . $extension;

                $newFilePath = $uploadedFile->storeAs(
                    'projects/' . $project->id . '/revisions/' . $projectRevision->id . '/architect',
                    $fileName,
                    'local'
                );

                $projectRevision->architect_file_path = $newFilePath;
                $projectRevision->architect_file_name = $originalName;
                $projectRevision->architect_file_type = $extension;
                $projectRevision->architect_file_size = $uploadedFile->getSize();
            }

            $projectRevision->save();

            if (
                $newFilePath
                && $oldArchitectFilePath
                && $oldArchitectFilePath !== $newFilePath
                && Storage::disk('local')->exists($oldArchitectFilePath)
            ) {
                Storage::disk('local')->delete($oldArchitectFilePath);
            }
        } catch (\Throwable $e) {
            if (
                $newFilePath
                && Storage::disk('local')->exists($newFilePath)
            ) {
                Storage::disk('local')->delete($newFilePath);
            }

            report($e);

            return back()
                ->withErrors([
                    'revised_file' => 'The revised file could not be saved. Please try again.',
                ])
                ->withInput();
        }

        $statusChanged = $oldStatus !== $projectRevision->status;
        $responseChanged = $oldArchitectResponse !== $projectRevision->architect_response;
        $fileChanged = $request->hasFile('revised_file');

        if ($statusChanged || $responseChanged || $fileChanged) {
            $details = [];

            if ($statusChanged) {
                $details[] =
                    'status changed from '
                    . ucwords(str_replace('_', ' ', $oldStatus))
                    . ' to '
                    . ucwords(str_replace('_', ' ', $projectRevision->status));
            }

            if ($responseChanged) {
                $details[] = $projectRevision->architect_response
                    ? 'architect response was added or updated'
                    : 'architect response was removed';
            }

            if ($fileChanged) {
                $details[] =
                    'revised file "'
                    . $projectRevision->architect_file_name
                    . '" was uploaded';
            }

            $auditAction = 'Revision Updated';

            if ($fileChanged) {
                $auditAction = 'Revision File Uploaded';
            } elseif ($projectRevision->status === 'resolved' && $statusChanged) {
                $auditAction = 'Revision Resolved';
            } elseif ($oldStatus === 'resolved' && $statusChanged) {
                $auditAction = 'Revision Reopened';
            } elseif ($statusChanged) {
                $auditAction = 'Revision Status Updated';
            } elseif ($responseChanged) {
                $auditAction = 'Revision Response Updated';
            }

            AuditLog::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'action' => $auditAction,
                'project_id' => $project->id,
                'project_name' => $project->project_name,
                'details' =>
                    'Architect updated revision #'
                    . $projectRevision->id
                    . ' for project "'
                    . $project->project_name
                    . '": '
                    . implode(', ', $details)
                    . '.',
            ]);
        }

        if (
            $project->client
            && ($statusChanged || $responseChanged || $fileChanged)
        ) {
            if ($fileChanged) {
                $notificationTitle = 'Revised File Uploaded';
                $notificationMessage =
                    'Your architect uploaded a revised file for your revision request in '
                    . $project->project_name
                    . '.';
            } elseif (
                $statusChanged
                && $projectRevision->status === 'in_progress'
            ) {
                $notificationTitle = 'Revision Updated';
                $notificationMessage =
                    'Your architect is now working on your revision request for '
                    . $project->project_name
                    . '.';
            } elseif (
                $statusChanged
                && $projectRevision->status === 'resolved'
            ) {
                $notificationTitle = 'Revision Resolved';
                $notificationMessage =
                    'Your revision request for '
                    . $project->project_name
                    . ' has been marked as resolved.';
            } elseif ($responseChanged) {
                $notificationTitle = 'Revision Response Updated';
                $notificationMessage =
                    'Your architect added or updated a response to your revision request for '
                    . $project->project_name
                    . '.';
            } else {
                $notificationTitle = 'Revision Updated';
                $notificationMessage =
                    'Your revision request for '
                    . $project->project_name
                    . ' has been updated.';
            }

            try {
                $project->client->notify(
                    new ProjectActivityNotification(
                        $notificationTitle,
                        $notificationMessage,
                        'revision',
                        route(
                            'architect.projects.show',
                            [
                                'id' => $project->id,
                                'tab' => 'revisions',
                            ]
                        )
                    )
                );
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()
            ->route(
                'architect.projects.show',
                [
                    'id' => $project->id,
                    'tab' => 'revisions',
                ]
            )
            ->with(
                'success',
                $fileChanged
                    ? 'Revision updated and revised file uploaded successfully.'
                    : 'Revision updated successfully.'
            );
    }

    public function downloadArchitectFile($id, $revision)
    {
        $project = $this->getProjectForArchitect($id);

        $projectRevision = ProjectRevision::where('id', $revision)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (
            !$projectRevision->architect_file_path
            || !Storage::disk('local')->exists($projectRevision->architect_file_path)
        ) {
            abort(404, 'Revised file not found.');
        }

        return Storage::disk('local')->download(
            $projectRevision->architect_file_path,
            $projectRevision->architect_file_name ?: 'revised-file'
        );
    }
}
