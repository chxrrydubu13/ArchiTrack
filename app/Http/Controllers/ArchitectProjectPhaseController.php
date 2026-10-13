<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Project;
use App\Models\ProjectPhase;
use App\Notifications\ProjectActivityNotification;
use Illuminate\Http\Request;

class ArchitectProjectPhaseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET PROJECT WITH ARCHITECT ACCESS
    |--------------------------------------------------------------------------
    |
    | The lead architect and assigned project collaborators can work
    | on the project's phases.
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
    | STANDARD PROJECT PHASES
    |--------------------------------------------------------------------------
    */

    private function standardPhases()
    {
        return [
            1 => [
                'name' => 'Consultation',

                'description' =>
                    'Initial client consultation, project discussion, needs assessment, site concerns, and project expectations.',
            ],

            2 => [
                'name' => 'Agreement',

                'description' =>
                    'Finalization of project scope, responsibilities, service terms, agreements, and project requirements.',
            ],

            3 => [
                'name' => 'Planning',

                'description' =>
                    'Project planning, site considerations, objectives, requirements, schedules, and initial project direction.',
            ],

            4 => [
                'name' => 'Design',

                'description' =>
                    'Preparation and refinement of architectural concepts, layouts, drawings, and design solutions.',
            ],

            5 => [
                'name' => 'Approval',

                'description' =>
                    'Client review, design approval, required revisions, and confirmation of the approved project direction.',
            ],

            6 => [
                'name' => 'Development',

                'description' =>
                    'Development of detailed plans, technical drawings, specifications, coordination, and construction documents.',
            ],

            7 => [
                'name' => 'Permits',

                'description' =>
                    'Preparation, submission, monitoring, and completion of required permits and regulatory documents.',
            ],

            8 => [
                'name' => 'Construction',

                'description' =>
                    'Construction implementation, site coordination, monitoring, and execution of the approved plans.',
            ],

            9 => [
                'name' => 'Inspection',

                'description' =>
                    'Site inspection, quality checking, corrections, final verification, and completion review.',
            ],

            10 => [
                'name' => 'Turnover',

                'description' =>
                    'Final project turnover, completion documentation, client handover, and closing of project requirements.',
            ],
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE / SYNC STANDARD PHASES
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        $projectId
    ) {
        /*
        |--------------------------------------------------------------------------
        | PROJECT OWNERSHIP
        |--------------------------------------------------------------------------
        */

        $project =
            $this->getProjectForArchitect(
                $projectId
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE OR UPDATE ALL TEN PHASES
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->standardPhases()
            as $order => $phaseData
        ) {

            $phase =
                ProjectPhase::where(
                    'project_id',
                    $project->id
                )
                    ->where(
                        'phase_order',
                        $order
                    )
                    ->first();


            if ($phase) {

                $phase->phase_name =
                    $phaseData['name'];

                $phase->description =
                    $phaseData['description'];

                $phase->save();

                continue;
            }


            ProjectPhase::create([
                'project_id' =>
                    $project->id,

                'phase_name' =>
                    $phaseData['name'],

                'description' =>
                    $phaseData['description'],

                'status' =>
                    'pending',

                'phase_order' =>
                    $order,

                'start_date' =>
                    null,

                'target_date' =>
                    null,

                'completed_date' =>
                    null,

                'completion_note' =>
                    null,

                'completed_by' =>
                    null,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RECALCULATE PROJECT PROGRESS
        |--------------------------------------------------------------------------
        */

        $this->updateProjectProgress(
            $project
        );


        /*
        |--------------------------------------------------------------------------
        | AUDIT
        |--------------------------------------------------------------------------
        */

        AuditLog::create([
            'user_id' =>
                auth()->id(),

            'user_name' =>
                auth()->user()->name,

            'action' =>
                'Project Phases Initialized',

            'project_id' =>
                $project->id,

            'project_name' =>
                $project->project_name,

            'details' =>
                'The standard ten project phases were prepared for project "'
                . $project->project_name
                . '".',
        ]);


        return back()->with(
            'success',
            'Standard project phases are ready.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROJECT PHASE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $projectId,
        $phaseId
    ) {
        /*
        |--------------------------------------------------------------------------
        | PROJECT
        |--------------------------------------------------------------------------
        */

        $project =
            $this->getProjectForArchitect(
                $projectId,
                [
                    'client',
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | PHASE
        |--------------------------------------------------------------------------
        */

        $phase =
            ProjectPhase::where(
                'id',
                $phaseId
            )
                ->where(
                    'project_id',
                    $project->id
                )
                ->with([
                    'milestones',
                    'completedBy',
                ])
                ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATE STATUS
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'status' => [
                'required',
                'in:pending,in_progress,completed',
            ],
        ]);


        $oldStatus =
            $phase->status;


        /*
        |--------------------------------------------------------------------------
        | COMPLETED PHASE CANNOT BE REOPENED
        |--------------------------------------------------------------------------
        */

        if (
            $oldStatus ===
            'completed'
            &&
            $request->status !==
            'completed'
        ) {

            return back()->withErrors([
                'phase' =>
                    'A completed project phase cannot be reopened.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK PREVIOUS PHASES
        |--------------------------------------------------------------------------
        */

        $previousPhases =
            ProjectPhase::where(
                'project_id',
                $project->id
            )
                ->where(
                    'phase_order',
                    '<',
                    $phase->phase_order
                )
                ->orderBy(
                    'phase_order'
                )
                ->get();


        $allPreviousCompleted =
            $previousPhases
                ->every(
                    function ($previousPhase) {

                        return
                            $previousPhase->status
                            ===
                            'completed';
                    }
                );


        /*
        |--------------------------------------------------------------------------
        | BLOCK PHASE SKIPPING
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $request->status,
                [
                    'in_progress',
                    'completed',
                ]
            )
            &&
            !$allPreviousCompleted
        ) {

            return back()->withErrors([
                'phase' =>
                    'Complete all previous project phases before continuing to this phase.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | START PHASE
        |--------------------------------------------------------------------------
        */

        if (
            $request->status ===
            'in_progress'
        ) {

            /*
            |--------------------------------------------------------------------------
            | ONLY ONE ACTIVE PHASE
            |--------------------------------------------------------------------------
            */

            $otherCurrentPhase =
                ProjectPhase::where(
                    'project_id',
                    $project->id
                )
                    ->where(
                        'id',
                        '!=',
                        $phase->id
                    )
                    ->where(
                        'status',
                        'in_progress'
                    )
                    ->first();


            if ($otherCurrentPhase) {

                return back()->withErrors([
                    'phase' =>
                        'Complete the current phase "'
                        . $otherCurrentPhase->phase_name
                        . '" before starting another phase.'
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | DO NOT START COMPLETED PHASE
            |--------------------------------------------------------------------------
            */

            if (
                $phase->status ===
                'completed'
            ) {

                return back()->withErrors([
                    'phase' =>
                        'This project phase has already been completed.'
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE PHASE
            |--------------------------------------------------------------------------
            */

            $phase->status =
                'in_progress';


            if (
                !$phase->start_date
            ) {

                $phase->start_date =
                    now()->toDateString();
            }


            $phase->save();


            /*
            |--------------------------------------------------------------------------
            | UPDATE PROJECT
            |--------------------------------------------------------------------------
            */

            $this->updateProjectProgress(
                $project
            );


            $project->refresh();


            /*
            |--------------------------------------------------------------------------
            | AUDIT
            |--------------------------------------------------------------------------
            */

            if (
                $oldStatus !==
                $phase->status
            ) {

                AuditLog::create([
                    'user_id' =>
                        auth()->id(),

                    'user_name' =>
                        auth()->user()->name,

                    'action' =>
                        'Project Phase Started',

                    'project_id' =>
                        $project->id,

                    'project_name' =>
                        $project->project_name,

                    'details' =>
                        'Architect started the "'
                        . $phase->phase_name
                        . '" phase for project "'
                        . $project->project_name
                        . '".',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | CLIENT NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if (
                $project->client
                &&
                $oldStatus !==
                $phase->status
            ) {

                $project->client->notify(

                    new ProjectActivityNotification(

                        'Project Phase Started',

                        'Your project is now in the "'
                        . $phase->phase_name
                        . '" phase.',

                        'general',

                        $project->id,

                        route(
                            'client.projects.index',
                            [
                                'project' =>
                                    $project->id,

                                'section' =>
                                    'phases',
                            ]
                        )

                    )

                );
            }


            return back()->with(
                'success',
                $phase->phase_name
                . ' is now the current project phase.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | COMPLETE PHASE
        |--------------------------------------------------------------------------
        */

        if (
            $request->status ===
            'completed'
        ) {

            /*
            |--------------------------------------------------------------------------
            | PHASE MUST BE IN PROGRESS FIRST
            |--------------------------------------------------------------------------
            */

            if (
                $oldStatus !==
                'in_progress'
            ) {

                return back()->withErrors([
                    'phase' =>
                        'Start this phase first before marking it as completed.'
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | PHASE COMPLETION NOTE
            |--------------------------------------------------------------------------
            */

            $request->validate([
                'completion_note' => [
                    'required',
                    'string',
                    'min:10',
                    'max:3000',
                ],
            ], [
                'completion_note.required' =>
                    'Please add a phase completion note.',

                'completion_note.min' =>
                    'The phase completion note must contain at least 10 characters.',

                'completion_note.max' =>
                    'The phase completion note must not exceed 3000 characters.',
            ]);


            /*
            |--------------------------------------------------------------------------
            | GET MILESTONES
            |--------------------------------------------------------------------------
            */

            $milestones =
                $phase->milestones;


            /*
            |--------------------------------------------------------------------------
            | REQUIRE AT LEAST ONE MILESTONE
            |--------------------------------------------------------------------------
            */

            if (
                $milestones->count()
                <
                1
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'phase' =>
                            'Add at least one milestone before completing this phase.'
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | CHECK EACH MILESTONE
            |--------------------------------------------------------------------------
            |
            | Every milestone must:
            | - be completed
            | - have a completion report
            | - have supporting proof
            | - have completed_by
            | - have completed_at
            |
            */

            foreach (
                $milestones
                as $milestone
            ) {

                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                if (
                    $milestone->status !==
                    'completed'
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'phase' =>
                                'Complete the milestone "'
                                . $milestone->milestone_name
                                . '" before completing this phase.'
                        ]);
                }


                /*
                |--------------------------------------------------------------------------
                | REPORT
                |--------------------------------------------------------------------------
                */

                if (
                    empty(
                        trim(
                            (string)
                            $milestone->completion_report
                        )
                    )
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'phase' =>
                                'The milestone "'
                                . $milestone->milestone_name
                                . '" is missing its completion report.'
                        ]);
                }


                /*
                |--------------------------------------------------------------------------
                | PROOF
                |--------------------------------------------------------------------------
                */

                if (
                    empty(
                        $milestone->proof_file
                    )
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'phase' =>
                                'The milestone "'
                                . $milestone->milestone_name
                                . '" is missing supporting proof.'
                        ]);
                }


                /*
                |--------------------------------------------------------------------------
                | COMPLETED BY
                |--------------------------------------------------------------------------
                */

                if (
                    empty(
                        $milestone->completed_by
                    )
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'phase' =>
                                'The milestone "'
                                . $milestone->milestone_name
                                . '" does not have a recorded architect completion.'
                        ]);
                }


                /*
                |--------------------------------------------------------------------------
                | COMPLETED TIME
                |--------------------------------------------------------------------------
                */

                if (
                    empty(
                        $milestone->completed_at
                    )
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'phase' =>
                                'The milestone "'
                                . $milestone->milestone_name
                                . '" does not have a recorded completion date.'
                        ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | COMPLETE PHASE
            |--------------------------------------------------------------------------
            */

            $phase->status =
                'completed';


            $phase->completion_note =
                trim(
                    $request->completion_note
                );


            $phase->completed_by =
                auth()->id();


            $phase->completed_date =
                now()->toDateString();


            if (
                !$phase->start_date
            ) {

                $phase->start_date =
                    now()->toDateString();
            }


            $phase->save();


            /*
            |--------------------------------------------------------------------------
            | UPDATE PROJECT PROGRESS
            |--------------------------------------------------------------------------
            */

            $this->updateProjectProgress(
                $project
            );


            $project->refresh();


            /*
            |--------------------------------------------------------------------------
            | AUDIT LOG
            |--------------------------------------------------------------------------
            */

            AuditLog::create([
                'user_id' =>
                    auth()->id(),

                'user_name' =>
                    auth()->user()->name,

                'action' =>
                    'Project Phase Completed',

                'project_id' =>
                    $project->id,

                'project_name' =>
                    $project->project_name,

                'details' =>
                    'Architect completed the "'
                    . $phase->phase_name
                    . '" phase after verifying '
                    . $milestones->count()
                    . ' milestone(s) with accomplishment reports and supporting proof. Overall project progress is now '
                    . $project->progress
                    . '%.',
            ]);


            /*
            |--------------------------------------------------------------------------
            | CLIENT NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if (
                $project->client
            ) {

                $project->client->notify(

                    new ProjectActivityNotification(

                        'Project Phase Completed',

                        'The "'
                        . $phase->phase_name
                        . '" phase of '
                        . $project->project_name
                        . ' has been completed. Project progress is now '
                        . $project->progress
                        . '%.',

                        'general',

                        $project->id,

                        route(
                            'client.projects.index',
                            [
                                'project' =>
                                    $project->id,

                                'section' =>
                                    'phases',
                            ]
                        )

                    )

                );
            }


            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            if (
                $project->progress >=
                100
            ) {

                return back()->with(
                    'success',
                    $phase->phase_name
                    . ' completed. All project phases are now complete.'
                );
            }


            return back()->with(
                'success',
                $phase->phase_name
                . ' completed successfully. Project progress is now '
                . $project->progress
                . '%. The next phase is now available.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DO NOT ALLOW MANUAL RETURN TO PENDING
        |--------------------------------------------------------------------------
        */

        if (
            $request->status ===
            'pending'
        ) {

            return back()->withErrors([
                'phase' =>
                    'Phase status cannot be manually returned to Pending.'
            ]);
        }


        return back()->with(
            'success',
            'Project phase updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROJECT PROGRESS
    |--------------------------------------------------------------------------
    */

    private function updateProjectProgress(
        Project $project
    ) {
        /*
        |--------------------------------------------------------------------------
        | FIXED PHASE WEIGHTS
        |--------------------------------------------------------------------------
        */

        $weights = [
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


        /*
        |--------------------------------------------------------------------------
        | COMPLETED PHASES
        |--------------------------------------------------------------------------
        */

        $completedPhases =
            ProjectPhase::where(
                'project_id',
                $project->id
            )
                ->where(
                    'status',
                    'completed'
                )
                ->get();


        /*
        |--------------------------------------------------------------------------
        | CALCULATE PROGRESS
        |--------------------------------------------------------------------------
        */

        $progress =
            0;


        foreach (
            $completedPhases
            as $completedPhase
        ) {

            $progress +=
                $weights[
                    $completedPhase->phase_order
                ]
                ?? 0;
        }


        $progress =
            min(
                $progress,
                100
            );


        /*
        |--------------------------------------------------------------------------
        | SAVE PROGRESS
        |--------------------------------------------------------------------------
        */

        $project->progress =
            $progress;


        /*
        |--------------------------------------------------------------------------
        | PROJECT STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $progress >=
            100
        ) {

            $project->status =
                'completed';

        } elseif (
            ProjectPhase::where(
                'project_id',
                $project->id
            )
                ->where(
                    'status',
                    'in_progress'
                )
                ->exists()
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
}