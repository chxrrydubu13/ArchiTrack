<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientMeetingsController extends Controller
{
    public function index(Request $request)
    {
        $client = Auth::user();

        // Only active client accounts may access the centralized meetings page.
        abort_unless(
            $client && $client->role === 'client' && $client->status === 'active',
            403
        );

        /*
        |--------------------------------------------------------------------------
        | CLIENT PROJECTS
        |--------------------------------------------------------------------------
        |
        | Only projects owned by the logged-in client are available here.
        |
        */

        $projects = Project::with('architect')
            ->where('client_id', $client->id)
            // Restrict projects by the LEAD architect account, not project status.
            ->whereHas('architect', function ($query) {
                $query->where('role', 'architect')
                    ->where('status', 'active');
            })
            ->orderBy('project_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CLIENT MEETINGS
        |--------------------------------------------------------------------------
        |
        | Meetings are also scoped directly by client_id for security.
        |
        */

        $allMeetings = ProjectMeeting::with([
                'project',
                'architect',
            ])
            ->where('client_id', $client->id)
            ->whereIn(
                'project_id',
                $projects->pluck('id')
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | COUNTS
        |--------------------------------------------------------------------------
        */

        $pendingCount = $allMeetings
            ->where('status', 'pending')
            ->count();

        $scheduledCount = $allMeetings
            ->where('status', 'scheduled')
            ->count();

        $completedCount = $allMeetings
            ->where('status', 'completed')
            ->count();

        $cancelledCount = $allMeetings
            ->where('status', 'cancelled')
            ->count();

        $totalCount = $allMeetings->count();


        /*
        |--------------------------------------------------------------------------
        | UPCOMING MEETINGS
        |--------------------------------------------------------------------------
        */

        $now = Carbon::now('Asia/Manila');

        $upcomingMeetings = $allMeetings
            ->filter(function ($meeting) use ($now) {

                if (
                    !in_array(
                        $meeting->status,
                        [
                            'pending',
                            'scheduled',
                        ]
                    )
                ) {
                    return false;
                }

                if (!$meeting->meeting_date) {
                    return false;
                }

                $meetingDate =
                    Carbon::parse(
                        $meeting->meeting_date,
                        'Asia/Manila'
                    );

                return $meetingDate
                    ->startOfDay()
                    ->gte(
                        $now->copy()->startOfDay()
                    );
            })
            ->sortBy(function ($meeting) {

                $date = Carbon::parse(
                    $meeting->meeting_date
                )->format('Y-m-d');

                return $date
                    . ' '
                    . ($meeting->start_time ?? '00:00:00');
            })
            ->take(5)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | FILTER VALUES
        |--------------------------------------------------------------------------
        */

        $search = trim(
            $request->search ?? ''
        );

        $projectId =
            $request->project;

        $status =
            $request->status;

        $type =
            $request->type;

        $view =
            $request->view ?? 'upcoming';

        $sort =
            $request->sort ?? 'soonest';


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {

            $searchText =
                strtolower($search);

            $allMeetings = $allMeetings
                ->filter(function ($meeting) use ($searchText) {

                    $title = strtolower(
                        $meeting->title ?? ''
                    );

                    $agenda = strtolower(
                        $meeting->agenda ?? ''
                    );

                    $projectName = strtolower(
                        $meeting->project->project_name
                        ?? ''
                    );

                    $architectName = strtolower(
                        $meeting->architect->name
                        ?? ''
                    );

                    $location = strtolower(
                        $meeting->location
                        ?? ''
                    );

                    return str_contains(
                        $title,
                        $searchText
                    )
                    ||
                    str_contains(
                        $agenda,
                        $searchText
                    )
                    ||
                    str_contains(
                        $projectName,
                        $searchText
                    )
                    ||
                    str_contains(
                        $architectName,
                        $searchText
                    )
                    ||
                    str_contains(
                        $location,
                        $searchText
                    );
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | PROJECT FILTER
        |--------------------------------------------------------------------------
        */

        if ($projectId) {

            $allMeetings = $allMeetings
                ->filter(function ($meeting) use ($projectId) {

                    return (int) $meeting->project_id
                        ===
                        (int) $projectId;
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($status) {

            $allowedStatuses = [
                'pending',
                'scheduled',
                'completed',
                'cancelled',
            ];

            if (in_array($status, $allowedStatuses)) {

                $allMeetings = $allMeetings
                    ->where('status', $status)
                    ->values();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MEETING TYPE FILTER
        |--------------------------------------------------------------------------
        */

        if (
            $type
            &&
            in_array(
                $type,
                [
                    'online',
                    'in_person',
                ]
            )
        ) {

            $allMeetings = $allMeetings
                ->where(
                    'meeting_type',
                    $type
                )
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | QUICK VIEW FILTERS
        |--------------------------------------------------------------------------
        */

        if ($view === 'upcoming') {

            $allMeetings = $allMeetings
                ->filter(function ($meeting) use ($now) {

                    if (
                        !in_array(
                            $meeting->status,
                            [
                                'pending',
                                'scheduled',
                            ]
                        )
                    ) {
                        return false;
                    }

                    if (!$meeting->meeting_date) {
                        return false;
                    }

                    return Carbon::parse(
                        $meeting->meeting_date,
                        'Asia/Manila'
                    )
                        ->startOfDay()
                        ->gte(
                            $now->copy()->startOfDay()
                        );
                })
                ->values();
        }

        if ($view === 'pending') {

            $allMeetings = $allMeetings
                ->where(
                    'status',
                    'pending'
                )
                ->values();
        }

        if ($view === 'scheduled') {

            $allMeetings = $allMeetings
                ->where(
                    'status',
                    'scheduled'
                )
                ->values();
        }

        if ($view === 'completed') {

            $allMeetings = $allMeetings
                ->where(
                    'status',
                    'completed'
                )
                ->values();
        }

        if ($view === 'cancelled') {

            $allMeetings = $allMeetings
                ->where(
                    'status',
                    'cancelled'
                )
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */

        if ($sort === 'latest') {

            $allMeetings = $allMeetings
                ->sortByDesc('created_at')
                ->values();
        }

        elseif ($sort === 'oldest') {

            $allMeetings = $allMeetings
                ->sortBy('created_at')
                ->values();
        }

        elseif ($sort === 'project') {

            $allMeetings = $allMeetings
                ->sortBy(function ($meeting) {

                    return strtolower(
                        $meeting->project->project_name
                        ?? ''
                    );
                })
                ->values();
        }

        else {

            /*
            |--------------------------------------------------------------------------
            | SOONEST MEETING FIRST
            |--------------------------------------------------------------------------
            */

            $allMeetings = $allMeetings
                ->sortBy(function ($meeting) {

                    if (!$meeting->meeting_date) {
                        return '9999-12-31 23:59:59';
                    }

                    $date = Carbon::parse(
                        $meeting->meeting_date
                    )->format('Y-m-d');

                    return $date
                        . ' '
                        . ($meeting->start_time ?? '00:00:00');
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'client.meetings',
            compact(
                'client',
                'projects',
                'allMeetings',
                'upcomingMeetings',
                'totalCount',
                'pendingCount',
                'scheduledCount',
                'completedCount',
                'cancelledCount',
                'search',
                'projectId',
                'status',
                'type',
                'view',
                'sort'
            )
        );
    }
}
