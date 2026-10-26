<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ClientNotificationController extends Controller
{
    /**
     * Only an active client may access notifications.
     */
    private function activeClient()
    {
        $user = Auth::user();

        abort_unless(
            $user && $user->role === 'client' && $user->status === 'active',
            403
        );

        return $user;
    }

    /**
     * Restrict notifications tied to a project to projects that still have
     * an active lead architect. Notifications without a project_id are kept.
     *
     * Laravel database notifications store their payload in the JSON `data`
     * column. This expects project-linked notifications to use `project_id`.
     */
    private function visibleNotificationsQuery($user, bool $unreadOnly = false)
    {
        $query = $unreadOnly
            ? $user->unreadNotifications()
            : $user->notifications();

        $allowedProjectIds = Project::query()
            ->where('client_id', $user->id)
            ->whereHas('architect', function ($architectQuery) {
                $architectQuery->where('role', 'architect')
                    ->where('status', 'active');
            })
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->all();

        // Use JSON extraction to keep the visibility rule in the database,
        // including for unread counts and mark-all operations.
        $query->where(function ($notificationQuery) use ($allowedProjectIds) {
            $notificationQuery->whereNull('data->project_id');

            if (!empty($allowedProjectIds)) {
                $notificationQuery->orWhereIn('data->project_id', $allowedProjectIds);
            }
        });

        return $query;
    }

    public function index()
    {
        $user = $this->activeClient();

        $notifications = $this->visibleNotificationsQuery($user)
            ->latest()
            ->take(20)
            ->get();

        $unreadCount = $this->visibleNotificationsQuery($user, true)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function markAsRead($id)
    {
        $user = $this->activeClient();

        $notification = $this->visibleNotificationsQuery($user)
            ->where('id', $id)
            ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $user = $this->activeClient();

        $this->visibleNotificationsQuery($user, true)
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
