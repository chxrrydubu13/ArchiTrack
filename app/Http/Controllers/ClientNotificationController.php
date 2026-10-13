<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientNotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        $notifications = $user->notifications()
            ->latest()
            ->take(20)
            ->get();

        $unreadCount = $user->unreadNotifications()
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MARK ONE AS READ
    |--------------------------------------------------------------------------
    */

    public function markAsRead($id)
    {
        $user = Auth::user();

        $notification = $user->notifications()
            ->where('id', $id)
            ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return response()->json([
            'success' => true,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MARK ALL AS READ
    |--------------------------------------------------------------------------
    */

    public function markAllAsRead()
    {
        $user = Auth::user();

        $user->unreadNotifications
            ->markAsRead();

        return response()->json([
            'success' => true,
        ]);
    }
}