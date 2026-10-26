<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;

class ArchitectDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Only active architect accounts may view architect dashboard data.
        abort_unless(
            $user && $user->role === 'architect' && $user->status === 'active',
            403
        );

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
        | Includes projects led by the architect or assigned to them as a
        | collaborator, but only when the project's lead architect is active.
        | Archived, on-hold and deleted lead-architect projects are excluded.
        */
        $projects = Project::query()
            ->whereHas('architect', function ($architectQuery) {
                $architectQuery
                    ->where('role', 'architect')
                    ->where('status', 'active');
            })
            ->where(function ($query) use ($user) {
                $query
                    ->where('architect_id', $user->id)
                    ->orWhereHas('projectArchitects', function ($teamQuery) use ($user) {
                        $teamQuery->where('architect_id', $user->id);
                    });
            })
            ->latest()
            ->get();

        $totalProjects = $projects->count();
        $planningProjects = $projects->where('status', 'planning')->count();
        $ongoingProjects = $projects->where('status', 'ongoing')->count();
        $completedProjects = $projects->where('status', 'completed')->count();

        $recentProjects = $projects
            ->sortByDesc('created_at')
            ->take(4)
            ->values();

        return view('architect.dashboard', compact(
            'user',
            'greeting',
            'currentDate',
            'currentTime',
            'totalProjects',
            'planningProjects',
            'ongoingProjects',
            'completedProjects',
            'recentProjects'
        ));
    }
}
