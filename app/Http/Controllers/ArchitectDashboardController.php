<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;

class ArchitectDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Philippine time
        $phTime = Carbon::now('Asia/Manila');

        $hour = $phTime->hour;

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good Morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Evening';
        }

        $currentDate = $phTime->format('l, F j, Y');
        $currentTime = $phTime->format('h:i A');


        /*
        |--------------------------------------------------------------------------
        | PROJECTS ACCESSIBLE TO THE LOGGED IN ARCHITECT
        |--------------------------------------------------------------------------
        |
        | Includes:
        | - projects where the user is the lead architect
        | - projects where the user is an assigned collaborator
        |
        */

        $projects = Project::where(
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
            ->latest()
            ->get();


        $totalProjects =
            $projects->count();


        $planningProjects =
            $projects
                ->where(
                    'status',
                    'planning'
                )
                ->count();


        $ongoingProjects =
            $projects
                ->where(
                    'status',
                    'ongoing'
                )
                ->count();


        $completedProjects =
            $projects
                ->where(
                    'status',
                    'completed'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | RECENT PROJECTS
        |--------------------------------------------------------------------------
        */

        $recentProjects =
            $projects
                ->sortByDesc(
                    'created_at'
                )
                ->take(4)
                ->values();


        return view(
            'architect.dashboard',
            compact(
                'user',
                'greeting',
                'currentDate',
                'currentTime',
                'totalProjects',
                'planningProjects',
                'ongoingProjects',
                'completedProjects',
                'recentProjects'
            )
        );
    }
}
