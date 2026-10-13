<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMeetingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchitectMeetingsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ACCESSIBLE PROJECTS
    |--------------------------------------------------------------------------
    |
    | The architect can access projects where they are either:
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
    | GET ONE ACCESSIBLE PROJECT
    |--------------------------------------------------------------------------
    */

    private function getProjectForArchitect($projectId)
    {
        return $this->accessibleProjectsQuery(
            Auth::id()
        )
            ->where(
                'id',
                $projectId
            )
            ->firstOrFail();
    }


    public function index(Request $request)
    {
        $architectId = Auth::id();

        $projects =
            $this->accessibleProjectsQuery(
                $architectId
            )
                ->with([
                    'client',
                    'meetings.client',
                    'meetingActions.meeting',
                ])
                ->orderBy(
                    'project_name'
                )
                ->get();


        $projectsWithMeetings = $projects
            ->filter(function ($project) {
                return $project->meetings->count() > 0;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | ALL MEETINGS
        |--------------------------------------------------------------------------
        */

        $allMeetings = $projects
            ->flatMap(function ($project) {

                return $project->meetings->map(
                    function ($meeting) use ($project) {

                        $meeting->calendar_project_id =
                            $project->id;

                        $meeting->calendar_project_name =
                            $project->project_name;

                        return $meeting;

                    }
                );

            });


        /*
        |--------------------------------------------------------------------------
        | MEETING COUNTS
        |--------------------------------------------------------------------------
        */

        $upcomingMeetingCount = $allMeetings
            ->filter(function ($meeting) {

                return $meeting->meeting_date
                    && $meeting->meeting_date >= now();

            })
            ->count();


        $pastMeetingCount = $allMeetings
            ->filter(function ($meeting) {

                return $meeting->meeting_date
                    && $meeting->meeting_date < now();

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | ALL ACTIONS
        |--------------------------------------------------------------------------
        */

        $allActions = $projects
            ->flatMap(function ($project) {

                return $project->meetingActions->map(
                    function ($action) use ($project) {

                        $action->calendar_project_name =
                            $project->project_name;

                        return $action;

                    }
                );

            });


        $openActionCount = $allActions
            ->where('status', '!=', 'done')
            ->count();


        $overdueActionCount = $allActions
            ->filter(function ($action) {

                return $action->status !== 'done'
                    && $action->due_date
                    && $action->due_date->isBefore(today());

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | SELECTED PROJECT
        |--------------------------------------------------------------------------
        */

        $selectedProject = null;

        $selectedActions = collect();


        if ($request->filled('project')) {

            $selectedProject = $projects
                ->firstWhere(
                    'id',
                    (int) $request->project
                );


            if ($selectedProject) {

                $selectedActions =
                    $selectedProject
                        ->meetingActions
                        ->sortBy('created_at');

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SELECTED DATE
        |--------------------------------------------------------------------------
        */

        $selectedDate = null;

        $selectedDateActions = collect();

        $selectedDateMeetings = collect();


        if ($request->filled('date')) {

            try {

                $selectedDate =
                    \Carbon\Carbon::parse(
                        $request->date
                    )
                    ->startOfDay();


                $selectedDateActions =
                    $allActions
                        ->filter(
                            function ($action) use ($selectedDate) {

                                return $action->due_date
                                    && $action->due_date
                                        ->isSameDay(
                                            $selectedDate
                                        );

                            }
                        )
                        ->sortBy('created_at')
                        ->values();


                $selectedDateMeetings =
                    $allMeetings
                        ->filter(
                            function ($meeting) use ($selectedDate) {

                                return $meeting->meeting_date
                                    && $meeting->meeting_date
                                        ->isSameDay(
                                            $selectedDate
                                        );

                            }
                        )
                        ->sortBy('meeting_date')
                        ->values();

            } catch (\Exception $e) {

                $selectedDate = null;

            }

        }


        return view(
            'architect.meetings',
            compact(
                'projects',
                'projectsWithMeetings',
                'allMeetings',
                'allActions',
                'upcomingMeetingCount',
                'pastMeetingCount',
                'openActionCount',
                'overdueActionCount',
                'selectedProject',
                'selectedActions',
                'selectedDate',
                'selectedDateActions',
                'selectedDateMeetings'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ACTION
    |--------------------------------------------------------------------------
    */

    public function storeAction(
        Request $request,
        $projectId
    ) {
        $projectData =
            $this->getProjectForArchitect(
                $projectId
            );


        /*
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | after_or_equal:today prevents past dates.
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'type' => [
                'required',
                'in:task,revision,submission,follow_up'
            ],

            'priority' => [
                'required',
                'in:low,normal,high'
            ],

            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:today'
            ],

            'meeting_id' => [
                'nullable',
                'integer'
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK RELATED MEETING
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['meeting_id'])) {

            $meetingExists =
                $projectData
                    ->meetings()
                    ->where(
                        'id',
                        $validated['meeting_id']
                    )
                    ->exists();


            if (!$meetingExists) {

                return back()
                    ->withErrors([
                        'meeting_id' =>
                            'The selected meeting does not belong to this project.'
                    ])
                    ->withInput();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        ProjectMeetingAction::create([

            'project_id' =>
                $projectData->id,

            'meeting_id' =>
                $validated['meeting_id']
                ?? null,

            'title' =>
                $validated['title'],

            'type' =>
                $validated['type'],

            'due_date' =>
                $validated['due_date']
                ?? null,

            'priority' =>
                $validated['priority'],

            'status' =>
                'todo',

            'notes' =>
                $validated['notes']
                ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        $parameters = [
            'project' => $projectData->id,
        ];


        if (!empty($validated['due_date'])) {

            $parameters['date'] =
                $validated['due_date'];

            $parameters['month'] =
                \Carbon\Carbon::parse(
                    $validated['due_date']
                )
                ->format('Y-m');

        }


        return redirect()
            ->route(
                'architect.meetings.index',
                $parameters
            )
            ->with(
                'success',
                'Action added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ACTION
    |--------------------------------------------------------------------------
    */

    public function updateAction(
        Request $request,
        $projectId,
        $actionId
    ) {
        $projectData =
            $this->getProjectForArchitect(
                $projectId
            );


        $actionData =
            ProjectMeetingAction::where(
                'project_id',
                $projectData->id
            )
            ->findOrFail($actionId);


        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'type' => [
                'required',
                'in:task,revision,submission,follow_up'
            ],

            'priority' => [
                'required',
                'in:low,normal,high'
            ],

            /*
             * Cannot move an action
             * to a past date.
             */
            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:today'
            ],

            'meeting_id' => [
                'nullable',
                'integer'
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000'
            ],
        ]);


        if (!empty($validated['meeting_id'])) {

            $meetingExists =
                $projectData
                    ->meetings()
                    ->where(
                        'id',
                        $validated['meeting_id']
                    )
                    ->exists();


            if (!$meetingExists) {

                return back()
                    ->withErrors([
                        'meeting_id' =>
                            'The selected meeting does not belong to this project.'
                    ])
                    ->withInput();

            }

        }


        $actionData->update([

            'title' =>
                $validated['title'],

            'type' =>
                $validated['type'],

            'priority' =>
                $validated['priority'],

            'due_date' =>
                $validated['due_date']
                ?? null,

            'meeting_id' =>
                $validated['meeting_id']
                ?? null,

            'notes' =>
                $validated['notes']
                ?? null,

        ]);


        return back()
            ->with(
                'success',
                'Action updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    public function updateActionStatus(
        Request $request,
        $projectId,
        $actionId
    ) {
        $projectData =
            $this->getProjectForArchitect(
                $projectId
            );


        $actionData =
            ProjectMeetingAction::where(
                'project_id',
                $projectData->id
            )
            ->findOrFail($actionId);


        $validated = $request->validate([
            'status' => [
                'required',
                'in:todo,in_progress,done'
            ],
        ]);


        $actionData->update([
            'status' =>
                $validated['status'],
        ]);


        return response()->json([
            'success' => true,
            'message' =>
                'Action status updated.',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE ACTION
    |--------------------------------------------------------------------------
    */

    public function destroyAction(
        $projectId,
        $actionId
    ) {
        $projectData =
            $this->getProjectForArchitect(
                $projectId
            );


        $actionData =
            ProjectMeetingAction::where(
                'project_id',
                $projectData->id
            )
            ->findOrFail($actionId);


        $actionData->delete();


        return back()
            ->with(
                'success',
                'Action deleted successfully.'
            );
    }
}