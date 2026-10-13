<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $action = trim($request->input('action', ''));
        $role = trim($request->input('role', ''));
        $date = trim($request->input('date', ''));


        // GET ACTUAL ACTIONS FROM DATABASE
        $actions = AuditLog::whereNotNull('action')
            ->where('action', '!=', '')
            ->select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');


        $logs = AuditLog::query()
            ->with([
                'user',
                'project'
            ]);


        // =====================================================
        // SEARCH
        // =====================================================
        if ($search !== '') {

            $logs->where(function ($query) use ($search) {

                $query
                    ->where('user_name', 'like', '%' . $search . '%')
                    ->orWhere('action', 'like', '%' . $search . '%')
                    ->orWhere('project_name', 'like', '%' . $search . '%')
                    ->orWhere('details', 'like', '%' . $search . '%');

            });

        }


        // =====================================================
        // EXACT ACTION FILTER
        // =====================================================
        if ($action !== '') {

            $logs->where(
                'action',
                $action
            );

        }


        // =====================================================
        // ROLE FILTER
        // =====================================================
        if ($role !== '') {

            $logs->whereHas('user', function ($query) use ($role) {

                $query->where(
                    'role',
                    $role
                );

            });

        }


        // =====================================================
        // DATE FILTER
        // =====================================================
        if ($date !== '') {

            $logs->whereDate(
                'created_at',
                $date
            );

        }


        $logs = $logs
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();


        return view(
            'admin.audit-logs.auditlogs',
            compact(
                'logs',
                'actions',
                'search',
                'action',
                'role',
                'date'
            )
        );
    }
}