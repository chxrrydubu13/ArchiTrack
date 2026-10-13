<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientProjectMessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SEND CLIENT MESSAGE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | PROJECT CHECK
        |--------------------------------------------------------------------------
        |
        | Client can only send a message to a project that belongs
        | to their own client account.
        |
        */

        $project = Project::where('id', $id)
            ->where('client_id', auth()->id())
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'message' => [
                'nullable',
                'string',
                'max:5000',
                'required_without:attachment',
            ],

            'attachment' => [
                'nullable',
                'file',
                'max:102400',
                'required_without:message',
                'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | DOCUMENT SIZE LIMIT
        |--------------------------------------------------------------------------
        |
        | Images can be up to 100 MB.
        | Documents can be up to 10 MB.
        |
        */

        if ($request->hasFile('attachment')) {

            $validatedFile =
                $request->file('attachment');


            $validatedExtension =
                strtolower(
                    $validatedFile
                        ->getClientOriginalExtension()
                );


            $imageExtensions = [
                'jpg',
                'jpeg',
                'png',
            ];


            if (
                !in_array(
                    $validatedExtension,
                    $imageExtensions
                )
                &&
                $validatedFile->getSize() >
                    (10 * 1024 * 1024)
            ) {

                return redirect()
                    ->route(
                        'client.projects.index',
                        [
                            'project' => $project->id,
                            'section' => 'messages',
                        ]
                    )
                    ->withErrors([
                        'attachment' =>
                            'Documents cannot be larger than 10 MB.'
                    ])
                    ->withInput();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ARCHITECT CHECK
        |--------------------------------------------------------------------------
        */

        if (!$project->architect_id) {

            return redirect()
                ->route(
                    'client.projects.index',
                    [
                        'project' => $project->id,
                        'section' => 'messages',
                    ]
                )
                ->withErrors([
                    'message' =>
                        'This project has no assigned architect.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ATTACHMENT
        |--------------------------------------------------------------------------
        */

        $attachmentPath = null;
        $attachmentName = null;
        $attachmentType = null;
        $attachmentSize = null;


        if ($request->hasFile('attachment')) {

            $file =
                $request->file('attachment');


            $attachmentName =
                basename(
                    $file->getClientOriginalName()
                );


            $attachmentType =
                strtolower(
                    $file->getClientOriginalExtension()
                );


            $attachmentSize =
                $file->getSize();


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
            | STORE ATTACHMENT PRIVATELY
            |--------------------------------------------------------------------------
            |
            | New client message attachments are stored on the local disk.
            | They should only be opened through the secure attachment routes.
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

                return redirect()
                    ->route(
                        'client.projects.index',
                        [
                            'project' => $project->id,
                            'section' => 'messages',
                        ]
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

        ProjectMessage::create([

            'project_id' =>
                $project->id,

            'sender_id' =>
                auth()->id(),

            'receiver_id' =>
                $project->architect_id,

            'message' =>
                $request->filled('message')
                    ? trim($request->message)
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


        /*
        |--------------------------------------------------------------------------
        | RETURN TO SAME FLOATING CHAT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'client.projects.index',
                [
                    'project' => $project->id,
                    'section' => 'messages',
                ]
            );
    }
}
