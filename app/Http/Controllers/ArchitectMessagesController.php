<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArchitectMessagesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET PROJECTS ACCESSIBLE TO ARCHITECT
    |--------------------------------------------------------------------------
    |
    | The architect can see projects where they are either:
    | 1. The lead architect, or
    | 2. An assigned project collaborator.
    |
    */

    private function accessibleProjectsQuery($architectId)
    {
        return Project::where(
            function ($query) use ($architectId) {

                $query
                    ->where(
                        'architect_id',
                        $architectId
                    )
                    ->orWhereHas(
                        'projectArchitects',
                        function ($teamQuery) use ($architectId) {

                            $teamQuery->where(
                                'architect_id',
                                $architectId
                            );
                        }
                    );
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $architect =
            Auth::user();


        $projects =
            $this->accessibleProjectsQuery(
                $architect->id
            )
                ->with([
                    'client',

                    'messages' => function ($query) {

                        $query
                            ->with([
                                'sender',
                                'receiver',
                            ])
                            ->orderBy(
                                'created_at',
                                'asc'
                            );
                    },

                    'files' => function ($query) {

                        $query
                            ->with(
                                'uploader'
                            )
                            ->orderBy(
                                'created_at',
                                'desc'
                            );
                    },

                    'revisions' => function ($query) {

                        $query
                            ->with(
                                'client'
                            )
                            ->orderBy(
                                'created_at',
                                'desc'
                            );
                    },

                    'meetings' => function ($query) {

                        $query
                            ->with(
                                'client'
                            )
                            ->orderBy(
                                'meeting_date',
                                'asc'
                            );
                    },
                ])
                ->get();


        $conversations =
            $projects
                ->filter(
                    function ($project) {

                        return
                            $project->client
                            !== null;
                    }
                )
                ->sortByDesc(
                    function ($project) {

                        $lastMessage =
                            $project
                                ->messages
                                ->sortByDesc(
                                    'created_at'
                                )
                                ->first();


                        return
                            $lastMessage
                                ? $lastMessage->created_at
                                : $project->updated_at;
                    }
                )
                ->values();


        $selectedProject =
            null;


        if (
            $request->filled(
                'project'
            )
        ) {

            $selectedProject =
                $conversations
                    ->firstWhere(
                        'id',
                        (int) $request->project
                    );
        }


        if (
            !$selectedProject
            &&
            $conversations->count() > 0
        ) {

            $selectedProject =
                $conversations->first();
        }


        $messages =
            collect();

        $sharedFiles =
            collect();

        $sharedRevisions =
            collect();

        $sharedMeetings =
            collect();

        $nextMeeting =
            null;


        if ($selectedProject) {

            $messages =
                $selectedProject
                    ->messages
                    ->sortBy(
                        'created_at'
                    )
                    ->values();


            $sharedFiles =
                $selectedProject
                    ->files
                    ->sortByDesc(
                        'created_at'
                    )
                    ->values();


            $sharedRevisions =
                $selectedProject
                    ->revisions
                    ->sortByDesc(
                        'created_at'
                    )
                    ->values();


            $sharedMeetings =
                $selectedProject
                    ->meetings
                    ->sortBy(
                        'meeting_date'
                    )
                    ->values();


            /*
            |--------------------------------------------------------------------------
            | NEXT MEETING
            |--------------------------------------------------------------------------
            */

            $nextMeeting =
                $sharedMeetings
                    ->filter(
                        function ($meeting) {

                            if (
                                !$meeting->meeting_date
                            ) {

                                return false;
                            }


                            return
                                \Carbon\Carbon::parse(
                                    $meeting->meeting_date
                                )
                                    ->endOfDay()
                                    ->isFuture();
                        }
                    )
                    ->sortBy(
                        'meeting_date'
                    )
                    ->first();
        }


        return view(
            'architect.messages',
            compact(
                'architect',
                'conversations',
                'selectedProject',
                'messages',
                'sharedFiles',
                'sharedRevisions',
                'sharedMeetings',
                'nextMeeting'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    */

    public function send(
        Request $request,
        $projectId
    ) {
        $architect =
            Auth::user();


        $project =
            $this->accessibleProjectsQuery(
                $architect->id
            )
                ->with(
                    'client'
                )
                ->where(
                    'id',
                    $projectId
                )
                ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate(
            [
                'message' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

                'attachment' => [
                    'nullable',
                    'file',
                    'max:102400',
                    'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
                ],
            ],
            [
                'message.string' =>
                    'The message must contain valid text.',

                'message.max' =>
                    'The message cannot exceed 5,000 characters.',

                'attachment.file' =>
                    'The attachment must be a valid file.',

                'attachment.max' =>
                    'Images can be up to 100 MB. Documents can be up to 10 MB.',

                'attachment.mimes' =>
                    'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.',
            ]
        );


        if (
            !$request->filled(
                'message'
            )
            &&
            !$request->hasFile(
                'attachment'
            )
        ) {

            return back()
                ->withErrors([
                    'message' =>
                        'Please enter a message or attach a file.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT CHECK
        |--------------------------------------------------------------------------
        */

        if (
            !$project->client_id
            ||
            !$project->client
        ) {

            return back()
                ->withErrors([
                    'message' =>
                        'This project has no linked client account.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | ATTACHMENT
        |--------------------------------------------------------------------------
        */

        $attachmentPath =
            null;

        $attachmentName =
            null;

        $attachmentType =
            null;

        $attachmentSize =
            null;


        if (
            $request->hasFile(
                'attachment'
            )
        ) {

            $file =
                $request->file(
                    'attachment'
                );


            $extension =
                strtolower(
                    $file->getClientOriginalExtension()
                );


            $allowedExtensions = [
                'jpg',
                'jpeg',
                'png',

                'pdf',

                'doc',
                'docx',

                'xls',
                'xlsx',
            ];


            if (
                !in_array(
                    $extension,
                    $allowedExtensions,
                    true
                )
            ) {

                return back()
                    ->withErrors([
                        'attachment' =>
                            'This attachment type is not allowed.'
                    ])
                    ->withInput();
            }


            $imageTypes = [
                'jpg',
                'jpeg',
                'png',
            ];


            if (
                !in_array(
                    $extension,
                    $imageTypes,
                    true
                )
                &&
                $file->getSize() > 10485760
            ) {

                return back()
                    ->withErrors([
                        'attachment' =>
                            'Documents cannot be larger than 10 MB.'
                    ])
                    ->withInput();
            }


            /*
            |--------------------------------------------------------------------------
            | STORE FILE PRIVATELY
            |--------------------------------------------------------------------------
            */

            $attachmentPath =
                $file->store(
                    'project-messages/'
                    . $project->id,
                    'local'
                );


            if (!$attachmentPath) {

                return back()
                    ->withErrors([
                        'attachment' =>
                            'The attachment could not be saved. Please try again.'
                    ])
                    ->withInput();
            }


            $attachmentName =
                basename(
                    $file->getClientOriginalName()
                );


            $attachmentType =
                $extension;


            $attachmentSize =
                $file->getSize();
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE MESSAGE
        |--------------------------------------------------------------------------
        */

        try {

            ProjectMessage::create([

                'project_id' =>
                    $project->id,

                'sender_id' =>
                    $architect->id,

                'receiver_id' =>
                    $project->client_id,

                'message' =>
                    $request->filled(
                        'message'
                    )
                        ? trim(
                            $request->message
                        )
                        : null,

                'attachment_path' =>
                    $attachmentPath,

                'attachment_name' =>
                    $attachmentName,

                'attachment_type' =>
                    $attachmentType,

                'attachment_size' =>
                    $attachmentSize,

                'is_read' =>
                    false,

            ]);

        } catch (\Throwable $error) {

            if (
                $attachmentPath
                &&
                Storage::disk(
                    'local'
                )
                    ->exists(
                        $attachmentPath
                    )
            ) {

                Storage::disk(
                    'local'
                )
                    ->delete(
                        $attachmentPath
                    );
            }


            return back()
                ->withErrors([
                    'message' =>
                        'The message could not be sent. Please try again.'
                ])
                ->withInput();
        }


        return redirect()
            ->route(
                'architect.messages.index',
                [
                    'project' =>
                        $project->id
                ]
            )
            ->with(
                'success',
                'Message sent.'
            );
    }
}
