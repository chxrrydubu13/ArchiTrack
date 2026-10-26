<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));
        $status = trim((string) $request->get('status', ''));
        $phase = trim((string) $request->get('phase', ''));

        // Admin can review retained projects even after their architect account is deleted.
        $query = Project::query()
            ->with([
                'architect:id,name,email,status',
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
                    // Preserved even when architect_id becomes NULL after account deletion.
                    ->orWhere('original_architect_name', 'like', "%{$search}%")
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
            // Presentation-only metadata; do not mutate ownership or database status.
            $project->admin_architect_name = $project->architect?->name
                ?: ($project->original_architect_name ?: 'Unknown architect');
            $project->admin_architect_account_state = $project->architect === null
                ? 'deleted'
                : strtolower((string) ($project->architect->status ?: 'active'));

            $currentPhase = $project->phases
                ->first(function ($projectPhase) {
                    return strtolower((string) $projectPhase->status) !== 'completed';
                });

            if (!$currentPhase) {
                $currentPhase = $project->phases->last();
            }

            $project->admin_current_phase = $currentPhase?->phase_name ?? 'Not started';
        });

        if ($phase !== '') {
            $projects = $projects
                ->filter(function ($project) use ($phase) {
                    return strtolower((string) $project->admin_current_phase) === strtolower($phase);
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
                return strtolower((string) $project->status) === 'active';
            })
            ->count();

        $completedProjects = $allProjects
            ->filter(function ($project) {
                return strtolower((string) $project->status) === 'completed'
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
            'architect:id,name,email,status',
            'client:id,name,email',
            'collaborators:id,name,email',
            'phases.milestones',
            'files',
            'revisions',
            'meetings',
            'messages',
            'aiHistories.client:id,name,email',
            'aiHistories.parentHistory',
            'meetingActions',
            'expenses',
        ]);

        // ProjectFile::versions() returns a Collection, not an Eloquent relation.
        // All file-version rows are already included in $project->files.

        $project->loadCount([
            'files',
            'revisions',
            'meetings',
            'messages',
            'aiHistories',
            'meetingActions',
            'expenses',
        ]);

        // Retain the original architect's identity for the Admin project detail view.
        $project->admin_architect_name = $project->architect?->name
            ?: ($project->original_architect_name ?: 'Unknown architect');
        $project->admin_architect_account_state = $project->architect === null
            ? 'deleted'
            : strtolower((string) ($project->architect->status ?: 'active'));

        $currentPhase = $project->phases
            ->first(function ($projectPhase) {
                return strtolower((string) $projectPhase->status) !== 'completed';
            });

        if (!$currentPhase) {
            $currentPhase = $project->phases->last();
        }

        $currentPhaseName = $currentPhase?->phase_name ?? 'Not started';

        $completedPhases = $project->phases
            ->filter(function ($projectPhase) {
                return strtolower((string) $projectPhase->status) === 'completed';
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
                        return strtolower((string) ($milestone->status ?? '')) === 'completed';
                    })
                    ->count();
            });

        // Read-only, project-scoped audit history; preserved user_name survives user removal.
        $auditLogs = AuditLog::query()
            ->where('project_id', $project->getKey())
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.projects.show', compact(
            'project',
            'currentPhaseName',
            'completedPhases',
            'totalPhases',
            'totalMilestones',
            'completedMilestones',
            'auditLogs'
        ));
    }
}
