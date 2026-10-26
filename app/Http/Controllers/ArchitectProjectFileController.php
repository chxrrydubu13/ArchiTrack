<?php



namespace App\Http\Controllers;



use App\Models\Project;

use App\Models\ProjectFile;

use App\Models\AuditLog;

use App\Notifications\ProjectActivityNotification;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;



class ArchitectProjectFileController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | GET PROJECT WITH ARCHITECT ACCESS

    |--------------------------------------------------------------------------

    |

    | The lead architect and assigned project collaborators can manage

    | project files.

    |

    */



    private function getProjectForArchitect($projectId, array $with = [])
    {
        $user = auth()->user();

        // Archived, suspended/on-hold, or unauthenticated architects cannot
        // manage files, even if they still have an authenticated session.
        abort_unless(
            $user && $user->role === 'architect'
                && strtolower((string) $user->status) === 'active',
            403,
            'Your architect account is not active.'
        );

        // Require a CURRENT, ACTIVE lead architect. This excludes projects
        // whose original lead was archived or permanently deleted, even when
        // the requesting architect remains listed as a collaborator.
        return Project::query()
            ->whereKey($projectId)
            ->whereHas('architect', function ($query) {
                $query->where('role', 'architect')
                    ->where('status', 'active');
            })
            ->where(function ($query) use ($user) {
                $query->where('architect_id', $user->id)
                    ->orWhereHas('projectArchitects', function ($teamQuery) use ($user) {
                        $teamQuery->where('architect_id', $user->id);
                    });
            })
            ->with($with)
            ->firstOrFail();
    }


    /*

    |--------------------------------------------------------------------------

    | UPLOAD NEW FILE

    |--------------------------------------------------------------------------

    */



    /** Upload one or more new project files (100 MB per file). */
    public function store(Request $request, $id)
    {
        $project = $this->getProjectForArchitect($id, ['client']);
        $redirect = route('architect.projects.show', ['id' => $project->id]) . '?tab=files';

        // Support the old single-file form as well as the new multiple-file form.
        $incoming = $request->hasFile('files') ? $request->file('files') :
            ($request->hasFile('file') ? [$request->file('file')] : []);
        if (!is_array($incoming)) {
            $incoming = [$incoming];
        }

        $validator = Validator::make([
            'files' => $incoming,
            'category' => $request->input('category'),
            'description' => $request->input('description'),
        ], [
            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['required', 'file', 'max:102400', 'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx'],
            'category' => ['required', 'in:general,drawing,document,presentation,reference,other'],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'files.required' => 'No files were received. Check PHP upload_max_filesize and post_max_size settings, then try again.',
            'files.*.max' => 'Each file must not exceed 100 MB.',
            'files.*.mimes' => 'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.',
        ]);

        if ($validator->fails()) {
            return redirect()->to($redirect)->withErrors($validator)->withInput();
        }

        $storedPaths = [];
        $createdIds = [];
        $uploadedNames = [];

        try {
            // Save all files first; if one fails, remove the new records and files.
            \Illuminate\Support\Facades\DB::beginTransaction();
            foreach ($incoming as $uploadedFile) {
                $originalName = basename($uploadedFile->getClientOriginalName());
                $extension = strtolower($uploadedFile->getClientOriginalExtension());
                if (!$this->isAllowedExtension($extension)) {
                    throw new \RuntimeException('Unsupported file type: ' . $originalName);
                }
                $fileName = $this->makeFileName($originalName, $extension);
                $path = $uploadedFile->storeAs('projects/' . $project->id, $fileName, 'local');
                if (!$path) {
                    throw new \RuntimeException('Could not save ' . $originalName);
                }
                $storedPaths[] = $path;
                $record = ProjectFile::create([
                    'project_id' => $project->id,
                    'uploaded_by' => auth()->id(),
                    'file_name' => $fileName,
                    'original_name' => $originalName,
                    'file_path' => $path,
                    'file_type' => $extension,
                    'file_size' => $uploadedFile->getSize(),
                    'category' => $request->input('category'),
                    'description' => $request->filled('description') ? trim($request->input('description')) : null,
                    'version_group' => (string) Str::uuid(),
                    'version_number' => 1,
                    'is_latest' => true,
                    'is_archived' => false,
                ]);
                $createdIds[] = $record->id;
                $uploadedNames[] = $originalName;

                AuditLog::create([
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'action' => 'File Uploaded',
                    'project_id' => $project->id,
                    'project_name' => $project->project_name,
                    'details' => 'Architect uploaded file "' . $originalName . '" to project "' . $project->project_name . '".',
                ]);
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Throwable $error) {
            \Illuminate\Support\Facades\DB::rollBack();
            foreach ($storedPaths as $path) {
                try { Storage::disk('local')->delete($path); } catch (\Throwable $ignored) {}
            }
            \Illuminate\Support\Facades\Log::error('Project file upload failed', [
                'project_id' => $project->id, 'error' => $error->getMessage(),
            ]);
            return redirect()->to($redirect)->withErrors([
                'files' => 'Upload failed. Please check the file size and try again.',
            ]);
        }

        // A notification failure must not turn a successful upload into an error.
        if ($project->client) {
            try {
                $project->client->notify(new ProjectActivityNotification(
                    'New Project File',
                    'Your architect uploaded ' . count($uploadedNames) . ' file(s) for ' . $project->project_name . '.',
                    'file', $project->id, route('client.files.index')
                ));
            } catch (\Throwable $error) {
                \Illuminate\Support\Facades\Log::warning('Project file notification failed', [
                    'project_id' => $project->id, 'error' => $error->getMessage(),
                ]);
            }
        }

        return redirect()->to($redirect)->with('success', count($uploadedNames) . ' file(s) uploaded successfully.');
    }

    /*

    |--------------------------------------------------------------------------

    | UPLOAD NEW VERSION

    |--------------------------------------------------------------------------

    */



    public function storeVersion(

        Request $request,

        $id,

        $file

    ) {

        $project =

            $this->getProjectForArchitect(

                $id,

                [

                    'client',

                ]

            );





        $originalFile = ProjectFile::where(

            'id',

            $file

        )

            ->where(

                'project_id',

                $project->id

            )

            ->firstOrFail();





        if (!$originalFile->version_group) {



            $originalFile->update([

                'version_group' =>

                    (string) Str::uuid(),



                'version_number' =>

                    1,



                'is_latest' =>

                    true,

            ]);



            $originalFile->refresh();

        }





        $validator = Validator::make(

            $request->all(),

            [

                'file' => [

                    'required',

                    'file',

                    'max:102400',

                    'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',

                ],



                'description' => [

                    'nullable',

                    'string',

                    'max:500',

                ],

            ],

            [

                'file.required' =>

                    'Please choose the new file version.',



                'file.file' =>

                    'The selected item must be a valid file.',



                'file.max' =>

                    'Each file must not exceed 100 MB.',



                'file.mimes' =>

                    'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.',

            ]

        );





        if ($validator->fails()) {



            return redirect()

                ->to(

                    route(

                        'architect.projects.show',

                        [

                            'id' => $project->id

                        ]

                    ) . '?tab=files'

                )

                ->withErrors($validator);

        }





        $uploadedFile =

            $request->file('file');





        if (!$uploadedFile) {



            return redirect()

                ->to(

                    route(

                        'architect.projects.show',

                        [

                            'id' => $project->id

                        ]

                    ) . '?tab=files'

                )

                ->withErrors([

                    'file' =>

                        'No file was received. Please choose a file again.'

                ]);

        }





        $originalName =

            basename(

                $uploadedFile->getClientOriginalName()

            );



        $extension =

            strtolower(

                $uploadedFile

                    ->getClientOriginalExtension()

            );

if (!$this->isAllowedExtension($extension)) {



            return redirect()

                ->to(

                    route(

                        'architect.projects.show',

                        [

                            'id' => $project->id

                        ]

                    ) . '?tab=files'

                )

                ->withErrors([

                    'file' =>

                        'This file type is not supported.'

                ]);

        }





        $latestVersion =

            ProjectFile::where(

                'project_id',

                $project->id

            )

                ->where(

                    'version_group',

                    $originalFile->version_group

                )

                ->max('version_number');





        $nextVersion =

            ((int) $latestVersion) + 1;





        $fileName =

            $this->makeFileName(

                $originalName,

                $extension

            );





        $path = null;





        try {



            $path =

                $uploadedFile->storeAs(

                    'projects/' . $project->id,

                    $fileName,

                    'local'

                );





            if (!$path) {



                return redirect()

                    ->to(

                        route(

                            'architect.projects.show',

                            [

                                'id' => $project->id

                            ]

                        ) . '?tab=files'

                    )

                    ->withErrors([

                        'file' =>

                            'The new version could not be saved.'

                    ]);

            }





            ProjectFile::where(

                'project_id',

                $project->id

            )

                ->where(

                    'version_group',

                    $originalFile->version_group

                )

                ->update([

                    'is_latest' => false

                ]);





            $newVersionFile =

                ProjectFile::create([



                    'project_id' =>

                        $project->id,



                    'uploaded_by' =>

                        auth()->id(),



                    'file_name' =>

                        $fileName,



                    'original_name' =>

                        $originalName,



                    'file_path' =>

                        $path,



                    'file_type' =>

                        $extension,



                    'file_size' =>

                        $uploadedFile->getSize(),



                    'category' =>

                        $originalFile->category,



                    'description' =>

                        $request->filled('description')

                            ? trim($request->description)

                            : $originalFile->description,



                    'version_group' =>

                        $originalFile->version_group,



                    'version_number' =>

                        $nextVersion,



                    'is_latest' =>

                        true,



                    'is_archived' =>

                        false,



                ]);





            /*

            |--------------------------------------------------------------------------

            | AUDIT LOG - NEW FILE VERSION

            |--------------------------------------------------------------------------

            */



            AuditLog::create([

                'user_id' =>

                    auth()->id(),



                'user_name' =>

                    auth()->user()->name,



                'action' =>

                    'File Version Uploaded',



                'project_id' =>

                    $project->id,



                'project_name' =>

                    $project->project_name,



                'details' =>

                    'Architect uploaded Version '

                    . $nextVersion

                    . ' of "'

                    . $originalName

                    . '" for project "'

                    . $project->project_name

                    . '".',

            ]);





            if ($project->client) {



                $project->client->notify(



                    new ProjectActivityNotification(



                        'New File Version',



                        'Your architect uploaded Version ' .

                        $nextVersion .

                        ' of "' .

                        $originalName .

                        '" for ' .

                        $project->project_name .

                        '.',



                        'file',



                        $project->id,



                        route(

                            'client.files.index'

                        )



                    )



                );

            }



        } catch (\Throwable $error) {



            if (

                $path &&

                (

                    Storage::disk('local')

                        ->exists($path)

                    ||

                    Storage::disk('public')

                        ->exists($path)

                )

            ) {



                if (

                    Storage::disk('local')

                        ->exists($path)

                ) {



                    Storage::disk('local')

                        ->delete($path);

                }



                elseif (

                    Storage::disk('public')

                        ->exists($path)

                ) {



                    Storage::disk('public')

                        ->delete($path);

                }

            }





            $latestExistingFile =

                ProjectFile::where(

                    'project_id',

                    $project->id

                )

                    ->where(

                        'version_group',

                        $originalFile->version_group

                    )

                    ->orderByDesc(

                        'version_number'

                    )

                    ->first();





            if ($latestExistingFile) {



                $latestExistingFile->update([

                    'is_latest' => true

                ]);

            }





            return redirect()

                ->to(

                    route(

                        'architect.projects.show',

                        [

                            'id' => $project->id

                        ]

                    ) . '?tab=files'

                )

                ->withErrors([

                    'file' =>

                        'The new file version could not be uploaded. Please try again.'

                ]);

        }





        return redirect()

            ->to(

                route(

                    'architect.projects.show',

                    [

                        'id' => $project->id

                    ]

                ) . '?tab=files'

            )

            ->with(

                'success',

                'Version ' .

                $nextVersion .

                ' uploaded successfully.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | DOWNLOAD FILE

    |--------------------------------------------------------------------------

    */



    public function download($id, $file)

    {

        $project =

            $this->getProjectForArchitect(

                $id

            );





        $projectFile =

            ProjectFile::where(

                'id',

                $file

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->firstOrFail();





        $disk = null;





        if (

            Storage::disk('local')

                ->exists(

                    $projectFile->file_path

                )

        ) {



            $disk = 'local';

        }



        elseif (

            Storage::disk('public')

                ->exists(

                    $projectFile->file_path

                )

        ) {



            $disk = 'public';

        }





        if (!$disk) {



            return redirect()

                ->to(

                    route(

                        'architect.projects.show',

                        [

                            'id' => $project->id

                        ]

                    ) . '?tab=files'

                )

                ->withErrors([

                    'file' =>

                        'The requested file could not be found.'

                ]);

        }





        AuditLog::create([

            'user_id' =>

                auth()->id(),



            'user_name' =>

                auth()->user()->name,



            'action' =>

                'File Downloaded',



            'project_id' =>

                $project->id,



            'project_name' =>

                $project->project_name,



            'details' =>

                'Architect downloaded file "'

                . $projectFile->original_name

                . '" from project "'

                . $project->project_name

                . '".',

        ]);





        return Storage::disk($disk)

            ->download(

                $projectFile->file_path,

                $projectFile->original_name

            );

    }





    /*

    |--------------------------------------------------------------------------

    | DELETE FILE

    |--------------------------------------------------------------------------

    */



    public function destroy($id, $file)

    {

        $project =

            $this->getProjectForArchitect(

                $id

            );





        $projectFile =

            ProjectFile::where(

                'id',

                $file

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->firstOrFail();





        $deletedFileName =

            $projectFile->original_name;





        $versionGroup =

            $projectFile->version_group;



        $wasLatest =

            $projectFile->is_latest;





        if (

            Storage::disk('local')

                ->exists(

                    $projectFile->file_path

                )

        ) {



            Storage::disk('local')

                ->delete(

                    $projectFile->file_path

                );

        }



        elseif (

            Storage::disk('public')

                ->exists(

                    $projectFile->file_path

                )

        ) {



            Storage::disk('public')

                ->delete(

                    $projectFile->file_path

                );

        }





        $projectFile->delete();





        if (

            $wasLatest &&

            $versionGroup

        ) {



            $previousVersion =

                ProjectFile::where(

                    'project_id',

                    $project->id

                )

                    ->where(

                        'version_group',

                        $versionGroup

                    )

                    ->orderByDesc(

                        'version_number'

                    )

                    ->first();





            if ($previousVersion) {



                $previousVersion->update([

                    'is_latest' => true

                ]);

            }

        }





        /*

        |--------------------------------------------------------------------------

        | AUDIT LOG - FILE DELETED

        |--------------------------------------------------------------------------

        */



        AuditLog::create([

            'user_id' =>

                auth()->id(),



            'user_name' =>

                auth()->user()->name,



            'action' =>

                'File Deleted',



            'project_id' =>

                $project->id,



            'project_name' =>

                $project->project_name,



            'details' =>

                'Architect deleted file "'

                . $deletedFileName

                . '" from project "'

                . $project->project_name

                . '".',

        ]);





        return redirect()

            ->to(

                route(

                    'architect.projects.show',

                    [

                        'id' => $project->id

                    ]

                ) . '?tab=files'

            )

            ->with(

                'success',

                'File deleted successfully.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | ARCHIVE FILE

    |--------------------------------------------------------------------------

    */



    public function archive($id, $file)

    {

        $project =

            $this->getProjectForArchitect(

                $id

            );





        $projectFile =

            ProjectFile::where(

                'id',

                $file

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->firstOrFail();





        $projectFile->update([

            'is_archived' => true

        ]);





        /*

        |--------------------------------------------------------------------------

        | AUDIT LOG - FILE ARCHIVED

        |--------------------------------------------------------------------------

        */



        AuditLog::create([

            'user_id' =>

                auth()->id(),



            'user_name' =>

                auth()->user()->name,



            'action' =>

                'File Archived',



            'project_id' =>

                $project->id,



            'project_name' =>

                $project->project_name,



            'details' =>

                'Architect archived file "'

                . $projectFile->original_name

                . '" in project "'

                . $project->project_name

                . '".',

        ]);





        return redirect()

            ->to(

                route(

                    'architect.projects.show',

                    [

                        'id' => $project->id

                    ]

                ) . '?tab=files'

            )

            ->with(

                'success',

                'File archived successfully.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | RESTORE FILE

    |--------------------------------------------------------------------------

    */



    public function restore($id, $file)

    {

        $project =

            $this->getProjectForArchitect(

                $id

            );





        $projectFile =

            ProjectFile::where(

                'id',

                $file

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->firstOrFail();





        $projectFile->update([

            'is_archived' => false

        ]);





        /*

        |--------------------------------------------------------------------------

        | AUDIT LOG - FILE RESTORED

        |--------------------------------------------------------------------------

        */



        AuditLog::create([

            'user_id' =>

                auth()->id(),



            'user_name' =>

                auth()->user()->name,



            'action' =>

                'File Restored',



            'project_id' =>

                $project->id,



            'project_name' =>

                $project->project_name,



            'details' =>

                'Architect restored file "'

                . $projectFile->original_name

                . '" in project "'

                . $project->project_name

                . '".',

        ]);





        return redirect()

            ->to(

                route(

                    'architect.projects.show',

                    [

                        'id' => $project->id

                    ]

                ) . '?tab=files&view=archived'

            )

            ->with(

                'success',

                'File restored successfully.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | CHECK ALLOWED EXTENSION

    |--------------------------------------------------------------------------

    */



    private function isAllowedExtension($extension)

    {

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





        return in_array(

            strtolower($extension),

            $allowedExtensions,

            true

        );

    }





    /*

    |--------------------------------------------------------------------------

    | CREATE SAFE STORAGE FILE NAME

    |--------------------------------------------------------------------------

    */



    private function makeFileName(

        $originalName,

        $extension

    ) {

        $baseName =

            pathinfo(

                $originalName,

                PATHINFO_FILENAME

            );





        $safeName =

            Str::slug($baseName);





        if (!$safeName) {



            $safeName =

                'project-file';

        }





        return

            time() .

            '_' .

            Str::random(8) .

            '_' .

            $safeName .

            '.' .

            $extension;

    }

}
