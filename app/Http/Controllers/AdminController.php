<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Philippine Time
        $phTime = Carbon::now('Asia/Manila');

        $hour = $phTime->hour;

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good Morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Evening';
        }

        // Date and time
        $currentDate = $phTime->format('l, F j, Y');
        $currentTime = $phTime->format('h:i A');

        // Architect accounts
        $totalArchitects = User::where('role', 'architect')->count();

        $activeArchitects = User::where('role', 'architect')
            ->where('status', 'active')
            ->count();

        $inactiveArchitects = User::where('role', 'architect')
            ->whereIn('status', ['inactive', 'suspended'])
            ->count();

        // All system users
        $totalUsers = User::count();

        // Recently registered users
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'greeting',
            'currentDate',
            'currentTime',
            'totalArchitects',
            'activeArchitects',
            'inactiveArchitects',
            'totalUsers',
            'recentUsers'
        ));
    }
}