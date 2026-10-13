<?php



namespace App\Http\Controllers;



use App\Models\AuditLog;

use App\Models\Project;

use App\Models\ProjectPhase;

use App\Models\ProjectMilestone;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;



class ArchitectProjectMilestoneController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | GET PROJECT WITH ARCHITECT ACCESS

    |--------------------------------------------------------------------------

    |

    | The lead architect and assigned project collaborators can work

    | on milestones under this project.

    |

    */



    private function getProjectForArchitect($projectId)

    {

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

            ->firstOrFail();

    }





    /*

    |--------------------------------------------------------------------------

    | CREATE MILESTONE

    |--------------------------------------------------------------------------

    */



    public function store(

        Request $request,

        $projectId,

        $phaseId

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

        | PHASE OWNERSHIP

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

                ->firstOrFail();





        /*

        |--------------------------------------------------------------------------

        | VALIDATION

        |--------------------------------------------------------------------------

        */



        $request->validate([

            'milestone_name' => [

                'required',

                'string',

                'min:3',

                'max:255',

            ],



            'description' => [

                'nullable',

                'string',

                'max:2000',

            ],



            'status' => [

                'required',

                'in:pending,in_progress',

            ],



            'target_date' => [

                'nullable',

                'date',

            ],

        ], [

            'milestone_name.required' =>

                'Please enter a milestone name.',



            'milestone_name.min' =>

                'The milestone name must contain at least 3 characters.',



            'status.in' =>

                'A new milestone can only start as Pending or In Progress.',

        ]);

        /*
        |--------------------------------------------------------------------------
        | PENDING PHASE MILESTONES MUST ALSO START AS PENDING
        |--------------------------------------------------------------------------
        |
        | Milestones may be prepared while the parent phase is still Pending,
        | but they cannot begin work until the phase itself has started.
        |
        */

        if (
            $phase->status === 'pending'
            &&
            $request->status !== 'pending'
        ) {
            return back()
                ->withErrors([
                    'milestone' =>
                        'A milestone under a pending phase must also start as Pending. Start the project phase first before setting the milestone to In Progress.',
                ])
                ->withInput();
        }







        /*

        |--------------------------------------------------------------------------

        | BLOCK MILESTONE ON LOCKED / COMPLETED PHASE

        |--------------------------------------------------------------------------

        */



        if (

            $phase->status ===

            'completed'

        ) {



            return back()->withErrors([

                'milestone' =>

                    'You cannot add a milestone to a completed project phase.'

            ]);

        }





        /*

        |--------------------------------------------------------------------------

        | GET NEXT MILESTONE ORDER

        |--------------------------------------------------------------------------

        */



        $lastOrder =

            ProjectMilestone::where(

                'project_phase_id',

                $phase->id

            )

                ->max(

                    'milestone_order'

                );





        $nextOrder =

            ($lastOrder ?? 0)

            +

            1;





        /*

        |--------------------------------------------------------------------------

        | CREATE MILESTONE

        |--------------------------------------------------------------------------

        */



        $milestone =

            ProjectMilestone::create([

                'project_phase_id' =>

                    $phase->id,



                'milestone_name' =>

                    trim(

                        $request->milestone_name

                    ),



                'description' =>

                    $request->filled(

                        'description'

                    )

                        ? trim(

                            $request->description

                        )

                        : null,



                'status' =>

                    $request->status,



                'milestone_order' =>

                    $nextOrder,



                'target_date' =>

                    $request->target_date,



                'completed_date' =>

                    null,



                'completion_report' =>

                    null,



                'proof_file' =>

                    null,



                'proof_file_name' =>

                    null,



                'completed_by' =>

                    null,



                'completed_at' =>

                    null,

            ]);





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

                'Project Milestone Created',



            'project_id' =>

                $project->id,



            'project_name' =>

                $project->project_name,



            'details' =>

                'Architect created milestone "'

                . $milestone->milestone_name

                . '" under the "'

                . $phase->phase_name

                . '" phase.',

        ]);





        return back()->with(

            'success',

            'Milestone added successfully.'

        );

    }





    /*

    |--------------------------------------------------------------------------

    | UPDATE MILESTONE

    |--------------------------------------------------------------------------

    */



    public function update(

        Request $request,

        $projectId,

        $phaseId,

        $milestoneId

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

                ->firstOrFail();





        /*

        |--------------------------------------------------------------------------

        | MILESTONE

        |--------------------------------------------------------------------------

        */



        $milestone =

            ProjectMilestone::where(

                'id',

                $milestoneId

            )

                ->where(

                    'project_phase_id',

                    $phase->id

                )

                ->firstOrFail();





        /*

        |--------------------------------------------------------------------------

        | BLOCK CHANGES ON COMPLETED PHASE

        |--------------------------------------------------------------------------

        */



        if (

            $phase->status ===

            'completed'

        ) {



            return back()->withErrors([

                'milestone' =>

                    'Milestones under a completed phase can no longer be changed.'

            ]);

        }





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

            $milestone->status;

        /*
        |--------------------------------------------------------------------------
        | BLOCK MILESTONE WORK WHILE PHASE IS STILL PENDING
        |--------------------------------------------------------------------------
        */

        if (
            $phase->status === 'pending'
            &&
            in_array(
                $request->status,
                [
                    'in_progress',
                    'completed',
                ],
                true
            )
        ) {
            return back()
                ->withErrors([
                    'milestone' =>
                        'Start the project phase first before progressing or completing its milestones.',
                ])
                ->withInput();
        }







        /*

        |--------------------------------------------------------------------------

        | COMPLETED MILESTONE IS LOCKED

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

                'milestone' =>

                    'A completed milestone cannot be reopened.'

            ]);

        }





        /*

        |--------------------------------------------------------------------------

        | MARK AS PENDING

        |--------------------------------------------------------------------------

        */



        if (

            $request->status ===

            'pending'

        ) {



            $milestone->status =

                'pending';



            $milestone->save();





            if (

                $oldStatus !==

                $milestone->status

            ) {



                $this->saveAuditLog(

                    $project,

                    $phase,

                    $milestone,

                    'Project Milestone Updated',

                    'Architect changed milestone "'

                    . $milestone->milestone_name

                    . '" to Pending.'

                );

            }





            return back()->with(

                'success',

                'Milestone status updated.'

            );

        }





        /*

        |--------------------------------------------------------------------------

        | MARK AS IN PROGRESS

        |--------------------------------------------------------------------------

        */



        if (

            $request->status ===

            'in_progress'

        ) {



            $milestone->status =

                'in_progress';



            $milestone->save();





            if (

                $oldStatus !==

                $milestone->status

            ) {



                $this->saveAuditLog(

                    $project,

                    $phase,

                    $milestone,

                    'Project Milestone Started',

                    'Architect marked milestone "'

                    . $milestone->milestone_name

                    . '" as In Progress.'

                );

            }





            return back()->with(

                'success',

                'Milestone is now in progress.'

            );

        }





        /*

        |--------------------------------------------------------------------------

        | COMPLETE MILESTONE

        |--------------------------------------------------------------------------

        */



        if (

            $request->status ===

            'completed'

        ) {



            /*

            |--------------------------------------------------------------------------

            | REQUIRE REPORT + PROOF

            |--------------------------------------------------------------------------

            */



            $request->validate([

                'completion_report' => [

                    'required',

                    'string',

                    'min:20',

                    'max:5000',

                ],



                'proof_file' => [

                    'required',

                    'file',



                    /*

                    |--------------------------------------------------------------------------

                    | ALLOWED PROOF FILES

                    |--------------------------------------------------------------------------

                    */



                    'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',



                    /*

                    |--------------------------------------------------------------------------

                    | IMAGES: 100 MB / DOCUMENTS: 10 MB

                    |--------------------------------------------------------------------------

                    */



                    'max:102400',

                ],



                'client_can_view' => [

                    'nullable',

                    'boolean',

                ],

            ], [

                'completion_report.required' =>

                    'Please add a completion report before completing the milestone.',



                'completion_report.min' =>

                    'The completion report must contain at least 20 characters.',



                'proof_file.required' =>

                    'Please upload a supporting proof file.',



                'proof_file.mimes' =>

                    'Proof must be a JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, or XLSX file.',



                'proof_file.max' =>

                    'Images can be up to 100 MB. Documents can be up to 10 MB.',

            ]);





            /*

            |--------------------------------------------------------------------------

            | STORE PROOF FILE

            |--------------------------------------------------------------------------

            */



            $proof =

                $request->file(

                    'proof_file'

                );





            $originalName =

                basename(

                    $proof->getClientOriginalName()

                );





            $extension =

                strtolower(

                    $proof->getClientOriginalExtension()

                );





            $allowedProofExtensions = [

                'jpg',

                'jpeg',

                'png',

                'pdf',

                'doc',

                'docx',

                'xls',

                'xlsx',

            ];





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

                $proof->getSize() > 10485760

            ) {



                return back()->withErrors([

                    'proof_file' =>

                        'Documents cannot be larger than 10 MB.'

                ]);

            }





            if (

                !in_array(

                    $extension,

                    $allowedProofExtensions,

                    true

                )

            ) {



                return back()->withErrors([

                    'proof_file' =>

                        'This proof file type is not allowed.'

                ]);

            }





            $safeFileName =

                time()

                . '_'

                . Str::random(8)

                . '.'

                . $extension;





            $folder =

                'projects/'

                . $project->id

                . '/phases/'

                . $phase->id

                . '/milestones/'

                . $milestone->id;





            $proofPath =

                $proof->storeAs(

                    $folder,

                    $safeFileName,

                    'local'

                );





            if (!$proofPath) {



                return back()->withErrors([

                    'proof_file' =>

                        'The proof file could not be saved. Please try again.'

                ]);

            }





            /*

            |--------------------------------------------------------------------------

            | DELETE OLD PROOF IF THERE IS ONE

            |--------------------------------------------------------------------------

            */



            if (

                $milestone->proof_file

                &&

                $milestone->proof_file !==

                $proofPath

            ) {



                if (

                    Storage::disk('local')

                        ->exists(

                            $milestone->proof_file

                        )

                ) {



                    Storage::disk('local')

                        ->delete(

                            $milestone->proof_file

                        );

                }



                elseif (

                    Storage::disk('public')

                        ->exists(

                            $milestone->proof_file

                        )

                ) {



                    Storage::disk('public')

                        ->delete(

                            $milestone->proof_file

                        );

                }

            }





            /*

            |--------------------------------------------------------------------------

            | SAVE COMPLETION DATA

            |--------------------------------------------------------------------------

            */



            $milestone->status =

                'completed';





            $milestone->completion_report =

                trim(

                    $request->completion_report

                );





            $milestone->proof_file =

                $proofPath;





            $milestone->proof_file_name =

                $originalName;





            /*

            |--------------------------------------------------------------------------

            | CLIENT PROOF VISIBILITY

            |--------------------------------------------------------------------------

            |

            | Checked = client can view the proof.

            | Unchecked = architect team only.

            |

            */



            $milestone->client_can_view =

                $request->boolean(

                    'client_can_view'

                );





            $milestone->completed_by =

                auth()->id();





            $milestone->completed_at =

                now();





            $milestone->completed_date =

                now()->toDateString();





            $milestone->save();





            /*

            |--------------------------------------------------------------------------

            | AUDIT LOG

            |--------------------------------------------------------------------------

            */



            $this->saveAuditLog(

                $project,

                $phase,

                $milestone,

                'Project Milestone Completed',

                'Architect completed milestone "'

                . $milestone->milestone_name

                . '" under the "'

                . $phase->phase_name

                . '" phase and submitted a completion report and supporting proof.'

            );





            return back()->with(

                'success',

                'Milestone completed successfully with proof and report.'

            );

        }





        return back()->with(

            'success',

            'Milestone updated successfully.'

        );

    }





    /*

    |--------------------------------------------------------------------------

    | AUDIT LOG HELPER

    |--------------------------------------------------------------------------

    */



    private function saveAuditLog(

        Project $project,

        ProjectPhase $phase,

        ProjectMilestone $milestone,

        $action,

        $details

    ) {

        AuditLog::create([

            'user_id' =>

                auth()->id(),



            'user_name' =>

                auth()->user()->name,



            'action' =>

                $action,



            'project_id' =>

                $project->id,



            'project_name' =>

                $project->project_name,



            'details' =>

                $details,

        ]);

    }

}