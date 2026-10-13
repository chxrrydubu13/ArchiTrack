<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $architectId = $request->get('architect');
        $phase = $request->get('phase');

        $projectsQuery = Project::query()
            ->with([
                'architect',
                'client',
                'collaborators',
                'phases.milestones',
                'expenses',
            ])
            ->withCount([
                'files',
                'revisions',
                'meetings',
                'messages',
            ]);

        if ($status) {
            $projectsQuery->where('status', $status);
        }

        if ($architectId) {
            $projectsQuery->where(function ($query) use ($architectId) {
                $query->where('architect_id', $architectId)
                    ->orWhereHas('collaborators', function ($teamQuery) use ($architectId) {
                        $teamQuery->where('users.id', $architectId);
                    });
            });
        }

        if ($phase) {
            $projectsQuery->whereHas('phases', function ($query) use ($phase) {
                $query->where('phase_name', $phase)
                    ->where('status', '!=', 'completed');
            });
        }

        $projects = $projectsQuery
            ->latest('updated_at')
            ->get();

        $allProjects = Project::query()
            ->with(['phases', 'expenses'])
            ->get();

        $totalProjects = $allProjects->count();

        $activeProjects = $allProjects
            ->filter(function ($project) {
                return strtolower((string) $project->status) === 'active';
            })
            ->count();

        $completedProjects = $allProjects
            ->filter(function ($project) {
                return strtolower((string) $project->status) === 'completed';
            })
            ->count();

        $archivedProjects = $allProjects
            ->filter(function ($project) {
                return strtolower((string) $project->status) === 'archived';
            })
            ->count();

        $phaseNames = [
            'Consultation',
            'Agreement',
            'Planning',
            'Design',
            'Approval',
            'Development',
            'Permits',
            'Construction',
            'Inspection',
            'Turnover',
        ];

        $phaseSummary = collect($phaseNames)->map(function ($phaseName) use ($allProjects) {
            $count = $allProjects->filter(function ($project) use ($phaseName) {
                $currentPhase = $project->phases
                    ->sortBy('phase_order')
                    ->first(function ($phase) {
                        return strtolower((string) $phase->status) !== 'completed';
                    });

                if (!$currentPhase) {
                    $currentPhase = $project->phases
                        ->sortBy('phase_order')
                        ->last();
                }

                return $currentPhase
                    && $currentPhase->phase_name === $phaseName;
            })->count();

            return [
                'phase' => $phaseName,
                'count' => $count,
            ];
        });

        $architects = User::query()
            ->where('role', 'architect')
            ->orderBy('name')
            ->get();

        $architectWorkload = $architects->map(function ($architect) use ($allProjects) {
            $leadCount = $allProjects
                ->where('architect_id', $architect->id)
                ->count();

            $collaboratorCount = Project::query()
                ->whereHas('collaborators', function ($query) use ($architect) {
                    $query->where('users.id', $architect->id);
                })
                ->count();

            return [
                'id' => $architect->id,
                'name' => $architect->name,
                'lead_projects' => $leadCount,
                'collaborator_projects' => $collaboratorCount,
                'total_projects' => $leadCount + $collaboratorCount,
            ];
        });

        $totalBudget = $allProjects->sum(function ($project) {
            return (float) ($project->budget ?? 0);
        });

        $totalExpenses = $allProjects->sum(function ($project) {
            return (float) $project->expenses->sum('amount');
        });

        $totalRemaining = $totalBudget - $totalExpenses;

        return view('admin.reports.index', compact(
            'projects',
            'architects',
            'phaseNames',
            'phaseSummary',
            'architectWorkload',
            'totalProjects',
            'activeProjects',
            'completedProjects',
            'archivedProjects',
            'totalBudget',
            'totalExpenses',
            'totalRemaining'
        ));
    }
}
