<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchitectRevisionsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ACCESSIBLE PROJECTS
    |--------------------------------------------------------------------------
    |
    | The architect can see projects where they are either:
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


    public function index(Request $request)
    {
        $architect = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | GET ACCESSIBLE ARCHITECT PROJECTS
        |--------------------------------------------------------------------------
        */

        $projects =
            $this->accessibleProjectsQuery(
                $architect->id
            )
                ->with([
                    'client',
                    'revisions.client'
                ])
                ->get();


        /*
        |--------------------------------------------------------------------------
        | PROJECTS WITH REVISION REQUESTS
        |--------------------------------------------------------------------------
        */

        $projectsWithRevisions = $projects
            ->filter(function ($project) {
                return $project->revisions->count() > 0;
            })
            ->map(function ($project) {

                $project->revision_total =
                    $project->revisions->count();

                $project->revision_pending =
                    $project->revisions
                        ->where('status', 'pending')
                        ->count();

                $project->revision_in_progress =
                    $project->revisions
                        ->where('status', 'in_progress')
                        ->count();

                $project->revision_resolved =
                    $project->revisions
                        ->where('status', 'resolved')
                        ->count();


                /*
                |--------------------------------------------------------------------------
                | TEMPORARY VIEW COMPATIBILITY
                |--------------------------------------------------------------------------
                |
                | The current centralized revisions Blade may still reference
                | revision_approved and revision_implemented.
                |
                | Keep these aliases temporarily so the page does not break while
                | the Blade is being updated to the current status names.
                |
                */

                $project->revision_approved =
                    $project->revision_in_progress;

                $project->revision_implemented =
                    $project->revision_resolved;


                $project->last_revision =
                    $project->revisions
                        ->sortByDesc('created_at')
                        ->first();

                return $project;
            })
            ->sortByDesc(function ($project) {
                return optional(
                    $project->last_revision
                )->created_at;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | ALL REVISION COUNTS
        |--------------------------------------------------------------------------
        */

        $allRevisions = $projects
            ->flatMap(function ($project) {
                return $project->revisions;
            });

        $totalRevisionCount =
            $allRevisions->count();

        $pendingRevisionCount =
            $allRevisions
                ->where('status', 'pending')
                ->count();

        $inProgressRevisionCount =
            $allRevisions
                ->where('status', 'in_progress')
                ->count();

        $resolvedRevisionCount =
            $allRevisions
                ->where('status', 'resolved')
                ->count();


        /*
        |--------------------------------------------------------------------------
        | TEMPORARY VIEW COMPATIBILITY
        |--------------------------------------------------------------------------
        |
        | Keep the old variable names available until the centralized revisions
        | Blade is updated. Their values now use the correct current statuses.
        |
        */

        $approvedRevisionCount =
            $inProgressRevisionCount;

        $implementedRevisionCount =
            $resolvedRevisionCount;


        /*
        |--------------------------------------------------------------------------
        | SELECTED PROJECT FOR DRAWER
        |--------------------------------------------------------------------------
        */

        $selectedProject = null;

        if ($request->filled('project')) {

            $selectedProject =
                $projectsWithRevisions
                    ->firstWhere(
                        'id',
                        (int) $request->project
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SELECTED REVISIONS
        |--------------------------------------------------------------------------
        */

        $selectedRevisions = collect();

        if ($selectedProject) {

            $selectedRevisions =
                $selectedProject->revisions
                    ->sortByDesc('created_at')
                    ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | DRAWER FILTER
        |--------------------------------------------------------------------------
        */

        $revisionFilter =
            $request->revision_status ?? 'all';


        $allowedRevisionFilters = [
            'all',
            'pending',
            'in_progress',
            'resolved',
        ];


        if (
            !in_array(
                $revisionFilter,
                $allowedRevisionFilters,
                true
            )
        ) {

            $revisionFilter =
                'all';
        }


        if (
            $selectedProject &&
            $revisionFilter !== 'all'
        ) {

            $selectedRevisions =
                $selectedRevisions
                    ->where(
                        'status',
                        $revisionFilter
                    )
                    ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'architect.revisions',
            compact(
                'projectsWithRevisions',

                'totalRevisionCount',
                'pendingRevisionCount',
                'inProgressRevisionCount',
                'resolvedRevisionCount',

                /*
                |--------------------------------------------------------------------------
                | TEMPORARY OLD VIEW VARIABLES
                |--------------------------------------------------------------------------
                */

                'approvedRevisionCount',
                'implementedRevisionCount',

                'selectedProject',
                'selectedRevisions',
                'revisionFilter'
            )
        );
    }
}
