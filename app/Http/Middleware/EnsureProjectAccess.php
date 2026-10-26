<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProjectAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        abort_unless($user, 401);

        // Archived or on-hold architects cannot use any architect endpoints.
        if ($user->role === 'architect' && $user->status !== 'active') {
            abort(403, 'Your architect account is not active.');
        }

        $route = $request->route();
        if (!$route) {
            return $next($request);
        }

        $uri = $route->uri();
        $projectId = $route->parameter('projectId') ?? $route->parameter('project');

        // Only interpret {id} as a project ID for project-scoped URLs.
        if ($projectId === null && preg_match('~(?:^|/)projects/\{id\}(?:/|$)~', $uri)) {
            $projectId = $route->parameter('id');
        }

        if ($projectId === null && preg_match('~(?:^|/)(?:messages|meetings)/\{projectId\}(?:/|$)~', $uri)) {
            $projectId = $route->parameter('projectId');
        }

        // Index and other non-project-scoped routes must filter records in their controllers.
        if ($projectId === null) {
            return $next($request);
        }

        if ($projectId instanceof Project) {
            $projectId = $projectId->getKey();
        }

        $project = Project::query()->with('architect:id,status')->findOrFail($projectId);

        if ($user->role === 'admin') {
            return $next($request);
        }

        // No lead architect or nonactive lead => retained project is admin-only.
        abort_unless($project->architect && $project->architect->status === 'active', 404);

        if ($user->role === 'client') {
            abort_unless((int) $project->client_id === (int) $user->id, 404);
        } elseif ($user->role === 'architect') {
            $isLead = (int) $project->architect_id === (int) $user->id;
            $isCollaborator = $project->projectArchitects()
                ->where('architect_id', $user->id)->exists();
            abort_unless($isLead || $isCollaborator, 404);
        } else {
            abort(403);
        }

        return $next($request);
    }
}
