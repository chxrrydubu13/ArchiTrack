<?php

namespace App\Http\Controllers;

use App\Models\Project;

use App\Models\ProjectFile;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class ClientProjectController extends Controller

{
    // Client access is restricted to projects with an active lead architect.
    // Archived, on-hold, and deleted lead accounts leave records Admin-only.


    /*

    |--------------------------------------------------------------------------

    | FIXED PROJECT PHASE WEIGHTS

    |--------------------------------------------------------------------------

    \\*/

    private function phaseWeights()

    {

        return [

            1 => 5,

            2 => 5,

            3 => 10,

            4 => 15,

            5 => 10,

            6 => 10,

            7 => 10,

            8 => 20,

            9 => 10,

            10 => 5,

        ];

    }

    /*

    |--------------------------------------------------------------------------

    | SYNC PROJECT PROGRESS

    |--------------------------------------------------------------------------

    |

    | Project progress is based ONLY on completed phases.

    |

    | Planning                         = 10%

    | Initial Design                   = 15%

    | Detailed Design & Prototyping    = 20%

    | Development & Construction       = 30%

    | Testing & Quality Assurance      = 15%

    | Deployment & Maintenance         = 10%

    |

    \\*/

    private function syncProjectProgress(

        Project $project

    ) {

        $weights =

            $this->phaseWeights();

        /*

        |--------------------------------------------------------------------------

        | GET COMPLETED PHASES

        |--------------------------------------------------------------------------

        \\*/

        $completedPhases =

            $project

                ->phases

                ->where(

                    'status',

                    'completed'

                );

        /*

        |--------------------------------------------------------------------------

        | CALCULATE PROGRESS

        |--------------------------------------------------------------------------

        \\*/

        $progress =

            0;

        foreach (

            $completedPhases

            as $phase

        ) {

            $progress +=

                $weights[

                    $phase->phase_order

                ]

                ?? 0;

        }

        $progress =

            min(

                max(

                    $progress,

                    0

                ),

                100

            );

        /*

        |--------------------------------------------------------------------------

        | UPDATE PROJECT ONLY IF NEEDED

        |--------------------------------------------------------------------------

        \\*/

        if (

            (int) $project->progress

            !==

            (int) $progress

        ) {

            $project->progress =

                $progress;

            /*

            |--------------------------------------------------------------------------

            | KEEP PROJECT STATUS CONSISTENT

            |--------------------------------------------------------------------------

            \\*/

            if (

                $progress >=

                100

            ) {

                $project->status =

                    'completed';

            } elseif (

                $project

                    ->phases

                    ->contains(

                        function ($phase) {

                            return

                                $phase->status

                                ===

                                'in_progress';

                        }

                    )

            ) {

                $project->status =

                    'ongoing';

            } elseif (

                $progress >

                0

            ) {

                $project->status =

                    'ongoing';

            } else {

                $project->status =

                    'planning';

            }

            $project->save();

        }

        /*

        |--------------------------------------------------------------------------

        | UPDATE MODEL VALUE IN MEMORY

        |--------------------------------------------------------------------------

        \\*/

        $project->progress =

            $progress;

        return $project;

    }

    /*

    |--------------------------------------------------------------------------

    | CLIENT PROJECT LIST

    |--------------------------------------------------------------------------

    \\*/

    public function index(Request $request)

    {

        $user =

            Auth::user();

        /*

        |--------------------------------------------------------------------------

        | LOAD CLIENT PROJECTS

        |--------------------------------------------------------------------------

        \\*/

        $projects =

            Project::where(

                'client_id',

                $user->id

            )
                ->whereHas('architect', function ($architectQuery) {
                    $architectQuery->where('role', 'architect')
                        ->where('status', 'active');
                })

                ->with([

                    'architect',

                    'files',

                    'revisions',

                    'meetings',

                    'messages',

                    'phases.milestones.completedBy',

                    'phases.completedBy',

                ])

                ->orderByDesc(

                    'created_at'

                )

                ->get();

        /*

        |--------------------------------------------------------------------------

        | SYNC PROGRESS OF EVERY PROJECT

        |--------------------------------------------------------------------------

        \\*/

        $projects->each(

            function ($project) {

                $this->syncProjectProgress(

                    $project

                );

            }

        );

        /*

        |--------------------------------------------------------------------------

        | SELECTED PROJECT

        |--------------------------------------------------------------------------

        \\*/

        $selectedProject =

            null;

        if (

            $request->filled(

                'project'

            )

        ) {

            $selectedProject =

                Project::where(

                    'client_id',

                    $user->id

                )
                ->whereHas('architect', function ($architectQuery) {
                    $architectQuery->where('role', 'architect')
                        ->where('status', 'active');
                })

                    ->where(

                        'id',

                        $request->project

                    )

                    ->with([

                        'architect',

                        'files',

                        'revisions',

                        'meetings',

                        'messages',

                        'phases.milestones.completedBy',

                        'phases.completedBy',

                    ])

                    ->first();

            /*

            |--------------------------------------------------------------------------

            | SYNC SELECTED PROJECT PROGRESS

            |--------------------------------------------------------------------------

            \\*/

            if ($selectedProject) {

                $this->syncProjectProgress(

                    $selectedProject

                );

                /*

                |--------------------------------------------------------------------------

                | REFRESH BUT KEEP RELATIONSHIPS LOADED

                |--------------------------------------------------------------------------

                \\*/

                $selectedProject->refresh();

                $selectedProject->load([

                    'architect',

                    'files',

                    'revisions',

                    'meetings',

                    'messages',

                    'phases.milestones.completedBy',

                    'phases.completedBy',

                ]);

            }

        }

        return view(

            'client.projects',

            compact(

                'projects',

                'selectedProject'

            )

        );

    }

    /*

    |--------------------------------------------------------------------------

    | VIEW PROJECT FILE

    |--------------------------------------------------------------------------

    \\*/

    public function viewFile(

        $id,

        $file

    )

    {

        /*

        |--------------------------------------------------------------------------

        | CHECK PROJECT OWNERSHIP

        |--------------------------------------------------------------------------

        \\*/

        $project =

            Project::where(

                'client_id',

                Auth::id()

            )
                ->whereHas('architect', function ($architectQuery) {
                    $architectQuery->where('role', 'architect')
                        ->where('status', 'active');
                })

                ->where(

                    'id',

                    $id

                )

                ->firstOrFail();

        /*

        |--------------------------------------------------------------------------

        | CHECK FILE

        |--------------------------------------------------------------------------

        \\*/

        $projectFile =

            ProjectFile::where(

                'id',

                $file

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->where(

                    'is_archived',

                    false

                )

                ->firstOrFail();

        /*

        |--------------------------------------------------------------------------

        | CHECK PHYSICAL FILE

        |--------------------------------------------------------------------------

        \\*/

        if (

            !$projectFile->file_path

            ||

            !Storage::disk(

                'public'

            )

                ->exists(

                    $projectFile->file_path

                )

        ) {

            abort(

                404,

                'File not found.'

            );

        }

        /*

        |--------------------------------------------------------------------------

        | GET FILE INFORMATION

        |--------------------------------------------------------------------------

        \\*/

        $path =

            Storage::disk(

                'public'

            )

                ->path(

                    $projectFile->file_path

                );

        $mimeType =

            Storage::disk(

                'public'

            )

                ->mimeType(

                    $projectFile->file_path

                );

        /*

        |--------------------------------------------------------------------------

        | DISPLAY FILE

        |--------------------------------------------------------------------------

        \\*/

        return response()->file(

            $path,

            [

                'Content-Type' =>

                    $mimeType

                    ?: 'application/octet-stream',

                'Content-Disposition' =>

                    'inline; filename="'

                    . addslashes(

                        $projectFile->original_name

                    )

                    . '"',

            ]

        );

    }

    /*

    |--------------------------------------------------------------------------

    | DOWNLOAD PROJECT FILE

    |--------------------------------------------------------------------------

    \\*/

    public function downloadFile(

        $id,

        $file

    )

    {

        /*

        |--------------------------------------------------------------------------

        | CHECK PROJECT OWNERSHIP

        |--------------------------------------------------------------------------

        \\*/

        $project =

            Project::where(

                'client_id',

                Auth::id()

            )
                ->whereHas('architect', function ($architectQuery) {
                    $architectQuery->where('role', 'architect')
                        ->where('status', 'active');
                })

                ->where(

                    'id',

                    $id

                )

                ->firstOrFail();

        /*

        |--------------------------------------------------------------------------

        | CHECK FILE

        |--------------------------------------------------------------------------

        \\*/

        $projectFile =

            ProjectFile::where(

                'id',

                $file

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->where(

                    'is_archived',

                    false

                )

                ->firstOrFail();

        /*

        |--------------------------------------------------------------------------

        | CHECK PHYSICAL FILE

        |--------------------------------------------------------------------------

        \\*/

        if (

            !$projectFile->file_path

            ||

            !Storage::disk(

                'public'

            )

                ->exists(

                    $projectFile->file_path

                )

        ) {

            abort(

                404,

                'File not found.'

            );

        }

        /*

        |--------------------------------------------------------------------------

        | DOWNLOAD FILE

        |--------------------------------------------------------------------------

        \\*/

        return Storage::disk(

            'public'

        )

            ->download(

                $projectFile->file_path,

                $projectFile->original_name

            );

    }

    /*

    |--------------------------------------------------------------------------

    | ARCHITECT LIVE PRESENCE

    |--------------------------------------------------------------------------

    \\*/

    public function presence($id)

    {

        /*

        |--------------------------------------------------------------------------

        | CLIENT CAN ONLY ACCESS THEIR PROJECT

        |--------------------------------------------------------------------------

        \\*/

        $project =

            Project::where(

                'client_id',

                Auth::id()

            )
                ->whereHas('architect', function ($architectQuery) {
                    $architectQuery->where('role', 'architect')
                        ->where('status', 'active');
                })

                ->where(

                    'id',

                    $id

                )

                ->with(

                    'architect'

                )

                ->firstOrFail();

        /*

        |--------------------------------------------------------------------------

        | GET ARCHITECT

        |--------------------------------------------------------------------------

        \\*/

        $architect =

            $project->architect;

        /*

        |--------------------------------------------------------------------------

        | NO ARCHITECT

        |--------------------------------------------------------------------------

        \\*/

        if (!$architect) {

            return response()->json([

                'status' =>

                    'away',

            ]);

        }

        /*

        |--------------------------------------------------------------------------

        | DEFAULT STATUS

        |--------------------------------------------------------------------------

        \\*/

        $status =

            $architect->presence_status

            ??

            'away';

        /*

        |--------------------------------------------------------------------------

        | VALID STATUS

        |--------------------------------------------------------------------------

        \\*/

        if (

            !in_array(

                $status,

                [

                    'online',

                    'idle',

                    'away',

                ]

            )

        ) {

            $status =

                'away';

        }

        /*

        |--------------------------------------------------------------------------

        | HEARTBEAT CHECK

        |--------------------------------------------------------------------------

        \\*/

        if (

            !$architect->last_seen_at

        ) {

            $status =

                'away';

        } elseif (

            $architect

                ->last_seen_at

                ->lt(

                    now()

                        ->subSeconds(

                            90

                        )

                )

        ) {

            $status =

                'away';

        }

        /*

        |--------------------------------------------------------------------------

        | RETURN PRESENCE

        |--------------------------------------------------------------------------

        \\*/

        return response()->json([

            'status' =>

                $status,

        ]);

    }

}