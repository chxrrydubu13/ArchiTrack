<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectMessage;
use App\Models\ProjectMilestone;
use App\Models\ProjectRevision;
use App\Models\ProjectAIHistory;
use Illuminate\Support\Facades\Storage;

class SecureProjectFileController extends Controller
{
    public function download($projectId, $fileId)
    {
        $project = $this->getAccessibleProject($projectId);

        $file = ProjectFile::where('id', $fileId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        $disk = $this->getFileDisk($file->file_path);

        if (!$disk) {
            abort(404, 'The requested project file could not be found.');
        }

        return Storage::disk($disk)
            ->download(
                $file->file_path,
                $file->original_name
            );
    }

    public function view($projectId, $fileId)
    {
        $project = $this->getAccessibleProject($projectId);

        $file = ProjectFile::where('id', $fileId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        return $this->viewStoredFile(
            $file->file_path,
            $file->original_name
        );
    }

    public function viewMessageAttachment($projectId, $messageId)
    {
        $project = $this->getAccessibleProject($projectId);

        $message = ProjectMessage::where('id', $messageId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (empty($message->attachment_path)) {
            abort(404, 'This message does not have an attachment.');
        }

        $fileName = $message->attachment_name
            ?: basename($message->attachment_path);

        return $this->viewStoredFile(
            $message->attachment_path,
            $fileName
        );
    }

    public function downloadMessageAttachment($projectId, $messageId)
    {
        $project = $this->getAccessibleProject($projectId);

        $message = ProjectMessage::where('id', $messageId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (empty($message->attachment_path)) {
            abort(404, 'This message does not have an attachment.');
        }

        $disk = $this->getFileDisk(
            $message->attachment_path
        );

        if (!$disk) {
            abort(
                404,
                'The requested message attachment could not be found.'
            );
        }

        $fileName = $message->attachment_name
            ?: basename($message->attachment_path);

        return Storage::disk($disk)
            ->download(
                $message->attachment_path,
                $fileName
            );
    }

    public function viewMilestoneProof($projectId, $milestoneId)
    {
        $project = $this->getAccessibleProject($projectId);

        $milestone = ProjectMilestone::where('id', $milestoneId)
            ->whereHas('phase', function ($query) use ($project) {
                $query->where(
                    'project_id',
                    $project->id
                );
            })
            ->firstOrFail();

        if (empty($milestone->proof_file)) {
            abort(404, 'This milestone does not have a proof file.');
        }

        $this->enforceMilestoneProofVisibility(
            $milestone
        );

        $fileName = $milestone->proof_file_name
            ?: basename($milestone->proof_file);

        return $this->viewStoredFile(
            $milestone->proof_file,
            $fileName
        );
    }

    public function downloadMilestoneProof($projectId, $milestoneId)
    {
        $project = $this->getAccessibleProject($projectId);

        $milestone = ProjectMilestone::where('id', $milestoneId)
            ->whereHas('phase', function ($query) use ($project) {
                $query->where(
                    'project_id',
                    $project->id
                );
            })
            ->firstOrFail();

        if (empty($milestone->proof_file)) {
            abort(404, 'This milestone does not have a proof file.');
        }

        $this->enforceMilestoneProofVisibility(
            $milestone
        );

        $disk = $this->getFileDisk(
            $milestone->proof_file
        );

        if (!$disk) {
            abort(
                404,
                'The requested milestone proof could not be found.'
            );
        }

        $fileName = $milestone->proof_file_name
            ?: basename($milestone->proof_file);

        return Storage::disk($disk)
            ->download(
                $milestone->proof_file,
                $fileName
            );
    }

    public function viewRevisionAttachment($projectId, $revisionId)
    {
        $project = $this->getAccessibleProject($projectId);

        $revision = ProjectRevision::where('id', $revisionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (empty($revision->attachment_path)) {
            abort(404, 'This revision does not have an attachment.');
        }

        $fileName = $revision->attachment_name
            ?: basename($revision->attachment_path);

        return $this->viewStoredFile(
            $revision->attachment_path,
            $fileName
        );
    }

    public function downloadRevisionAttachment($projectId, $revisionId)
    {
        $project = $this->getAccessibleProject($projectId);

        $revision = ProjectRevision::where('id', $revisionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (empty($revision->attachment_path)) {
            abort(404, 'This revision does not have an attachment.');
        }

        $disk = $this->getFileDisk(
            $revision->attachment_path
        );

        if (!$disk) {
            abort(
                404,
                'The requested revision attachment could not be found.'
            );
        }

        $fileName = $revision->attachment_name
            ?: basename($revision->attachment_path);

        return Storage::disk($disk)
            ->download(
                $revision->attachment_path,
                $fileName
            );
    }

    public function viewAiReferenceImage($projectId, $historyId)
    {
        $project = $this->getAccessibleProject($projectId);

        $history = ProjectAIHistory::where('id', $historyId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (empty($history->image_path)) {
            abort(
                404,
                'This AI history item does not have a reference image.'
            );
        }

        return $this->viewStoredFile(
            $history->image_path,
            basename($history->image_path)
        );
    }

    public function viewAiGeneratedImage($projectId, $historyId)
    {
        $project = $this->getAccessibleProject($projectId);

        $history = ProjectAIHistory::where('id', $historyId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (empty($history->generated_image_path)) {
            abort(
                404,
                'This AI history item does not have a generated image.'
            );
        }

        return $this->viewStoredFile(
            $history->generated_image_path,
            basename($history->generated_image_path)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | MILESTONE PROOF VISIBILITY
    |--------------------------------------------------------------------------
    |
    | Architects with project access can always view milestone proof files.
    | Assigned clients can only view proof files explicitly shared with them.
    |
    */

    private function enforceMilestoneProofVisibility(
        ProjectMilestone $milestone
    ): void {

        $user =
            auth()->user();


        if (
            $user
            &&
            $user->role === 'client'
            &&
            !$milestone->client_can_view
        ) {

            abort(
                404,
                'The requested milestone proof is not available.'
            );
        }
    }


    private function viewStoredFile($filePath, $fileName)
    {
        $disk = $this->getFileDisk($filePath);

        if (!$disk) {
            abort(404, 'The requested file could not be found.');
        }

        $absolutePath = Storage::disk($disk)
            ->path($filePath);

        return response()->file(
            $absolutePath,
            [
                'Content-Disposition' =>
                    'inline; filename="'
                    . addslashes($fileName)
                    . '"',
            ]
        );
    }

    private function getFileDisk($filePath): ?string
    {
        if (empty($filePath)) {
            return null;
        }

        if (
            Storage::disk('local')
                ->exists($filePath)
        ) {
            return 'local';
        }

        if (
            Storage::disk('public')
                ->exists($filePath)
        ) {
            return 'public';
        }

        return null;
    }

    /**
     * All secure attachment endpoints use this shared authorization check.
     * Projects with a missing or non-active lead architect are admin-only.
     */
    private function getAccessibleProject($projectId): Project
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Authentication required.');
        }

        $project = Project::query()->findOrFail($projectId);

        if ($user->role === 'admin') {
            return $project;
        }

        if (!in_array($user->role, ['architect', 'client'], true)
            || $user->status !== 'active') {
            abort(404);
        }

        // A null architect_id (after permanent account deletion) must not
        // make retained project files accessible to clients or collaborators.
        $leadArchitect = $project->architect;
        if (!$leadArchitect || $leadArchitect->role !== 'architect' || $leadArchitect->status !== 'active') {
            abort(404);
        }

        if ($user->role === 'client') {
            abort_unless((int) $project->client_id === (int) $user->id, 404);
            return $project;
        }

        $isLead = (int) $project->architect_id === (int) $user->id;
        $isCollaborator = $project->projectArchitects()
            ->where('architect_id', $user->id)
            ->exists();

        abort_unless($isLead || $isCollaborator, 404);

        return $project;
    }
}
