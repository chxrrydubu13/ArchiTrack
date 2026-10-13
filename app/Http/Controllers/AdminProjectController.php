<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));
        $status = trim((string) $request->get('status', ''));
        $phase = trim((string) $request->get('phase', ''));

        $query = Project::query()
            ->with([
                'architect:id,name,email',
                'client:id,name,email',
                'phases',
            ])
            ->withCount([
                'files',
                'revisions',
                'meetings',
            ])
            ->latest('updated_at');

        if ($search !== '') {
            $query->where(function ($projectQuery) use ($search) {
                $projectQuery
                    ->where('project_name', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%")
                    ->orWhereHas('architect', function ($architectQuery) use ($search) {
                        $architectQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('client', function ($clientQuery) use ($search) {
                        $clientQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        $projects = $query->get();

        $projects->each(function ($project) {

            $currentPhase = $project->phases
                ->first(function ($projectPhase) {
                    return strtolower(
                        (string) $projectPhase->status
                    ) !== 'completed';
                });

            if (!$currentPhase) {
                $currentPhase = $project->phases->last();
            }

            $project->admin_current_phase =
                $currentPhase?->phase_name
                ?? 'Not started';
        });

        if ($phase !== '') {
            $projects = $projects
                ->filter(function ($project) use ($phase) {
                    return strtolower(
                        (string) $project->admin_current_phase
                    ) === strtolower($phase);
                })
                ->values();
        }

        $allProjects = Project::query()->get([
            'id',
            'status',
            'progress',
        ]);

        $totalProjects = $allProjects->count();

        $activeProjects = $allProjects
            ->filter(function ($project) {
                return strtolower(
                    (string) $project->status
                ) === 'active';
            })
            ->count();

        $completedProjects = $allProjects
            ->filter(function ($project) {
                return strtolower(
                    (string) $project->status
                ) === 'completed'
                    || (int) $project->progress >= 100;
            })
            ->count();

        $needsAttentionProjects = Project::query()
            ->whereHas('revisions', function ($revisionQuery) {
                $revisionQuery->whereIn('status', [
                    'pending',
                    'in_progress',
                ]);
            })
            ->count();

        return view('admin.projects.index', compact(
            'projects',
            'totalProjects',
            'activeProjects',
            'completedProjects',
            'needsAttentionProjects',
            'search',
            'status',
            'phase'
        ));
    }


    public function show(Project $project)
    {
        $project->load([
            'architect:id,name,email',
            'client:id,name,email',
            'collaborators:id,name,email',
            'phases.milestones',
        ]);

        $project->loadCount([
            'files',
            'revisions',
            'meetings',
            'messages',
        ]);

        $currentPhase = $project->phases
            ->first(function ($projectPhase) {
                return strtolower(
                    (string) $projectPhase->status
                ) !== 'completed';
            });

        if (!$currentPhase) {
            $currentPhase = $project->phases->last();
        }

        $currentPhaseName =
            $currentPhase?->phase_name
            ?? 'Not started';

        $completedPhases = $project->phases
            ->filter(function ($projectPhase) {
                return strtolower(
                    (string) $projectPhase->status
                ) === 'completed';
            })
            ->count();

        $totalPhases = $project->phases->count();

        $totalMilestones = $project->phases
            ->sum(function ($projectPhase) {
                return $projectPhase->milestones->count();
            });

        $completedMilestones = $project->phases
            ->sum(function ($projectPhase) {
                return $projectPhase->milestones
                    ->filter(function ($milestone) {
                        return strtolower(
                            (string) ($milestone->status ?? '')
                        ) === 'completed';
                    })
                    ->count();
            });

        return view('admin.projects.show', compact(
            'project',
            'currentPhaseName',
            'completedPhases',
            'totalPhases',
            'totalMilestones',
            'completedMilestones'
        ));
    }
}
