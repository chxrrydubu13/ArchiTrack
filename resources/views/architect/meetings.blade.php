<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Meetings | ArchiTrack</title>
    @vite([
        'resources/css/app.css',
        'resources/css/architect-dashboard.css',
        'resources/css/architect-meetings.css',
        'resources/css/architect-meetings-redesign.css',
        'resources/js/app.js'
    ])
<style>
html, body, button, input, textarea, select, option {
    font-family: "Segoe UI", Arial, sans-serif !important;
}
</style>
</head>
<body>
<button
        type="button"
        class="mobile-sidebar-launcher"
        id="mobileSidebarLauncher"
        aria-label="Open navigation"
        aria-controls="architectSidebar"
        aria-expanded="false"
    >
        <svg viewBox="0 0 24 24">
            <path d="M4 6h16"/>
            <path d="M4 12h16"/>
            <path d="M4 18h16"/>
        </svg>
    </button>
@php
    /*
    |--------------------------------------------------------------------------
    | CALENDAR
    |--------------------------------------------------------------------------
    */
    try {
        $calendarDate = request('month')
            ? \Carbon\Carbon::createFromFormat('Y-m', request('month'))->startOfMonth()
            : now()->startOfMonth();
    } catch (\Exception $e) {
        $calendarDate = now()->startOfMonth();
    }
    $calendarStart = $calendarDate
        ->copy()
        ->startOfWeek(\Carbon\Carbon::SUNDAY);
    $calendarEnd = $calendarDate
        ->copy()
        ->endOfMonth()
        ->endOfWeek(\Carbon\Carbon::SATURDAY);
    $previousMonth = $calendarDate
        ->copy()
        ->subMonth()
        ->format('Y-m');
    $nextMonth = $calendarDate
        ->copy()
        ->addMonth()
        ->format('Y-m');
    $calendarMeetings = $allMeetings ?? collect();
    $calendarActions = $allActions ?? collect();
    /*
    |--------------------------------------------------------------------------
    | PENDING CLIENT MEETING REQUESTS
    |--------------------------------------------------------------------------
    */
    $pendingMeetingRequests = $calendarMeetings
        ->filter(function ($meeting) {
            return $meeting->status === 'pending'
                &&
                (
                    $meeting->proposed_by === 'client'
                    ||
                    empty($meeting->proposed_by)
                );
        })
        ->sortBy('meeting_date');
    /*
    |--------------------------------------------------------------------------
    | UPCOMING
    |--------------------------------------------------------------------------
    */
    $upcomingMeetingsList = $calendarMeetings
        ->filter(function ($meeting) {
            return $meeting->meeting_date
                && $meeting->meeting_date >= now();
        })
        ->sortBy('meeting_date')
        ->take(5);
    /*
    |--------------------------------------------------------------------------
    | SELECTED PROJECT
    |--------------------------------------------------------------------------
    */
    $selectedProjectNextMeeting = null;
    if ($selectedProject) {
        $selectedProjectNextMeeting = $selectedProject
            ->meetings
            ->filter(function ($meeting) {
                return $meeting->meeting_date
                    && $meeting->meeting_date >= now();
            })
            ->sortBy('meeting_date')
            ->first();
    }
    /*
    |--------------------------------------------------------------------------
    | ACTION BOARD
    |--------------------------------------------------------------------------
    */
    $todoActions = $selectedProject
        ? $selectedActions->where('status', 'todo')
        : collect();
    $progressActions = $selectedProject
        ? $selectedActions->where('status', 'in_progress')
        : collect();
    $doneActions = $selectedProject
        ? $selectedActions->where('status', 'done')
        : collect();
