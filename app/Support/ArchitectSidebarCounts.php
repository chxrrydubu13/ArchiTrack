<?php

namespace App\Support;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ArchitectSidebarCounts
{
    public static function get(): array
    {
        $counts = ['pendingRevisionCount' => 0, 'pendingMeetingCount' => 0];
        $user = Auth::user();
        if (!$user || $user->role !== 'architect' || $user->status !== 'active') {
            return $counts;
        }

        $projects = Project::query()
            ->whereHas('architect', fn ($query) => $query
                ->where('role', 'architect')->where('status', 'active'))
            ->where(function ($query) use ($user) {
                $query->where('architect_id', $user->id)
                    ->orWhereHas('projectArchitects', fn ($team) => $team
                        ->where('architect_id', $user->id));
            })
            ->withCount([
                'revisions as pending_revision_requests_count' => fn ($query) => $query
                    ->where('status', 'pending'),
                'meetings as pending_meeting_requests_count' => fn ($query) => $query
                    ->where('status', 'pending')
                    ->where(function ($proposal) {
                        $proposal->where('proposed_by', 'client')
                            ->orWhereNull('proposed_by');
                    }),
            ])
            ->get();

        return [
            'pendingRevisionCount' => (int) $projects->sum('pending_revision_requests_count'),
            'pendingMeetingCount' => (int) $projects->sum('pending_meeting_requests_count'),
        ];
    }
}
