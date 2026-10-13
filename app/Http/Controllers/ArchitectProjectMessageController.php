<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMessage;
use App\Notifications\ProjectActivityNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArchitectProjectMessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET PROJECT WITH ARCHITECT ACCESS
    |--------------------------------------------------------------------------
    |
    | The lead architect and assigned project collaborators can use
    | the project conversation.
    |
    */

    private function getProjectForArchitect(
        $projectId,
        array $with = []
    ) {
        return Project::where(
            'id',
            $projectId
        )
            ->where(
                function ($query) {

                    $query
                        ->where(
                            'architect_id',
                            auth()->id()
                        )
                        ->orWhereHas(
                            'projectArchitects',
                            function ($teamQuery) {

                                $teamQuery->where(
                                    'architect_id',
                                    auth()->id()
                                );
                            }
                        );
                }
            )
            ->with($with)
            ->firstOrFail();
    }


    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        $id
    ) {
        /*
        |--------------------------------------------------------------------------
        | PROJECT ACCESS
        |--------------------------------------------------------------------------
        */

        $project =
            $this->getProjectForArchitect(
                $id,
                [
                    'client',
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDATE MESSAGE
        |--------------------------------------------------------------------------
        */

        $request->validate(
            [
                'message' => [
                    'nullable',
                    'string',
                    'max:5000',
                    'required_without:attachment',
                ],

                'attachment' => [
                    'nullable',
                    'file',
                    'required_without:message',
                    'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
                    'max:102400',
                ],
            ],
            [
                'message.required_without' =>
                    'Please write a message or attach a file.',

                'message.max' =>
                    'The message must not exceed 5000 characters.',

                'attachment.required_without' =>
                    'Please attach a file or write a message.',

                'attachment.file' =>
                    'The selected attachment must be a valid file.',

                'attachment.mimes' =>
                    'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.',

                'attachment.max' =>
                    'Images can be up to 100 MB. Documents can be up to 10 MB.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | CLIENT CHECK
        |--------------------------------------------------------------------------
        */

        if (!$project->client_id) {

            return $this->backToProjectChat(
                $project->id
            )
                ->withErrors([
                    'message' =>
                        'This project has no linked client account.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT ACCOUNT CHECK
        |--------------------------------------------------------------------------
        */

        if (!$project->client) {

            return $this->backToProjectChat(
                $project->id
            )
                ->withErrors([
                    'message' =>
                        'The linked client account could not be found.'
                ]);
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


            /*
            |--------------------------------------------------------------------------
            | ORIGINAL FILE NAME
            |--------------------------------------------------------------------------
            */

            $attachmentName =
                basename(
                    $file->getClientOriginalName()
                );


            /*
            |--------------------------------------------------------------------------
            | FILE TYPE
            |--------------------------------------------------------------------------
            */

            $attachmentType =
                strtolower(
                    $file->getClientOriginalExtension()
                );


            /*
            |--------------------------------------------------------------------------
            | FILE SIZE
            |--------------------------------------------------------------------------
            */

            $attachmentSize =
                $file->getSize();


            /*
            |--------------------------------------------------------------------------
            | ALLOWED FILE TYPES
            |--------------------------------------------------------------------------
            */

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
                    $attachmentType,
                    $allowedExtensions,
                    true
                )
            ) {

                return $this->backToProjectChat(
                    $project->id
                )
                    ->withErrors([
                        'attachment' =>
                            'This attachment type is not allowed.'
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | IMAGE / DOCUMENT SIZE LIMIT
            |--------------------------------------------------------------------------
            */

            $imageTypes = [
                'jpg',
                'jpeg',
                'png',
            ];


            if (
                !in_array(
                    $attachmentType,
                    $imageTypes,
                    true
                )
                &&
                $attachmentSize > 10485760
            ) {

                return $this->backToProjectChat(
                    $project->id
                )
                    ->withErrors([
                        'attachment' =>
                            'Documents cannot be larger than 10 MB.'
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | SAFE FILE NAME
            |--------------------------------------------------------------------------
            */

            $safeBaseName =
                Str::slug(
                    pathinfo(
                        $attachmentName,
                        PATHINFO_FILENAME
                    )
                );


            if (!$safeBaseName) {

                $safeBaseName =
                    'message-file';
            }


            $storedName =
                time()
                . '_'
                . Str::random(8)
                . '_'
                . $safeBaseName
                . '.'
                . $attachmentType;


            /*
            |--------------------------------------------------------------------------
            | STORE ATTACHMENT
            |--------------------------------------------------------------------------
            |
            | Use the private local disk so project conversation files are not
            | directly exposed through /storage.
            |
            */

            $attachmentPath =
                $file->storeAs(
                    'project-messages/'
                    . $project->id,
                    $storedName,
                    'local'
                );


            if (!$attachmentPath) {

                return $this->backToProjectChat(
                    $project->id
                )
                    ->withErrors([
                        'attachment' =>
                            'The attachment could not be saved. Please try again.'
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE MESSAGE
        |--------------------------------------------------------------------------
        */

        try {

            $projectMessage =
                ProjectMessage::create([

                    'project_id' =>
                        $project->id,

                    'sender_id' =>
                        auth()->id(),

                    'receiver_id' =>
                        $project->client_id,

                    'message' =>
                        $request->filled('message')
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
                Storage::disk('local')
                    ->exists(
                        $attachmentPath
                    )
            ) {

                Storage::disk('local')
                    ->delete(
                        $attachmentPath
                    );
            }


            return $this->backToProjectChat(
                $project->id
            )
                ->withErrors([
                    'message' =>
                        'The message could not be sent. Please try again.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PREPARE CLIENT NOTIFICATION MESSAGE
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('message')
            &&
            $attachmentName
        ) {

            $notificationMessage =
                'Your architect sent you a new message with an attachment for '
                . $project->project_name
                . '.';

        } elseif (
            $attachmentName
        ) {

            $notificationMessage =
                'Your architect sent you a new file in the project conversation for '
                . $project->project_name
                . '.';

        } else {

            $notificationMessage =
                'Your architect sent you a new message for '
                . $project->project_name
                . '.';
        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT MESSAGE URL
        |--------------------------------------------------------------------------
        */

        $notificationUrl =
            route(
                'client.projects.index',
                [
                    'project' =>
                        $project->id,

                    'section' =>
                        'messages',
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY CLIENT
        |--------------------------------------------------------------------------
        */

        $project->client->notify(

            new ProjectActivityNotification(

                'New Project Message',

                $notificationMessage,

                'message',

                $project->id,

                $notificationUrl

            )

        );


        /*
        |--------------------------------------------------------------------------
        | GO BACK DIRECTLY TO PROJECT CHAT
        |--------------------------------------------------------------------------
        */

        return $this->backToProjectChat(
            $project->id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RETURN TO PROJECT CHAT
    |--------------------------------------------------------------------------
    */

    private function backToProjectChat(
        $projectId
    ) {
        return redirect()
            ->to(
                route(
                    'architect.projects.show',
                    [
                        'id' =>
                            $projectId
                    ]
                )
                . '?tab=messages#project-chat'
            );
    }
}
