<?php







namespace App\Http\Controllers;







use App\Models\Project;



use App\Models\ProjectPhase;

use App\Models\ProjectExpense;



use App\Models\User;



use App\Models\AuditLog;







use Illuminate\Http\Request;



use Illuminate\Support\Facades\Hash;



use Illuminate\Support\Facades\Mail;



use Illuminate\Support\Str;







class ArchitectProjectController extends Controller



{



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



                'weight' => 5,



            ],







            2 => [



                'name' => 'Agreement',



                'description' =>



                    'Finalization of project scope, responsibilities, service terms, agreements, and project requirements.',



                'weight' => 5,



            ],







            3 => [



                'name' => 'Planning',



                'description' =>



                    'Project planning, site considerations, objectives, requirements, schedules, and initial project direction.',



                'weight' => 10,



            ],







            4 => [



                'name' => 'Design',



                'description' =>



                    'Preparation and refinement of architectural concepts, layouts, drawings, and design solutions.',



                'weight' => 15,



            ],







            5 => [



                'name' => 'Approval',



                'description' =>



                    'Client review, design approval, required revisions, and confirmation of the approved project direction.',



                'weight' => 10,



            ],







            6 => [



                'name' => 'Development',



                'description' =>



                    'Development of detailed plans, technical drawings, specifications, coordination, and construction documents.',



                'weight' => 10,



            ],







            7 => [



                'name' => 'Permits',



                'description' =>



                    'Preparation, submission, monitoring, and completion of required permits and regulatory documents.',



                'weight' => 10,



            ],







            8 => [



                'name' => 'Construction',



                'description' =>



                    'Construction implementation, site coordination, monitoring, and execution of the approved plans.',



                'weight' => 20,



            ],







            9 => [



                'name' => 'Inspection',



                'description' =>



                    'Site inspection, quality checking, corrections, final verification, and completion review.',



                'weight' => 10,



            ],







            10 => [



                'name' => 'Turnover',



                'description' =>



                    'Final project turnover, completion documentation, client handover, and closing of project requirements.',



                'weight' => 5,



            ],



        ];



    }











    /*



    |--------------------------------------------------------------------------



    | SYNC STANDARD PHASES



    |--------------------------------------------------------------------------



    */







    private function syncStandardPhases(Project $project)



    {



        foreach (



            $this->standardPhases()



            as $phaseOrder => $phaseData



        ) {







            $phase =



                ProjectPhase::where(



                    'project_id',



                    $project->id



                )



                    ->where(



                        'phase_order',



                        $phaseOrder



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



                    $phaseOrder,







                'start_date' =>



                    null,







                'target_date' =>



                    null,







                'completed_date' =>



                    null,







                'completion_checklist' =>



                    null,







                'completion_note' =>



                    null,







                'completed_by' =>



                    null,



            ]);



        }











        $this->recalculateProgress(



            $project



        );



    }











    /*



    |--------------------------------------------------------------------------



    | RECALCULATE PROGRESS



    |--------------------------------------------------------------------------



    */







    private function recalculateProgress(Project $project)



    {



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



                $progress,



                100



            );











        $project->progress =



            $progress;











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



            $progress > 0



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



    | INDEX



    |--------------------------------------------------------------------------



    */







    public function index(Request $request)



    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);




        $user =



            auth()->user();











        /*



        |--------------------------------------------------------------------------



        | PROJECTS ACCESSIBLE TO THIS ARCHITECT



        |--------------------------------------------------------------------------



        |



        | The architect can see projects where they are either:



        | 1. The lead architect, or



        | 2. An added project collaborator.



        |



        */







        $accessibleProjectsQuery =



            Project::whereHas('architect', function ($leadQuery) {
                $leadQuery->where('status', 'active');
            })->where(



                function ($query) use ($user) {







                    $query



                        ->where(



                            'architect_id',



                            $user->id



                        )



                        ->orWhereHas(



                            'projectArchitects',



                            function ($teamQuery) use ($user) {







                                $teamQuery->where(



                                    'architect_id',



                                    $user->id



                                );



                            }



                        );



                }



            );











        $projectsQuery =



            clone $accessibleProjectsQuery;











        if (



            $request->filled('search')



        ) {







            $search =



                trim(



                    $request->search



                );











            $projectsQuery->where(



                function ($query) use ($search) {







                    $query



                        ->where(



                            'project_name',



                            'like',



                            '%' . $search . '%'



                        )



                        ->orWhere(



                            'client_name',



                            'like',



                            '%' . $search . '%'



                        )



                        ->orWhere(



                            'client_email',



                            'like',



                            '%' . $search . '%'



                        );



                }



            );



        }











        if (



            $request->filled('status')



            &&



            $request->status !==



            'all'



        ) {







            $projectsQuery->where(



                'status',



                $request->status



            );



        }











        $projects =



            $projectsQuery



                ->latest()



                ->paginate(9)



                ->withQueryString();











        $totalProjects =



            (clone $accessibleProjectsQuery)



                ->count();











        $planningProjects =



            (clone $accessibleProjectsQuery)



                ->where(



                    'status',



                    'planning'



                )



                ->count();











        $ongoingProjects =



            (clone $accessibleProjectsQuery)



                ->where(



                    'status',



                    'ongoing'



                )



                ->count();











        $completedProjects =



            (clone $accessibleProjectsQuery)



                ->where(



                    'status',



                    'completed'



                )



                ->count();











        return view(



            'architect.projects.projects',



            compact(



                'user',



                'projects',



                'totalProjects',



                'planningProjects',



                'ongoingProjects',



                'completedProjects'



            )



        );



    }











    /*



    |--------------------------------------------------------------------------



    | CREATE



    |--------------------------------------------------------------------------



    */







    public function create()



    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);




        $user =



            auth()->user();











        $clientIds =



            Project::where(



                'architect_id',



                $user->id



            )



                ->whereNotNull(



                    'client_id'



                )



                ->pluck(



                    'client_id'



                )



                ->unique();











        $existingClients =



            User::whereIn(



                'id',



                $clientIds



            )



                ->where(



                    'role',



                    'client'



                )



                ->orderBy(



                    'name'



                )



                ->get();











        return view(



            'architect.projects.create-projects',



            compact(



                'user',



                'existingClients'



            )



        );



    }











    /*



    |--------------------------------------------------------------------------



    | SHOW PROJECT



    |--------------------------------------------------------------------------



    */







    public function show($id)



    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);




        $user =



            auth()->user();











        /*



        |--------------------------------------------------------------------------



        | PROJECT ACCESS



        |--------------------------------------------------------------------------



        |



        | Allow the lead architect and added collaborators to open



        | the same project workspace.



        |



        */







        $project =



            Project::whereHas('architect', function ($leadQuery) {
                $leadQuery->where('status', 'active');
            })->where(



                'id',



                $id



            )



                ->where(



                    function ($query) use ($user) {







                        $query



                            ->where(



                                'architect_id',



                                $user->id



                            )



                            ->orWhereHas(



                                'projectArchitects',



                                function ($teamQuery) use ($user) {







                                    $teamQuery->where(



                                        'architect_id',



                                        $user->id



                                    );



                                }



                            );



                    }



                )



                ->firstOrFail();











        $isLeadArchitect =



            (int) $project->architect_id



            ===



            (int) $user->id;











        /*



        |--------------------------------------------------------------------------



        | MAKE SURE 10 PHASES EXIST



        |--------------------------------------------------------------------------



        |



        | Only the lead architect should synchronize or create project phases.



        | Collaborators may view and work inside the project workspace, but



        | simply opening the project should not modify project records.



        |



        */







        if ($isLeadArchitect) {







            $this->syncStandardPhases(



                $project



            );











            $project->refresh();



        }











        /*



        |--------------------------------------------------------------------------



        | LOAD ALL RELATIONSHIPS



        |--------------------------------------------------------------------------



        */







        $project->load([



            'architect',



            'client',







            'projectArchitects.architect',







            'phases.milestones',



            'phases.completedBy',







            'files.uploader',







            'messages.sender',



            'messages.receiver',







            'revisions.client',







            'meetings.client',







            'aiHistories.client',



            'expenses.recordedBy',



        ]);











        /*



        |--------------------------------------------------------------------------



        | PROJECT TEAM



        |--------------------------------------------------------------------------



        */







        $projectTeam =



            $project



                ->projectArchitects



                ->sortBy('created_at')



                ->values();











        /*



        |--------------------------------------------------------------------------



        | AVAILABLE ARCHITECTS



        |--------------------------------------------------------------------------



        |



        | Only the lead architect needs this list because only the lead



        | architect can add or remove collaborators.



        |



        */







        $availableArchitects =



            collect();











        if ($isLeadArchitect) {







            $existingArchitectIds =



                $projectTeam



                    ->pluck('architect_id')



                    ->push($project->architect_id)



                    ->unique()



                    ->values();











            $availableArchitects =



                User::where(



                    'role',



                    'architect'



                )



                    ->where(



                        'status',



                        'active'



                    )



                    ->whereNotIn(



                        'id',



                        $existingArchitectIds



                    )



                    ->orderBy(



                        'name'



                    )



                    ->get();



        }











        /*



        |--------------------------------------------------------------------------



        | MARK MESSAGES AS READ



        |--------------------------------------------------------------------------



        */







        if (



            request('tab') ===



            'messages'



        ) {







            $project->messages()



                ->where(



                    'receiver_id',



                    $user->id



                )



                ->where(



                    'is_read',



                    false



                )



                ->update([



                    'is_read' =>



                        true,







                    'read_at' =>



                        now(),



                ]);



        }











        /*



        |--------------------------------------------------------------------------



        | MESSAGES



        |--------------------------------------------------------------------------



        */







        $messages =



            $project->messages



                ->sortBy(



                    'created_at'



                )



                ->values();











        /*



        |--------------------------------------------------------------------------



        | REVISIONS



        |--------------------------------------------------------------------------



        */







        $revisions =



            $project->revisions



                ->sortByDesc(



                    'created_at'



                )



                ->values();











        $pendingRevisions =



            $revisions



                ->where(



                    'status',



                    'pending'



                )



                ->count();











        $inProgressRevisions =



            $revisions



                ->where(



                    'status',



                    'in_progress'



                )



                ->count();











        $resolvedRevisions =



            $revisions



                ->where(



                    'status',



                    'resolved'



                )



                ->count();











        /*



        |--------------------------------------------------------------------------



        | MEETINGS



        |--------------------------------------------------------------------------



        */







        $meetings =



            $project->meetings



                ->sortBy(



                    function ($meeting) {







                        return



                            $meeting



                                ->meeting_date



                                ->format('Y-m-d')



                            . ' '



                            . $meeting->start_time;



                    }



                )



                ->values();











        $scheduledMeetings =



            $meetings



                ->where(



                    'status',



                    'scheduled'



                )



                ->count();











        $completedMeetings =



            $meetings



                ->where(



                    'status',



                    'completed'



                )



                ->count();











        $cancelledMeetings =



            $meetings



                ->where(



                    'status',



                    'cancelled'



                )



                ->count();











        /*



        |--------------------------------------------------------------------------



        | AI



        |--------------------------------------------------------------------------



        */







        $clientAiSuggestions =



            $project



                ->aiHistories



                ->where(



                    'type',



                    'suggestion'



                )



                ->sortByDesc(



                    'created_at'



                )



                ->values();











        $clientAiImages =



            $project



                ->aiHistories



                ->whereIn(
                    'type',
                    [
                        'image',
                        'image_generation',
                        'image_edit',
                    ]
                )



                ->sortByDesc(



                    'created_at'



                )



                ->values();











        /*

        |--------------------------------------------------------------------------

        | FINANCIAL SUMMARY

        |--------------------------------------------------------------------------

        */



        $expenses =

            $project->expenses

                ->sortByDesc('expense_date')

                ->values();



        $totalExpenses =

            (float) $expenses->sum('amount');



        $remainingBudget =

            $project->budget !== null

                ? (float) $project->budget - $totalExpenses

                : null;





        return view(



            'architect.projects.show-project',



            compact(



                'user',



                'project',



                'messages',







                'revisions',



                'pendingRevisions',



                'inProgressRevisions',



                'resolvedRevisions',







                'meetings',



                'scheduledMeetings',



                'completedMeetings',



                'cancelledMeetings',







                'clientAiSuggestions',



                'clientAiImages',







                'isLeadArchitect',



                'projectTeam',



                'availableArchitects',



                'expenses',



                'totalExpenses',



                'remainingBudget'



            )



        );



    }











    /*



    |--------------------------------------------------------------------------



    | STORE PROJECT



    |--------------------------------------------------------------------------



    */









    /*

    |--------------------------------------------------------------------------

    | UPDATE PROJECT BUDGET

    |--------------------------------------------------------------------------

    |

    | Only the lead architect may change project financial records.

    |

    */



    public function updateBudget(Request $request, $id)

    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);


        $project = Project::where('id', $id)

            ->where('architect_id', auth()->id())
            ->whereHas('architect', function ($leadQuery) {
                $leadQuery->where('status', 'active');
            })

            ->firstOrFail();



        $validated = $request->validate([

            'budget' => [

                'nullable',

                'numeric',

                'min:0',

                'max:999999999.99',

            ],

        ]);



        $project->budget =

            isset($validated['budget'])

            && $validated['budget'] !== ''

                ? $validated['budget']

                : null;



        $project->save();



        AuditLog::create([

            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Project Budget Updated',

            'project_id' => $project->id,

            'project_name' => $project->project_name,

            'details' => $project->budget !== null

                ? 'Lead architect updated the project budget to PHP '

                    . number_format((float) $project->budget, 2)

                    . '.'

                : 'Lead architect cleared the project budget.',

        ]);



        return redirect()

            ->route(

                'architect.projects.show',

                $project->id

            )

            ->with(

                'success',

                'Project budget updated successfully.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | STORE PROJECT EXPENSE

    |--------------------------------------------------------------------------

    */



    public function storeExpense(Request $request, $id)

    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);


        $project = Project::where('id', $id)

            ->where('architect_id', auth()->id())
            ->whereHas('architect', function ($leadQuery) {
                $leadQuery->where('status', 'active');
            })

            ->firstOrFail();



        $validated = $request->validate([

            'category' => [

                'required',

                'string',

                'max:100',

            ],

            'description' => [

                'required',

                'string',

                'max:255',

            ],

            'amount' => [

                'required',

                'numeric',

                'min:0.01',

                'max:999999999.99',

            ],

            'expense_date' => [

                'required',

                'date',

            ],

            'notes' => [

                'nullable',

                'string',

                'max:2000',

            ],

        ]);



        $expense = ProjectExpense::create([

            'project_id' => $project->id,

            'recorded_by' => auth()->id(),

            'category' => trim($validated['category']),

            'description' => trim($validated['description']),

            'amount' => $validated['amount'],

            'expense_date' => $validated['expense_date'],

            'notes' => !empty($validated['notes'])

                ? trim($validated['notes'])

                : null,

        ]);



        AuditLog::create([

            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Project Expense Added',

            'project_id' => $project->id,

            'project_name' => $project->project_name,

            'details' => 'Lead architect recorded expense "'

                . $expense->description

                . '" worth PHP '

                . number_format((float) $expense->amount, 2)

                . '.',

        ]);



        return redirect()

            ->route(

                'architect.projects.show',

                ['id' => $project->id, 'tab' => 'financial']

            )

            ->with(

                'success',

                'Project expense added successfully.'

            )
            ->withFragment('recorded-expenses');

    }





    /*

    |--------------------------------------------------------------------------

    | UPDATE PROJECT EXPENSE

    |--------------------------------------------------------------------------

    */



    public function updateExpense(

        Request $request,

        $id,

        $expense

    ) {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);


        $project = Project::where('id', $id)

            ->where('architect_id', auth()->id())
            ->whereHas('architect', function ($leadQuery) {
                $leadQuery->where('status', 'active');
            })

            ->firstOrFail();



        $projectExpense = ProjectExpense::where('id', $expense)

            ->where('project_id', $project->id)

            ->firstOrFail();



        $validated = $request->validate([

            'category' => [

                'required',

                'string',

                'max:100',

            ],

            'description' => [

                'required',

                'string',

                'max:255',

            ],

            'amount' => [

                'required',

                'numeric',

                'min:0.01',

                'max:999999999.99',

            ],

            'expense_date' => [

                'required',

                'date',

            ],

            'notes' => [

                'nullable',

                'string',

                'max:2000',

            ],

        ]);



        $projectExpense->update([

            'category' => trim($validated['category']),

            'description' => trim($validated['description']),

            'amount' => $validated['amount'],

            'expense_date' => $validated['expense_date'],

            'notes' => !empty($validated['notes'])

                ? trim($validated['notes'])

                : null,

        ]);



        AuditLog::create([

            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Project Expense Updated',

            'project_id' => $project->id,

            'project_name' => $project->project_name,

            'details' => 'Lead architect updated expense "'

                . $projectExpense->description

                . '".',

        ]);



        return redirect()

            ->route(

                'architect.projects.show',

                $project->id

            )

            ->with(

                'success',

                'Project expense updated successfully.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | DELETE PROJECT EXPENSE

    |--------------------------------------------------------------------------

    */



    public function destroyExpense($id, $expense)

    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);


        $project = Project::where('id', $id)

            ->where('architect_id', auth()->id())
            ->whereHas('architect', function ($leadQuery) {
                $leadQuery->where('status', 'active');
            })

            ->firstOrFail();



        $projectExpense = ProjectExpense::where('id', $expense)

            ->where('project_id', $project->id)

            ->firstOrFail();



        $expenseDescription = $projectExpense->description;

        $expenseAmount = (float) $projectExpense->amount;



        $projectExpense->delete();



        AuditLog::create([

            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Project Expense Deleted',

            'project_id' => $project->id,

            'project_name' => $project->project_name,

            'details' => 'Lead architect deleted expense "'

                . $expenseDescription

                . '" worth PHP '

                . number_format($expenseAmount, 2)

                . '.',

        ]);



        return redirect()

            ->route(

                'architect.projects.show',

                $project->id

            )

            ->with(

                'success',

                'Project expense deleted successfully.'

            );

    }





    public function store(Request $request)



    {
        // Archived and on-hold architect accounts cannot access project operations.
        abort_unless(auth()->user()?->role === 'architect' && auth()->user()?->status === 'active', 403);




        $request->validate([



            'project_name' => [



                'required',



                'string',



                'max:255',



            ],







            'description' => [



                'nullable',



                'string',



                'max:2000',



            ],







            'client_type' => [



                'required',



                'in:new,existing',



            ],







            'existing_client_id' => [



                'nullable',



                'required_if:client_type,existing',



                'exists:users,id',



            ],







            'client_name' => [



                'nullable',



                'required_if:client_type,new',



                'string',



                'max:255',



            ],







            'client_email' => [



                'nullable',



                'required_if:client_type,new',



                'email',



                'max:255',



            ],







            'status' => [



                'required',



                'in:planning,ongoing,on_hold,completed',



            ],







            'start_date' => [



                'nullable',



                'date',



            ],







            'target_date' => [



                'nullable',



                'date',



                'after_or_equal:start_date',



            ],







            'project_image' => [



                'nullable',



                'image',



                'mimes:jpg,jpeg,png,webp',



                'max:5120',



            ],



        ]);











        $architect =



            auth()->user();











        $temporaryPassword =



            null;











        /*



        |--------------------------------------------------------------------------



        | EXISTING CLIENT



        |--------------------------------------------------------------------------



        */







        if (



            $request->client_type ===



            'existing'



        ) {







            $client =



                User::where(



                    'id',



                    $request->existing_client_id



                )



                    ->where(



                        'role',



                        'client'



                    )



                    ->first();











            if (!$client) {







                return back()



                    ->withInput()



                    ->withErrors([



                        'existing_client_id' =>



                            'The selected client account was not found.'



                    ]);



            }











            $clientBelongsToArchitect =



                Project::where(



                    'architect_id',



                    auth()->id()



                )



                    ->where(



                        'client_id',



                        $client->id



                    )



                    ->exists();











            if (



                !$clientBelongsToArchitect



            ) {







                return back()



                    ->withInput()



                    ->withErrors([



                        'existing_client_id' =>



                            'You cannot select this client account.'



                    ]);



            }







        } else {







            /*



            |--------------------------------------------------------------------------



            | NEW CLIENT



            |--------------------------------------------------------------------------



            */







            $clientName =



                trim(



                    $request->client_name



                );











            $clientEmail =



                strtolower(



                    trim(



                        $request->client_email



                    )



                );











            $client =



                User::where(



                    'email',



                    $clientEmail



                )



                    ->first();











            if (!$client) {







                $temporaryPassword =



                    Str::random(10);











                $client =



                    User::create([



                        'name' =>



                            $clientName,







                        'email' =>



                            $clientEmail,







                        'password' =>



                            Hash::make(



                                $temporaryPassword



                            ),







                        'role' =>



                            'client',







                        'status' =>



                            'active',







                        'must_change_password' =>



                            1,



                    ]);











                AuditLog::create([



                    'user_id' =>



                        $architect->id,







                    'user_name' =>



                        $architect->name,







                    'action' =>



                        'Client Account Created',







                    'details' =>



                        'Architect created a client account for '



                        . $client->name



                        . '.',



                ]);







            } else {







                if (



                    $client->role !==



                    'client'



                ) {







                    return back()



                        ->withInput()



                        ->withErrors([



                            'client_email' =>



                                'This email is already being used by another system account.'



                        ]);



                }











                $alreadyMyClient =



                    Project::where(



                        'architect_id',



                        auth()->id()



                    )



                        ->where(



                            'client_id',



                            $client->id



                        )



                        ->exists();











                if (



                    !$alreadyMyClient



                ) {







                    return back()



                        ->withInput()



                        ->withErrors([



                            'client_email' =>



                                'This client account already exists but is not connected to your account.'



                        ]);



                }











                $client->name =



                    $clientName;











                $client->save();



            }



        }











        /*



        |--------------------------------------------------------------------------



        | PROJECT IMAGE



        |--------------------------------------------------------------------------



        */







        $imageName =



            null;











        if (



            $request->hasFile(



                'project_image'



            )



        ) {







            $image =



                $request->file(



                    'project_image'



                );











            $imageName =



                time()



                . '_'



                . Str::random(6)



                . '.'



                . $image



                    ->getClientOriginalExtension();











            $projectFolder =



                public_path(



                    'uploads/projects'



                );











            if (



                !file_exists(



                    $projectFolder



                )



            ) {







                mkdir(



                    $projectFolder,



                    0755,



                    true



                );



            }











            $image->move(



                $projectFolder,



                $imageName



            );



        }











        /*



        |--------------------------------------------------------------------------



        | CREATE PROJECT



        |--------------------------------------------------------------------------



        */







        $project =



            Project::create([



                'project_name' =>



                    trim(



                        $request->project_name



                    ),







                'description' =>



                    $request->filled('description')



                        ? trim(



                            $request->description



                        )



                        : null,







                'project_image' =>



                    $imageName,







                'architect_id' =>



                    auth()->id(),







                'client_id' =>



                    $client->id,







                'client_name' =>



                    $client->name,







                'client_email' =>



                    $client->email,







                'status' =>



                    'planning',







                'progress' =>



                    0,







                'start_date' =>



                    $request->start_date,







                'target_date' =>



                    $request->target_date,



            ]);

        // Preserve the lead architect's identity after eventual account deletion.
        $project->original_architect_name = $architect->name;
        $project->save();











        /*



        |--------------------------------------------------------------------------



        | CREATE TEN PHASES



        |--------------------------------------------------------------------------



        */







        $this->syncStandardPhases(



            $project



        );











        /*



        |--------------------------------------------------------------------------



        | AUDIT



        |--------------------------------------------------------------------------



        */







        AuditLog::create([



            'user_id' =>



                $architect->id,







            'user_name' =>



                $architect->name,







            'action' =>



                'Project Created',







            'project_id' =>



                $project->id,







            'project_name' =>



                $project->project_name,







            'details' =>



                'Architect created project "'



                . $project->project_name



                . '" for client '



                . $client->name



                . '.',



        ]);











        /*



        |--------------------------------------------------------------------------



        | EMAIL



        |--------------------------------------------------------------------------



        */







        if (



            $temporaryPassword



        ) {







            Mail::send(



                'emails.client-invitation',



                [



                    'client' =>



                        $client,







                    'project' =>



                        $project,







                    'temporaryPassword' =>



                        $temporaryPassword,



                ],



                function ($message) use ($client) {







                    $message



                        ->to(



                            $client->email



                        )



                        ->subject(



                            'Your ArchiTrack Client Account'



                        );



                }



            );



        }











        /*



        |--------------------------------------------------------------------------



        | SUCCESS



        |--------------------------------------------------------------------------



        */







        if (



            $temporaryPassword



        ) {







            return redirect()



                ->route(



                    'architect.projects.show',



                    $project->id



                )



                ->with(



                    'success',



                    'Project and client account created successfully. Login details were sent to the client email.'



                );



        }











        return redirect()



            ->route(



                'architect.projects.show',



                $project->id



            )



            ->with(



                'success',



                'Project created successfully and linked to the existing client account.'



            );



    }



}