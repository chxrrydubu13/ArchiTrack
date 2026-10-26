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
    | Active architects can see projects where they are the lead architect
    | or an assigned collaborator, provided the lead architect is active.
    |
    */
    private function accessibleProjectsQuery($architectId)
    {
        return Project::whereHas('architect', function ($query) {
            $query->where('role', 'architect')
                ->where('status', 'active');
        })->where(function ($query) use ($architectId) {
            $query->where('architect_id', $architectId)
                ->orWhereHas('projectArchitects', function ($teamQuery) use ($architectId) {
                    $teamQuery->where('architect_id', $architectId);
                });
        });
    }

    public function index(Request $request)
    {
        $architect = Auth::user();

        abort_unless(
            $architect && $architect->role === 'architect' && $architect->status === 'active',
            403
        );

        $projects = $this->accessibleProjectsQuery($architect->id)
            ->with(['client', 'revisions.client'])
            ->get();

        $projectsWithRevisions = $projects
            ->filter(function ($project) {
                return $project->revisions->count() > 0;
            })
            ->map(function ($project) {
                $project->revision_total = $project->revisions->count();
                $project->revision_pending = $project->revisions->where('status', 'pending')->count();
                $project->revision_in_progress = $project->revisions->where('status', 'in_progress')->count();
                $project->revision_resolved = $project->revisions->where('status', 'resolved')->count();

                // Keep aliases for the existing centralized revisions Blade.
                $project->revision_approved = $project->revision_in_progress;
                $project->revision_implemented = $project->revision_resolved;

                $project->last_revision = $project->revisions
                    ->sortByDesc('created_at')
                    ->first();

                return $project;
            })
            ->sortByDesc(function ($project) {
                return optional($project->last_revision)->created_at;
            })
            ->values();

        $allRevisions = $projects->flatMap(function ($project) {
            return $project->revisions;
        });

        $totalRevisionCount = $allRevisions->count();
        $pendingRevisionCount = $allRevisions->where('status', 'pending')->count();
        $inProgressRevisionCount = $allRevisions->where('status', 'in_progress')->count();
        $resolvedRevisionCount = $allRevisions->where('status', 'resolved')->count();

        // Preserve compatibility with existing Blade variable names.
        $approvedRevisionCount = $inProgressRevisionCount;
        $implementedRevisionCount = $resolvedRevisionCount;

        $selectedProject = null;
        if ($request->filled('project')) {
            $selectedProject = $projectsWithRevisions->firstWhere('id', (int) $request->project);
        }

        $selectedRevisions = collect();
        if ($selectedProject) {
            $selectedRevisions = $selectedProject->revisions
                ->sortByDesc('created_at')
                ->values();
        }

        $revisionFilter = $request->revision_status ?? 'all';
        $allowedRevisionFilters = ['all', 'pending', 'in_progress', 'resolved'];

        if (!in_array($revisionFilter, $allowedRevisionFilters, true)) {
            $revisionFilter = 'all';
        }

        if ($selectedProject && $revisionFilter !== 'all') {
            $selectedRevisions = $selectedRevisions
                ->where('status', $revisionFilter)
                ->values();
        }

        return view('architect.revisions', compact(
            'projectsWithRevisions',
            'totalRevisionCount',
            'pendingRevisionCount',
            'inProgressRevisionCount',
            'resolvedRevisionCount',
            'approvedRevisionCount',
            'implementedRevisionCount',
            'selectedProject',
            'selectedRevisions',
            'revisionFilter'
        ));
    }
}