@endphp
{{-- =========================================================
    SIDEBAR
========================================================= --}}
<aside class="sidebar" id="architectSidebar">
        <div class="sidebar-top">
            <a
                href="{{ route('architect.dashboard') }}"
                class="sidebar-logo"
                aria-label="ArchiTrack Architect Dashboard"
            >
                <img
                    src="{{ asset('images/arlogo.jpg') }}"
                    alt="Vero Designs"
                >
            </a>
            <button
                type="button"
                class="sidebar-toggle"
                id="sidebarToggle"
                aria-label="Minimize sidebar"
                aria-expanded="true"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>
        </div>
        <!-- ARCHITECT IDENTITY -->
        <div class="architect-identity">
            <div class="identity-top">
                <div class="identity-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="identity-info">
                    <strong>
                        {{ auth()->user()->name }}
                    </strong>
                    <span>
                        Architect
                    </span>
                </div>
                <button
                    type="button"
                    class="status-button status-active"
                    title="Active"
                >
                    <span class="status-dot"></span>
                </button>
            </div>
        </div>
        <div class="sidebar-divider"></div>
        <!-- WORKSPACE -->
        <p class="menu-title">
            WORKSPACE
        </p>
        <!-- DASHBOARD -->
        <a
            href="{{ route('architect.dashboard') }}"
            class="menu-link {{ request()->routeIs('architect.dashboard') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            </span>
            <span class="menu-text">
                Dashboard
            </span>
        </a>
        <!-- PROJECTS -->
        <a
            href="{{ route('architect.projects.index') }}"
            class="menu-link {{ request()->routeIs('architect.projects.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 7h6l2 2h10v10H3z"/>
                    <path d="M3 7V5h7l2 2"/>
                </svg>
            </span>
            <span class="menu-text">
                Projects
            </span>
        </a>
        <!-- PROJECT TOOLS -->
        <p class="menu-title">
            PROJECT TOOLS
        </p>
        <!-- FILES -->
        <a
            href="{{ route('architect.files.index') }}"
            class="menu-link {{ request()->routeIs('architect.files.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 6h6l2 2h10v10H3z"/>
                </svg>
            </span>
            <span class="menu-text">
                Files
            </span>
        </a>
        <!-- REVISIONS -->
        <a
            href="{{ route('architect.revisions.index') }}"
            class="menu-link {{ request()->routeIs('architect.revisions.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16v12H7l-3 3z"/>
                    <path d="M8 8h8"/>
                    <path d="M8 12h5"/>
                </svg>
            </span>
            <span class="menu-text">
                Revisions
            </span>
        </a>
        <!-- MEETINGS -->
        <a
            href="{{ route('architect.meetings.index') }}"
            class="menu-link {{ request()->routeIs('architect.meetings.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <path d="M8 3v4"/>
                    <path d="M16 3v4"/>
                    <path d="M3 10h18"/>
                </svg>
            </span>
            <span class="menu-text">
                Meetings
            </span>
        </a>
        <!-- REPORTS -->
        <a
            href="{{ route('architect.reports.index') }}"
            class="menu-link {{ request()->routeIs('architect.reports.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 20V10"/>
                    <path d="M10 20V4"/>
                    <path d="M16 20v-7"/>
                    <path d="M22 20V7"/>
                </svg>
            </span>
            <span class="menu-text">
                Reports
            </span>
        </a>
        <!-- ACCOUNT -->
        <p class="menu-title">
            ACCOUNT
        </p>
        <!-- SETTINGS -->
        <a
            href="{{ route('architect.settings.index') }}"
            class="menu-link {{ request()->routeIs('architect.settings.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="12" r="8"/>
                </svg>
            </span>
            <span class="menu-text">
                Settings
            </span>
        </a>
        <!-- LOGOUT -->
        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout-form"
        >
            @csrf
            <button
                type="submit"
                class="logout-btn"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M10 17l5-5-5-5"/>
                        <path d="M15 12H3"/>
                        <path d="M13 4h7v16h-7"/>
                    </svg>
                </span>
                <span class="menu-text">
                    Log Out
                </span>
            </button>
        </form>
    </aside>
    <button
        type="button"
        class="sidebar-backdrop"
        id="sidebarBackdrop"
        aria-label="Close navigation"
    ></button>
{{-- =========================================================
    MAIN
========================================================= --}}
<main class="main-content">
    <header class="topbar">
        <button
            type="button"
            class="topbar-menu-button"
            id="topbarMenuButton"
            aria-label="Open navigation"
        >
            <svg viewBox="0 0 24 24">
                <path d="M4 6h16"/>
                <path d="M4 12h16"/>
                <path d="M4 18h16"/>
            </svg>
        </button>
        <div class="topbar-heading">
            <span class="workspace-label">
                ARCHITECT WORKSPACE
            </span>
            <h1>Meetings</h1>
        </div>
        <div class="top-date">
            <span>
                {{ now()->format('l') }}
            </span>
            <strong>
                {{ now()->format('F d, Y') }}
            </strong>
        </div>
    </header>
    <div class="meetings-page">
        {{-- PAGE HEADING --}}
        <section class="meetings-heading">
            <div>
                <span class="meetings-eyebrow">
                    PROJECT COORDINATION
                </span>
                <h2>
                    Meetings & Action Calendar
                </h2>
                <p>
                    Click today or any future date to add actions.
                    Past dates remain available for viewing meeting history.
                </p>
            </div>
            <div class="calendar-guide">
                <span class="guide-icon">
                    +
                </span>
                <div>
                    <strong>Need to add a task?</strong>
                    <span>Choose today or a future date.</span>
                </div>
            </div>
        </section>
        {{-- =====================================================
            STATS
        ====================================================== --}}
        <section class="meeting-stats">
            <article class="meeting-stat">
                <div class="meeting-stat-icon orange">
                    <svg viewBox="0 0 24 24">
                        <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>
                        <path d="M4 10h16"></path>
                    </svg>
                </div>
                <div>
                    <strong class="meeting-stat-number">
                        {{ $upcomingMeetingCount ?? 0 }}
                    </strong>
                    <span class="meeting-stat-title">
                        Upcoming Meetings
                    </span>
                    <small>
                        Scheduled client meetings
                    </small>
                </div>
            </article>
            <article class="meeting-stat">
                <div class="meeting-stat-icon gray">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </div>
                <div>
                    <strong class="meeting-stat-number">
                        {{ $pastMeetingCount ?? 0 }}
                    </strong>
                    <span class="meeting-stat-title">
                        Past Meetings
                    </span>
                    <small>
                        Previous meeting records
                    </small>
                </div>
            </article>
            <article class="meeting-stat">
                <div class="meeting-stat-icon blue">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="4" width="14" height="16" rx="2"></rect>
                        <path d="M9 12l2 2 4-5"></path>
                    </svg>
                </div>
                <div>
                    <strong class="meeting-stat-number">
                        {{ $openActionCount ?? 0 }}
                    </strong>
                    <span class="meeting-stat-title">
                        Open Actions
                    </span>
                    <small>
                        To Do and In Progress
                    </small>
                </div>
            </article>
            <article class="meeting-stat">
                <div class="meeting-stat-icon red">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L2.8 19h18.4z"></path>
                        <path d="M12 9v4"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <strong class="meeting-stat-number">
                        {{ $overdueActionCount ?? 0 }}
                    </strong>
                    <span class="meeting-stat-title">
                        Overdue Actions
                    </span>
                    <small>
                        {{ ($overdueActionCount ?? 0) > 0
                            ? 'Needs your attention'
                            : 'Nothing overdue'
                        }}
                    </small>
                </div>
            </article>
        </section>
        {{-- =====================================================
            PENDING CLIENT MEETING REQUESTS
        ====================================================== --}}
        @if($errors->any())
            <div class="meeting-validation-alert" role="alert">
                <strong>Unable to confirm the meeting.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="pending-meeting-requests">
            <div class="pending-request-header">
                <div>
                    <span>CLIENT REQUESTS</span>
                    <h3>Pending Meeting Requests</h3>
                    <p>
                        Review meeting requests submitted by your clients.
                        Confirm the requested schedule or open the project workspace
                        before making changes.
                    </p>
                </div>
                <span class="pending-request-count">
                    {{ $pendingMeetingRequests->count() }}
                </span>
            </div>
            <div class="pending-request-list">
                @forelse($pendingMeetingRequests as $meeting)
                    @php
                        $pendingProjectId =
                            $meeting->calendar_project_id
                            ?? $meeting->project_id;
                        $pendingProjectName =
                            $meeting->calendar_project_name
                            ?? optional($meeting->project)->project_name
                            ?? 'Project';
                        $pendingClientName =
                            optional($meeting->client)->name
                            ?? optional(optional($meeting->project)->client)->name
                            ?? 'Client';
                        $pendingDate =
                            $meeting->meeting_date
                                ? \Carbon\Carbon::parse($meeting->meeting_date)
                                : null;
                        $pendingStart =
                            $meeting->start_time
                                ? \Carbon\Carbon::parse($meeting->start_time)->format('g:i A')
                                : null;
                        $pendingEnd =
                            $meeting->end_time
                                ? \Carbon\Carbon::parse($meeting->end_time)->format('g:i A')
                                : null;
                    @endphp
                    <article class="pending-request-card">
                        <div class="pending-request-date">
                            @if($pendingDate)
                                <span>{{ strtoupper($pendingDate->format('M')) }}</span>
                                <strong>{{ $pendingDate->format('d') }}</strong>
                                <small>{{ strtoupper($pendingDate->format('D')) }}</small>
                            @else
                                <span>DATE</span>
                                <strong>--</strong>
                            @endif
                        </div>
                        <div class="pending-request-info">
                            <div class="pending-request-title-row">
                                <div>
                                    <strong>
                                        {{ $meeting->title ?? 'Project Meeting' }}
                                    </strong>
                                    <span class="pending-status-pill">
                                        Pending
                                    </span>
                                </div>
                                <small>
                                    Requested by {{ $pendingClientName }}
                                </small>
                            </div>
                            <div class="pending-request-meta">
                                <span>
                                    <strong>Project</strong>
                                    {{ $pendingProjectName }}
                                </span>
                                <span>
                                    <strong>Time</strong>
                                    {{ $pendingStart ?? 'Not specified' }}
                                    @if($pendingEnd)
                                        – {{ $pendingEnd }}
                                    @endif
                                </span>
                                <span>
                                    <strong>Type</strong>
                                    {{ $meeting->meeting_type === 'in_person'
                                        ? 'In Person'
                                        : 'Online'
                                    }}
                                </span>
                            </div>
                            @if($meeting->agenda)
                                <p class="pending-request-agenda">
                                    {{ $meeting->agenda }}
                                </p>
                            @endif
                        </div>
                        <div class="pending-request-actions">
                            <a
                                href="{{ route(
                                    'architect.meetings.index',
                                    [
                                        'project' => $pendingProjectId,
                                        'month' => $calendarDate->format('Y-m')
                                    ]
                                ) }}"
                                class="pending-open-project"
                            >
                                Open Project
                            </a>
                            <form
                                method="POST"
                                action="{{ route(
                                    'architect.projects.meetings.update',
                                    [
                                        'id' => $pendingProjectId,
                                        'meeting' => $meeting->id
                                    ]
                                ) }}"
                                class="pending-confirm-form"
                            >
                                @csrf
                                @method('PUT')
                                <input
                                    type="hidden"
                                    name="title"
                                    value="{{ $meeting->title }}"
                                >
                                <input
                                    type="hidden"
                                    name="agenda"
                                    value="{{ $meeting->agenda }}"
                                >
                                <input
                                    type="hidden"
                                    name="meeting_type"
                                    value="{{ $meeting->meeting_type }}"
                                >
                                <input
                                    type="hidden"
                                    name="meeting_date"
                                    value="{{ $pendingDate ? $pendingDate->format('Y-m-d') : '' }}"
                                >
                                <input
                                    type="hidden"
                                    name="start_time"
                                    value="{{ $meeting->start_time
        ? \Carbon\Carbon::parse($meeting->start_time)->format('H:i')
        : '' }}"
                                >
                                <input
                                    type="hidden"
                                    name="end_time"
                                    value="{{ $meeting->end_time
        ? \Carbon\Carbon::parse($meeting->end_time)->format('H:i')
        : '' }}"
                                >
                                <input
                                    type="hidden"
                                    name="meeting_link"
                                    value="{{ $meeting->meeting_link }}"
                                >
                                <input
                                    type="hidden"
                                    name="location"
                                    value="{{ $meeting->location }}"
                                >
                                <input
                                    type="hidden"
                                    name="notes"
                                    value="{{ $meeting->notes }}"
                                >
                                <input
                                    type="hidden"
                                    name="status"
                                    value="scheduled"
                                >
                                <input
                                    type="hidden"
                                    name="approval_action"
                                    value="approve_client_request"
                                >
                                <button
                                    type="submit"
                                    class="pending-confirm-button"
                                >
                                    Confirm Schedule
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="pending-request-empty">
                        <strong>No pending meeting requests</strong>
                        <span>New client requests will appear here for review.</span>
                    </div>
                @endforelse
            </div>
        </section>
        {{-- =====================================================
            CALENDAR
        ====================================================== --}}
        <section class="main-calendar">
            <div class="calendar-header">
                <div class="calendar-left">
                    <a
                        href="{{ route('architect.meetings.index', [
                            'month' => $previousMonth
                        ]) }}"
                        class="calendar-nav"
                        title="Previous month"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('architect.meetings.index', [
                            'month' => $nextMonth
                        ]) }}"
                        class="calendar-nav"
                        title="Next month"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('architect.meetings.index') }}"
                        class="today-btn"
                    >
                        Today
                    </a>
                </div>
                <h3>
                    {{ $calendarDate->format('F Y') }}
                </h3>
                <div class="calendar-type">
                    Month
                </div>
            </div>
            <div class="calendar-weekdays">
                <div>SUN</div>
                <div>MON</div>
                <div>TUE</div>
                <div>WED</div>
                <div>THU</div>
                <div>FRI</div>
                <div>SAT</div>
            </div>
            <div class="calendar-grid">
                @php
                    $calendarDay = $calendarStart->copy();
                @endphp
                @while($calendarDay <= $calendarEnd)
                    @php
                        $dayMeetings = $calendarMeetings
                            ->filter(function ($meeting) use ($calendarDay) {
                                return $meeting->meeting_date
                                    && $meeting->meeting_date->isSameDay($calendarDay);
                            })
                            ->sortBy('meeting_date');
                        $dayActions = $calendarActions
                            ->filter(function ($action) use ($calendarDay) {
                                return $action->due_date
                                    && $action->due_date->isSameDay($calendarDay);
                            })
                            ->sortBy('created_at');
                        $isCurrentMonth =
                            $calendarDay->month === $calendarDate->month;
                        $isToday =
                            $calendarDay->isToday();
                        /*
                        |--------------------------------------------------------------------------
                        | PAST DATE RESTRICTION
                        |--------------------------------------------------------------------------
                        |
                        | Yesterday and older = VIEW ONLY.
                        | Today and future = clickable.
                        |
                        */
                        $isPastDate =
                            $calendarDay
                                ->copy()
                                ->startOfDay()
                                ->lt(today());
                        $dateUrl = route(
                            'architect.meetings.index',
                            [
                                'date' => $calendarDay->format('Y-m-d'),
                                'month' => $calendarDate->format('Y-m')
                            ]
                        );
                    @endphp
                    <div
                        class="
                            calendar-day
                            {{ !$isCurrentMonth ? 'outside-month' : '' }}
                            {{ $isToday ? 'is-today' : '' }}
                            {{ $isPastDate ? 'past-date' : '' }}
                        "
                        @if(!$isPastDate)
                            data-date-url="{{ $dateUrl }}"
                            role="button"
                            tabindex="0"
                            aria-label="
                                Open {{ $calendarDay->format('F d, Y') }}
                            "
                        @else
                            aria-label="
                                {{ $calendarDay->format('F d, Y') }}
                                - Past date
                            "
                        @endif
                    >
                        <div class="calendar-date-top">
                            <span
                                class="
                                    calendar-date-number
                                    {{ $isToday ? 'today-number' : '' }}
                                "
                            >
                                {{ $calendarDay->day }}
                            </span>
                            @if(!$isPastDate)
                                <span class="calendar-add-hint">
                                    + Add
                                </span>
                            @else
                                <span class="calendar-past-label">
                                    Past
                                </span>
                            @endif
                        </div>
                        <div class="calendar-items">
                            {{-- MEETINGS --}}
                            @foreach($dayMeetings->take(2) as $meeting)
                                @php
                                    $meetingTitle =
                                        $meeting->title
                                        ?? $meeting->meeting_title
                                        ?? 'Project Meeting';
                                    $meetingColor =
                                        $meeting->calendar_project_id % 4;
                                @endphp
                                <a
                                    href="{{ route(
                                        'architect.meetings.index',
                                        [
                                            'project' => $meeting->calendar_project_id,
                                            'month' => $calendarDate->format('Y-m')
                                        ]
                                    ) }}"
                                    class="
                                        calendar-meeting
                                        meeting-color-{{ $meetingColor }}
                                    "
                                >
                                    <span class="calendar-item-time">
                                        {{ $meeting->meeting_date->format('h:i A') }}
                                    </span>
                                    <strong>
                                        {{ $meetingTitle }}
                                    </strong>
                                    <small>
                                        {{ $meeting->calendar_project_name }}
                                    </small>
                                </a>
                            @endforeach
                            {{-- ACTIONS --}}
                            @foreach($dayActions->take(2) as $action)
                                @php
                                    $actionOverdue =
                                        $action->status !== 'done'
                                        && $action->due_date
                                        && $action->due_date->isBefore(today());
                                @endphp
                                <div
                                    class="
                                        calendar-action
                                        calendar-action-{{ $action->type }}
                                        {{ $action->status === 'done'
                                            ? 'calendar-action-done'
                                            : ''
                                        }}
                                    "
                                >
                                    <span class="mini-sticky-icon"></span>
                                    <div>
                                        <strong>
                                            {{ $action->title }}
                                        </strong>
                                        <small>
                                            {{ $action->calendar_project_name }}
                                            @if($actionOverdue)
                                                · Overdue
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                            @php
                                $totalDayItems =
                                    $dayMeetings->count()
                                    + $dayActions->count();
                                $hiddenItems =
                                    max(0, $totalDayItems - 4);
                            @endphp
                            @if($hiddenItems > 0)
                                <span class="calendar-more">
                                    +{{ $hiddenItems }} more
                                </span>
                            @endif
                        </div>
                    </div>
                    @php
                        $calendarDay->addDay();
                    @endphp
                @endwhile
            </div>
            <div class="calendar-bottom">
                <div class="calendar-legend">
                    <span>
                        <i class="legend-meeting"></i>
                        Meeting
                    </span>
                    <span>
                        <i class="legend-task"></i>
                        Task
                    </span>
                    <span>
                        <i class="legend-revision"></i>
                        Revision
                    </span>
                    <span>
                        <i class="legend-done"></i>
                        Done
                    </span>
                </div>
                <p>
                    Past dates are view only.
                </p>
            </div>
        </section>
        {{-- =====================================================
            UPCOMING MEETINGS
        ====================================================== --}}
        <section class="upcoming-section">
            <div class="upcoming-header">
                <span>
                    UP NEXT
                </span>
                <h3>
                    Upcoming Meetings
                </h3>
            </div>
            <div class="upcoming-meetings">
                @forelse($upcomingMeetingsList as $meeting)
                    @php
                        $meetingTitle =
                            $meeting->title
                            ?? $meeting->meeting_title
                            ?? 'Project Meeting';
                    @endphp
                    <a
                        href="{{ route(
                            'architect.meetings.index',
                            [
                                'project' => $meeting->calendar_project_id,
                                'month' => $calendarDate->format('Y-m')
                            ]
                        ) }}"
                        class="upcoming-meeting"
                    >
                        <div class="upcoming-date-box">
                            <span>
                                {{ strtoupper(
                                    $meeting->meeting_date->format('M')
                                ) }}
                            </span>
                            <strong>
                                {{ $meeting->meeting_date->format('d') }}
                            </strong>
                            <small>
                                {{ strtoupper(
                                    $meeting->meeting_date->format('D')
                                ) }}
                            </small>
                        </div>
                        <div class="upcoming-meeting-info">
                            <strong>
                                {{ $meetingTitle }}
                            </strong>
                            <span>
                                {{ $meeting->meeting_date->format('h:i A') }}
                            </span>
                            <small>
                                {{ $meeting->calendar_project_name }}
                            </small>
                        </div>
                        <span class="upcoming-pill">
                            Upcoming
                        </span>
                        <svg
                            class="upcoming-arrow"
                            viewBox="0 0 24 24"
                        >
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </a>
                @empty
                    <div class="empty-state">
                        No upcoming meetings scheduled.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</main>
{{-- =========================================================
    DAY PLANNER
========================================================= --}}
@if($selectedDate && !$selectedProject)
    @php
        /*
        | Extra protection:
        | Even if somebody manually puts ?date=PAST_DATE
        | in the URL, Add Sticky Note will still be disabled.
        */
        $selectedDateIsPast =
            $selectedDate
                ->copy()
                ->startOfDay()
                ->lt(today());
    @endphp
    <div class="planner-layer">
        <a
            href="{{ route(
                'architect.meetings.index',
                [
                    'month' => $calendarDate->format('Y-m')
                ]
            ) }}"
            class="planner-backdrop"
            aria-label="Close Day Planner"
        ></a>
        <aside class="day-planner">
            <div class="planner-topbar">
                <div>
                    <span>
                        DAY PLANNER
                    </span>
                    <h2>
                        {{ $selectedDate->format('F d, Y') }}
                    </h2>
                    <p>
                        {{ $selectedDate->format('l') }}
                    </p>
                </div>
                <a
                    href="{{ route(
                        'architect.meetings.index',
                        [
                            'month' => $calendarDate->format('Y-m')
                        ]
                    ) }}"
                    class="planner-close"
                >
                    ×
                </a>
            </div>
            <div class="planner-content">
                @if(!$selectedDateIsPast)
                    {{-- ADD STICKY NOTE --}}
                    <section class="planner-add-card">
                        <div class="planner-add-icon">
                            +
                        </div>
                        <div>
                            <span>
                                NEW ACTION
                            </span>
                            <h3>
                                Add something for this day
                            </h3>
                            <p>
                                Create a task, revision,
                                submission, or follow-up.
                            </p>
                        </div>
                        <button
                            type="button"
                            class="planner-add-btn"
                            id="openDayActionModal"
                        >
                            + Add Sticky Note
                        </button>
                    </section>
                @else
                    <section class="planner-past-notice">
                        <strong>
                            Past Date
                        </strong>
                        <p>
                            You can view existing meetings and actions,
                            but new sticky notes cannot be added to a past date.
                        </p>
                    </section>
                @endif
                {{-- ACTIONS --}}
                <section class="planner-section">
                    <div class="planner-section-header">
                        <div>
                            <span>
                                ACTIONS
                            </span>
                            <h3>
                                Sticky Notes
                            </h3>
                        </div>
                        <span class="planner-count">
                            {{ $selectedDateActions->count() }}
                        </span>
                    </div>
                    <div class="planner-notes">
                        @forelse($selectedDateActions as $action)
                            @php
                                $isOverdue =
                                    $action->status !== 'done'
                                    && $action->due_date
                                    && $action->due_date->isBefore(today());
                            @endphp
                            <article
                                class="
                                    planner-note
                                    planner-note-{{ $action->type }}
                                    {{ $action->status === 'done'
                                        ? 'planner-note-done'
                                        : ''
                                    }}
                                "
                            >
                                <div class="planner-note-top">
                                    <span class="planner-note-type">
                                        {{ strtoupper(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $action->type
                                            )
                                        ) }}
                                    </span>
                                    <span
                                        class="
                                            planner-note-status
                                            status-{{ $action->status }}
                                        "
                                    >
                                        {{ $action->status === 'in_progress'
                                            ? 'In Progress'
                                            : ucfirst($action->status)
                                        }}
                                    </span>
                                </div>
                                <h4>
                                    {{ $action->title }}
                                </h4>
                                @if($action->notes)
                                    <p>
                                        {{ $action->notes }}
                                    </p>
                                @endif
                                <div class="planner-note-bottom">
                                    <div>
                                        <span>
                                            Project
                                        </span>
                                        <strong>
                                            {{ $action->calendar_project_name }}
                                        </strong>
                                    </div>
                                    @if($isOverdue)
                                        <span class="overdue-pill">
                                            Overdue
                                        </span>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="planner-empty">
                                <strong>
                                    No actions for this date
                                </strong>
                                <span>
                                    {{ $selectedDateIsPast
                                        ? 'This past date has no recorded actions.'
                                        : 'Add a sticky note for this date.'
                                    }}
                                </span>
                                @if(!$selectedDateIsPast)
                                    <button
                                        type="button"
                                        data-open-day-action
                                    >
                                        + Add Sticky Note
                                    </button>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </section>
                {{-- MEETINGS --}}
                <section class="planner-section">
                    <div class="planner-section-header">
                        <div>
                            <span>
                                SCHEDULE
                            </span>
                            <h3>
                                Meetings
                            </h3>
                        </div>
                        <span class="planner-count">
                            {{ $selectedDateMeetings->count() }}
                        </span>
                    </div>
                    <div class="planner-meetings">
                        @forelse($selectedDateMeetings as $meeting)
                            @php
                                $meetingTitle =
                                    $meeting->title
                                    ?? $meeting->meeting_title
                                    ?? 'Project Meeting';
                            @endphp
                            <a
                                href="{{ route(
                                    'architect.meetings.index',
                                    [
                                        'project' => $meeting->calendar_project_id,
                                        'month' => $calendarDate->format('Y-m')
                                    ]
                                ) }}"
                                class="planner-meeting"
                            >
                                <div class="planner-meeting-time">
                                    <strong>
                                        {{ $meeting->meeting_date->format('h:i') }}
                                    </strong>
                                    <span>
                                        {{ $meeting->meeting_date->format('A') }}
                                    </span>
                                </div>
                                <div class="planner-meeting-info">
                                    <strong>
                                        {{ $meetingTitle }}
                                    </strong>
                                    <span>
                                        {{ $meeting->calendar_project_name }}
                                    </span>
                                    <small>
                                        {{ $meeting->location
                                            ?? $meeting->meeting_link
                                            ?? 'Location not specified'
                                        }}
                                    </small>
                                </div>
                                <svg viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6"></path>
                                </svg>
                            </a>
                        @empty
                            <div class="planner-no-meetings">
                                No meetings scheduled for this day.
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </aside>
    </div>
    {{-- =========================================================
        ADD STICKY NOTE MODAL
        ONLY EXISTS FOR TODAY/FUTURE
    ========================================================== --}}
    @if(!$selectedDateIsPast)
        <div
            class="action-modal"
            id="dayActionModal"
        >
            <div
                class="action-modal-backdrop"
                data-close-day-action
            ></div>
            <div class="action-modal-card">
                <div class="action-modal-header">
                    <div>
                        <span>
                            {{ strtoupper(
                                $selectedDate->format('F d, Y')
                            ) }}
                        </span>
                        <h3>
                            Add Sticky Note
                        </h3>
                        <p>
                            Choose a project and add an action
                            for this date.
                        </p>
                    </div>
                    <button
                        type="button"
                        class="modal-close"
                        data-close-day-action
                    >
                        ×
                    </button>
                </div>
                <form
                    id="dayActionForm"
                    method="POST"
                    action=""
                >
                    @csrf
                    <div class="form-group">
                        <label for="dayProjectSelect">
                            Project
                        </label>
                        <select
                            id="dayProjectSelect"
                            required
                        >
                            <option value="">
                                Select Project
                            </option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">
                                    {{ $project->project_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            Action Title
                        </label>
                        <input
                            type="text"
                            name="title"
                            required
                            maxlength="255"
                            placeholder="Example: Revise kitchen layout"
                        >
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>
                                Type
                            </label>
                            <select
                                name="type"
                                required
                            >
                                <option value="task">
                                    Task
                                </option>
                                <option value="revision">
                                    Revision
                                </option>
                                <option value="submission">
                                    Submission
                                </option>
                                <option value="follow_up">
                                    Follow Up
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>
                                Priority
                            </label>
                            <select
                                name="priority"
                                required
                            >
                                <option value="normal">
                                    Normal
                                </option>
                                <option value="high">
                                    High
                                </option>
                                <option value="low">
                                    Low
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Due Date
                        </label>
                        <input
                            type="date"
                            name="due_date"
                            value="{{ $selectedDate->format('Y-m-d') }}"
                            min="{{ today()->format('Y-m-d') }}"
                            required
                        >
                        <small class="form-help">
                            Past dates are not allowed.
                        </small>
                    </div>
                    <div class="form-group">
                        <label>
                            Notes
                        </label>
                        <textarea
                            name="notes"
                            rows="4"
                            maxlength="2000"
                            placeholder="Add additional details..."
                        ></textarea>
                    </div>
                    <div class="modal-actions">
                        <button
                            type="button"
                            class="modal-cancel"
                            data-close-day-action
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="modal-submit"
                        >
                            Add Sticky Note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endif
{{-- =========================================================
    PROJECT WORKSPACE
========================================================= --}}
@if($selectedProject)
    <div class="workspace-layer">
        <a
            href="{{ route(
                'architect.meetings.index',
                [
                    'month' => $calendarDate->format('Y-m')
                ]
            ) }}"
            class="workspace-backdrop"
            aria-label="Close Project Workspace"
        ></a>
        <aside class="project-workspace">
            <div class="workspace-top">
                <a
                    href="{{ route(
                        'architect.meetings.index',
                        [
                            'month' => $calendarDate->format('Y-m')
                        ]
                    ) }}"
                    class="workspace-back"
                >
                    ← Back to Calendar
                </a>
                <a
                    href="{{ route(
                        'architect.meetings.index',
                        [
                            'month' => $calendarDate->format('Y-m')
                        ]
                    ) }}"
                    class="workspace-close"
                >
                    ×
                </a>
            </div>
            <div class="workspace-project">
                <div class="workspace-project-image">
                    @if($selectedProject->project_image)
                        <img
                            src="{{ asset(
                                'storage/' .
                                $selectedProject->project_image
                            ) }}"
                            alt="{{ $selectedProject->project_name }}"
                        >
                    @else
                        <span>
                            {{ strtoupper(
                                substr(
                                    $selectedProject->project_name,
                                    0,
                                    1
                                )
                            ) }}
                        </span>
                    @endif
                </div>
                <div>
                    <span>
                        PROJECT MEETING WORKSPACE
                    </span>
                    <h2>
                        {{ $selectedProject->project_name }}
                    </h2>
                    <p>
                        {{ optional($selectedProject->client)->name
                            ?? $selectedProject->client_name
                            ?? 'Client'
                        }}
                    </p>
                </div>
            </div>
            <div class="workspace-content">
                {{-- NEXT MEETING --}}
                <section class="workspace-section">
                    <div class="workspace-section-title">
                        <span>
                            NEXT
                        </span>
                        <h3>
                            Next Meeting
                        </h3>
                    </div>
                    @if($selectedProjectNextMeeting)
                        <div class="next-meeting-card">
                            <div class="next-meeting-date">
                                <span>
                                    {{ strtoupper(
                                        $selectedProjectNextMeeting
                                            ->meeting_date
                                            ->format('M')
                                    ) }}
                                </span>
                                <strong>
                                    {{ $selectedProjectNextMeeting
                                        ->meeting_date
                                        ->format('d')
                                    }}
                                </strong>
                                <small>
                                    {{ strtoupper(
                                        $selectedProjectNextMeeting
                                            ->meeting_date
                                            ->format('D')
                                    ) }}
                                </small>
                            </div>
                            <div>
                                <strong>
                                    {{ $selectedProjectNextMeeting->title
                                        ?? $selectedProjectNextMeeting->meeting_title
                                        ?? 'Project Meeting'
                                    }}
                                </strong>
                                <span>
                                    {{ $selectedProjectNextMeeting
                                        ->meeting_date
                                        ->format('F d, Y · h:i A')
                                    }}
                                </span>
                                <small>
                                    {{ $selectedProjectNextMeeting->location
                                        ?? $selectedProjectNextMeeting->meeting_link
                                        ?? 'Location not specified'
                                    }}
                                </small>
                            </div>
                        </div>
                    @else
                        <div class="empty-state">
                            No upcoming meeting scheduled.
                        </div>
                    @endif
                </section>
                {{-- ACTION BOARD HEADER --}}
                <section class="workspace-action-header">
                    <div>
                        <span>
                            PROJECT ACTIONS
                        </span>
                        <h3>
                            Sticky Note Board
                        </h3>
                        <p>
                            Drag actions between To Do,
                            In Progress, and Done.
                        </p>
                    </div>
                    <button
                        type="button"
                        class="workspace-add-action"
                        id="openProjectActionModal"
                    >
                        + Add Action
                    </button>
                </section>
                {{-- ACTION BOARD --}}
                <section class="action-board">
                    @foreach([
                        'todo' => [
                            'title' => 'To Do',
                            'items' => $todoActions
                        ],
                        'in_progress' => [
                            'title' => 'In Progress',
                            'items' => $progressActions
                        ],
                        'done' => [
                            'title' => 'Done',
                            'items' => $doneActions
                        ]
                    ] as $status => $column)
                        <div
                            class="
                                action-column
                                column-{{ $status }}
                            "
                            data-status="{{ $status }}"
                        >
                            <div class="action-column-title">
                                <div>
                                    <span
                                        class="
                                            board-status-dot
                                            dot-{{ $status }}
                                        "
                                    ></span>
                                    <strong>
                                        {{ $column['title'] }}
                                    </strong>
                                </div>
                                <span class="action-count">
                                    {{ $column['items']->count() }}
                                </span>
                            </div>
                            <div class="action-drop-zone">
                                @forelse($column['items'] as $action)
                                    @php
                                        $isOverdue =
                                            $action->status !== 'done'
                                            && $action->due_date
                                            && $action->due_date->isBefore(today());
                                    @endphp
                                    <article
                                        class="
                                            action-note
                                            note-{{ $action->type }}
                                            {{ $status === 'done'
                                                ? 'note-complete'
                                                : ''
                                            }}
                                        "
                                        draggable="true"
                                        data-action="{{ $action->id }}"
                                        data-project="{{ $action->project_id }}"
                                        data-status="{{ $action->status }}"
                                    >
                                        <div class="action-note-header">
                                            <span>
                                                {{ strtoupper(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $action->type
                                                    )
                                                ) }}
                                            </span>
                                            @if($action->priority === 'high')
                                                <strong class="high-priority">
                                                    High
                                                </strong>
                                            @endif
                                        </div>
                                        <h4>
                                            {{ $action->title }}
                                        </h4>
                                        @if($action->notes)
                                            <p>
                                                {{ $action->notes }}
                                            </p>
                                        @endif
                                        <div class="action-note-meta">
                                            @if($action->due_date)
                                                <span>
                                                    Due
                                                    <strong
                                                        class="{{ $isOverdue
                                                            ? 'text-overdue'
                                                            : ''
                                                        }}"
                                                    >
                                                        {{ $action->due_date->format('M d') }}
                                                    </strong>
                                                </span>
                                            @else
                                                <span>
                                                    No due date
                                                </span>
                                            @endif
                                            <span
                                                class="drag-handle"
                                                title="Drag action"
                                            >
                                                ⋮⋮
                                            </span>
                                        </div>
                                    </article>
                                @empty
                                    <div class="column-empty">
                                        Drop an action here.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </section>
                {{-- MEETING HISTORY --}}
                <section class="workspace-section meeting-history">
                    <div class="workspace-section-title">
                        <span>
                            HISTORY
                        </span>
                        <h3>
                            Meeting Timeline
                        </h3>
                    </div>
                    @forelse(
                        $selectedProject->meetings->sortByDesc('meeting_date')
                        as $meeting
                    )
                        @php
                            $isFuture =
                                $meeting->meeting_date
                                && $meeting->meeting_date >= now();
                        @endphp
                        <div class="history-row">
                            <div class="history-date">
                                <span>
                                    {{ strtoupper(
                                        $meeting->meeting_date->format('M')
                                    ) }}
                                </span>
                                <strong>
                                    {{ $meeting->meeting_date->format('d') }}
                                </strong>
                            </div>
                            <div class="history-info">
                                <strong>
                                    {{ $meeting->title
                                        ?? $meeting->meeting_title
                                        ?? 'Project Meeting'
                                    }}
                                </strong>
                                <span>
                                    {{ $meeting->meeting_date->format('h:i A') }}
                                </span>
                            </div>
                            <span
                                class="
                                    history-status
                                    {{ $isFuture
                                        ? 'history-upcoming'
                                        : 'history-complete'
                                    }}
                                "
                            >
                                {{ $isFuture
                                    ? 'Upcoming'
                                    : 'Completed'
                                }}
                            </span>
                        </div>
                    @empty
                        <div class="empty-state">
                            No meeting history.
                        </div>
                    @endforelse
                </section>
            </div>
        </aside>
    </div>
    {{-- =========================================================
        PROJECT ACTION MODAL
    ========================================================== --}}
    <div
        class="action-modal"
        id="projectActionModal"
    >
        <div
            class="action-modal-backdrop"
            data-close-project-action
        ></div>
        <div class="action-modal-card">
            <div class="action-modal-header">
                <div>
                    <span>
                        PROJECT ACTION
                    </span>
                    <h3>
                        Add Action
                    </h3>
                    <p>
                        Add a new action for
                        {{ $selectedProject->project_name }}.
                    </p>
                </div>
                <button
                    type="button"
                    class="modal-close"
                    data-close-project-action
                >
                    ×
                </button>
            </div>
            <form
                method="POST"
                action="{{ route(
                    'architect.meetings.actions.store',
                    $selectedProject->id
                ) }}"
            >
                @csrf
                <div class="form-group">
                    <label>
                        Action Title
                    </label>
                    <input
                        type="text"
                        name="title"
                        required
                        maxlength="255"
                        placeholder="Example: Revise kitchen layout"
                    >
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>
                            Type
                        </label>
                        <select name="type" required>
                            <option value="task">
                                Task
                            </option>
                            <option value="revision">
                                Revision
                            </option>
                            <option value="submission">
                                Submission
                            </option>
                            <option value="follow_up">
                                Follow Up
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            Priority
                        </label>
                        <select name="priority" required>
                            <option value="normal">
                                Normal
                            </option>
                            <option value="high">
                                High
                            </option>
                            <option value="low">
                                Low
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        Due Date
                    </label>
                    <input
                        type="date"
                        name="due_date"
                        min="{{ today()->format('Y-m-d') }}"
                    >
                    <small class="form-help">
                        Past dates are not allowed.
                    </small>
                </div>
                <div class="form-group">
                    <label>
                        Related Meeting
                    </label>
                    <select name="meeting_id">
                        <option value="">
                            General Project Action
                        </option>
                        @foreach(
                            $selectedProject->meetings->sortByDesc('meeting_date')
                            as $meeting
                        )
                            <option value="{{ $meeting->id }}">
                                {{ $meeting->meeting_date->format('M d, Y') }}
                                —
                                {{ $meeting->title
                                    ?? $meeting->meeting_title
                                    ?? 'Meeting'
                                }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Notes
                    </label>
                    <textarea
                        name="notes"
                        rows="4"
                        maxlength="2000"
                        placeholder="Add details..."
                    ></textarea>
                </div>
                <div class="modal-actions">
                    <button
                        type="button"
                        class="modal-cancel"
                        data-close-project-action
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="modal-submit"
                    >
                        Add Action
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    /* =========================================================
       CALENDAR DATE CLICK
    ========================================================= */
    const calendarDays =
        document.querySelectorAll('.calendar-day');
    calendarDays.forEach(function (day) {
        day.addEventListener(
            'click',
            function (event) {
                /*
                 * Meeting links always remain clickable,
                 * including meetings on past dates.
                 */
                if (
                    event.target.closest('.calendar-meeting')
                ) {
                    return;
                }
                /*
                 * Past dates have no data-date-url.
                 * Therefore nothing happens.
                 */
                const dateUrl =
                    day.dataset.dateUrl;
                if (!dateUrl) {
                    return;
                }
                window.location.href =
                    dateUrl;
            }
        );
        day.addEventListener(
            'keydown',
            function (event) {
                if (
                    event.key !== 'Enter'
                    && event.key !== ' '
                ) {
                    return;
                }
                const dateUrl =
                    day.dataset.dateUrl;
                if (!dateUrl) {
                    return;
                }
                event.preventDefault();
                window.location.href =
                    dateUrl;
            }
        );
    });
    /* =========================================================
       DAY PLANNER MODAL
    ========================================================= */
    const dayModal =
        document.getElementById('dayActionModal');
    const openDayButton =
        document.getElementById('openDayActionModal');
    function openDayModal() {
        if (!dayModal) {
            return;
        }
        dayModal.classList.add('show');
    }
    function closeDayModal() {
        if (!dayModal) {
            return;
        }
        dayModal.classList.remove('show');
    }
    if (openDayButton) {
        openDayButton.addEventListener(
            'click',
            openDayModal
        );
    }
    document
        .querySelectorAll('[data-open-day-action]')
        .forEach(function (button) {
            button.addEventListener(
                'click',
                openDayModal
            );
        });
    document
        .querySelectorAll('[data-close-day-action]')
        .forEach(function (button) {
            button.addEventListener(
                'click',
                closeDayModal
            );
        });
    /* =========================================================
       DAY PLANNER PROJECT
    ========================================================= */
    const dayProjectSelect =
        document.getElementById('dayProjectSelect');
    const dayActionForm =
        document.getElementById('dayActionForm');
    if (dayProjectSelect && dayActionForm) {
        dayProjectSelect.addEventListener(
            'change',
            function () {
                const projectId =
                    dayProjectSelect.value;
                if (projectId) {
                    dayActionForm.action =
                        `/architect/meetings/${projectId}/actions`;
                } else {
                    dayActionForm.action = '';
                }
            }
        );
        dayActionForm.addEventListener(
            'submit',
            function (event) {
                if (!dayProjectSelect.value) {
                    event.preventDefault();
                    alert(
                        'Please select a project first.'
                    );
                }
            }
        );
    }
    /* =========================================================
       PROJECT ACTION MODAL
    ========================================================= */
    const projectModal =
        document.getElementById('projectActionModal');
    const openProjectButton =
        document.getElementById('openProjectActionModal');
    function openProjectModal() {
        if (!projectModal) {
            return;
        }
        projectModal.classList.add('show');
    }
    function closeProjectModal() {
        if (!projectModal) {
            return;
        }
        projectModal.classList.remove('show');
    }
    if (openProjectButton) {
        openProjectButton.addEventListener(
            'click',
            openProjectModal
        );
    }
    document
        .querySelectorAll('[data-close-project-action]')
        .forEach(function (button) {
            button.addEventListener(
                'click',
                closeProjectModal
            );
        });
    /* =========================================================
       DRAG & DROP
    ========================================================= */
    const notes =
        document.querySelectorAll('.action-note');
    const columns =
        document.querySelectorAll('.action-column');
    let draggedNote = null;
    notes.forEach(function (note) {
        note.addEventListener(
            'dragstart',
            function () {
                draggedNote = note;
                note.classList.add(
                    'dragging'
                );
            }
        );
        note.addEventListener(
            'dragend',
            function () {
                note.classList.remove(
                    'dragging'
                );
                columns.forEach(
                    function (column) {
                        column.classList.remove(
                            'drag-over'
                        );
                    }
                );
                draggedNote = null;
            }
        );
    });
    columns.forEach(function (column) {
        column.addEventListener(
            'dragover',
            function (event) {
                event.preventDefault();
                column.classList.add(
                    'drag-over'
                );
            }
        );
        column.addEventListener(
            'dragleave',
            function () {
                column.classList.remove(
                    'drag-over'
                );
            }
        );
        column.addEventListener(
            'drop',
            async function (event) {
                event.preventDefault();
                column.classList.remove(
                    'drag-over'
                );
                if (!draggedNote) {
                    return;
                }
                const oldZone =
                    draggedNote.parentElement;
                const oldStatus =
                    draggedNote.dataset.status;
                const newStatus =
                    column.dataset.status;
                if (oldStatus === newStatus) {
                    return;
                }
                const newZone =
                    column.querySelector(
                        '.action-drop-zone'
                    );
                if (!newZone) {
                    return;
                }
                const destinationEmpty =
                    newZone.querySelector(
                        '.column-empty'
                    );
                if (destinationEmpty) {
                    destinationEmpty.remove();
                }
                newZone.appendChild(
                    draggedNote
                );
                draggedNote.dataset.status =
                    newStatus;
                updateEmptyStates();
                updateCounts();
                const projectId =
                    draggedNote.dataset.project;
                const actionId =
                    draggedNote.dataset.action;
                try {
                    const response =
                        await fetch(
                            `/architect/meetings/${projectId}/actions/${actionId}/status`,
                            {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type':
                                        'application/json',
                                    'Accept':
                                        'application/json',
                                    'X-CSRF-TOKEN':
                                        document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .content
                                },
                                body:
                                    JSON.stringify({
                                        status: newStatus
                                    })
                            }
                        );
                    if (!response.ok) {
                        oldZone.appendChild(
                            draggedNote
                        );
                        draggedNote.dataset.status =
                            oldStatus;
                        updateEmptyStates();
                        updateCounts();
                        alert(
                            'Unable to update the action status.'
                        );
                    }
                } catch (error) {
                    oldZone.appendChild(
                        draggedNote
                    );
                    draggedNote.dataset.status =
                        oldStatus;
                    updateEmptyStates();
                    updateCounts();
                    alert(
                        'Unable to update the action status.'
                    );
                }
            }
        );
    });
    function updateCounts() {
        columns.forEach(function (column) {
            const count =
                column.querySelectorAll(
                    '.action-note'
                ).length;
            const counter =
                column.querySelector(
                    '.action-count'
                );
            if (counter) {
                counter.textContent = count;
            }
        });
    }
    function updateEmptyStates() {
        columns.forEach(function (column) {
            const zone =
                column.querySelector(
                    '.action-drop-zone'
                );
            if (!zone) {
                return;
            }
            const notesInside =
                zone.querySelectorAll(
                    '.action-note'
                );
            const existingEmpty =
                zone.querySelector(
                    '.column-empty'
                );
            if (notesInside.length === 0) {
                if (!existingEmpty) {
                    const empty =
                        document.createElement(
                            'div'
                        );
                    empty.className =
                        'column-empty';
                    empty.textContent =
                        'Drop an action here.';
                    zone.appendChild(
                        empty
                    );
                }
            } else {
                if (existingEmpty) {
                    existingEmpty.remove();
                }
            }
        });
    }
    /* =========================================================
       ESCAPE
    ========================================================= */
    document.addEventListener(
        'keydown',
        function (event) {
            if (event.key !== 'Escape') {
                return;
            }
            closeDayModal();
            closeProjectModal();
        }
    );
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const sidebar = document.getElementById('architectSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const mobileSidebarLauncher = document.getElementById('mobileSidebarLauncher');
    const topbarMenuButton = document.getElementById('topbarMenuButton');
    const desktopMedia = window.matchMedia('(min-width: 701px)');
    function setDesktopCollapsed(collapsed) {
        if (!desktopMedia.matches) {
            return;
        }
        body.classList.toggle('sidebar-collapsed', collapsed);
        if (sidebarToggle) {
            sidebarToggle.setAttribute(
                'aria-expanded',
                collapsed ? 'false' : 'true'
            );
            sidebarToggle.setAttribute(
                'aria-label',
                collapsed ? 'Maximize sidebar' : 'Minimize sidebar'
            );
        }
        localStorage.setItem(
            'architrackArchitectSidebarCollapsed',
            collapsed ? '1' : '0'
        );
    }
    function openMobileSidebar() {
        if (desktopMedia.matches) {
            return;
        }
        body.classList.add('mobile-sidebar-open');
        mobileSidebarLauncher?.setAttribute(
            'aria-expanded',
            'true'
        );
    }
    function closeMobileSidebar() {
        body.classList.remove('mobile-sidebar-open');
        mobileSidebarLauncher?.setAttribute(
            'aria-expanded',
            'false'
        );
    }
    function syncSidebarForViewport() {
        closeMobileSidebar();
        if (desktopMedia.matches) {
            const savedCollapsed =
                localStorage.getItem(
                    'architrackArchitectSidebarCollapsed'
                ) === '1';
            setDesktopCollapsed(savedCollapsed);
        } else {
            body.classList.remove('sidebar-collapsed');
        }
    }
    sidebarToggle?.addEventListener('click', function () {
        if (desktopMedia.matches) {
            setDesktopCollapsed(
                !body.classList.contains('sidebar-collapsed')
            );
        } else {
            closeMobileSidebar();
        }
    });
    mobileSidebarLauncher?.addEventListener(
        'click',
        openMobileSidebar
    );
    topbarMenuButton?.addEventListener(
        'click',
        openMobileSidebar
    );
    sidebarBackdrop?.addEventListener(
        'click',
        closeMobileSidebar
    );
    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape'
            &&
            body.classList.contains('mobile-sidebar-open')
        ) {
            closeMobileSidebar();
        }
    });
    sidebar?.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (!desktopMedia.matches) {
                closeMobileSidebar();
            }
        });
    });
    if (desktopMedia.addEventListener) {
        desktopMedia.addEventListener(
            'change',
            syncSidebarForViewport
        );
    } else {
        desktopMedia.addListener(
            syncSidebarForViewport
        );
    }
    syncSidebarForViewport();
});
</script>
</body>
</html>
