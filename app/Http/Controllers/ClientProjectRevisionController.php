<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectRevision;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClientProjectRevisionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STORE CLIENT REVISION
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | CHECK PROJECT OWNERSHIP
        |--------------------------------------------------------------------------
        */

        abort_unless(Auth::user()?->role === 'client' && Auth::user()?->status === 'active', 403);

        $project = Project::where('id', $id)
            ->where('client_id', Auth::id())
            ->whereHas('architect', function ($query) {
                $query->where('role', 'architect')->where('status', 'active');
            })
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATE REVISION
        |--------------------------------------------------------------------------
        */

        $request->validate(
            [
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'required',
                    'string',
                    'max:5000',
                ],

                'revision_category' => [
                    'nullable',
                    'string',
                    Rule::in([
                        'Layout',
                        'Exterior',
                        'Interior',
                        'Materials',
                        'Furniture',
                        'Lighting',
                        'Other',
                    ]),
                ],

                /*
                |--------------------------------------------------------------------------
                | AI STRUCTURED FEEDBACK
                |--------------------------------------------------------------------------
                */

                'ai_structured_feedback' => [
                    'nullable',
                    'string',
                    'max:8000',
                ],

                'used_ai' => [
                    'nullable',
                    'boolean',
                ],

                /*
                |--------------------------------------------------------------------------
                | ATTACHMENT
                |--------------------------------------------------------------------------
                |
                | Allowed:
                | JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, XLSX
                |
                | Maximum file size:
                | 10 MB
                |
                */

                'attachment' => [
                    'nullable',
                    'file',
                    'max:102400',
                    'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
                ],
            ],
            [
                'title.required' =>
                    'Please enter a revision title.',

                'title.max' =>
                    'The revision title cannot exceed 255 characters.',

                'description.required' =>
                    'Please enter your revision request.',

                'description.max' =>
                    'The revision description cannot exceed 5,000 characters.',

                'revision_category.in' =>
                    'Please select a valid revision category.',

                'attachment.file' =>
                    'The attachment must be a valid file.',

                'attachment.max' =>
                    'Images can be up to 100 MB. Documents can be up to 10 MB.',

                'attachment.mimes' =>
                    'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK IF AI WAS ACTUALLY USED
        |--------------------------------------------------------------------------
        |
        | We only save used_ai = true when:
        |
        | 1. The form says AI was used
        | 2. There is an actual reviewed AI structured result
        |
        */

        $usedAI =
            $request->boolean('used_ai')
            &&
            $request->filled(
                'ai_structured_feedback'
            );


        $aiStructuredFeedback =
            $usedAI
                ? trim(
                    $request
                        ->ai_structured_feedback
                )
                : null;


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

            $file = $request->file('attachment');


            /*
            |--------------------------------------------------------------------------
            | SAFE ORIGINAL NAME
            |--------------------------------------------------------------------------
            */

            $attachmentName =
                basename(
                    $file->getClientOriginalName()
                );


            $attachmentType =
                strtolower(
                    $file
                        ->getClientOriginalExtension()
                );


            $attachmentSize =
                $file->getSize();


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

                return back()
                    ->withErrors([
                        'attachment' =>
                            'Documents cannot be larger than 10 MB.'
                    ])
                    ->withInput();
            }


            /*
            |--------------------------------------------------------------------------
            | SECOND EXTENSION CHECK
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

                return back()
                    ->withErrors([
                        'attachment' =>
                            'This attachment type is not allowed.'
                    ])
                    ->withInput();
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE SAFE FILE NAME
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
                    'revision-reference';

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
            */

            $attachmentPath =
                $file->storeAs(
                    'project-revisions/'
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

        }


        /*
        |--------------------------------------------------------------------------
        | CREATE REVISION
        |--------------------------------------------------------------------------
        */

        try {
            $revision =
            ProjectRevision::create([

                'project_id' =>
                    $project->id,

                'client_id' =>
                    Auth::id(),


                /*
                |--------------------------------------------------------------------------
                | ORIGINAL CLIENT REQUEST
                |--------------------------------------------------------------------------
                */

                'title' =>
                    trim(
                        $request->title
                    ),


                'description' =>
                    trim(
                        $request->description
                    ),


                'revision_category' =>
                    $request->filled(
                        'revision_category'
                    )
                        ? trim(
                            $request
                                ->revision_category
                        )
                        : null,


                /*
                |--------------------------------------------------------------------------
                | ATTACHMENT
                |--------------------------------------------------------------------------
                */

                'attachment_path' =>
                    $attachmentPath,

                'attachment_name' =>
                    $attachmentName,

                'attachment_type' =>
                    $attachmentType,

                'attachment_size' =>
                    $attachmentSize,


                /*
                |--------------------------------------------------------------------------
                | AI STRUCTURED REVISION
                |--------------------------------------------------------------------------
                */

                'ai_structured_feedback' =>
                    $aiStructuredFeedback,

                'used_ai' =>
                    $usedAI,


                /*
                |--------------------------------------------------------------------------
                | REVISION STATUS
                |--------------------------------------------------------------------------
                */

                'status' =>
                    'pending',

                'architect_response' =>
                    null,

                'resolved_at' =>
                    null,

            ]);
        } catch (\Throwable $error) {
            if ($attachmentPath && Storage::disk('local')->exists($attachmentPath)) {
                Storage::disk('local')->delete($attachmentPath);
            }

            report($error);
            return back()->withErrors([
                'description' => 'The revision could not be submitted. Please try again.',
            ])->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN TO PROJECT REVISIONS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->to(
                route(
                    'client.projects.index',
                    [
                        'project' =>
                            $project->id,

                        'section' =>
                            'revisions',
                    ]
                )
                . '#revision-'
                . $revision->id
            )
            ->with(
                'success',
                $usedAI
                    ? 'AI-assisted revision request submitted successfully.'
                    : 'Revision request submitted successfully.'
            );
    }
}
