<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMessage;
use App\Models\ProjectAIHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientMessagesController extends Controller
{
    public function index(Request $request)
    {
        $client = Auth::user();

        abort_unless($client && $client->role === 'client' && $client->status === 'active', 403);


        /*
        |--------------------------------------------------------------------------
        | GET ALL PROJECTS OF THE LOGGED-IN CLIENT
        |--------------------------------------------------------------------------
        */

        $projects = Project::with([
                'architect',

                'messages' => function ($query) {
                    $query
                        ->with([
                            'sender',
                            'receiver'
                        ])
                        ->orderBy(
                            'created_at',
                            'asc'
                        );
                },
            ])
            ->whereHas('architect', function ($query) {
                $query->where('role', 'architect')->where('status', 'active');
            })
            ->where(
                'client_id',
                $client->id
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BUILD CLIENT CONVERSATIONS
        |--------------------------------------------------------------------------
        |
        | Each project becomes one conversation.
        |
        */

        $conversations = $projects
            ->filter(function ($project) {

                return $project->architect !== null;
            })
            ->sortByDesc(function ($project) {

                $lastMessage = $project
                    ->messages
                    ->sortByDesc('created_at')
                    ->first();

                return $lastMessage
                    ? $lastMessage->created_at
                    : $project->updated_at;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | SELECTED PROJECT
        |--------------------------------------------------------------------------
        */

        $selectedProject = null;


        if ($request->filled('project')) {

            $selectedProject = $conversations
                ->firstWhere(
                    'id',
                    (int) $request->project
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DEFAULT TO FIRST CONVERSATION
        |--------------------------------------------------------------------------
        */

        if (
            !$selectedProject &&
            $conversations->count() > 0
        ) {

            $selectedProject =
                $conversations->first();
        }


        /*
        |--------------------------------------------------------------------------
        | MESSAGES OF SELECTED PROJECT
        |--------------------------------------------------------------------------
        */

        $messages = collect();


        if ($selectedProject) {

            $messages = $selectedProject
                ->messages
                ->sortBy('created_at')
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | AI PROMPT HISTORY
        |--------------------------------------------------------------------------
        |
        | AI history is private to the logged-in client.
        |
        | The client will only see AI prompts and AI results
        | belonging to the currently selected project.
        |
        */

        $aiHistory = collect();


        if ($selectedProject) {

            $aiHistory = ProjectAIHistory::where(
                    'project_id',
                    $selectedProject->id
                )
                ->where(
                    'client_id',
                    $client->id
                )
                ->orderByDesc('created_at')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN CLIENT MESSAGES PAGE
        |--------------------------------------------------------------------------
        */

        return view(
            'client.messages',
            compact(
                'client',
                'conversations',
                'selectedProject',
                'messages',
                'aiHistory'
            )
        );
    }


    public function send(
        Request $request,
        $projectId
    ) {

        $client = Auth::user();

        abort_unless($client && $client->role === 'client' && $client->status === 'active', 403);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | Client can only send messages inside their own project.
        |
        */

        $project = Project::with('architect')
            ->whereHas('architect', function ($query) {
                $query->where('role', 'architect')->where('status', 'active');
            })
            ->where(
                'client_id',
                $client->id
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

        $request->validate([

            'message' =>
                'nullable|string|max:5000',

            'attachment' => [
                'nullable',
                'file',
                'max:102400',
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

                return back()
                    ->withErrors([
                        'attachment' =>
                            'Documents cannot be larger than 10 MB.'
                    ])
                    ->withInput();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REQUIRE MESSAGE OR ATTACHMENT
        |--------------------------------------------------------------------------
        */

        if (
            !$request->filled('message') &&
            !$request->hasFile('attachment')
        ) {

            return back()->withErrors([

                'message' =>
                    'Please enter a message or attach a file.'

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ATTACHMENT VARIABLES
        |--------------------------------------------------------------------------
        */

        $attachmentPath = null;

        $attachmentName = null;

        $attachmentType = null;

        $attachmentSize = null;


        /*
        |--------------------------------------------------------------------------
        | SAVE ATTACHMENT
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachment')) {

            $file =
                $request->file('attachment');


            $attachmentName =
                basename(
                    $file->getClientOriginalName()
                );


            $extension =
                strtolower(
                    $file->getClientOriginalExtension()
                );


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
                . $extension;


            /*
            |--------------------------------------------------------------------------
            | STORE ATTACHMENT PRIVATELY
            |--------------------------------------------------------------------------
            */

            $attachmentPath =
                $file->storeAs(
                    'project-messages/'
                    . $project->id,
                    $storedName,
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
                $client->id,

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

            ]);
        } catch (\Throwable $error) {
            if ($attachmentPath && Storage::disk('local')->exists($attachmentPath)) {
                Storage::disk('local')->delete($attachmentPath);
            }

            return back()->withErrors([
                'message' => 'The message could not be sent. Please try again.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN TO SAME CONVERSATION
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'client.messages.index',
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
