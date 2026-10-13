<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMeeting;
use App\Notifications\ProjectActivityNotification;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientProjectMeetingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET CLIENT PROJECT
    |--------------------------------------------------------------------------
    */

    private function getProjectForClient(
        $projectId,
        array $with = []
    ) {
        return Project::where(
            'id',
            $projectId
        )
            ->where(
                'client_id',
                auth()->id()
            )
            ->with($with)
            ->firstOrFail();
    }


    /*
    |--------------------------------------------------------------------------
    | CLIENT PROJECT REDIRECT
    |--------------------------------------------------------------------------
    */

    private function meetingRedirect(
        Project $project,
        ?ProjectMeeting $meeting = null
    ) {
        $url =
            route(
                'client.projects.index',
                [
                    'project' =>
                        $project->id,

                    'section' =>
                        'meetings',
                ]
            );

        if ($meeting) {
            $url .= '#meeting-' . $meeting->id;
        }

        return redirect()->to($url);
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK ARCHITECT SCHEDULE CONFLICT
    |--------------------------------------------------------------------------
    */

    private function hasScheduleConflict(
        $architectId,
        $meetingDate,
        $startTime,
        $endTime = null,
        $excludeMeetingId = null
    ) {
        $meetingStart =
            Carbon::createFromFormat(
                'Y-m-d H:i',
                $meetingDate
                . ' '
                . $startTime,
                'Asia/Manila'
            );

        $meetingEnd =
            $endTime
                ? Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $meetingDate
                    . ' '
                    . $endTime,
                    'Asia/Manila'
                )
                : $meetingStart
                    ->copy()
                    ->addHour();


        $architectMeetings =
            ProjectMeeting::where(
                'architect_id',
                $architectId
            )
                ->whereDate(
                    'meeting_date',
                    $meetingDate
                )
                ->whereIn(
                    'status',
                    [
                        'pending',
                        'scheduled',
                    ]
                )
                ->when(
                    $excludeMeetingId,
                    function ($query) use ($excludeMeetingId) {

                        $query->where(
                            'id',
                            '!=',
                            $excludeMeetingId
                        );
                    }
                )
                ->get();


        foreach ($architectMeetings as $existingMeeting) {

            $existingDate =
                Carbon::parse(
                    $existingMeeting->meeting_date
                )
                    ->format('Y-m-d');

            $existingStart =
                Carbon::createFromFormat(
                    'Y-m-d H:i:s',
                    $existingDate
                    . ' '
                    . $existingMeeting->start_time,
                    'Asia/Manila'
                );

            $existingEnd =
                $existingMeeting->end_time
                    ? Carbon::createFromFormat(
                        'Y-m-d H:i:s',
                        $existingDate
                        . ' '
                        . $existingMeeting->end_time,
                        'Asia/Manila'
                    )
                    : $existingStart
                        ->copy()
                        ->addHour();

            $hasConflict =
                $meetingStart->lt(
                    $existingEnd
                )
                &&
                $meetingEnd->gt(
                    $existingStart
                );

            if ($hasConflict) {
                return true;
            }
        }

        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | REQUEST MEETING
    |--------------------------------------------------------------------------
    |
    | A Client-created meeting is a proposal.
    | It stays Pending until the Architect approves it.
    |
    */

    public function store(Request $request, $id)
    {
        $project =
            $this->getProjectForClient(
                $id,
                [
                    'architect',
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'agenda' => [
                'nullable',
                'string',
                'max:3000',
            ],

            'meeting_type' => [
                'required',
                'in:online,in_person',
            ],

            'meeting_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'nullable',
                'date_format:H:i',
                'after:start_time',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:3000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK IF PROJECT HAS ARCHITECT
        |--------------------------------------------------------------------------
        */

        if (!$project->architect_id) {

            return back()
                ->withInput()
                ->withErrors([
                    'meeting' =>
                        'A meeting cannot be requested because this project does not have an assigned architect yet.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PREVENT PAST DATE + TIME
        |--------------------------------------------------------------------------
        */

        $meetingStart =
            Carbon::createFromFormat(
                'Y-m-d H:i',
                $request->meeting_date
                . ' '
                . $request->start_time,
                'Asia/Manila'
            );

        if (
            $meetingStart->lte(
                Carbon::now('Asia/Manila')
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'meeting_date' =>
                        'Please select a future date and time.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK FOR SCHEDULE CONFLICT
        |--------------------------------------------------------------------------
        */

        if (
            $this->hasScheduleConflict(
                $project->architect_id,
                $request->meeting_date,
                $request->start_time,
                $request->filled('end_time')
                    ? $request->end_time
                    : null
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                        'Your architect already has a meeting or pending request during this time. Please choose another schedule.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE PENDING MEETING REQUEST
        |--------------------------------------------------------------------------
        */

        $projectMeeting =
            ProjectMeeting::create([

                'project_id' =>
                    $project->id,

                'architect_id' =>
                    $project->architect_id,

                'client_id' =>
                    auth()->id(),

                'proposed_by' =>
                    'client',

                'proposed_by_user_id' =>
                    auth()->id(),

                'title' =>
                    trim($request->title),

                'agenda' =>
                    $request->filled('agenda')
                        ? trim($request->agenda)
                        : null,

                'meeting_type' =>
                    $request->meeting_type,

                'meeting_date' =>
                    $request->meeting_date,

                'start_time' =>
                    $request->start_time,

                'end_time' =>
                    $request->filled('end_time')
                        ? $request->end_time
                        : null,

                /*
                 * The architect may add the actual meeting link
                 * or location when reviewing the request.
                 */
                'meeting_link' =>
                    null,

                'location' =>
                    null,

                'status' =>
                    'pending',

                'notes' =>
                    $request->filled('notes')
                        ? trim($request->notes)
                        : null,

            ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY ARCHITECT
        |--------------------------------------------------------------------------
        */

        if ($project->architect) {

            $formattedDate =
                Carbon::parse(
                    $projectMeeting->meeting_date
                )->format('M d, Y');

            $formattedTime =
                Carbon::parse(
                    $projectMeeting->start_time
                )->format('g:i A');

            $project->architect->notify(

                new ProjectActivityNotification(

                    'Meeting Request from Client',

                    'Your client requested "' .
                    $projectMeeting->title .
                    '" for ' .
                    $formattedDate .
                    ' at ' .
                    $formattedTime .
                    ' for ' .
                    $project->project_name .
                    '. Please review the request.',

                    'meeting',

                    $project->id,

                    route(
                        'architect.projects.show',
                        [
                            'id' =>
                                $project->id,
                        ]
                    )
                    . '?tab=meetings#meeting-'
                    . $projectMeeting->id

                )

            );
        }


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this
            ->meetingRedirect(
                $project,
                $projectMeeting
            )
            ->with(
                'success',
                'Meeting request submitted successfully. Your architect will review the requested schedule.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE ARCHITECT MEETING REQUEST
    |--------------------------------------------------------------------------
    */

    public function approve($id, $meeting)
    {
        $project =
            $this->getProjectForClient(
                $id
            );

        $projectMeeting =
            ProjectMeeting::with(
                'architect'
            )
                ->where(
                    'id',
                    $meeting
                )
                ->where(
                    'project_id',
                    $project->id
                )
                ->where(
                    'client_id',
                    auth()->id()
                )
                ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | ONLY CLIENT MAY APPROVE AN ARCHITECT PROPOSAL
        |--------------------------------------------------------------------------
        */

        if (
            $projectMeeting->status !== 'pending'
            ||
            $projectMeeting->proposed_by !== 'architect'
        ) {

            return $this
                ->meetingRedirect(
                    $project,
                    $projectMeeting
                )
                ->withErrors([
                    'meeting' =>
                        'This meeting request is not waiting for your approval.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PREVENT APPROVAL OF PAST REQUEST
        |--------------------------------------------------------------------------
        */

        $meetingStart =
            Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $projectMeeting->meeting_date->format('Y-m-d')
                . ' '
                . $projectMeeting->start_time,
                'Asia/Manila'
            );

        if (
            $meetingStart->lte(
                Carbon::now('Asia/Manila')
            )
        ) {

            return $this
                ->meetingRedirect(
                    $project,
                    $projectMeeting
                )
                ->withErrors([
                    'meeting_date' =>
                        'This meeting request can no longer be approved because the proposed schedule has already passed.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK FOR SCHEDULE CONFLICT
        |--------------------------------------------------------------------------
        */

        if (
            $this->hasScheduleConflict(
                $projectMeeting->architect_id,
                $projectMeeting->meeting_date->format('Y-m-d'),
                Carbon::parse(
                    $projectMeeting->start_time
                )->format('H:i'),
                $projectMeeting->end_time
                    ? Carbon::parse(
                        $projectMeeting->end_time
                    )->format('H:i')
                    : null,
                $projectMeeting->id
            )
        ) {

            return $this
                ->meetingRedirect(
                    $project,
                    $projectMeeting
                )
                ->withErrors([
                    'start_time' =>
                        'The architect already has another meeting or pending request during this time. Please propose another schedule.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVE
        |--------------------------------------------------------------------------
        */

        $projectMeeting->update([
            'status' =>
                'scheduled',
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY ARCHITECT
        |--------------------------------------------------------------------------
        */

        if ($projectMeeting->architect) {

            $projectMeeting->architect->notify(

                new ProjectActivityNotification(

                    'Meeting Request Approved',

                    'Your client approved the meeting request "' .
                    $projectMeeting->title .
                    '" for ' .
                    $project->project_name .
                    '.',

                    'meeting',

                    $project->id,

                    route(
                        'architect.projects.show',
                        [
                            'id' =>
                                $project->id,
                        ]
                    )
                    . '?tab=meetings#meeting-'
                    . $projectMeeting->id

                )

            );
        }


        return $this
            ->meetingRedirect(
                $project,
                $projectMeeting
            )
            ->with(
                'success',
                'Meeting request approved successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REJECT ARCHITECT MEETING REQUEST
    |--------------------------------------------------------------------------
    */

    public function reject($id, $meeting)
    {
        $project =
            $this->getProjectForClient(
                $id
            );

        $projectMeeting =
            ProjectMeeting::with(
                'architect'
            )
                ->where(
                    'id',
                    $meeting
                )
                ->where(
                    'project_id',
                    $project->id
                )
                ->where(
                    'client_id',
                    auth()->id()
                )
                ->firstOrFail();


        if (
            $projectMeeting->status !== 'pending'
            ||
            $projectMeeting->proposed_by !== 'architect'
        ) {

            return $this
                ->meetingRedirect(
                    $project,
                    $projectMeeting
                )
                ->withErrors([
                    'meeting' =>
                        'This meeting request is not waiting for your response.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REJECT
        |--------------------------------------------------------------------------
        |
        | We use the existing "cancelled" status for a rejected proposal.
        |
        */

        $projectMeeting->update([
            'status' =>
                'cancelled',
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY ARCHITECT
        |--------------------------------------------------------------------------
        */

        if ($projectMeeting->architect) {

            $projectMeeting->architect->notify(

                new ProjectActivityNotification(

                    'Meeting Request Rejected',

                    'Your client rejected the meeting request "' .
                    $projectMeeting->title .
                    '" for ' .
                    $project->project_name .
                    '.',

                    'meeting',

                    $project->id,

                    route(
                        'architect.projects.show',
                        [
                            'id' =>
                                $project->id,
                        ]
                    )
                    . '?tab=meetings#meeting-'
                    . $projectMeeting->id

                )

            );
        }


        return $this
            ->meetingRedirect(
                $project,
                $projectMeeting
            )
            ->with(
                'success',
                'Meeting request rejected.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PROPOSE NEW SCHEDULE
    |--------------------------------------------------------------------------
    |
    | Client may respond to an Architect proposal by proposing a new date
    | and time. The proposal remains Pending, but ownership transfers to
    | the Client. The Architect must then approve the new proposal.
    |
    */

    public function reschedule(
        Request $request,
        $id,
        $meeting
    ) {
        $project =
            $this->getProjectForClient(
                $id
            );

        $projectMeeting =
            ProjectMeeting::with(
                'architect'
            )
                ->where(
                    'id',
                    $meeting
                )
                ->where(
                    'project_id',
                    $project->id
                )
                ->where(
                    'client_id',
                    auth()->id()
                )
                ->firstOrFail();


        if (
            $projectMeeting->status !== 'pending'
            ||
            $projectMeeting->proposed_by !== 'architect'
        ) {

            return $this
                ->meetingRedirect(
                    $project,
                    $projectMeeting
                )
                ->withErrors([
                    'meeting' =>
                        'A new schedule can only be proposed for a pending Architect meeting request.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'meeting_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'nullable',
                'date_format:H:i',
                'after:start_time',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:3000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PREVENT PAST DATE + TIME
        |--------------------------------------------------------------------------
        */

        $meetingStart =
            Carbon::createFromFormat(
                'Y-m-d H:i',
                $request->meeting_date
                . ' '
                . $request->start_time,
                'Asia/Manila'
            );

        if (
            $meetingStart->lte(
                Carbon::now('Asia/Manila')
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'meeting_date' =>
                        'Please select a future date and time.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK FOR SCHEDULE CONFLICT
        |--------------------------------------------------------------------------
        */

        if (
            $this->hasScheduleConflict(
                $projectMeeting->architect_id,
                $request->meeting_date,
                $request->start_time,
                $request->filled('end_time')
                    ? $request->end_time
                    : null,
                $projectMeeting->id
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                        'The architect already has another meeting or pending request during this time. Please choose another schedule.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SAVE CLIENT COUNTER-PROPOSAL
        |--------------------------------------------------------------------------
        */

        $projectMeeting->update([

            'meeting_date' =>
                $request->meeting_date,

            'start_time' =>
                $request->start_time,

            'end_time' =>
                $request->filled('end_time')
                    ? $request->end_time
                    : null,

            'status' =>
                'pending',

            'proposed_by' =>
                'client',

            'proposed_by_user_id' =>
                auth()->id(),

            'notes' =>
                $request->filled('notes')
                    ? trim($request->notes)
                    : $projectMeeting->notes,

        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY ARCHITECT
        |--------------------------------------------------------------------------
        */

        if ($projectMeeting->architect) {

            $formattedDate =
                Carbon::parse(
                    $projectMeeting->meeting_date
                )->format('M d, Y');

            $formattedTime =
                Carbon::parse(
                    $projectMeeting->start_time
                )->format('g:i A');

            $projectMeeting->architect->notify(

                new ProjectActivityNotification(

                    'Client Proposed New Meeting Schedule',

                    'Your client proposed a new schedule for "' .
                    $projectMeeting->title .
                    '" on ' .
                    $formattedDate .
                    ' at ' .
                    $formattedTime .
                    ' for ' .
                    $project->project_name .
                    '. Please review the new proposal.',

                    'meeting',

                    $project->id,

                    route(
                        'architect.projects.show',
                        [
                            'id' =>
                                $project->id,
                        ]
                    )
                    . '?tab=meetings#meeting-'
                    . $projectMeeting->id

                )

            );
        }


        return $this
            ->meetingRedirect(
                $project,
                $projectMeeting
            )
            ->with(
                'success',
                'New meeting schedule proposed. Your architect must approve the updated schedule.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK ARCHITECT AVAILABILITY
    |--------------------------------------------------------------------------
    */

    public function availability(Request $request, $id)
    {
        $project =
            $this->getProjectForClient(
                $id
            );


        /*
        |--------------------------------------------------------------------------
        | CHECK IF PROJECT HAS ARCHITECT
        |--------------------------------------------------------------------------
        */

        if (!$project->architect_id) {

            return response()->json([
                'success' =>
                    false,

                'message' =>
                    'This project does not have an assigned architect yet.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATE DATE
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET BLOCKED MEETINGS
        |--------------------------------------------------------------------------
        */

        $meetings =
            ProjectMeeting::where(
                'architect_id',
                $project->architect_id
            )
                ->whereDate(
                    'meeting_date',
                    $request->date
                )
                ->whereIn(
                    'status',
                    [
                        'pending',
                        'scheduled',
                    ]
                )
                ->orderBy(
                    'start_time'
                )
                ->get();


        /*
        |--------------------------------------------------------------------------
        | FORMAT UNAVAILABLE TIMES
        |--------------------------------------------------------------------------
        */

        $unavailableTimes =
            $meetings
                ->map(
                    function ($meeting) {

                        $start =
                            Carbon::parse(
                                $meeting->start_time,
                                'Asia/Manila'
                            );

                        $end =
                            $meeting->end_time
                                ? Carbon::parse(
                                    $meeting->end_time,
                                    'Asia/Manila'
                                )
                                : $start
                                    ->copy()
                                    ->addHour();

                        return [

                            'start' =>
                                $start->format('H:i'),

                            'end' =>
                                $end->format('H:i'),

                            'start_label' =>
                                $start->format('g:i A'),

                            'end_label' =>
                                $end->format('g:i A'),

                        ];
                    }
                )
                ->values();


        /*
        |--------------------------------------------------------------------------
        | RETURN AVAILABILITY
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'date' =>
                $request->date,

            'unavailable_times' =>
                $unavailableTimes,

        ]);
    }
}
