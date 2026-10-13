<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Projects | ArchiTrack</title>

    @vite([
        'resources/css/app.css',
        'resources/css/client-dashboard.css',
        'resources/css/client-projects.css',
        'resources/css/client-revisions.css',
        'resources/css/client-meetings.css',
        'resources/css/client-phases.css',
        'resources/js/app.js'
    ])

    <style>
        .client-financial-overview {
            margin-top: 28px;
            padding: 24px;
            border: 1px solid rgba(33, 33, 33, 0.10);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 12px 30px rgba(31, 31, 31, 0.06);
        }

        .client-financial-overview-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .client-financial-overview-head span {
            display: block;
            margin-bottom: 5px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #d96b22;
        }

        .client-financial-overview-head h3 {
            margin: 0;
            font-size: 21px;
            line-height: 1.2;
            color: #252525;
        }

        .client-financial-overview-head p {
            margin: 6px 0 0;
            max-width: 620px;
            font-size: 13px;
            line-height: 1.55;
            color: #737373;
        }

        .client-financial-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .client-financial-summary-card {
            min-width: 0;
            padding: 18px;
            border: 1px solid rgba(33, 33, 33, 0.08);
            border-radius: 14px;
            background: #fffdf9;
        }

        .client-financial-summary-card > span {
            display: block;
            margin-bottom: 9px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #7b7b7b;
        }

        .client-financial-summary-card > strong {
            display: block;
            overflow-wrap: anywhere;
            font-size: 18px;
            line-height: 1.25;
            color: #242424;
        }

        .client-financial-summary-card > small {
            display: block;
            margin-top: 7px;
            font-size: 11px;
            line-height: 1.4;
            color: #929292;
        }

        .client-financial-summary-card .client-financial-negative {
            color: #b33a2f;
        }

        .client-financial-budget-track {
            width: 100%;
            height: 7px;
            margin-top: 11px;
            overflow: hidden;
            border-radius: 999px;
            background: #ece7df;
        }

        .client-financial-budget-track span {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: #d96b22;
        }

        .client-financial-budget-track span.over-budget {
            background: #b33a2f;
        }

        .client-financial-note {
            margin: 14px 0 0;
            font-size: 11px;
            line-height: 1.5;
            color: #8a8a8a;
        }

        @media (max-width: 980px) {
            .client-financial-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 620px) {
            .client-financial-overview {
                padding: 18px;
            }

            .client-financial-overview-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .client-financial-summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>

<body>

<div class="client-app">

    {{-- =========================================================
         ARCHITECTURAL BACKGROUND
    ========================================================== --}}

    <div class="architectural-background">

        <div class="blueprint-left">

            <div class="blueprint-grid"></div>

            <div class="blueprint-plan">

                <span class="bp-wall wall-one"></span>
                <span class="bp-wall wall-two"></span>
                <span class="bp-wall wall-three"></span>
                <span class="bp-wall wall-four"></span>
                <span class="bp-wall wall-five"></span>
                <span class="bp-wall wall-six"></span>

                <span class="bp-door door-one"></span>
                <span class="bp-door door-two"></span>

                <span class="bp-dimension dimension-horizontal"></span>

                <span class="bp-measure measure-horizontal">
                    4.80
                </span>

                <span class="bp-dimension dimension-vertical"></span>

                <span class="bp-measure measure-vertical">
                    3.60
                </span>

                <span class="bp-axis axis-a">A</span>
                <span class="bp-axis axis-b">B</span>
                <span class="bp-axis axis-c">C</span>

            </div>

        </div>

        <img
            src="{{ asset('images/lineart2.png') }}"
            alt=""
            class="right-building-lineart"
        >

        <div class="draft-path draft-path-one">
            <span class="draft-segment first"></span>
            <span class="draft-segment second"></span>
            <span class="draft-node"></span>
            <span class="draft-cross"></span>
        </div>

        <div class="draft-path draft-path-two">
            <span class="draft-segment first"></span>
            <span class="draft-segment second"></span>
            <span class="draft-node"></span>
            <span class="draft-cross"></span>
        </div>

        <div class="draft-path draft-path-three">
            <span class="draft-segment first"></span>
            <span class="draft-segment second"></span>
            <span class="draft-node"></span>
            <span class="draft-cross"></span>
        </div>

        <div class="bottom-dimension">
            <span></span>
            <small>7.50 m</small>
        </div>

    </div>


    {{-- =========================================================
         TOPBAR
    ========================================================== --}}

    <header class="client-topbar">

        <div class="client-topbar-inner">

            <a
                href="{{ route('client.dashboard') }}"
                class="client-brand"
            >

                <div class="client-logo">

                    <img
                        src="{{ asset('images/arlogo.jpg') }}"
                        alt="ArchiTrack"
                    >

                </div>

                <span class="client-portal-label">
                    Client Portal
                </span>

            </a>


            <nav class="client-navigation">

                <a
                    href="{{ route('client.dashboard') }}"
                    class="client-nav-link"
                >
                    Home
                </a>

                <a
                    href="{{ route('client.projects.index') }}"
                    class="client-nav-link active"
                >
                    My Project
                </a>
<a
                    href="{{ route('client.files.index') }}"
                    class="client-nav-link"
                >
                    Files
                </a>

                <a
                    href="{{ route('client.meetings.index') }}"
                    class="client-nav-link"
                >
                    Meetings
                </a>

            </nav>


            <div class="client-account-area">

                <div class="notification-wrapper">

                    <button
                        type="button"
                        class="notification-button"
                        id="notificationButton"
                        aria-label="Notifications"
                        aria-expanded="false"
                    >

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"
                            ></path>

                            <path d="M10 20h4"></path>

                        </svg>

                        <span
                            class="notification-badge"
                            id="notificationBadge"
                            hidden
                        >
                            0
                        </span>

                    </button>


                    <div
                        class="notification-dropdown"
                        id="notificationDropdown"
                    >

                        <div class="notification-dropdown-header">

                            <div>

                                <span class="notification-small-label">
                                    Project Updates
                                </span>

                                <h3>
                                    Notifications
                                </h3>

                            </div>

                            <button
                                type="button"
                                class="mark-all-read-button"
                                id="markAllReadButton"
                            >
                                Mark all read
                            </button>

                        </div>

                        <div
                            class="notification-list"
                            id="notificationList"
                        >

                            <div class="notification-loading">
                                Loading notifications...
                            </div>

                        </div>

                    </div>

                </div>


                <div class="client-profile">

                    <div class="client-avatar">

                        @if(Auth::user()->profile_image)

                            <img
                                src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                alt="{{ Auth::user()->name }}"
                            >

                        @else

                            {{ strtoupper(
                                substr(
                                    Auth::user()->name ?? 'C',
                                    0,
                                    1
                                )
                            ) }}

                        @endif

                    </div>


                    <div class="client-profile-text">

                        <strong>
                            {{ Auth::user()->name }}
                        </strong>

                        <span>
                            Client
                        </span>

                    </div>


                    <button
                        type="button"
                        class="profile-menu-button"
                        id="profileMenuButton"
                        aria-label="Profile Menu"
                    >

                        <svg viewBox="0 0 24 24">

                            <path d="m6 9 6 6 6-6"></path>

                        </svg>

                    </button>


                    <div
                        class="profile-dropdown"
                        id="profileDropdown"
                    >

                        <div class="dropdown-user">

                            <strong>
                                {{ Auth::user()->name }}
                            </strong>

                            <span>
                                {{ Auth::user()->email }}
                            </span>

                        </div>

                        <a href="{{ route('client.account.index') }}">
                            Account Settings
                        </a>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button type="submit">
                                Log Out
                            </button>

                        </form>

                    </div>

                </div>


                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Menu"
                >

                    <svg viewBox="0 0 24 24">

                        <path d="M4 6h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 18h16"></path>

                    </svg>

                </button>

            </div>

        </div>

    </header>


    {{-- =========================================================
         MOBILE NAVIGATION
    ========================================================== --}}

    <nav
        class="mobile-navigation"
        id="mobileNavigation"
    >

        <a href="{{ route('client.dashboard') }}">
            Home
        </a>

        <a
            href="{{ route('client.projects.index') }}"
            class="active"
        >
            My Project
        </a>
<a href="{{ route('client.files.index') }}">
            Files
        </a>

        <a href="{{ route('client.meetings.index') }}">
            Meetings
        </a>

        <a href="{{ route('client.account.index') }}">
            Account
        </a>

    </nav>


    {{-- =========================================================
         MAIN PROJECT LIST
    ========================================================== --}}

    <main class="client-projects-main">

        <section class="projects-page-heading">

            <div>

                <span class="projects-eyebrow">
                    Project Workspace
                </span>

                <h1>
                    My Projects
                </h1>

                <p>
                    Review your project progress, files,
                    revisions, meetings and communicate
                    directly with your architect.
                </p>

            </div>

            <div class="projects-count">

                <strong>
                    {{ $projects->count() }}
                </strong>

                <span>
                    {{ $projects->count() === 1
                        ? 'Project'
                        : 'Projects'
                    }}
                </span>

            </div>

        </section>


        @if($projects->count())

            <section class="client-project-list">

                @foreach($projects as $project)

                    @php

                        $progress =
                            (int) (
                                $project->progress
                                ?? 0
                            );

                        $status =
                            ucfirst(
                                str_replace(
                                    '_',
                                    ' ',
                                    $project->status
                                    ?? 'active'
                                )
                            );

                        $nextMeeting =
                            $project->meetings
                                ->filter(
                                    function ($meeting) {

                                        if (!$meeting->meeting_date) {
                                            return false;
                                        }

                                        return
                                            \Carbon\Carbon::parse(
                                                $meeting->meeting_date
                                            )
                                            ->isFuture();
                                    }
                                )
                                ->sortBy('meeting_date')
                                ->first();

                    @endphp


                    <article class="client-project-card">

                        <div class="project-card-image">

                            @if($project->project_image)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $project->project_image
                                    ) }}"
                                    alt="{{ $project->project_name }}"
                                >

                            @else

                                <div class="projects-image-placeholder">

                                    <svg viewBox="0 0 24 24">

                                        <path d="M3 21h18"></path>

                                        <path
                                            d="M5 21V8l7-5 7 5v13"
                                        ></path>

                                        <path
                                            d="M9 21v-6h6v6"
                                        ></path>

                                    </svg>

                                </div>

                            @endif

                            <span class="project-status-badge">
                                {{ $status }}
                            </span>

                        </div>


                        <div class="project-card-content">

                            <div class="project-card-top">

                                <div>

                                    <span>
                                        Project
                                    </span>

                                    <h2>
                                        {{ $project->project_name }}
                                    </h2>

                                </div>

                                <div class="project-progress-number">
                                    {{ $progress }}%
                                </div>

                            </div>


                            <div class="project-progress-track">

                                <span
                                    style="
                                        width:
                                        {{ max(
                                            0,
                                            min(
                                                100,
                                                $progress
                                            )
                                        ) }}%;
                                    "
                                ></span>

                            </div>


                            <div class="project-card-details">

                                <div>

                                    <span>
                                        Architect
                                    </span>

                                    <strong>
                                        {{ $project
                                            ->architect?->name
                                            ?? 'Not assigned'
                                        }}
                                    </strong>

                                </div>

                                <div>

                                    <span>
                                        Target Date
                                    </span>

                                    <strong>

                                        {{ $project->target_date
                                            ? \Carbon\Carbon::parse(
                                                $project->target_date
                                            )->format('M d, Y')
                                            : 'Not set'
                                        }}

                                    </strong>

                                </div>

                                <div>

                                    <span>
                                        Next Meeting
                                    </span>

                                    <strong>

                                        {{ $nextMeeting
                                            ? \Carbon\Carbon::parse(
                                                $nextMeeting->meeting_date
                                            )
                                            ->timezone('Asia/Manila')
                                            ->format('M d, g:i A')
                                            : 'No meeting'
                                        }}

                                    </strong>

                                </div>

                            </div>


                            <a
                                href="{{ route(
                                    'client.projects.index',
                                    [
                                        'project' =>
                                            $project->id
                                    ]
                                ) }}"
                                class="open-project-workspace"
                            >

                                Open Workspace

                                <svg viewBox="0 0 24 24">

                                    <path d="M5 12h14"></path>

                                    <path d="m13 6 6 6-6 6"></path>

                                </svg>

                            </a>

                        </div>

                    </article>

                @endforeach

            </section>

        @else

            <section class="client-project-empty">

                <div class="project-empty-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="M3 21h18"></path>

                        <path
                            d="M5 21V8l7-5 7 5v13"
                        ></path>

                        <path
                            d="M9 21v-6h6v6"
                        ></path>

                    </svg>

                </div>

                <h2>
                    No projects yet
                </h2>

                <p>
                    Your assigned projects will appear here.
                </p>

            </section>

        @endif

    </main>


    @if($selectedProject)

        @php

            $selectedProgress =
                (int) (
                    $selectedProject->progress
                    ?? 0
                );

            $selectedStatus =
                ucfirst(
                    str_replace(
                        '_',
                        ' ',
                        $selectedProject->status
                        ?? 'active'
                    )
                );

            $selectedNextMeeting =
                $selectedProject->meetings
                    ->filter(
                        function ($meeting) {

                            if (!$meeting->meeting_date) {
                                return false;
                            }

                            return
                                \Carbon\Carbon::parse(
                                    $meeting->meeting_date
                                )
                                ->isFuture();
                        }
                    )
                    ->sortBy('meeting_date')
                    ->first();

            $architectPresence =
                $selectedProject
                    ->architect
                    ?->presence_status
                ?? 'away';

            if (
                !in_array(
                    $architectPresence,
                    [
                        'online',
                        'idle',
                        'away'
                    ]
                )
            ) {

                $architectPresence =
                    'away';

            }

        @endphp


        <div
            class="project-workspace-overlay"
            id="projectWorkspaceOverlay"
        >

            <a
                href="{{ route('client.projects.index') }}"
                class="workspace-overlay-background"
                aria-label="Close Workspace"
            ></a>


            <section class="floating-project-workspace">

                <div class="floating-workspace-header">

                    <div class="workspace-project-heading">

                        <span>
                            Project Workspace
                        </span>

                        <h2>
                            {{ $selectedProject->project_name }}
                        </h2>

                        <div class="workspace-project-meta">

                            <span>
                                {{ $selectedStatus }}
                            </span>

                            <i></i>

                            <span>
                                {{ $selectedProgress }}% Complete
                            </span>

                        </div>

                    </div>


                    <a
                        href="{{ route('client.projects.index') }}"
                        class="close-project-workspace"
                        aria-label="Close Workspace"
                    >

                        <svg viewBox="0 0 24 24">

                            <path d="M18 6 6 18"></path>

                            <path d="m6 6 12 12"></path>

                        </svg>

                    </a>

                </div>


                {{-- =================================================
                     WORKSPACE OVERVIEW
                ================================================== --}}

                <div
                    class="floating-workspace-body"
                    id="workspaceMainContent"
                >

                    <div class="workspace-overview-grid">

                        <div class="workspace-overview-main">

                            <span class="workspace-section-label">
                                Project Overview
                            </span>

                            <h3>
                                Your project at a glance
                            </h3>

                            @if($selectedProject->description)

                                <p class="workspace-description">
                                    {{ $selectedProject->description }}
                                </p>

                            @endif


                            <div class="workspace-progress-block">

                                <div class="workspace-progress-heading">

                                    <span>
                                        Overall Progress
                                    </span>

                                    <strong>
                                        {{ $selectedProgress }}%
                                    </strong>

                                </div>

                                <div class="workspace-progress-bar">

                                    <span
                                        style="
                                            width:
                                            {{ max(
                                                0,
                                                min(
                                                    100,
                                                    $selectedProgress
                                                )
                                            ) }}%;
                                        "
                                    ></span>

                                </div>

                            </div>


                            <div class="workspace-detail-grid">

                                <div class="workspace-detail-card">

                                    <span>
                                        Architect
                                    </span>

                                    <strong>
                                        {{ $selectedProject
                                            ->architect?->name
                                            ?? 'Not assigned'
                                        }}
                                    </strong>

                                </div>

                                <div class="workspace-detail-card">

                                    <span>
                                        Start Date
                                    </span>

                                    <strong>

                                        {{ $selectedProject->start_date
                                            ? \Carbon\Carbon::parse(
                                                $selectedProject->start_date
                                            )
                                            ->format('M d, Y')
                                            : 'Not set'
                                        }}

                                    </strong>

                                </div>

                                <div class="workspace-detail-card">

                                    <span>
                                        Target Date
                                    </span>

                                    <strong>

                                        {{ $selectedProject->target_date
                                            ? \Carbon\Carbon::parse(
                                                $selectedProject->target_date
                                            )
                                            ->format('M d, Y')
                                            : 'Not set'
                                        }}

                                    </strong>

                                </div>

                                <div class="workspace-detail-card">

                                    <span>
                                        Status
                                    </span>

                                    <strong>
                                        {{ $selectedStatus }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        <aside class="workspace-meeting-card">

                            <div class="workspace-meeting-icon">

                                <svg viewBox="0 0 24 24">

                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="16"
                                        rx="2"
                                    ></rect>

                                    <path d="M16 3v4"></path>

                                    <path d="M8 3v4"></path>

                                    <path d="M3 11h18"></path>

                                </svg>

                            </div>

                            <span>
                                Next Meeting
                            </span>

                            @if($selectedNextMeeting)

                                <h4>
                                    {{ $selectedNextMeeting
                                        ->title
                                        ?? 'Project Meeting'
                                    }}
                                </h4>

                                <strong>

                                    {{ \Carbon\Carbon::parse(
                                        $selectedNextMeeting->meeting_date
                                    )
                                    ->timezone('Asia/Manila')
                                    ->format('M d, Y') }}

                                </strong>

                                <p>

                                    {{ \Carbon\Carbon::parse(
                                        $selectedNextMeeting->meeting_date
                                    )
                                    ->timezone('Asia/Manila')
                                    ->format('g:i A') }}

                                </p>

                            @else

                                <h4>
                                    No upcoming meeting
                                </h4>

                                <p>
                                    Your next scheduled meeting
                                    will appear here.
                                </p>

                            @endif

                        </aside>

                    </div>


                    @php
                        $clientFinancialExpenses =
                            $selectedProject->expenses ?? collect();

                        $clientFinancialTotalExpenses =
                            (float) $clientFinancialExpenses->sum('amount');

                        $clientFinancialBudget =
                            $selectedProject->budget !== null
                                ? (float) $selectedProject->budget
                                : null;

                        $clientFinancialRemaining =
                            $clientFinancialBudget !== null
                                ? $clientFinancialBudget - $clientFinancialTotalExpenses
                                : null;

                        $clientFinancialUsage =
                            $clientFinancialBudget !== null
                            && $clientFinancialBudget > 0
                                ? min(
                                    100,
                                    round(
                                        (
                                            $clientFinancialTotalExpenses
                                            / $clientFinancialBudget
                                        ) * 100
                                    )
                                )
                                : 0;
                    @endphp

                    <section class="client-financial-overview">

                        <div class="client-financial-overview-head">

                            <div>

                                <span>
                                    Project Financials
                                </span>

                                <h3>
                                    Budget overview
                                </h3>

                                <p>
                                    View the approved project budget,
                                    recorded expenses, and remaining balance.
                                </p>

                            </div>

                        </div>

                        <div class="client-financial-summary-grid">

                            <article class="client-financial-summary-card">

                                <span>
                                    Project Budget
                                </span>

                                <strong>
                                    @if($clientFinancialBudget !== null)
                                        ₱{{ number_format(
                                            $clientFinancialBudget,
                                            2
                                        ) }}
                                    @else
                                        —
                                    @endif
                                </strong>

                                <small>
                                    Approved project budget
                                </small>

                            </article>

                            <article class="client-financial-summary-card">

                                <span>
                                    Recorded Expenses
                                </span>

                                <strong>
                                    ₱{{ number_format(
                                        $clientFinancialTotalExpenses,
                                        2
                                    ) }}
                                </strong>

                                <small>
                                    Total expenses recorded by your architect
                                </small>

                            </article>

                            <article class="client-financial-summary-card">

                                <span>
                                    Remaining Balance
                                </span>

                                <strong
                                    class="{{
                                        $clientFinancialRemaining !== null
                                        && $clientFinancialRemaining < 0
                                            ? 'client-financial-negative'
                                            : ''
                                    }}"
                                >
                                    @if($clientFinancialRemaining !== null)
                                        ₱{{ number_format(
                                            $clientFinancialRemaining,
                                            2
                                        ) }}
                                    @else
                                        —
                                    @endif
                                </strong>

                                <small>
                                    Budget less recorded expenses
                                </small>

                            </article>

                            <article class="client-financial-summary-card">

                                <span>
                                    Budget Used
                                </span>

                                <strong>
                                    {{
                                        $clientFinancialBudget !== null
                                        && $clientFinancialBudget > 0
                                            ? $clientFinancialUsage . '%'
                                            : '—'
                                    }}
                                </strong>

                                <div class="client-financial-budget-track">

                                    <span
                                        class="{{
                                            $clientFinancialBudget !== null
                                            && $clientFinancialTotalExpenses > $clientFinancialBudget
                                                ? 'over-budget'
                                                : ''
                                        }}"
                                        style="width: {{ $clientFinancialUsage }}%;"
                                    ></span>

                                </div>

                            </article>

                        </div>

                        <p class="client-financial-note">
                            Financial information is view-only in the Client Portal.
                            Updates are managed by the project architect.
                        </p>

                    </section>


                    <div class="workspace-action-section">

                        <div class="workspace-action-heading">

                            <span>
                                Project Tools
                            </span>

                            <h3>
                                What would you like to check?
                            </h3>

                        </div>


                        <div class="workspace-action-grid">

                            <button
                                type="button"
                                class="workspace-action-card"
                                data-workspace-section="phases"
                            >

                                <div class="workspace-action-icon">

                                    <svg viewBox="0 0 24 24">

                                        <path d="M4 6h16"></path>

                                        <path d="M4 12h16"></path>

                                        <path d="M4 18h16"></path>

                                        <circle
                                            cx="7"
                                            cy="6"
                                            r="1"
                                        ></circle>

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="1"
                                        ></circle>

                                        <circle
                                            cx="17"
                                            cy="18"
                                            r="1"
                                        ></circle>

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        Phases
                                    </strong>

                                    <span>
                                        Project roadmap
                                    </span>

                                </div>

                                <small>
                                    {{ $selectedProject
                                        ->phases
                                        ->count()
                                    }}
                                </small>

                            </button>


                            <button
                                type="button"
                                class="workspace-action-card"
                                data-workspace-section="messages"
                            >

                                <div class="workspace-action-icon">

                                    <svg viewBox="0 0 24 24">

                                        <path
                                            d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"
                                        ></path>

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        Messages
                                    </strong>

                                    <span>
                                        Chat or ask AI
                                    </span>

                                </div>

                                <small>
                                    {{ $selectedProject
                                        ->messages
                                        ->count()
                                    }}
                                </small>

                            </button>


                            <button
                                type="button"
                                class="workspace-action-card"
                                data-workspace-section="files"
                            >

                                <div class="workspace-action-icon">

                                    <svg viewBox="0 0 24 24">

                                        <path
                                            d="M3 7h6l2 2h10v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                        ></path>

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        Files
                                    </strong>

                                    <span>
                                        Project documents
                                    </span>

                                </div>

                                <small>
                                    {{ $selectedProject
                                        ->files
                                        ->count()
                                    }}
                                </small>

                            </button>


                            <button
                                type="button"
                                class="workspace-action-card"
                                data-workspace-section="revisions"
                            >

                                <div class="workspace-action-icon">

                                    <svg viewBox="0 0 24 24">

                                        <path
                                            d="M3 12a9 9 0 1 0 3-6.7"
                                        ></path>

                                        <path d="M3 4v6h6"></path>

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        Revisions
                                    </strong>

                                    <span>
                                        Revision requests
                                    </span>

                                </div>

                                <small>
                                    {{ $selectedProject
                                        ->revisions
                                        ->count()
                                    }}
                                </small>

                            </button>


                            <button
                                type="button"
                                class="workspace-action-card"
                                data-workspace-section="meetings"
                            >

                                <div class="workspace-action-icon">

                                    <svg viewBox="0 0 24 24">

                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="16"
                                            rx="2"
                                        ></rect>

                                        <path d="M16 3v4"></path>

                                        <path d="M8 3v4"></path>

                                        <path d="M3 11h18"></path>

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        Meetings
                                    </strong>

                                    <span>
                                        Project schedule
                                    </span>

                                </div>

                                <small>
                                    {{ $selectedProject
                                        ->meetings
                                        ->count()
                                    }}
                                </small>

                            </button>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PHASES
                ================================================== --}}

                <div
                    class="workspace-inner-panel"
                    id="phasesWorkspacePanel"
                >

                    <div class="inner-panel-header">

                        <button
                            type="button"
                            class="inner-panel-back"
                            data-close-workspace-section
                        >

                            <svg viewBox="0 0 24 24">

                                <path d="M19 12H5"></path>

                                <path d="m11 18-6-6 6-6"></path>

                            </svg>

                            <span>
                                Back to Workspace
                            </span>

                        </button>


                        <div class="inner-panel-heading">

                            <span>
                                Project Roadmap
                            </span>

                            <h3>
                                Phases & Milestones
                            </h3>

                            <p>
                                Follow the major stages of your
                                project and see which milestones
                                have been completed.
                            </p>

                        </div>

                    </div>


                    @php

                        $clientProjectPhases =
                            $selectedProject
                                ->phases
                                ->sortBy('phase_order')
                                ->values();

                        $clientTotalMilestones =
                            $clientProjectPhases
                                ->sum(
                                    fn ($phase) =>
                                        $phase
                                            ->milestones
                                            ->count()
                                );

                        $clientCompletedMilestones =
                            $clientProjectPhases
                                ->sum(
                                    fn ($phase) =>
                                        $phase
                                            ->milestones
                                            ->where(
                                                'status',
                                                'completed'
                                            )
                                            ->count()
                                );

                    @endphp


                    <div class="client-phase-summary">

                        <div class="client-phase-summary-card">

                            <span>
                                Project Phases
                            </span>

                            <strong>
                                {{ $clientProjectPhases->count() }}
                            </strong>

                            <p>
                                Roadmap stages
                            </p>

                        </div>

                        <div class="client-phase-summary-card">

                            <span>
                                Milestones
                            </span>

                            <strong>
                                {{ $clientTotalMilestones }}
                            </strong>

                            <p>
                                Total checkpoints
                            </p>

                        </div>

                        <div
                            class="
                                client-phase-summary-card
                                completed
                            "
                        >

                            <span>
                                Completed
                            </span>

                            <strong>
                                {{ $clientCompletedMilestones }}
                            </strong>

                            <p>
                                Finished milestones
                            </p>

                        </div>

                    </div>


                    @if($clientProjectPhases->count())

                        <div class="client-phase-roadmap">

                            @foreach(
                                $clientProjectPhases
                                as $phase
                            )

                                @php

                                    $clientPhaseStatus =
                                        $phase->status
                                        ?? 'pending';

                                    $clientPhaseStatusLabel =
                                        ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $clientPhaseStatus
                                            )
                                        );

                                    $clientPhaseMilestones =
                                        $phase
                                            ->milestones
                                            ->sortBy(
                                                'milestone_order'
                                            )
                                            ->values();

                                    $clientPhaseCompleted =
                                        $clientPhaseMilestones
                                            ->where(
                                                'status',
                                                'completed'
                                            )
                                            ->count();

                                    /*
                                    |--------------------------------------------------------------------------
                                    | FIXED PHASE CONTRIBUTION
                                    |--------------------------------------------------------------------------
                                    |
                                    | Client uses the same phase weights as the
                                    | architect side. Milestones are proof of
                                    | accomplishment, but they do not directly
                                    | change the overall project percentage.
                                    |
                                    */

                                    $clientPhaseWeights = [
                                        1 => 5,
                                        2 => 5,
                                        3 => 10,
                                        4 => 15,
                                        5 => 10,
                                        6 => 10,
                                        7 => 10,
                                        8 => 20,
                                        9 => 10,
                                        10 => 5,
                                    ];

                                    $clientPhaseWeight =
                                        $clientPhaseWeights[
                                            $phase->phase_order
                                        ]
                                        ?? 0;

                                    $clientPhaseContribution =
                                        $clientPhaseStatus === 'completed'
                                            ? $clientPhaseWeight
                                            : 0;

                                @endphp


                                <article class="client-phase-card">

                                    <div class="client-phase-number">

                                        {{ str_pad(
                                            $phase->phase_order
                                            ?? $loop->iteration,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}

                                    </div>


                                    <div class="client-phase-content">

                                        <div class="client-phase-header">

                                            <div>

                                                <span class="client-phase-label">
                                                    Phase
                                                </span>

                                                <h4>
                                                    {{ $phase->phase_name }}
                                                </h4>

                                                @if($phase->description)

                                                    <p>
                                                        {{ $phase->description }}
                                                    </p>

                                                @endif

                                            </div>

                                            <span
                                                class="
                                                    client-phase-status
                                                    status-{{ $clientPhaseStatus }}
                                                "
                                            >
                                                {{ $clientPhaseStatusLabel }}
                                            </span>

                                        </div>


                                        <div class="client-phase-progress">

                                            <div class="client-phase-progress-heading">

                                                <span>
                                                    Project Contribution
                                                </span>

                                                <strong>

                                                    @if(
                                                        $clientPhaseStatus
                                                        ===
                                                        'completed'
                                                    )

                                                        +{{ $clientPhaseWeight }}%

                                                    @else

                                                        {{ $clientPhaseWeight }}%
                                                        when completed

                                                    @endif

                                                </strong>

                                            </div>

                                            <div class="client-phase-progress-track">

                                                <span
                                                    style="
                                                        width:
                                                        {{ $clientPhaseStatus === 'completed'
                                                            ? 100
                                                            : 0
                                                        }}%;
                                                    "
                                                ></span>

                                            </div>

                                        </div>


                                        <div class="client-phase-dates">

                                            <div>

                                                <span>
                                                    Start Date
                                                </span>

                                                <strong>

                                                    {{ $phase->start_date
                                                        ? \Carbon\Carbon::parse(
                                                            $phase->start_date
                                                        )
                                                        ->format('M d, Y')
                                                        : 'Not set'
                                                    }}

                                                </strong>

                                            </div>

                                            <div>

                                                <span>
                                                    Target Date
                                                </span>

                                                <strong>

                                                    {{ $phase->target_date
                                                        ? \Carbon\Carbon::parse(
                                                            $phase->target_date
                                                        )
                                                        ->format('M d, Y')
                                                        : 'Not set'
                                                    }}

                                                </strong>

                                            </div>

                                            @if(
                                                $clientPhaseStatus
                                                ===
                                                'completed'
                                                &&
                                                $phase->completed_date
                                            )

                                                <div>

                                                    <span>
                                                        Completed
                                                    </span>

                                                    <strong>

                                                        {{ \Carbon\Carbon::parse(
                                                            $phase
                                                                ->completed_date
                                                        )
                                                        ->format('M d, Y') }}

                                                    </strong>

                                                </div>

                                            @endif

                                        </div>


                                        <div class="client-milestone-section">

                                            <div class="client-milestone-heading">

                                                <strong>
                                                    Milestones
                                                </strong>

                                                <span>

                                                    {{ $clientPhaseCompleted }}

                                                    of

                                                    {{ $clientPhaseMilestones
                                                        ->count()
                                                    }}

                                                    completed

                                                </span>

                                            </div>


                                            @if($clientPhaseMilestones->count())

                                                <div class="client-milestone-list">

                                                    @foreach(
                                                        $clientPhaseMilestones
                                                        as $milestone
                                                    )

                                                        @php

                                                            $clientMilestoneStatus =
                                                                $milestone->status
                                                                ?? 'pending';

                                                            $clientMilestoneStatusLabel =
                                                                ucfirst(
                                                                    str_replace(
                                                                        '_',
                                                                        ' ',
                                                                        $clientMilestoneStatus
                                                                    )
                                                                );

                                                        @endphp

                                                        <div class="client-milestone-row">

                                                            <span
                                                                class="
                                                                    client-milestone-dot
                                                                    status-{{ $clientMilestoneStatus }}
                                                                "
                                                            ></span>


                                                            <div class="client-milestone-copy">

                                                                <strong>
                                                                    {{ $milestone
                                                                        ->milestone_name
                                                                    }}
                                                                </strong>

                                                                @if($milestone->description)

                                                                    <p>
                                                                        {{ $milestone
                                                                            ->description
                                                                        }}
                                                                    </p>

                                                                @endif

                                                                <small>

                                                                    Target:

                                                                    {{ $milestone
                                                                        ->target_date
                                                                        ? \Carbon\Carbon::parse(
                                                                            $milestone
                                                                                ->target_date
                                                                        )
                                                                        ->format('M d, Y')
                                                                        : 'Not set'
                                                                    }}

                                                                </small>

                                                            </div>


                                                            <div>

                                                                <span
                                                                    class="
                                                                        client-milestone-status
                                                                        status-{{ $clientMilestoneStatus }}
                                                                    "
                                                                >
                                                                    {{ $clientMilestoneStatusLabel }}
                                                                </span>


                                                                @if(
                                                                    $clientMilestoneStatus === 'completed'
                                                                    &&
                                                                    !empty($milestone->proof_file)
                                                                    &&
                                                                    $milestone->client_can_view
                                                                )

                                                                    <a
                                                                        href="{{ route(
                                                                            'project.milestones.proof.secure.view',
                                                                            [
                                                                                'projectId' =>
                                                                                    $selectedProject->id,

                                                                                'milestoneId' =>
                                                                                    $milestone->id
                                                                            ]
                                                                        ) }}"
                                                                        target="_blank"
                                                                        rel="noopener"
                                                                        style="
                                                                            display: inline-block;
                                                                            margin-top: 8px;
                                                                            font-size: 12px;
                                                                            font-weight: 700;
                                                                        "
                                                                    >
                                                                        View Proof
                                                                    </a>

                                                                @endif

                                                            </div>

                                                        </div>

                                                    @endforeach

                                                </div>

                                            @else

                                                <div class="client-milestone-empty">
                                                    Milestones for this phase
                                                    have not been added yet.
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    @else

                        <div class="client-phase-empty">

                            <div class="client-phase-empty-number">
                                01
                            </div>

                            <strong>
                                Project roadmap is being prepared
                            </strong>

                            <p>
                                Your architect has not added project
                                phases and milestones yet. They will
                                appear here once available.
                            </p>

                        </div>

                    @endif

                </div>


{{-- =================================================
     MESSAGES PANEL
================================================== --}}

<div
    class="workspace-inner-panel"
    id="messagesWorkspacePanel"
>

    <div class="messages-workspace-topbar">

        <button
            type="button"
            class="inner-panel-back"
            data-close-workspace-section
        >

            <svg viewBox="0 0 24 24">
                <path d="M19 12H5"></path>
                <path d="m11 18-6-6 6-6"></path>
            </svg>

            <span>
                Back to Workspace
            </span>

        </button>


        <div class="messages-workspace-label">
            <span>
                Project Communication
            </span>
        </div>

    </div>


    <div
        class="messages-workspace-layout"
        id="messagesWorkspaceLayout"
    >

        {{-- =====================================================
             LEFT SIDE — CHAT
        ====================================================== --}}

        <section class="messages-chat-panel">

            {{-- ARCHITECT HEADER --}}

            <div class="chat-person">

                <div class="chat-person-avatar">

                    {{ strtoupper(
                        substr(
                            $selectedProject
                                ->architect?->name
                                ?? 'A',
                            0,
                            1
                        )
                    ) }}

                </div>


                <div class="chat-person-info">

                    <strong>
                        {{ $selectedProject
                            ->architect?->name
                            ?? 'Architect'
                        }}
                    </strong>

                    <span>
                        Project Architect
                    </span>

                </div>


                <div
                    class="
                        chat-status
                        {{ $architectPresence }}
                    "
                >

                    <span></span>

                    @if($architectPresence === 'online')

                        Online now

                    @elseif($architectPresence === 'idle')

                        Idle

                    @else

                        Away

                    @endif

                </div>

            </div>


            {{-- LIVE STATUS MESSAGES --}}

            <div
                class="chat-live-message error"
                id="chatLiveError"
            ></div>

            <div
                class="chat-live-message success"
                id="chatLiveSuccess"
            ></div>


            @if($errors->any())

                <div class="chat-error-message">
                    {{ $errors->first() }}
                </div>

            @endif


            {{-- =====================================================
                 MESSAGE HISTORY
            ====================================================== --}}

            <div
                class="workspace-message-history"
                id="workspaceMessageHistory"
            >

                @forelse(
                    $selectedProject
                        ->messages
                        ->sortBy('created_at')
                    as $message
                )

                    @php

                        $isMine =
                            (int) $message->sender_id
                            ===
                            (int) Auth::id();


                        $attachmentType =
                            strtolower(
                                $message
                                    ->attachment_type
                                ?? ''
                            );


                        $attachmentExtension =
                            strtolower(
                                pathinfo(
                                    $message
                                        ->attachment_path
                                    ?? '',
                                    PATHINFO_EXTENSION
                                )
                            );


                        $imageTypes = [
                            'jpg',
                            'jpeg',
                            'png',
                            'webp'
                        ];


                        $isImage =
                            $message->attachment_path
                            &&
                            (
                                in_array(
                                    $attachmentType,
                                    $imageTypes
                                )
                                ||
                                in_array(
                                    $attachmentExtension,
                                    $imageTypes
                                )
                                ||
                                str_starts_with(
                                    $attachmentType,
                                    'image/'
                                )
                            );


                        $isAiMessage =
                            $message->message
                            &&
                            (
                                str_starts_with(
                                    $message->message,
                                    'AI-assisted design request'
                                )
                                ||
                                str_starts_with(
                                    $message->message,
                                    'AI Concept / Design Inspiration'
                                )
                            );


                        $messageSenderName =
                            $isMine
                                ? 'You'
                                : (
                                    $selectedProject
                                        ->architect?->name
                                    ?? 'Architect'
                                );

                    @endphp


                    <div
                        class="
                            workspace-message-row
                            {{ $isMine
                                ? 'mine'
                                : 'theirs'
                            }}
                            {{ $isAiMessage
                                ? 'ai-message-row'
                                : ''
                            }}
                        "
                    >

                        <div class="workspace-message-wrap">

                            {{-- SENDER --}}

                            <div class="workspace-message-sender">
                                {{ $messageSenderName }}
                            </div>


                            {{-- BUBBLE --}}

                            <div class="workspace-message-bubble">


                                {{-- ==============================
                                     AI LABEL
                                =============================== --}}

                                @if($isAiMessage)

                                    <div class="message-ai-label">

                                        <svg viewBox="0 0 24 24">

                                            <path d="M12 3v3"></path>
                                            <path d="M12 18v3"></path>
                                            <path d="M3 12h3"></path>
                                            <path d="M18 12h3"></path>

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="4"
                                            ></circle>

                                        </svg>

                                        <span>
                                            AI Concept
                                        </span>

                                    </div>

                                @endif


                                {{-- ==============================
                                     IMAGE ATTACHMENT
                                =============================== --}}

                                @if($isImage)

                                    <a
                                        href="{{ route(
                                            'project.messages.attachments.secure.view',
                                            [
                                                'projectId' =>
                                                    $selectedProject->id,

                                                'messageId' =>
                                                    $message->id
                                            ]
                                        ) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="
                                            message-image-link
                                            {{ $isAiMessage
                                                ? 'ai-message-image-link'
                                                : ''
                                            }}
                                        "
                                    >

                                        <img
                                            src="{{ route(
                                            'project.messages.attachments.secure.view',
                                            [
                                                'projectId' =>
                                                    $selectedProject->id,

                                                'messageId' =>
                                                    $message->id
                                            ]
                                        ) }}"
                                            alt="Message Attachment"
                                            class="message-image-preview"
                                        >

                                    </a>


                                {{-- ==============================
                                     FILE ATTACHMENT
                                =============================== --}}

                                @elseif(
                                    $message->attachment_path
                                )

                                    <a
                                        href="{{ route(
                                            'project.messages.attachments.secure.view',
                                            [
                                                'projectId' =>
                                                    $selectedProject->id,

                                                'messageId' =>
                                                    $message->id
                                            ]
                                        ) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="message-file-card"
                                    >

                                        <svg viewBox="0 0 24 24">

                                            <path
                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                            ></path>

                                            <path d="M14 2v6h6"></path>

                                        </svg>


                                        <div>

                                            <strong>

                                                {{ $message
                                                    ->attachment_name
                                                    ?? 'Attachment'
                                                }}

                                            </strong>

                                            <span>

                                                {{ strtoupper(
                                                    $message
                                                        ->attachment_type
                                                    ?? 'FILE'
                                                ) }}

                                            </span>

                                        </div>

                                    </a>

                                @endif


                                {{-- ==============================
                                     MESSAGE BODY
                                =============================== --}}

                               @if($message->message)
    <p class="workspace-message-text">{{ $message->message }}</p>
@endif


                                {{-- ==============================
                                     TIME
                                =============================== --}}

                                <span class="message-time">

                                    {{ $message->created_at
                                        ? $message
                                            ->created_at
                                            ->timezone(
                                                'Asia/Manila'
                                            )
                                            ->format(
                                                'M d, g:i A'
                                            )
                                        : ''
                                    }}

                                </span>

                            </div>

                        </div>

                    </div>


                @empty

                    <div class="workspace-no-messages">

                        <div class="messages-empty-icon">

                            <svg viewBox="0 0 24 24">

                                <path
                                    d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"
                                ></path>

                            </svg>

                        </div>


                        <strong>
                            Start the conversation
                        </strong>


                        <p>
                            Send a message directly to your
                            project architect.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- =====================================================
                 ATTACHMENT PREVIEW
            ====================================================== --}}

            <div
                class="selected-attachment-preview"
                id="selectedAttachmentPreview"
            >

                <div
                    class="selected-image-preview"
                    id="selectedImagePreview"
                ></div>


                <div class="selected-file-details">

                    <strong
                        id="selectedAttachmentName"
                    ></strong>

                    <span
                        id="selectedAttachmentSize"
                    ></span>

                </div>


                <button
                    type="button"
                    id="removeSelectedAttachment"
                    class="remove-selected-attachment"
                    aria-label="Remove Attachment"
                >

                    <svg viewBox="0 0 24 24">

                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>

                    </svg>

                </button>

            </div>


            {{-- =====================================================
                 COMPOSER
            ====================================================== --}}

            <div class="unified-chat-composer">

                <div class="chat-compose-toolbar">

                    <div class="composer-mode-switch">

                        <button
                            type="button"
                            class="composer-mode active"
                            data-composer-mode="message"
                        >

                            <svg viewBox="0 0 24 24">

                                <path
                                    d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"
                                ></path>

                            </svg>

                            Message

                        </button>


                        <button
                            type="button"
                            class="composer-mode"
                            data-composer-mode="ai"
                        >

                            <svg viewBox="0 0 24 24">

                                <path d="M12 3v3"></path>
                                <path d="M12 18v3"></path>
                                <path d="M3 12h3"></path>
                                <path d="M18 12h3"></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="4"
                                ></circle>

                            </svg>

                            Ask AI

                        </button>

                    </div>


                    <span
                        class="composer-mode-description"
                        id="composerModeDescription"
                    >
                        Send directly to your architect
                    </span>

                </div>


                {{-- NORMAL MESSAGE FORM --}}

                <form
                    method="POST"
                    action="{{ route(
                        'client.projects.messages.store',
                        [
                            'id' =>
                                $selectedProject->id
                        ]
                    ) }}"
                    enctype="multipart/form-data"
                    id="workspaceMessageForm"
                    class="unified-message-form"
                >

                    @csrf


                    <input
                        type="file"
                        name="attachment"
                        id="workspaceAttachmentInput"
                        class="hidden-message-file-input"
                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                    >


                    <div class="unified-composer-row">

                        <label
                            for="workspaceAttachmentInput"
                            class="message-attachment-button"
                            title="Attach File"
                        >

                            <svg viewBox="0 0 24 24">

                                <path
                                    d="m21.4 11.6-8.9 8.9a6 6 0 0 1-8.5-8.5l9.6-9.6a4 4 0 0 1 5.7 5.7l-9.6 9.6a2 2 0 0 1-2.8-2.8l8.9-8.9"
                                ></path>

                            </svg>

                        </label>


                        <div class="message-textarea-wrap">

                            <textarea
                                name="message"
                                rows="1"
                                id="workspaceMessageInput"
                                placeholder="Message your architect..."
                            >{{ old('message') }}</textarea>

                        </div>


                        <button
                            type="submit"
                            class="workspace-message-send"
                            id="workspaceMessageSend"
                            aria-label="Send Message"
                        >

                            <svg viewBox="0 0 24 24">

                                <path
                                    d="m22 2-7 20-4-9-9-4z"
                                ></path>

                                <path d="M22 2 11 13"></path>

                            </svg>

                        </button>

                    </div>

                </form>


                {{-- AI FORM --}}

                <form
                    id="chatAiForm"
                    class="unified-ai-form"
                    enctype="multipart/form-data"
                >

                    <input
                        type="file"
                        name="reference_image"
                        id="chatAiImageInput"
                        class="hidden-message-file-input"
                        accept=".jpg,.jpeg,.png"
                    >


                    <input
                        type="hidden"
                        id="chatAiParentHistoryId"
                        value=""
                    >


                    <div
                        class="chat-ai-image-preview"
                        id="chatAiImagePreview"
                    ></div>


                    <div class="unified-composer-row">

                        <label
                            for="chatAiImageInput"
                            class="message-attachment-button ai"
                            title="Reference Image"
                        >

                            <svg viewBox="0 0 24 24">

                                <rect
                                    x="3"
                                    y="3"
                                    width="18"
                                    height="18"
                                    rx="2"
                                ></rect>

                                <circle
                                    cx="8.5"
                                    cy="8.5"
                                    r="1.5"
                                ></circle>

                                <path
                                    d="m21 15-5-5L5 21"
                                ></path>

                            </svg>

                        </label>


                        <div class="message-textarea-wrap">

                            <textarea
                                name="prompt"
                                rows="1"
                                id="chatAiPrompt"
                                maxlength="3000"
                                placeholder="Describe the design concept you want..."
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="workspace-message-send ai-send"
                            id="chatAskAiButton"
                            aria-label="Generate AI Concept"
                        >

                            <svg viewBox="0 0 24 24">

                                <path d="M12 3v3"></path>
                                <path d="M12 18v3"></path>
                                <path d="M3 12h3"></path>
                                <path d="M18 12h3"></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="4"
                                ></circle>

                            </svg>

                        </button>

                    </div>

                </form>

            </div>

        </section>


        {{-- =====================================================
             RIGHT SIDE — AI CONCEPT PREVIEW
        ====================================================== --}}

        <aside
            class="messages-ai-panel"
            id="messagesAiPanel"
        >

            <div class="messages-ai-panel-header">

                <div>

                    <span>
                        AI Design Studio
                    </span>

                    <strong>
                        Concept Preview
                    </strong>

                </div>


                <button
                    type="button"
                    class="messages-ai-close"
                    id="messagesAiClose"
                    aria-label="Close AI Panel"
                >

                    <svg viewBox="0 0 24 24">

                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>

                    </svg>

                </button>

            </div>


            <div class="messages-ai-panel-body">

                <div
                    class="messages-ai-empty"
                    id="messagesAiEmpty"
                >

                    <div class="messages-ai-empty-icon">

                        <svg viewBox="0 0 24 24">

                            <path d="M12 3v3"></path>
                            <path d="M12 18v3"></path>
                            <path d="M3 12h3"></path>
                            <path d="M18 12h3"></path>

                            <circle
                                cx="12"
                                cy="12"
                                r="4"
                            ></circle>

                        </svg>

                    </div>


                    <strong>
                        Create a design concept
                    </strong>


                    <p>
                        Describe your idea below or attach
                        a reference image. Your generated
                        concept will appear here.
                    </p>

                </div>


                <div
                    class="chat-ai-result-wrapper"
                    id="chatAiResultWrapper"
                ></div>

            </div>

        </aside>

    </div>

</div>

                {{-- =================================================
                     FILES PANEL
                ================================================== --}}

                <div
                    class="workspace-inner-panel"
                    id="filesWorkspacePanel"
                >

                    <div class="inner-panel-header">

                        <button
                            type="button"
                            class="inner-panel-back"
                            data-close-workspace-section
                        >

                            <svg viewBox="0 0 24 24">

                                <path d="M19 12H5"></path>

                                <path d="m11 18-6-6 6-6"></path>

                            </svg>

                            <span>
                                Back to Workspace
                            </span>

                        </button>


                        <div class="inner-panel-heading">

                            <span>
                                Project Documents
                            </span>

                            <h3>
                                Files
                            </h3>

                            <p>
                                View drawings, documents,
                                presentations, and reference files
                                shared by your architect.
                            </p>

                        </div>

                    </div>


                    @php

                        $workspaceFiles =
                            $selectedProject
                                ->files
                                ->sortByDesc('created_at');

                        $allActiveWorkspaceFiles =
                            $workspaceFiles
                                ->filter(
                                    function ($file) {

                                        return !(
                                            $file->is_archived
                                            ?? false
                                        );
                                    }
                                );

                        $activeWorkspaceFiles =
                            $allActiveWorkspaceFiles
                                ->filter(
                                    function ($file) {

                                        if (!$file->version_group) {
                                            return true;
                                        }

                                        return
                                            (bool)
                                            $file->is_latest;
                                    }
                                )
                                ->values();

                        $workspaceFileCategories =
                            $activeWorkspaceFiles
                                ->pluck('category')
                                ->filter()
                                ->unique()
                                ->sort()
                                ->values();

                    @endphp


                    <div class="client-files-toolbar">

                        <div class="client-files-summary">

                            <div class="client-files-summary-icon">

                                <svg viewBox="0 0 24 24">

                                    <path
                                        d="M3 7h6l2 2h10v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                    ></path>

                                </svg>

                            </div>


                            <div>

                                <strong>
                                    {{ $activeWorkspaceFiles->count() }}
                                </strong>

                                <span>

                                    {{ $activeWorkspaceFiles->count()
                                        === 1
                                        ? 'Shared file'
                                        : 'Shared files'
                                    }}

                                </span>

                            </div>

                        </div>


                        <div class="client-files-controls">

                            <label class="client-file-search">

                                <svg viewBox="0 0 24 24">

                                    <circle
                                        cx="11"
                                        cy="11"
                                        r="7"
                                    ></circle>

                                    <path
                                        d="m20 20-3.5-3.5"
                                    ></path>

                                </svg>

                                <input
                                    type="search"
                                    id="clientFileSearch"
                                    placeholder="Search project files..."
                                    autocomplete="off"
                                >

                            </label>


                            <label class="client-file-filter">

                                <span class="sr-only">
                                    Filter by category
                                </span>

                                <select
                                    id="clientFileCategoryFilter"
                                >

                                    <option value="all">
                                        All Categories
                                    </option>

                                    @foreach(
                                        $workspaceFileCategories
                                        as $category
                                    )

                                        <option
                                            value="{{ strtolower(
                                                $category
                                            ) }}"
                                        >
                                            {{ ucfirst($category) }}
                                        </option>

                                    @endforeach

                                </select>

                            </label>

                        </div>

                    </div>


                    <div
                        class="client-files-empty-filter"
                        id="clientFilesNoResults"
                    >

                        <div class="client-files-empty-icon">

                            <svg viewBox="0 0 24 24">

                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                ></circle>

                                <path
                                    d="m20 20-3.5-3.5"
                                ></path>

                            </svg>

                        </div>

                        <strong>
                            No matching files
                        </strong>

                        <p>
                            Try another file name or category.
                        </p>

                    </div>


                    <div
                        class="client-files-list"
                        id="clientFilesList"
                    >

                        @forelse(
                            $activeWorkspaceFiles
                            as $file
                        )

                            @php

                                $fileName =
                                    $file->original_name
                                    ?? $file->file_name
                                    ?? 'Project File';

                                $fileType =
                                    strtolower(
                                        $file->file_type
                                        ??
                                        pathinfo(
                                            $fileName,
                                            PATHINFO_EXTENSION
                                        )
                                        ??
                                        'file'
                                    );

                                $fileCategory =
                                    strtolower(
                                        $file->category
                                        ?? 'general'
                                    );

                                $fileVersionNumber =
                                    (int) (
                                        $file->version_number
                                        ?? 1
                                    );

                                if ($file->version_group) {

                                    $fileVersions =
                                        $allActiveWorkspaceFiles
                                            ->filter(
                                                fn ($version) =>
                                                    $version
                                                        ->version_group
                                                    ===
                                                    $file
                                                        ->version_group
                                            )
                                            ->sortByDesc(
                                                'version_number'
                                            )
                                            ->values();

                                } else {

                                    $fileVersions =
                                        collect([$file]);

                                }

                                $fileVersionCount =
                                    $fileVersions->count();

                                $fileSize =
                                    (int) (
                                        $file->file_size
                                        ?? 0
                                    );

                                if ($fileSize >= 1048576) {

                                    $formattedFileSize =
                                        number_format(
                                            $fileSize / 1048576,
                                            2
                                        )
                                        .
                                        ' MB';

                                } elseif ($fileSize >= 1024) {

                                    $formattedFileSize =
                                        number_format(
                                            $fileSize / 1024,
                                            1
                                        )
                                        .
                                        ' KB';

                                } elseif ($fileSize > 0) {

                                    $formattedFileSize =
                                        $fileSize
                                        .
                                        ' B';

                                } else {

                                    $formattedFileSize =
                                        'Size unavailable';

                                }

                                $imageFileTypes = [
                                    'jpg',
                                    'jpeg',
                                    'png',
                                    'webp'
                                ];

                                $drawingFileTypes = [
                                    'dwg',
                                    'dxf'
                                ];

                                if ($fileType === 'pdf') {

                                    $fileIconType =
                                        'pdf';

                                } elseif (
                                    in_array(
                                        $fileType,
                                        $imageFileTypes
                                    )
                                ) {

                                    $fileIconType =
                                        'image';

                                } elseif (
                                    in_array(
                                        $fileType,
                                        $drawingFileTypes
                                    )
                                ) {

                                    $fileIconType =
                                        'drawing';

                                } elseif ($fileType === 'zip') {

                                    $fileIconType =
                                        'archive';

                                } else {

                                    $fileIconType =
                                        'file';

                                }

                            @endphp


                            <article
                                class="client-file-card"
                                data-client-file
                                data-file-name="{{ strtolower(
                                    $fileName
                                ) }}"
                                data-file-category="{{ $fileCategory }}"
                                data-file-type="{{ $fileType }}"
                            >

                                <div
                                    class="
                                        client-file-type-icon
                                        type-{{ $fileIconType }}
                                    "
                                >

                                    @if($fileIconType === 'image')

                                        <svg viewBox="0 0 24 24">

                                            <rect
                                                x="3"
                                                y="3"
                                                width="18"
                                                height="18"
                                                rx="2"
                                            ></rect>

                                            <circle
                                                cx="8.5"
                                                cy="8.5"
                                                r="1.5"
                                            ></circle>

                                            <path
                                                d="m21 15-5-5L5 21"
                                            ></path>

                                        </svg>

                                    @else

                                        <svg viewBox="0 0 24 24">

                                            <path
                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                            ></path>

                                            <path
                                                d="M14 2v6h6"
                                            ></path>

                                            <path
                                                d="M8 13h8"
                                            ></path>

                                            <path
                                                d="M8 17h6"
                                            ></path>

                                        </svg>

                                    @endif

                                    <span>
                                        {{ strtoupper(
                                            $fileType
                                            ?: 'FILE'
                                        ) }}
                                    </span>

                                </div>


                                <div class="client-file-information">

                                    <div class="client-file-name-row">

                                        <div class="client-file-name-wrap">

                                            <strong
                                                class="client-file-name"
                                                title="{{ $fileName }}"
                                            >
                                                {{ $fileName }}
                                            </strong>


                                            <div class="client-file-badges">

                                                <span class="client-file-category">
                                                    {{ ucfirst($fileCategory) }}
                                                </span>

                                                <span class="client-file-version">
                                                    V{{ $fileVersionNumber }}
                                                </span>

                                                <span class="client-file-latest">
                                                    Latest
                                                </span>

                                                <span class="client-file-shared">
                                                    Shared by Architect
                                                </span>

                                            </div>

                                        </div>


                                        <span class="client-file-size">
                                            {{ $formattedFileSize }}
                                        </span>

                                    </div>


                                    @if($file->description)

                                        <p class="client-file-description">
                                            {{ $file->description }}
                                        </p>

                                    @endif


                                    <div class="client-file-meta">

                                        <span>

                                            Uploaded

                                            {{ $file->created_at
                                                ? $file
                                                    ->created_at
                                                    ->timezone(
                                                        'Asia/Manila'
                                                    )
                                                    ->format(
                                                        'M d, Y · g:i A'
                                                    )
                                                : 'date unavailable'
                                            }}

                                        </span>

                                        <i></i>

                                        <span>
                                            {{ strtoupper(
                                                $fileType
                                                ?: 'FILE'
                                            ) }}
                                        </span>

                                    </div>

                                </div>


                                <div class="client-file-actions">

                                    <a
                                        href="{{ route(
                                            'client.projects.files.view',
                                            [
                                                'id' =>
                                                    $selectedProject->id,
                                                'file' =>
                                                    $file->id
                                            ]
                                        ) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="client-file-view"
                                    >
                                        View
                                    </a>


                                    <a
                                        href="{{ route(
                                            'client.projects.files.download',
                                            [
                                                'id' =>
                                                    $selectedProject->id,
                                                'file' =>
                                                    $file->id
                                            ]
                                        ) }}"
                                        class="client-file-download"
                                    >
                                        Download
                                    </a>


                                    <button
                                        type="button"
                                        class="client-file-history-button"
                                        data-file-history-toggle="{{ $file->id }}"
                                        aria-expanded="false"
                                        aria-controls="clientFileHistory{{ $file->id }}"
                                    >

                                        Version History

                                        <span>
                                            {{ $fileVersionCount }}
                                        </span>

                                    </button>

                                </div>


                                <div
                                    class="client-file-version-history"
                                    id="clientFileHistory{{ $file->id }}"
                                    data-file-history="{{ $file->id }}"
                                >

                                    <div class="client-file-history-header">

                                        <div>

                                            <span>
                                                File History
                                            </span>

                                            <strong>
                                                {{ $fileName }}
                                            </strong>

                                        </div>

                                        <small>

                                            {{ $fileVersionCount }}

                                            {{ $fileVersionCount === 1
                                                ? 'version'
                                                : 'versions'
                                            }}

                                        </small>

                                    </div>


                                    <div class="client-file-history-list">

                                        @foreach(
                                            $fileVersions
                                            as $version
                                        )

                                            @php

                                                $versionNumber =
                                                    (int) (
                                                        $version
                                                            ->version_number
                                                        ?? 1
                                                    );

                                                $versionName =
                                                    $version
                                                        ->original_name
                                                    ??
                                                    $version
                                                        ->file_name
                                                    ??
                                                    $fileName;

                                                $versionIsLatest =
                                                    $file
                                                        ->version_group
                                                    ? (bool)
                                                        $version
                                                            ->is_latest
                                                    : true;

                                            @endphp


                                            <div class="client-file-history-item">

                                                <div class="client-file-history-version">

                                                    <span>
                                                        V{{ $versionNumber }}
                                                    </span>

                                                    @if($versionIsLatest)

                                                        <small>
                                                            Latest
                                                        </small>

                                                    @endif

                                                </div>


                                                <div class="client-file-history-info">

                                                    <strong>
                                                        {{ $versionName }}
                                                    </strong>

                                                    <span>

                                                        {{ $version->created_at
                                                            ? $version
                                                                ->created_at
                                                                ->timezone(
                                                                    'Asia/Manila'
                                                                )
                                                                ->format(
                                                                    'M d, Y · g:i A'
                                                                )
                                                            : 'Date unavailable'
                                                        }}

                                                    </span>

                                                </div>


                                                <div class="client-file-history-actions">

                                                    <a
                                                        href="{{ route(
                                                            'client.projects.files.view',
                                                            [
                                                                'id' =>
                                                                    $selectedProject
                                                                        ->id,
                                                                'file' =>
                                                                    $version
                                                                        ->id
                                                            ]
                                                        ) }}"
                                                        target="_blank"
                                                        rel="noopener"
                                                    >
                                                        View
                                                    </a>


                                                    <a
                                                        href="{{ route(
                                                            'client.projects.files.download',
                                                            [
                                                                'id' =>
                                                                    $selectedProject
                                                                        ->id,
                                                                'file' =>
                                                                    $version
                                                                        ->id
                                                            ]
                                                        ) }}"
                                                    >
                                                        Download
                                                    </a>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            </article>

                        @empty

                            <div class="client-files-empty-main">

                                <strong>
                                    No project files yet
                                </strong>

                                <p>
                                    Files shared by your architect
                                    will appear here.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>


                {{-- =================================================
                     REVISIONS PANEL
                ================================================== --}}

                <div
                    class="workspace-inner-panel"
                    id="revisionsWorkspacePanel"
                >

                    <div class="inner-panel-header">

                        <button
                            type="button"
                            class="inner-panel-back"
                            data-close-workspace-section
                        >

                            <svg viewBox="0 0 24 24">

                                <path d="M19 12H5"></path>

                                <path d="m11 18-6-6 6-6"></path>

                            </svg>

                            <span>
                                Back to Workspace
                            </span>

                        </button>


                        <div class="inner-panel-heading">

                            <span>
                                Project Updates
                            </span>

                            <h3>
                                Revisions
                            </h3>

                            <p>
                                Submit clear revision requests and
                                follow your architect's progress
                                and response.
                            </p>

                        </div>

                    </div>


                    @php

                        $workspaceRevisions =
                            $selectedProject
                                ->revisions
                                ->sortByDesc('created_at');

                        $pendingRevisionCount =
                            $workspaceRevisions
                                ->where(
                                    'status',
                                    'pending'
                                )
                                ->count();

                        $inProgressRevisionCount =
                            $workspaceRevisions
                                ->where(
                                    'status',
                                    'in_progress'
                                )
                                ->count();

                        $resolvedRevisionCount =
                            $workspaceRevisions
                                ->where(
                                    'status',
                                    'resolved'
                                )
                                ->count();

                    @endphp


                    <div class="client-revision-layout">

                        <div class="client-revision-main">

                            <div class="client-revision-summary">

                                <div class="client-revision-summary-card">

                                    <span>
                                        All Requests
                                    </span>

                                    <strong>
                                        {{ $workspaceRevisions->count() }}
                                    </strong>

                                </div>

                                <div
                                    class="
                                        client-revision-summary-card
                                        pending
                                    "
                                >

                                    <span>
                                        Pending
                                    </span>

                                    <strong>
                                        {{ $pendingRevisionCount }}
                                    </strong>

                                </div>

                                <div
                                    class="
                                        client-revision-summary-card
                                        progress
                                    "
                                >

                                    <span>
                                        In Progress
                                    </span>

                                    <strong>
                                        {{ $inProgressRevisionCount }}
                                    </strong>

                                </div>

                                <div
                                    class="
                                        client-revision-summary-card
                                        resolved
                                    "
                                >

                                    <span>
                                        Resolved
                                    </span>

                                    <strong>
                                        {{ $resolvedRevisionCount }}
                                    </strong>

                                </div>

                            </div>


                            @if(session('success'))

                                <div class="client-revision-alert success">
                                    {{ session('success') }}
                                </div>

                            @endif


                            @if($errors->any())

                                <div class="client-revision-alert error">

                                    <strong>
                                        Please check your revision request.
                                    </strong>

                                    <span>
                                        {{ $errors->first() }}
                                    </span>

                                </div>

                            @endif


                            <div class="client-revision-section-heading">

                                <div>

                                    <span>
                                        Revision History
                                    </span>

                                    <h4>
                                        Your submitted requests
                                    </h4>

                                </div>


                                <button
                                    type="button"
                                    class="client-new-revision-button"
                                    id="openRevisionFormButton"
                                >

                                    <svg viewBox="0 0 24 24">

                                        <path d="M12 5v14"></path>

                                        <path d="M5 12h14"></path>

                                    </svg>

                                    New Revision Request

                                </button>

                            </div>


                            <div class="client-revision-list">

                                @forelse(
                                    $workspaceRevisions
                                    as $revision
                                )

                                    @php

                                        $revisionStatus =
                                            $revision->status
                                            ?? 'pending';

                                        $revisionStatusLabel =
                                            ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $revisionStatus
                                                )
                                            );

                                        $revisionAttachmentType =
                                            strtolower(
                                                $revision
                                                    ->attachment_type
                                                ?? ''
                                            );

                                        $revisionAttachmentExtension =
                                            strtolower(
                                                pathinfo(
                                                    $revision
                                                        ->attachment_path
                                                    ?? '',
                                                    PATHINFO_EXTENSION
                                                )
                                            );

                                        $revisionAttachmentIsImage =
                                            $revision->attachment_path
                                            &&
                                            (
                                                in_array(
                                                    $revisionAttachmentType,
                                                    [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'webp'
                                                    ]
                                                )
                                                ||
                                                in_array(
                                                    $revisionAttachmentExtension,
                                                    [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'webp'
                                                    ]
                                                )
                                                ||
                                                str_starts_with(
                                                    $revisionAttachmentType,
                                                    'image/'
                                                )
                                            );

                                    @endphp


                                    <article
                                        class="client-revision-card"
                                        id="revision-{{ $revision->id }}"
                                    >

                                        <div class="client-revision-card-top">

                                            <div class="client-revision-card-title">

                                                <span class="client-revision-number">
                                                    Revision #{{ $revision->id }}
                                                </span>

                                                <h4>
                                                    {{ $revision->title
                                                        ?? 'Revision Request'
                                                    }}
                                                </h4>

                                            </div>


                                            <span
                                                class="
                                                    client-revision-status
                                                    status-{{ $revisionStatus }}
                                                "
                                            >
                                                {{ $revisionStatusLabel }}
                                            </span>

                                        </div>


                                        <div class="client-revision-meta">

                                            <span>

                                                Submitted

                                                {{ $revision->created_at
                                                    ? $revision
                                                        ->created_at
                                                        ->timezone(
                                                            'Asia/Manila'
                                                        )
                                                        ->format(
                                                            'M d, Y · g:i A'
                                                        )
                                                    : 'date unavailable'
                                                }}

                                            </span>


                                            @if($revision->revision_category)

                                                <i></i>

                                                <span>
                                                    {{ $revision
                                                        ->revision_category
                                                    }}
                                                </span>

                                            @endif


                                            @if($revision->used_ai)

                                                <i></i>

                                                <span>
                                                    AI-assisted
                                                </span>

                                            @endif

                                        </div>


                                        @if($revision->description)

                                            <div class="client-revision-feedback">

                                                <span>
                                                    Your Feedback
                                                </span>

                                                <p>
                                                    {{ $revision->description }}
                                                </p>

                                            </div>

                                        @endif


                                        @if(
                                            $revision
                                                ->ai_structured_feedback
                                        )

                                            <div class="client-revision-ai-feedback">

                                                <span>
                                                    Structured Revision
                                                </span>

                                                <p>
                                                    {{ $revision->ai_structured_feedback }}
                                                </p>

                                            </div>

                                        @endif


                                        @if($revision->attachment_path)

                                            <div class="client-revision-attachment">

                                                @if($revisionAttachmentIsImage)

                                                    <a
                                                        href="{{ route(
                                                            'project.revisions.attachments.secure.view',
                                                            [
                                                                'projectId' =>
                                                                    $selectedProject->id,

                                                                'revisionId' =>
                                                                    $revision->id
                                                            ]
                                                        ) }}"
                                                        target="_blank"
                                                        rel="noopener"
                                                        class="client-revision-image"
                                                    >

                                                        <img
                                                            src="{{ route(
                                                            'project.revisions.attachments.secure.view',
                                                            [
                                                                'projectId' =>
                                                                    $selectedProject->id,

                                                                'revisionId' =>
                                                                    $revision->id
                                                            ]
                                                        ) }}"
                                                            alt="Revision Reference"
                                                        >

                                                    </a>

                                                @endif


                                                <a
                                                    href="{{ route(
                                                            'project.revisions.attachments.secure.view',
                                                            [
                                                                'projectId' =>
                                                                    $selectedProject->id,

                                                                'revisionId' =>
                                                                    $revision->id
                                                            ]
                                                        ) }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    class="client-revision-file"
                                                >

                                                    <div>

                                                        <strong>
                                                            {{ $revision
                                                                ->attachment_name
                                                                ?? 'Reference Attachment'
                                                            }}
                                                        </strong>

                                                    </div>

                                                </a>

                                            </div>

                                        @endif


                                        <div class="client-revision-architect-response">

                                            <div class="client-revision-response-heading">

                                                <div class="client-revision-response-avatar">

                                                    {{ strtoupper(
                                                        substr(
                                                            $selectedProject
                                                                ->architect?->name
                                                                ?? 'A',
                                                            0,
                                                            1
                                                        )
                                                    ) }}

                                                </div>


                                                <div>

                                                    <strong>
                                                        Architect Response
                                                    </strong>

                                                    <span>
                                                        {{ $selectedProject
                                                            ->architect?->name
                                                            ?? 'Project Architect'
                                                        }}
                                                    </span>

                                                </div>

                                            </div>


                                            @if(
                                                $revision
                                                    ->architect_response
                                            )

                                                <p>
                                                    {{ $revision
                                                        ->architect_response
                                                    }}
                                                </p>

                                            @else

                                                <p class="waiting">
                                                    No response yet.
                                                    Your architect will
                                                    update this request here.
                                                </p>

                                            @endif

                                        </div>

                                    </article>

                                @empty

                                    <div
                                        class="
                                            workspace-empty-state
                                            client-revision-empty
                                        "
                                    >

                                        <strong>
                                            No revision requests yet
                                        </strong>

                                        <p>
                                            When you need a design change,
                                            submit your first revision request.
                                        </p>

                                    </div>

                                @endforelse

                            </div>

                        </div>


                        <aside
                            class="client-revision-form-card"
                            id="clientRevisionFormCard"
                        >

                            <div class="client-revision-form-heading">

                                <div>

                                    <span>
                                        New Request
                                    </span>

                                    <h4>
                                        What would you like revised?
                                    </h4>

                                    <p>
                                        Be specific so your architect can
                                        understand the requested change.
                                    </p>

                                </div>


                                <button
                                    type="button"
                                    class="client-revision-form-close"
                                    id="closeRevisionFormButton"
                                    aria-label="Close Revision Form"
                                >

                                    <svg viewBox="0 0 24 24">

                                        <path d="M18 6 6 18"></path>

                                        <path d="m6 6 12 12"></path>

                                    </svg>

                                </button>

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                                    'client.projects.revisions.store',
                                    [
                                        'id' =>
                                            $selectedProject->id
                                    ]
                                ) }}"
                                enctype="multipart/form-data"
                                id="clientRevisionForm"
                            >

                                @csrf


                                <div class="client-revision-field">

                                    <label for="revisionTitle">
                                        Revision Title
                                    </label>

                                    <input
                                        type="text"
                                        name="title"
                                        id="revisionTitle"
                                        maxlength="255"
                                        value="{{ old('title') }}"
                                        placeholder="Example: Living room window adjustment"
                                        required
                                    >

                                </div>


                                <div class="client-revision-field">

                                    <label for="revisionCategory">
                                        Category
                                    </label>

                                    <select
                                        name="revision_category"
                                        id="revisionCategory"
                                    >

                                        <option value="">
                                            Select a category
                                        </option>

                                        <option
                                            value="Layout"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Layout'
                                            )
                                        >
                                            Layout
                                        </option>

                                        <option
                                            value="Exterior"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Exterior'
                                            )
                                        >
                                            Exterior
                                        </option>

                                        <option
                                            value="Interior"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Interior'
                                            )
                                        >
                                            Interior
                                        </option>

                                        <option
                                            value="Materials"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Materials'
                                            )
                                        >
                                            Materials
                                        </option>

                                        <option
                                            value="Furniture"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Furniture'
                                            )
                                        >
                                            Furniture
                                        </option>

                                        <option
                                            value="Lighting"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Lighting'
                                            )
                                        >
                                            Lighting
                                        </option>

                                        <option
                                            value="Other"
                                            @selected(
                                                old(
                                                    'revision_category'
                                                )
                                                ===
                                                'Other'
                                            )
                                        >
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <div class="client-revision-field">

                                    <div class="client-revision-label-row">

                                        <label for="revisionDescription">
                                            Revision Feedback
                                        </label>

                                        <span>
                                            Required
                                        </span>

                                    </div>

                                    <textarea
                                        name="description"
                                        id="revisionDescription"
                                        rows="7"
                                        maxlength="5000"
                                        placeholder="Describe what you want changed, where it is located, and what result you prefer."
                                        required
                                    >{{ old('description') }}</textarea>

                                    <small>
                                        Include the area, requested change,
                                        and your preferred result.
                                    </small>

                                </div>


                                <div class="client-revision-field">

                                    <label for="revisionAttachment">
                                        Reference File or Image
                                    </label>

                                    <label
                                        for="revisionAttachment"
                                        class="client-revision-upload"
                                    >

                                        <div>

                                            <strong>
                                                Attach reference
                                            </strong>

                                            <span>
                                                JPG, JPEG, PNG, PDF,
                                                DOC, DOCX, XLS or XLSX.
                                                Images up to 100 MB.
                                                Documents up to 10 MB.
                                            </span>

                                        </div>

                                    </label>

                                    <input
                                        type="file"
                                        name="attachment"
                                        id="revisionAttachment"
                                        class="client-revision-file-input"
                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                    >

                                    <div
                                        class="client-revision-file-preview"
                                        id="revisionFilePreview"
                                    >

                                        <div
                                            class="client-revision-preview-image"
                                            id="revisionPreviewImage"
                                        ></div>

                                        <div>

                                            <strong
                                                id="revisionPreviewName"
                                            ></strong>

                                            <span
                                                id="revisionPreviewSize"
                                            ></span>

                                        </div>

                                        <button
                                            type="button"
                                            id="removeRevisionAttachment"
                                            aria-label="Remove Attachment"
                                        >
                                            Remove
                                        </button>

                                    </div>

                                </div>


                                <input
                                    type="hidden"
                                    name="used_ai"
                                    id="revisionUsedAi"
                                    value="{{ old(
                                        'used_ai',
                                        '0'
                                    ) }}"
                                >


                                <div class="client-revision-ai-note">

                                    <div>

                                        <strong>
                                            Make your revision clearer with AI
                                        </strong>

                                        <span>
                                            AI can organize your original
                                            feedback into a clearer revision
                                            request. Review and edit the
                                            result before submitting.
                                        </span>

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="client-revision-ai-button"
                                    id="structureRevisionAiButton"
                                >
                                    Structure with AI
                                </button>


                                <div
                                    class="client-revision-ai-status"
                                    id="revisionAiStatus"
                                    aria-live="polite"
                                ></div>


                                <div
                                    class="client-revision-ai-review"
                                    id="revisionAiReview"
                                >

                                    <div class="client-revision-ai-review-heading">

                                        <div>

                                            <span>
                                                AI-assisted
                                            </span>

                                            <strong>
                                                Review Structured Revision
                                            </strong>

                                        </div>


                                        <button
                                            type="button"
                                            id="discardRevisionAiButton"
                                        >
                                            Discard AI Result
                                        </button>

                                    </div>


                                    <div class="client-revision-field">

                                        <label for="revisionAiStructuredFeedback">
                                            Structured Revision
                                        </label>

                                        <textarea
                                            name="ai_structured_feedback"
                                            id="revisionAiStructuredFeedback"
                                            rows="10"
                                            maxlength="8000"
                                            placeholder="The AI-structured revision will appear here."
                                        >{{ old('ai_structured_feedback') }}</textarea>

                                        <small>
                                            Review and edit this before
                                            submitting. Your original feedback
                                            above stays unchanged.
                                        </small>

                                    </div>

                                </div>


                                <button
                                    type="submit"
                                    class="client-revision-submit"
                                    id="clientRevisionSubmit"
                                >
                                    Submit Revision Request
                                </button>

                            </form>

                        </aside>

                    </div>

                </div>


                {{-- =================================================
                     MEETINGS PANEL
                ================================================== --}}

                <div
                    class="workspace-inner-panel"
                    id="meetingsWorkspacePanel"
                >

                    <div class="inner-panel-header">

                        <button
                            type="button"
                            class="inner-panel-back"
                            data-close-workspace-section
                        >

                            <svg viewBox="0 0 24 24">

                                <path d="M19 12H5"></path>

                                <path d="m11 18-6-6 6-6"></path>

                            </svg>

                            <span>
                                Back to Workspace
                            </span>

                        </button>


                        <div class="inner-panel-heading">

                            <span>
                                Project Schedule
                            </span>

                            <h3>
                                Meetings
                            </h3>

                            <p>
                                Request a meeting with your architect
                                and track upcoming or previous meetings.
                            </p>

                        </div>

                    </div>


                    @php

                        $workspaceMeetings =
                            $selectedProject
                                ->meetings
                                ->sortByDesc(
                                    function ($meeting) {

                                        return (
                                            $meeting
                                                ->meeting_date
                                            ? \Carbon\Carbon::parse(
                                                $meeting
                                                    ->meeting_date
                                            )
                                            ->format('Y-m-d')
                                            : '0000-00-00'
                                        )
                                        .
                                        ' '
                                        .
                                        (
                                            $meeting
                                                ->start_time
                                            ?? '00:00:00'
                                        );
                                    }
                                );

                        $pendingMeetingCount =
                            $workspaceMeetings
                                ->where(
                                    'status',
                                    'pending'
                                )
                                ->count();

                        $scheduledMeetingCount =
                            $workspaceMeetings
                                ->where(
                                    'status',
                                    'scheduled'
                                )
                                ->count();

                        $completedMeetingCount =
                            $workspaceMeetings
                                ->where(
                                    'status',
                                    'completed'
                                )
                                ->count();

                    @endphp


                    <div class="client-meeting-layout">

                        <div class="client-meeting-main">

                            <div class="client-meeting-summary">

                                <div class="client-meeting-summary-card">

                                    <span>
                                        All Meetings
                                    </span>

                                    <strong>
                                        {{ $workspaceMeetings->count() }}
                                    </strong>

                                </div>

                                <div
                                    class="
                                        client-meeting-summary-card
                                        pending
                                    "
                                >

                                    <span>
                                        Pending
                                    </span>

                                    <strong>
                                        {{ $pendingMeetingCount }}
                                    </strong>

                                </div>

                                <div
                                    class="
                                        client-meeting-summary-card
                                        scheduled
                                    "
                                >

                                    <span>
                                        Scheduled
                                    </span>

                                    <strong>
                                        {{ $scheduledMeetingCount }}
                                    </strong>

                                </div>

                                <div
                                    class="
                                        client-meeting-summary-card
                                        completed
                                    "
                                >

                                    <span>
                                        Completed
                                    </span>

                                    <strong>
                                        {{ $completedMeetingCount }}
                                    </strong>

                                </div>

                            </div>


                            <div class="client-meeting-section-heading">

                                <div>

                                    <span>
                                        Meeting History
                                    </span>

                                    <h4>
                                        Project meetings and requests
                                    </h4>

                                </div>

                                <button
                                    type="button"
                                    class="client-new-meeting-button"
                                    id="openMeetingFormButton"
                                >
                                    Request Meeting
                                </button>

                            </div>


                            <div class="client-meeting-list">

                                @forelse(
                                    $workspaceMeetings
                                    as $meeting
                                )

                                    @php

                                        $meetingStatus =
                                            $meeting->status
                                            ?? 'pending';

                                        $meetingStatusLabel =
                                            ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $meetingStatus
                                                )
                                            );

                                        $meetingDate =
                                            $meeting
                                                ->meeting_date
                                            ? \Carbon\Carbon::parse(
                                                $meeting
                                                    ->meeting_date
                                            )
                                            : null;

                                        $meetingStartTime =
                                            $meeting
                                                ->start_time
                                            ? \Carbon\Carbon::parse(
                                                $meeting
                                                    ->start_time
                                            )
                                            ->format('g:i A')
                                            : null;

                                        $meetingEndTime =
                                            $meeting
                                                ->end_time
                                            ? \Carbon\Carbon::parse(
                                                $meeting
                                                    ->end_time
                                            )
                                            ->format('g:i A')
                                            : null;

                                        $meetingTypeLabel =
                                            $meeting
                                                ->meeting_type
                                            ===
                                            'in_person'
                                            ? 'In Person'
                                            : 'Online';

                                    @endphp


                                    <article
                                        class="client-meeting-card"
                                        id="meeting-{{ $meeting->id }}"
                                    >

                                        <div class="client-meeting-date">

                                            <strong>

                                                {{ $meetingDate
                                                    ? $meetingDate
                                                        ->format('d')
                                                    : '--'
                                                }}

                                            </strong>

                                            <span>

                                                {{ $meetingDate
                                                    ? strtoupper(
                                                        $meetingDate
                                                            ->format('M')
                                                    )
                                                    : ''
                                                }}

                                            </span>

                                        </div>


                                        <div class="client-meeting-information">

                                            <div class="client-meeting-card-top">

                                                <div>

                                                    <span class="client-meeting-type">
                                                        {{ $meetingTypeLabel }}
                                                    </span>

                                                    <h4>
                                                        {{ $meeting
                                                            ->title
                                                            ?? 'Project Meeting'
                                                        }}
                                                    </h4>

                                                </div>


                                                <span
                                                    class="
                                                        client-meeting-status
                                                        status-{{ $meetingStatus }}
                                                    "
                                                >
                                                    {{ $meetingStatusLabel }}
                                                </span>

                                            </div>


                                            <div class="client-meeting-meta">

                                                <span>

                                                    {{ $meetingDate
                                                        ? $meetingDate
                                                            ->format(
                                                                'M d, Y'
                                                            )
                                                        : 'Date not set'
                                                    }}

                                                </span>


                                                @if($meetingStartTime)

                                                    <i></i>

                                                    <span>

                                                        {{ $meetingStartTime }}

                                                        @if($meetingEndTime)

                                                            –
                                                            {{ $meetingEndTime }}

                                                        @endif

                                                    </span>

                                                @endif

                                            </div>


                                            @if($meeting->agenda)

                                                <div class="client-meeting-detail">

                                                    <span>
                                                        Purpose / Agenda
                                                    </span>

                                                    <p>
                                                        {{ $meeting->agenda }}
                                                    </p>

                                                </div>

                                            @endif


                                            @if($meeting->notes)

                                                <div class="client-meeting-detail">

                                                    <span>
                                                        Notes
                                                    </span>

                                                    <p>
                                                        {{ $meeting->notes }}
                                                    </p>

                                                </div>

                                            @endif

                                        </div>

                                    </article>

                                @empty

                                    <div
                                        class="
                                            workspace-empty-state
                                            client-meeting-empty
                                        "
                                    >

                                        <strong>
                                            No meetings yet
                                        </strong>

                                        <p>
                                            Request a meeting when you
                                            need to discuss your project
                                            with your architect.
                                        </p>

                                    </div>

                                @endforelse

                            </div>

                        </div>


                        <aside
                            class="client-meeting-form-card"
                            id="clientMeetingFormCard"
                        >

                            <div class="client-meeting-form-heading">

                                <div>

                                    <span>
                                        New Request
                                    </span>

                                    <h4>
                                        Request a meeting
                                    </h4>

                                    <p>
                                        Suggest your preferred schedule.
                                        Your architect will review and
                                        confirm the meeting.
                                    </p>

                                </div>

                                <button
                                    type="button"
                                    class="client-meeting-form-close"
                                    id="closeMeetingFormButton"
                                    aria-label="Close Meeting Form"
                                >
                                    ×
                                </button>

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                                    'client.projects.meetings.store',
                                    [
                                        'id' =>
                                            $selectedProject->id
                                    ]
                                ) }}"
                                id="clientMeetingForm"
                            >

                                @csrf


                                <div class="client-meeting-field">

                                    <label for="meetingTitle">
                                        Meeting Title
                                    </label>

                                    <input
                                        type="text"
                                        name="title"
                                        id="meetingTitle"
                                        maxlength="255"
                                        value="{{ old('title') }}"
                                        placeholder="Example: Kitchen layout discussion"
                                        required
                                    >

                                </div>


                                <div class="client-meeting-field">

                                    <label for="meetingAgenda">
                                        Purpose / Agenda
                                    </label>

                                    <textarea
                                        name="agenda"
                                        id="meetingAgenda"
                                        rows="4"
                                        maxlength="3000"
                                        placeholder="What would you like to discuss?"
                                    >{{ old('agenda') }}</textarea>

                                </div>


                                <div class="client-meeting-field">

                                    <label for="meetingType">
                                        Preferred Meeting Type
                                    </label>

                                    <select
                                        name="meeting_type"
                                        id="meetingType"
                                        required
                                    >

                                        <option
                                            value="online"
                                            @selected(
                                                old(
                                                    'meeting_type',
                                                    'online'
                                                )
                                                ===
                                                'online'
                                            )
                                        >
                                            Online
                                        </option>

                                        <option
                                            value="in_person"
                                            @selected(
                                                old(
                                                    'meeting_type'
                                                )
                                                ===
                                                'in_person'
                                            )
                                        >
                                            In Person
                                        </option>

                                    </select>

                                </div>


                                <div class="client-meeting-field">

                                    <label for="meetingDate">
                                        Preferred Date
                                    </label>

                                    <input
                                        type="date"
                                        name="meeting_date"
                                        id="meetingDate"
                                        value="{{ old(
                                            'meeting_date'
                                        ) }}"
                                        min="{{ now(
                                            'Asia/Manila'
                                        )->format(
                                            'Y-m-d'
                                        ) }}"
                                        required
                                    >

                                </div>


                                <div
                                    class="client-meeting-availability"
                                    id="meetingAvailability"
                                    aria-live="polite"
                                    style="display:none;"
                                >

                                    <div class="client-meeting-availability-heading">

                                        <strong>
                                            Architect Availability
                                        </strong>

                                        <span
                                            id="meetingAvailabilityDate"
                                        ></span>

                                    </div>


                                    <div
                                        class="client-meeting-availability-content"
                                        id="meetingAvailabilityContent"
                                    ></div>

                                </div>


                                <div class="client-meeting-time-grid">

                                    <div class="client-meeting-field">

                                        <label for="meetingStartTime">
                                            Start Time
                                        </label>

                                        <input
                                            type="time"
                                            name="start_time"
                                            id="meetingStartTime"
                                            value="{{ old(
                                                'start_time'
                                            ) }}"
                                            required
                                        >

                                    </div>


                                    <div class="client-meeting-field">

                                        <label for="meetingEndTime">
                                            End Time
                                        </label>

                                        <input
                                            type="time"
                                            name="end_time"
                                            id="meetingEndTime"
                                            value="{{ old(
                                                'end_time'
                                            ) }}"
                                        >

                                    </div>

                                </div>


                                <div class="client-meeting-field">

                                    <label for="meetingNotes">
                                        Additional Notes
                                    </label>

                                    <textarea
                                        name="notes"
                                        id="meetingNotes"
                                        rows="4"
                                        maxlength="3000"
                                        placeholder="Add any details your architect should know before confirming."
                                    >{{ old('notes') }}</textarea>

                                </div>


                                <button
                                    type="submit"
                                    class="client-meeting-submit"
                                    id="clientMeetingSubmit"
                                >
                                    Submit Meeting Request
                                </button>

                            </form>

                        </aside>

                    </div>

                </div>

            </section>

        </div>

    @endif

</div>


{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const csrfToken =
            document
                .querySelector(
                    'meta[name="csrf-token"]'
                )
                ?.getAttribute(
                    'content'
                );


        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(value) {

            const div =
                document.createElement(
                    'div'
                );

            div.textContent =
                value ?? '';

            return div.innerHTML;
        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT UPLOAD VALIDATION
        |--------------------------------------------------------------------------
        |
        | Standard project uploads:
        | JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, XLSX
        |
        | Images: up to 100 MB
        | Documents: up to 10 MB
        |
        */

        function validateClientUpload(
            input,
            imageOnly = false
        ) {

            if (
                !input
                ||
                !input.files
                ||
                input.files.length === 0
            ) {
                return true;
            }


            const file =
                input.files[0];


            const fileName =
                file.name || '';


            const extension =
                fileName.includes('.')
                    ? fileName
                        .split('.')
                        .pop()
                        .toLowerCase()
                    : '';


            const imageExtensions = [
                'jpg',
                'jpeg',
                'png'
            ];


            const allowedExtensions =
                imageOnly
                    ? imageExtensions
                    : [
                        'jpg',
                        'jpeg',
                        'png',
                        'pdf',
                        'doc',
                        'docx',
                        'xls',
                        'xlsx'
                    ];


            if (
                !allowedExtensions.includes(
                    extension
                )
            ) {

                alert(
                    imageOnly
                        ? 'Only JPG, JPEG, and PNG images are allowed.'
                        : 'Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.'
                );

                input.value =
                    '';

                return false;
            }


            const maxImageSize =
                100 * 1024 * 1024;


            const maxDocumentSize =
                10 * 1024 * 1024;


            const isImage =
                imageExtensions.includes(
                    extension
                );


            if (
                isImage
                &&
                file.size > maxImageSize
            ) {

                alert(
                    'Images cannot be larger than 100 MB.'
                );

                input.value =
                    '';

                return false;
            }


            if (
                !isImage
                &&
                file.size > maxDocumentSize
            ) {

                alert(
                    'Documents cannot be larger than 10 MB.'
                );

                input.value =
                    '';

                return false;
            }


            return true;
        }


        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */

        const profileMenuButton =
            document.getElementById(
                'profileMenuButton'
            );

        const profileDropdown =
            document.getElementById(
                'profileDropdown'
            );


        if (
            profileMenuButton
            &&
            profileDropdown
        ) {

            profileMenuButton
                .addEventListener(
                    'click',
                    function (event) {

                        event.preventDefault();
                        event.stopPropagation();

                        profileDropdown
                            .classList
                            .toggle(
                                'show'
                            );
                    }
                );


            profileDropdown
                .addEventListener(
                    'click',
                    function (event) {

                        event.stopPropagation();
                    }
                );
        }


        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */

        const notificationButton =
            document.getElementById(
                'notificationButton'
            );

        const notificationDropdown =
            document.getElementById(
                'notificationDropdown'
            );

        const notificationBadge =
            document.getElementById(
                'notificationBadge'
            );

        const notificationList =
            document.getElementById(
                'notificationList'
            );

        const markAllReadButton =
            document.getElementById(
                'markAllReadButton'
            );


        function formatNotificationTime(
            dateValue
        ) {

            if (!dateValue) {
                return '';
            }


            const date =
                new Date(
                    dateValue
                );

            const now =
                new Date();

            const difference =
                now - date;

            const minutes =
                Math.floor(
                    difference / 60000
                );


            if (minutes < 1) {
                return 'Just now';
            }


            if (minutes < 60) {
                return `${minutes} min ago`;
            }


            const hours =
                Math.floor(
                    minutes / 60
                );


            if (hours < 24) {
                return `${hours} hr ago`;
            }


            const days =
                Math.floor(
                    hours / 24
                );


            if (days < 7) {

                return `${days} ${
                    days === 1
                        ? 'day'
                        : 'days'
                } ago`;
            }


            return date
                .toLocaleDateString(
                    'en-PH',
                    {
                        month:
                            'short',

                        day:
                            'numeric',

                        year:
                            'numeric'
                    }
                );
        }


        function updateNotificationBadge(
            count
        ) {

            if (!notificationBadge) {
                return;
            }


            const unread =
                Number(
                    count || 0
                );


            if (unread > 0) {

                notificationBadge.hidden =
                    false;

                notificationBadge.textContent =
                    unread > 99
                        ? '99+'
                        : unread;

            } else {

                notificationBadge.hidden =
                    true;

                notificationBadge.textContent =
                    '0';
            }
        }


        function getNotificationIcon(
            type
        ) {

            if (type === 'message') {

                return `
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M4 5h16v11H8l-4 4z"
                        ></path>
                    </svg>
                `;
            }


            if (type === 'file') {

                return `
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M3 6h7l2 2h9v11H3z"
                        ></path>
                    </svg>
                `;
            }


            if (type === 'revision') {

                return `
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M4 12a8 8 0 101.8-5"
                        ></path>

                        <path
                            d="M4 4v6h6"
                        ></path>
                    </svg>
                `;
            }


            if (type === 'meeting') {

                return `
                    <svg viewBox="0 0 24 24">

                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        ></rect>

                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>
                        <path d="M3 10h18"></path>

                    </svg>
                `;
            }


            return `
                <svg viewBox="0 0 24 24">

                    <path
                        d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"
                    ></path>

                    <path
                        d="M10 20h4"
                    ></path>

                </svg>
            `;
        }


        function renderNotifications(
            notifications
        ) {

            if (!notificationList) {
                return;
            }


            if (
                !notifications
                ||
                notifications.length === 0
            ) {

                notificationList.innerHTML =
                    `

                    <div class="notification-empty">

                        <strong>
                            No notifications yet
                        </strong>

                        <span>
                            New project updates will appear here.
                        </span>

                    </div>

                    `;

                return;
            }


            notificationList.innerHTML =
                notifications
                    .map(
                        function (
                            notification
                        ) {

                            const data =
                                notification.data
                                ||
                                {};

                            const type =
                                escapeHtml(
                                    data.type
                                    ||
                                    'general'
                                );

                            const title =
                                escapeHtml(
                                    data.title
                                    ||
                                    'Project Update'
                                );

                            const message =
                                escapeHtml(
                                    data.message
                                    ||
                                    ''
                                );

                            const notificationUrl =
                                data.url
                                ||
                                '#';

                            const isUnread =
                                !notification
                                    .read_at;

                            const time =
                                formatNotificationTime(
                                    notification
                                        .created_at
                                );


                            return `

                                <a
                                    href="${escapeHtml(notificationUrl)}"
                                    class="
                                        notification-item
                                        ${
                                            isUnread
                                                ? 'unread'
                                                : ''
                                        }
                                    "
                                    data-notification-id="${notification.id}"
                                >

                                    <span
                                        class="
                                            notification-type-icon
                                        "
                                    >

                                        ${getNotificationIcon(type)}

                                    </span>


                                    <div
                                        class="
                                            notification-content
                                        "
                                    >

                                        <div
                                            class="
                                                notification-item-top
                                            "
                                        >

                                            <strong
                                                class="
                                                    notification-item-title
                                                "
                                            >
                                                ${title}
                                            </strong>


                                            ${
                                                isUnread
                                                    ?
                                                    `
                                                    <span
                                                        class="
                                                            notification-unread-dot
                                                        "
                                                    ></span>
                                                    `
                                                    :
                                                    ''
                                            }

                                        </div>


                                        ${
                                            message
                                                ?
                                                `
                                                <p
                                                    class="
                                                        notification-item-message
                                                    "
                                                >
                                                    ${message}
                                                </p>
                                                `
                                                :
                                                ''
                                        }


                                        <span
                                            class="
                                                notification-item-time
                                            "
                                        >
                                            ${time}
                                        </span>

                                    </div>

                                </a>

                            `;
                        }
                    )
                    .join('');


            document
                .querySelectorAll(
                    '.notification-item'
                )
                .forEach(
                    function (
                        item
                    ) {

                        item
                            .addEventListener(
                                'click',
                                async function (
                                    event
                                ) {

                                    const id =
                                        this
                                            .dataset
                                            .notificationId;

                                    const destination =
                                        this
                                            .getAttribute(
                                                'href'
                                            );


                                    if (
                                        this
                                            .classList
                                            .contains(
                                                'unread'
                                            )
                                    ) {

                                        event.preventDefault();

                                        await markNotificationAsRead(
                                            id
                                        );


                                        if (
                                            destination
                                            &&
                                            destination !== '#'
                                        ) {

                                            window.location.href =
                                                destination;
                                        }
                                    }
                                }
                            );
                    }
                );
        }


        async function loadNotifications() {

            if (!notificationList) {
                return;
            }


            try {

                const response =
                    await fetch(
                        "{{ route('client.notifications.index') }}",
                        {
                            method:
                                'GET',

                            headers: {

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Unable to load notifications.'
                    );
                }


                const data =
                    await response.json();


                updateNotificationBadge(
                    data.unread_count
                );

                renderNotifications(
                    data.notifications
                );


            } catch (error) {

                console.error(
                    error
                );

                notificationList.innerHTML =
                    `

                    <div class="notification-error">

                        Couldn't load notifications.

                    </div>

                    `;
            }
        }


        async function markNotificationAsRead(
            notificationId
        ) {

            try {

                const url =
                    "{{ route(
                        'client.notifications.read',
                        [
                            'id' =>
                                '__ID__'
                        ]
                    ) }}"
                    .replace(
                        '__ID__',
                        notificationId
                    );


                const response =
                    await fetch(
                        url,
                        {
                            method:
                                'POST',

                            headers: {

                                'Accept':
                                    'application/json',

                                'Content-Type':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Unable to mark notification as read.'
                    );
                }


                await loadNotifications();


            } catch (error) {

                console.error(
                    error
                );
            }
        }


        async function markAllNotificationsAsRead() {

            try {

                const response =
                    await fetch(
                        "{{ route(
                            'client.notifications.readAll'
                        ) }}",
                        {
                            method:
                                'POST',

                            headers: {

                                'Accept':
                                    'application/json',

                                'Content-Type':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Unable to mark notifications as read.'
                    );
                }


                await loadNotifications();


            } catch (error) {

                console.error(
                    error
                );
            }
        }


        if (
            notificationButton
            &&
            notificationDropdown
        ) {

            notificationButton
                .addEventListener(
                    'click',
                    function (
                        event
                    ) {

                        event.stopPropagation();


                        const isOpen =
                            notificationDropdown
                                .classList
                                .toggle(
                                    'show'
                                );


                        notificationButton
                            .setAttribute(
                                'aria-expanded',
                                isOpen
                                    ? 'true'
                                    : 'false'
                            );


                        profileDropdown
                            ?.classList
                            .remove(
                                'show'
                            );


                        if (isOpen) {
                            loadNotifications();
                        }
                    }
                );


            notificationDropdown
                .addEventListener(
                    'click',
                    function (
                        event
                    ) {

                        event.stopPropagation();
                    }
                );
        }


        markAllReadButton
            ?.addEventListener(
                'click',
                markAllNotificationsAsRead
            );


        loadNotifications();


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        const mobileMenuButton =
            document.getElementById(
                'mobileMenuButton'
            );

        const mobileNavigation =
            document.getElementById(
                'mobileNavigation'
            );


        if (
            mobileMenuButton
            &&
            mobileNavigation
        ) {

            mobileMenuButton
                .addEventListener(
                    'click',
                    function (
                        event
                    ) {

                        event.preventDefault();
                        event.stopPropagation();

                        mobileNavigation
                            .classList
                            .toggle(
                                'show'
                            );
                    }
                );


            mobileNavigation
                .addEventListener(
                    'click',
                    function (
                        event
                    ) {

                        event.stopPropagation();
                    }
                );
        }


        document
            .addEventListener(
                'click',
                function () {

                    profileDropdown
                        ?.classList
                        .remove(
                            'show'
                        );

                    notificationDropdown
                        ?.classList
                        .remove(
                            'show'
                        );

                    mobileNavigation
                        ?.classList
                        .remove(
                            'show'
                        );

                    notificationButton
                        ?.setAttribute(
                            'aria-expanded',
                            'false'
                        );
                }
            );


        @if($selectedProject)


        /*
        |--------------------------------------------------------------------------
        | WORKSPACE
        |--------------------------------------------------------------------------
        */

        const workspaceMain =
            document.getElementById(
                'workspaceMainContent'
            );

        const projectOverlay =
            document.getElementById(
                'projectWorkspaceOverlay'
            );

        const phasesPanel =
            document.getElementById(
                'phasesWorkspacePanel'
            );

        const messagesPanel =
            document.getElementById(
                'messagesWorkspacePanel'
            );

        const filesPanel =
            document.getElementById(
                'filesWorkspacePanel'
            );

        const revisionsPanel =
            document.getElementById(
                'revisionsWorkspacePanel'
            );

        const meetingsPanel =
            document.getElementById(
                'meetingsWorkspacePanel'
            );


        const allPanels = [

            phasesPanel,
            messagesPanel,
            filesPanel,
            revisionsPanel,
            meetingsPanel

        ].filter(Boolean);


        if (projectOverlay) {

            document
                .body
                .classList
                .add(
                    'workspace-open'
                );
        }


        function scrollChatBottom() {

            const history =
                document.getElementById(
                    'workspaceMessageHistory'
                );


            if (!history) {
                return;
            }


            setTimeout(
                function () {

                    history.scrollTop =
                        history.scrollHeight;

                },
                50
            );
        }


        function openWorkspaceSection(
            panel
        ) {

            if (!panel) {
                return;
            }


            allPanels
                .forEach(
                    function (item) {

                        item
                            .classList
                            .remove(
                                'active'
                            );
                    }
                );


            workspaceMain
                ?.classList
                .add(
                    'workspace-content-hidden'
                );


            panel
                .classList
                .add(
                    'active'
                );


            if (
                panel === messagesPanel
            ) {

                scrollChatBottom();


                setTimeout(
                    function () {

                        const messageModeButton =
                            document.querySelector(
                                '[data-composer-mode="message"]'
                            );


                        messageModeButton
                            ?.click();


                        document
                            .getElementById(
                                'workspaceMessageInput'
                            )
                            ?.focus();

                    },
                    100
                );
            }
        }


        function closeWorkspaceSections() {

            allPanels
                .forEach(
                    function (panel) {

                        panel
                            .classList
                            .remove(
                                'active'
                            );
                    }
                );


            workspaceMain
                ?.classList
                .remove(
                    'workspace-content-hidden'
                );
        }


        document
            .querySelectorAll(
                '[data-workspace-section]'
            )
            .forEach(
                function (button) {

                    button
                        .addEventListener(
                            'click',
                            function () {

                                const section =
                                    button
                                        .dataset
                                        .workspaceSection;


                                if (section === 'phases') {
                                    openWorkspaceSection(
                                        phasesPanel
                                    );
                                }

                                if (section === 'messages') {
                                    openWorkspaceSection(
                                        messagesPanel
                                    );
                                }

                                if (section === 'files') {
                                    openWorkspaceSection(
                                        filesPanel
                                    );
                                }

                                if (section === 'revisions') {
                                    openWorkspaceSection(
                                        revisionsPanel
                                    );
                                }

                                if (section === 'meetings') {
                                    openWorkspaceSection(
                                        meetingsPanel
                                    );
                                }
                            }
                        );
                }
            );


        document
            .querySelectorAll(
                '[data-close-workspace-section]'
            )
            .forEach(
                function (button) {

                    button
                        .addEventListener(
                            'click',
                            closeWorkspaceSections
                        );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | FILE SEARCH
        |--------------------------------------------------------------------------
        */

        const clientFileSearch =
            document.getElementById(
                'clientFileSearch'
            );

        const clientFileCategoryFilter =
            document.getElementById(
                'clientFileCategoryFilter'
            );

        const clientFileCards =
            Array.from(
                document
                    .querySelectorAll(
                        '[data-client-file]'
                    )
            );

        const clientFilesNoResults =
            document.getElementById(
                'clientFilesNoResults'
            );


        function filterClientFiles() {

            const searchValue =
                (
                    clientFileSearch
                        ?.value
                    ??
                    ''
                )
                .trim()
                .toLowerCase();


            const categoryValue =
                (
                    clientFileCategoryFilter
                        ?.value
                    ??
                    'all'
                )
                .toLowerCase();


            let visibleCount =
                0;


            clientFileCards
                .forEach(
                    function (card) {

                        const fileName =
                            (
                                card
                                    .dataset
                                    .fileName
                                ??
                                ''
                            )
                            .toLowerCase();

                        const category =
                            (
                                card
                                    .dataset
                                    .fileCategory
                                ??
                                ''
                            )
                            .toLowerCase();

                        const type =
                            (
                                card
                                    .dataset
                                    .fileType
                                ??
                                ''
                            )
                            .toLowerCase();


                        const matchesSearch =
                            !searchValue
                            ||
                            fileName
                                .includes(
                                    searchValue
                                )
                            ||
                            category
                                .includes(
                                    searchValue
                                )
                            ||
                            type
                                .includes(
                                    searchValue
                                );


                        const matchesCategory =
                            categoryValue
                            ===
                            'all'
                            ||
                            category
                            ===
                            categoryValue;


                        const visible =
                            matchesSearch
                            &&
                            matchesCategory;


                        card.hidden =
                            !visible;


                        if (visible) {
                            visibleCount++;
                        }
                    }
                );


            clientFilesNoResults
                ?.classList
                .toggle(
                    'show',
                    visibleCount === 0
                );
        }


        clientFileSearch
            ?.addEventListener(
                'input',
                filterClientFiles
            );


        clientFileCategoryFilter
            ?.addEventListener(
                'change',
                filterClientFiles
            );


        document
            .querySelectorAll(
                '[data-file-history-toggle]'
            )
            .forEach(
                function (button) {

                    button
                        .addEventListener(
                            'click',
                            function () {

                                const fileId =
                                    button
                                        .dataset
                                        .fileHistoryToggle;


                                const history =
                                    document
                                        .querySelector(
                                            '[data-file-history="'
                                            +
                                            fileId
                                            +
                                            '"]'
                                        );


                                if (!history) {
                                    return;
                                }


                                const open =
                                    history
                                        .classList
                                        .toggle(
                                            'show'
                                        );


                                button
                                    .classList
                                    .toggle(
                                        'active',
                                        open
                                    );


                                button
                                    .setAttribute(
                                        'aria-expanded',
                                        open
                                            ? 'true'
                                            : 'false'
                                    );
                            }
                        );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | NORMAL MESSAGE
        |--------------------------------------------------------------------------
        */

        const messageForm =
            document.getElementById(
                'workspaceMessageForm'
            );

        const messageInput =
            document.getElementById(
                'workspaceMessageInput'
            );

        const attachmentInput =
            document.getElementById(
                'workspaceAttachmentInput'
            );

        const messageSend =
            document.getElementById(
                'workspaceMessageSend'
            );


        if (
            messageForm
            &&
            messageInput
        ) {

            messageInput
                .addEventListener(
                    'keydown',
                    function (
                        event
                    ) {

                        if (
                            event.key === 'Enter'
                            &&
                            !event.shiftKey
                        ) {

                            event.preventDefault();


                            const hasMessage =
                                messageInput
                                    .value
                                    .trim()
                                    .length
                                >
                                0;


                            const hasAttachment =
                                attachmentInput
                                &&
                                attachmentInput
                                    .files
                                    .length
                                >
                                0;


                            if (
                                hasMessage
                                ||
                                hasAttachment
                            ) {

                                messageForm
                                    .requestSubmit();
                            }
                        }
                    }
                );


            messageForm
                .addEventListener(
                    'submit',
                    function () {

                        if (messageSend) {

                            messageSend.disabled =
                                true;

                            messageSend
                                .classList
                                .add(
                                    'sending'
                                );
                        }
                    }
                );
        }


        /*
        |--------------------------------------------------------------------------
        | MESSAGE ATTACHMENT PREVIEW
        |--------------------------------------------------------------------------
        */

        const selectedPreview =
            document.getElementById(
                'selectedAttachmentPreview'
            );

        const selectedImagePreview =
            document.getElementById(
                'selectedImagePreview'
            );

        const selectedAttachmentName =
            document.getElementById(
                'selectedAttachmentName'
            );

        const selectedAttachmentSize =
            document.getElementById(
                'selectedAttachmentSize'
            );

        const removeSelectedAttachment =
            document.getElementById(
                'removeSelectedAttachment'
            );


        attachmentInput
            ?.addEventListener(
                'change',
                function () {

                    const file =
                        attachmentInput
                            .files[0];


                    if (!file) {
                        return;
                    }


                    if (
                        !validateClientUpload(
                            attachmentInput
                        )
                    ) {

                        selectedPreview
                            ?.classList
                            .remove(
                                'active'
                            );

                        if (selectedImagePreview) {

                            selectedImagePreview.innerHTML =
                                '';
                        }

                        return;
                    }


                    selectedPreview
                        ?.classList
                        .add(
                            'active'
                        );


                    if (selectedAttachmentName) {

                        selectedAttachmentName
                            .textContent =
                            file.name;
                    }


                    if (selectedAttachmentSize) {

                        selectedAttachmentSize
                            .textContent =
                            (
                                file.size
                                /
                                1024
                                /
                                1024
                            )
                            .toFixed(2)
                            +
                            ' MB';
                    }


                    if (selectedImagePreview) {

                        selectedImagePreview
                            .innerHTML =
                            '';


                        if (
                            file.type
                                .startsWith(
                                    'image/'
                                )
                        ) {

                            const reader =
                                new FileReader();


                            reader.onload =
                                function (event) {

                                    const image =
                                        document
                                            .createElement(
                                                'img'
                                            );

                                    image.src =
                                        event
                                            .target
                                            .result;

                                    selectedImagePreview
                                        .appendChild(
                                            image
                                        );
                                };


                            reader
                                .readAsDataURL(
                                    file
                                );
                        }
                    }
                }
            );


        removeSelectedAttachment
            ?.addEventListener(
                'click',
                function () {

                    if (attachmentInput) {

                        attachmentInput.value =
                            '';
                    }


                    selectedPreview
                        ?.classList
                        .remove(
                            'active'
                        );


                    if (selectedImagePreview) {

                        selectedImagePreview
                            .innerHTML =
                            '';
                    }
                }
            );


        /*
        |--------------------------------------------------------------------------
        | MESSAGE / AI MODE
        |--------------------------------------------------------------------------
        */

        const composerModes =
            document.querySelectorAll(
                '[data-composer-mode]'
            );

        const normalMessageForm =
            document.getElementById(
                'workspaceMessageForm'
            );

        const aiForm =
            document.getElementById(
                'chatAiForm'
            );

        const composerDescription =
            document.getElementById(
                'composerModeDescription'
            );

        const messagesWorkspaceLayout =
            document.getElementById(
                'messagesWorkspaceLayout'
            );

        const messagesAiPanel =
            document.getElementById(
                'messagesAiPanel'
            );

        const messagesAiClose =
            document.getElementById(
                'messagesAiClose'
            );

        const messagesAiEmpty =
            document.getElementById(
                'messagesAiEmpty'
            );


        function openAiPanel() {

            messagesWorkspaceLayout
                ?.classList
                .add(
                    'ai-open'
                );
        }


        function closeAiPanel() {

            messagesWorkspaceLayout
                ?.classList
                .remove(
                    'ai-open'
                );
        }


        composerModes
            .forEach(
                function (button) {

                    button
                        .addEventListener(
                            'click',
                            function () {

                                composerModes
                                    .forEach(
                                        function (item) {

                                            item
                                                .classList
                                                .remove(
                                                    'active'
                                                );
                                        }
                                    );


                                button
                                    .classList
                                    .add(
                                        'active'
                                    );


                                if (
                                    button
                                        .dataset
                                        .composerMode
                                    ===
                                    'ai'
                                ) {

                                    normalMessageForm
                                        ?.classList
                                        .add(
                                            'hidden'
                                        );

                                    aiForm
                                        ?.classList
                                        .add(
                                            'active'
                                        );

                                    openAiPanel();


                                    if (composerDescription) {

                                        composerDescription
                                            .textContent =
                                            'Generate a visual concept with AI';
                                    }


                                    setTimeout(
                                        function () {

                                            document
                                                .getElementById(
                                                    'chatAiPrompt'
                                                )
                                                ?.focus();

                                        },
                                        100
                                    );

                                } else {

                                    aiForm
                                        ?.classList
                                        .remove(
                                            'active'
                                        );

                                    normalMessageForm
                                        ?.classList
                                        .remove(
                                            'hidden'
                                        );


                                    if (composerDescription) {

                                        composerDescription
                                            .textContent =
                                            'Send directly to your architect';
                                    }


                                    setTimeout(
                                        function () {

                                            messageInput
                                                ?.focus();

                                        },
                                        100
                                    );
                                }
                            }
                        );
                }
            );


        messagesAiClose
            ?.addEventListener(
                'click',
                function () {

                    closeAiPanel();

                    document
                        .querySelector(
                            '[data-composer-mode="message"]'
                        )
                        ?.click();
                }
            );


        /*
        |--------------------------------------------------------------------------
        | AI REFERENCE IMAGE
        |--------------------------------------------------------------------------
        */

        const chatAiImageInput =
            document.getElementById(
                'chatAiImageInput'
            );

        const chatAiImagePreview =
            document.getElementById(
                'chatAiImagePreview'
            );


        if (
            chatAiImageInput
            &&
            chatAiImagePreview
        ) {

            chatAiImageInput
                .addEventListener(
                    'change',
                    function () {

                        const file =
                            chatAiImageInput
                                .files[0];


                        if (!file) {

                            chatAiImagePreview
                                .classList
                                .remove(
                                    'active'
                                );

                            chatAiImagePreview.innerHTML =
                                '';

                            return;
                        }


                        if (
                            !validateClientUpload(
                                chatAiImageInput,
                                true
                            )
                        ) {

                            chatAiImagePreview
                                .classList
                                .remove(
                                    'active'
                                );

                            chatAiImagePreview.innerHTML =
                                '';

                            return;
                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (event) {

                                chatAiImagePreview.innerHTML =
                                    '';


                                const image =
                                    document.createElement(
                                        'img'
                                    );

                                image.src =
                                    event
                                        .target
                                        .result;

                                chatAiImagePreview
                                    .appendChild(
                                        image
                                    );

                                chatAiImagePreview
                                    .classList
                                    .add(
                                        'active'
                                    );
                            };


                        reader
                            .readAsDataURL(
                                file
                            );
                    }
                );
        }


        /*
        |--------------------------------------------------------------------------
        | AI ELEMENTS
        |--------------------------------------------------------------------------
        */

        const chatAiPrompt =
            document.getElementById(
                'chatAiPrompt'
            );

        const chatAskAiButton =
            document.getElementById(
                'chatAskAiButton'
            );

        const aiResultWrapper =
            document.getElementById(
                'chatAiResultWrapper'
            );

        const chatLiveError =
            document.getElementById(
                'chatLiveError'
            );

        const chatLiveSuccess =
            document.getElementById(
                'chatLiveSuccess'
            );

        const chatAiParentHistoryId =
            document.getElementById(
                'chatAiParentHistoryId'
            );


        function showChatError(
            message
        ) {

            if (!chatLiveError) {

                alert(
                    message
                );

                return;
            }


            chatLiveError.textContent =
                message;

            chatLiveError
                .classList
                .add(
                    'show'
                );


            setTimeout(
                function () {

                    chatLiveError
                        .classList
                        .remove(
                            'show'
                        );

                },
                5000
            );
        }


        function showChatSuccess(
            message
        ) {

            if (!chatLiveSuccess) {
                return;
            }


            chatLiveSuccess.textContent =
                message;

            chatLiveSuccess
                .classList
                .add(
                    'show'
                );


            setTimeout(
                function () {

                    chatLiveSuccess
                        .classList
                        .remove(
                            'show'
                        );

                },
                4000
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AI IMAGE LIGHTBOX
        |--------------------------------------------------------------------------
        */

        const aiImageLightbox =
            document.createElement(
                'div'
            );

        aiImageLightbox.className =
            'ai-image-lightbox';


        aiImageLightbox.innerHTML =
            `

            <div
                class="
                    ai-image-lightbox-content
                "
            >

                <button
                    type="button"
                    class="
                        ai-image-lightbox-close
                    "
                    aria-label="Close image"
                >
                    ×
                </button>

                <img
                    src=""
                    alt="AI Concept Preview"
                    id="aiImageLightboxImage"
                >

            </div>

            `;


        document.body
            .appendChild(
                aiImageLightbox
            );


        const aiImageLightboxImage =
            document.getElementById(
                'aiImageLightboxImage'
            );


        function openAiImageLightbox(
            imageUrl
        ) {

            if (
                !imageUrl
                ||
                !aiImageLightboxImage
            ) {
                return;
            }


            aiImageLightboxImage.src =
                imageUrl;

            aiImageLightbox
                .classList
                .add(
                    'active'
                );
        }


        function closeAiImageLightbox() {

            aiImageLightbox
                .classList
                .remove(
                    'active'
                );


            if (aiImageLightboxImage) {

                aiImageLightboxImage.src =
                    '';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | RENDER AI CONCEPT
        |--------------------------------------------------------------------------
        */

        function renderAiConcept(
            data
        ) {

            if (!aiResultWrapper) {
                return;
            }


            openAiPanel();


            if (messagesAiEmpty) {

                messagesAiEmpty
                    .classList
                    .add(
                        'hidden'
                    );
            }


            const generatedImage =
                data.generated_image_url
                ||
                '';

            const referenceImage =
                data.reference_image_url
                ||
                '';

            const versionNumber =
                Number(
                    data.version_number
                    ||
                    1
                );

            const historyId =
                data.history_id
                ||
                '';

            const safePrompt =
                escapeHtml(
                    data.prompt
                    ||
                    ''
                );


            if (!generatedImage) {

                aiResultWrapper.innerHTML =
                    '';

                showChatError(
                    'AI did not return a concept image.'
                );

                messagesAiEmpty
                    ?.classList
                    .remove(
                        'hidden'
                    );

                return;
            }


            if (!historyId) {

                aiResultWrapper.innerHTML =
                    '';

                showChatError(
                    'AI concept history ID was not returned.'
                );

                messagesAiEmpty
                    ?.classList
                    .remove(
                        'hidden'
                    );

                return;
            }


            let imagesHtml =
                '';


            if (referenceImage) {

                imagesHtml =
                    `

                    <div class="chat-ai-comparison">

                        <div class="chat-ai-comparison-item">

                            <div class="chat-ai-image-label">
                                Original Reference
                            </div>

                            <a
                                href="${escapeHtml(referenceImage)}"
                                class="ai-preview-link"
                            >

                                <img
                                    src="${escapeHtml(referenceImage)}"
                                    alt="Original Reference"
                                >

                            </a>

                        </div>


                        <div
                            class="
                                chat-ai-comparison-item
                                generated
                            "
                        >

                            <div class="chat-ai-image-label">
                                AI Concept · Version ${versionNumber}
                            </div>

                            <a
                                href="${escapeHtml(generatedImage)}"
                                class="ai-preview-link"
                            >

                                <img
                                    src="${escapeHtml(generatedImage)}"
                                    alt="AI Concept Preview"
                                >

                            </a>

                        </div>

                    </div>

                    `;

            } else {

                imagesHtml =
                    `

                    <div class="chat-ai-generated-single">

                        <div class="chat-ai-image-label">
                            AI Concept · Version ${versionNumber}
                        </div>

                        <a
                            href="${escapeHtml(generatedImage)}"
                            class="ai-preview-link"
                        >

                            <img
                                src="${escapeHtml(generatedImage)}"
                                alt="AI Concept Preview"
                            >

                        </a>

                    </div>

                    `;
            }


            aiResultWrapper.innerHTML =
                `

                <div
                    class="chat-ai-concept-card"
                    data-history-id="${escapeHtml(historyId)}"
                >

                    <div class="chat-ai-card-header">

                        <div class="chat-ai-card-icon">

                            <svg viewBox="0 0 24 24">

                                <path d="M12 3v3"></path>
                                <path d="M12 18v3"></path>
                                <path d="M3 12h3"></path>
                                <path d="M18 12h3"></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="4"
                                ></circle>

                            </svg>

                        </div>


                        <div>

                            <strong>
                                AI Design Concept
                            </strong>

                            <span>
                                Version ${versionNumber}
                                · Review before sending
                            </span>

                        </div>

                    </div>


                    ${imagesHtml}


                    <div class="chat-ai-request-summary">

                        <strong>
                            Your Design Request
                        </strong>

                        <p>
                            ${safePrompt}
                        </p>

                    </div>


                    <div class="chat-ai-disclaimer">

                        AI-generated concept for design inspiration only.
                        This is not a construction drawing or technically
                        approved architectural design.

                    </div>


                    <div class="chat-ai-edit-concept">

                        <label for="aiConceptRevisionPrompt">
                            Want another version?
                        </label>

                        <textarea
                            id="aiConceptRevisionPrompt"
                            rows="3"
                            maxlength="3000"
                            placeholder="Example: Keep this design but make the walls warmer and add wood accents."
                        ></textarea>

                    </div>


                    <div class="chat-ai-send-note">

                        <label for="aiConceptArchitectNote">
                            Note to Architect
                        </label>

                        <textarea
                            id="aiConceptArchitectNote"
                            rows="3"
                            maxlength="5000"
                            placeholder="Optional message to your architect about this concept."
                        ></textarea>

                    </div>


                    <div class="chat-ai-card-actions">

                        <button
                            type="button"
                            class="chat-ai-discard"
                            id="discardAiConcept"
                        >
                            Discard
                        </button>


                        <button
                            type="button"
                            class="chat-ai-regenerate"
                            id="generateAnotherAiConcept"
                        >
                            Create Another Version
                        </button>


                        <button
                            type="button"
                            class="chat-ai-send"
                            id="sendAiConcept"
                        >
                            Send to Architect
                        </button>

                    </div>

                </div>

                `;


            const aiPanelBody =
                document.querySelector(
                    '#messagesWorkspacePanel .messages-ai-panel-body'
                );


            if (aiPanelBody) {

                aiPanelBody.scrollTop =
                    0;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE AI IMAGE
        |--------------------------------------------------------------------------
        */

        if (
            aiForm
            &&
            chatAiPrompt
        ) {

            aiForm
                .addEventListener(
                    'submit',
                    async function (
                        event
                    ) {

                        event.preventDefault();


                        const prompt =
                            chatAiPrompt
                                .value
                                .trim();


                        if (!prompt) {

                            showChatError(
                                'Describe the design you want first.'
                            );

                            chatAiPrompt
                                .focus();

                            return;
                        }


                        openAiPanel();


                        messagesAiEmpty
                            ?.classList
                            .add(
                                'hidden'
                            );


                        const formData =
                            new FormData();


                        formData
                            .append(
                                'prompt',
                                prompt
                            );


                        if (
                            chatAiImageInput
                            &&
                            chatAiImageInput
                                .files[0]
                        ) {

                            formData
                                .append(
                                    'reference_image',
                                    chatAiImageInput
                                        .files[0]
                                );
                        }


                        const parentHistoryId =
                            chatAiParentHistoryId
                                ?.value
                                ?.trim()
                            ||
                            '';


                        if (parentHistoryId) {

                            formData
                                .append(
                                    'parent_history_id',
                                    parentHistoryId
                                );
                        }


                        if (chatAskAiButton) {

                            chatAskAiButton.disabled =
                                true;

                            chatAskAiButton
                                .classList
                                .add(
                                    'sending'
                                );
                        }


                        if (aiResultWrapper) {

                            aiResultWrapper.innerHTML =
                                `

                                <div class="chat-ai-loading">

                                    <span
                                        class="
                                            ai-loading-dot
                                        "
                                    ></span>


                                    <div>

                                        <strong>
                                            Creating AI concept...
                                        </strong>

                                        <span>
                                            Image generation can take
                                            a little longer.
                                        </span>

                                    </div>

                                </div>

                                `;
                        }


                        try {

                            const response =
                                await fetch(

                                    @json(
                                        route(
                                            'client.projects.ai.prompt',
                                            [
                                                'id' =>
                                                    $selectedProject->id
                                            ]
                                        )
                                    ),

                                    {
                                        method:
                                            'POST',

                                        headers: {

                                            'X-CSRF-TOKEN':
                                                csrfToken,

                                            'Accept':
                                                'application/json',

                                            'X-Requested-With':
                                                'XMLHttpRequest'
                                        },

                                        body:
                                            formData
                                    }
                                );


                            let data =
                                {};


                            try {

                                data =
                                    await response
                                        .json();

                            } catch (jsonError) {

                                throw new Error(
                                    'The server returned an invalid response.'
                                );
                            }


                            if (
                                !response.ok
                                ||
                                !data.success
                            ) {

                                let errorMessage =
                                    data.message
                                    ||
                                    'Unable to generate the AI concept.';


                                if (
                                    data.errors
                                    &&
                                    typeof data.errors
                                    ===
                                    'object'
                                ) {

                                    const firstError =
                                        Object
                                            .values(
                                                data.errors
                                            )
                                            .flat()[0];


                                    if (firstError) {

                                        errorMessage =
                                            firstError;
                                    }
                                }


                                throw new Error(
                                    errorMessage
                                );
                            }


                            /*
                            | THIS WAS MISSING/BROKEN BEFORE
                            */

                            renderAiConcept(
                                data
                            );


                            if (
                                chatAiParentHistoryId
                            ) {

                                chatAiParentHistoryId.value =
                                    '';
                            }


                        } catch (error) {

                            console.error(
                                'AI GENERATION ERROR:',
                                error
                            );


                            if (aiResultWrapper) {

                                aiResultWrapper.innerHTML =
                                    '';
                            }


                            messagesAiEmpty
                                ?.classList
                                .remove(
                                    'hidden'
                                );


                            showChatError(
                                error.message
                                ||
                                'Unable to generate the AI concept.'
                            );


                        } finally {

                            if (chatAskAiButton) {

                                chatAskAiButton.disabled =
                                    false;

                                chatAskAiButton
                                    .classList
                                    .remove(
                                        'sending'
                                    );
                            }
                        }
                    }
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ENTER TO GENERATE
        |--------------------------------------------------------------------------
        */

        chatAiPrompt
            ?.addEventListener(
                'keydown',
                function (
                    event
                ) {

                    if (
                        event.key === 'Enter'
                        &&
                        !event.shiftKey
                    ) {

                        event.preventDefault();


                        if (
                            chatAiPrompt
                                .value
                                .trim()
                        ) {

                            aiForm
                                ?.requestSubmit();
                        }
                    }
                }
            );


        /*
        |--------------------------------------------------------------------------
        | AI ACTION BUTTONS
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Buttons are dynamically created inside aiResultWrapper.
        | We only attach ONE delegated listener here.
        |--------------------------------------------------------------------------
        */

        if (aiResultWrapper) {

            aiResultWrapper
                .addEventListener(
                    'click',
                    async function (
                        event
                    ) {

                        /*
                        |--------------------------------------------------------------------------
                        | IMAGE PREVIEW
                        |--------------------------------------------------------------------------
                        */

                        const clickedImage =
                            event
                                .target
                                .closest(
                                    '.chat-ai-generated-single img, .chat-ai-comparison-item img'
                                );


                        if (clickedImage) {

                            event.preventDefault();
                            event.stopPropagation();

                            openAiImageLightbox(
                                clickedImage.src
                            );

                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | DISCARD
                        |--------------------------------------------------------------------------
                        */

                        const discardButton =
                            event
                                .target
                                .closest(
                                    '#discardAiConcept'
                                );


                        if (discardButton) {

                            event.preventDefault();
                            event.stopPropagation();


                            aiResultWrapper.innerHTML =
                                '';


                            if (
                                chatAiParentHistoryId
                            ) {

                                chatAiParentHistoryId.value =
                                    '';
                            }


                            if (chatAiPrompt) {

                                chatAiPrompt.value =
                                    '';
                            }


                            if (chatAiImageInput) {

                                chatAiImageInput.value =
                                    '';
                            }


                            if (chatAiImagePreview) {

                                chatAiImagePreview.innerHTML =
                                    '';

                                chatAiImagePreview
                                    .classList
                                    .remove(
                                        'active'
                                    );
                            }


                            messagesAiEmpty
                                ?.classList
                                .remove(
                                    'hidden'
                                );


                            showChatSuccess(
                                'AI concept discarded.'
                            );


                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | CREATE ANOTHER VERSION
                        |--------------------------------------------------------------------------
                        */

                        const regenerateButton =
                            event
                                .target
                                .closest(
                                    '#generateAnotherAiConcept'
                                );


                        if (regenerateButton) {

                            event.preventDefault();
                            event.stopPropagation();


                            const conceptCard =
                                regenerateButton
                                    .closest(
                                        '.chat-ai-concept-card'
                                    );


                            const currentHistoryId =
                                conceptCard
                                    ?.dataset
                                    ?.historyId
                                ||
                                '';


                            const revisionInput =
                                conceptCard
                                    ?.querySelector(
                                        '#aiConceptRevisionPrompt'
                                    );


                            const revisionPrompt =
                                revisionInput
                                    ?.value
                                    ?.trim()
                                ||
                                '';


                            if (!revisionPrompt) {

                                showChatError(
                                    'Describe what you want changed for the next version.'
                                );

                                revisionInput
                                    ?.focus();

                                return;
                            }


                            if (!currentHistoryId) {

                                showChatError(
                                    'AI concept history could not be found.'
                                );

                                return;
                            }


                            /*
                            | Current generated concept becomes parent.
                            */

                            if (
                                chatAiParentHistoryId
                            ) {

                                chatAiParentHistoryId.value =
                                    currentHistoryId;
                            }


                            /*
                            | Put revision text into main AI prompt.
                            */

                            if (chatAiPrompt) {

                                chatAiPrompt.value =
                                    revisionPrompt;
                            }


                            /*
                            | Clear direct image upload.
                            | Parent history should carry the context.
                            */

                            if (chatAiImageInput) {

                                chatAiImageInput.value =
                                    '';
                            }


                            if (chatAiImagePreview) {

                                chatAiImagePreview.innerHTML =
                                    '';

                                chatAiImagePreview
                                    .classList
                                    .remove(
                                        'active'
                                    );
                            }


                            aiForm
                                ?.requestSubmit();


                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | SEND TO ARCHITECT
                        |--------------------------------------------------------------------------
                        */

                        const sendButton =
                            event
                                .target
                                .closest(
                                    '#sendAiConcept'
                                );


                        if (sendButton) {

                            event.preventDefault();
                            event.stopPropagation();


                            const conceptCard =
                                sendButton
                                    .closest(
                                        '.chat-ai-concept-card'
                                    );


                            const currentHistoryId =
                                conceptCard
                                    ?.dataset
                                    ?.historyId
                                ||
                                '';


                            if (!currentHistoryId) {

                                showChatError(
                                    'AI concept history could not be found.'
                                );

                                return;
                            }


                            await sendAiConceptToArchitect(
                                currentHistoryId,
                                sendButton,
                                conceptCard
                            );


                            return;
                        }
                    }
                );
        }


        /*
        |--------------------------------------------------------------------------
        | LIGHTBOX EVENTS
        |--------------------------------------------------------------------------
        */

        aiImageLightbox
            .addEventListener(
                'click',
                function (
                    event
                ) {

                    if (
                        event.target ===
                        aiImageLightbox
                    ) {

                        closeAiImageLightbox();

                        return;
                    }


                    if (
                        event.target
                            .closest(
                                '.ai-image-lightbox-close'
                            )
                    ) {

                        closeAiImageLightbox();
                    }
                }
            );


        /*
        |--------------------------------------------------------------------------
        | SEND AI CONCEPT TO ARCHITECT
        |--------------------------------------------------------------------------
        */

        async function sendAiConceptToArchitect(
            historyId,
            sendButton = null,
            conceptCard = null
        ) {

            const noteInput =
                conceptCard
                    ?.querySelector(
                        '#aiConceptArchitectNote'
                    )
                ||
                document
                    .getElementById(
                        'aiConceptArchitectNote'
                    );


            const message =
                noteInput
                    ?.value
                    ?.trim()
                ||
                '';


            if (!historyId) {

                showChatError(
                    'AI concept history could not be found.'
                );

                return;
            }


            if (!sendButton) {

                sendButton =
                    document.getElementById(
                        'sendAiConcept'
                    );
            }


            const oldButtonText =
                sendButton
                    ?.textContent
                    ?.trim()
                ||
                'Send to Architect';


            if (sendButton) {

                sendButton.disabled =
                    true;

                sendButton.textContent =
                    'Sending...';
            }


            try {

                const sendUrl =
                    @json(
                        route(
                            'client.projects.ai.send',
                            [
                                'id' =>
                                    $selectedProject->id,

                                'historyId' =>
                                    '__HISTORY_ID__'
                            ]
                        )
                    )
                    .replace(
                        '__HISTORY_ID__',
                        encodeURIComponent(
                            historyId
                        )
                    );


                const response =
                    await fetch(
                        sendUrl,
                        {
                            method:
                                'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            body:
                                JSON.stringify(
                                    {
                                        message:
                                            message
                                    }
                                )
                        }
                    );


                let data =
                    {};


                try {

                    data =
                        await response
                            .json();

                } catch (jsonError) {

                    throw new Error(
                        'The server returned an invalid response.'
                    );
                }


                if (
                    !response.ok
                    ||
                    !data.success
                ) {

                    let errorMessage =
                        data.message
                        ||
                        'Unable to send the AI concept.';


                    if (
                        data.errors
                        &&
                        typeof data.errors
                        ===
                        'object'
                    ) {

                        const firstError =
                            Object
                                .values(
                                    data.errors
                                )
                                .flat()[0];


                        if (firstError) {

                            errorMessage =
                                firstError;
                        }
                    }


                    throw new Error(
                        errorMessage
                    );
                }


                showChatSuccess(
                    data.message
                    ||
                    'AI concept sent to your architect.'
                );


                if (aiResultWrapper) {

                    aiResultWrapper.innerHTML =
                        '';
                }


                messagesAiEmpty
                    ?.classList
                    .remove(
                        'hidden'
                    );


                if (
                    chatAiParentHistoryId
                ) {

                    chatAiParentHistoryId.value =
                        '';
                }


                if (chatAiPrompt) {

                    chatAiPrompt.value =
                        '';
                }


                if (chatAiImageInput) {

                    chatAiImageInput.value =
                        '';
                }


                if (chatAiImagePreview) {

                    chatAiImagePreview.innerHTML =
                        '';

                    chatAiImagePreview
                        .classList
                        .remove(
                            'active'
                        );
                }


                /*
                | Reload message section so the newly sent
                | AI concept appears in the chat history.
                */

                setTimeout(
                    function () {

                        window.location.href =
                            @json(
                                route(
                                    'client.projects.index',
                                    [
                                        'project' =>
                                            $selectedProject->id,

                                        'section' =>
                                            'messages'
                                    ]
                                )
                            );

                    },
                    400
                );


            } catch (error) {

                console.error(
                    'AI SEND ERROR:',
                    error
                );


                if (sendButton) {

                    sendButton.disabled =
                        false;

                    sendButton.textContent =
                        oldButtonText;
                }


                showChatError(
                    error.message
                    ||
                    'Unable to send the AI concept.'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REVISION FORM
        |--------------------------------------------------------------------------
        */

        const revisionFormCard =
            document.getElementById(
                'clientRevisionFormCard'
            );

        const openRevisionFormButton =
            document.getElementById(
                'openRevisionFormButton'
            );

        const closeRevisionFormButton =
            document.getElementById(
                'closeRevisionFormButton'
            );

        const clientRevisionForm =
            document.getElementById(
                'clientRevisionForm'
            );

        const clientRevisionSubmit =
            document.getElementById(
                'clientRevisionSubmit'
            );

        const revisionAttachment =
            document.getElementById(
                'revisionAttachment'
            );

        const revisionFilePreview =
            document.getElementById(
                'revisionFilePreview'
            );

        const revisionPreviewImage =
            document.getElementById(
                'revisionPreviewImage'
            );

        const revisionPreviewName =
            document.getElementById(
                'revisionPreviewName'
            );

        const revisionPreviewSize =
            document.getElementById(
                'revisionPreviewSize'
            );

        const removeRevisionAttachment =
            document.getElementById(
                'removeRevisionAttachment'
            );


        function openRevisionForm() {

            revisionFormCard
                ?.classList
                .add(
                    'active'
                );


            setTimeout(
                function () {

                    document
                        .getElementById(
                            'revisionTitle'
                        )
                        ?.focus();

                },
                100
            );
        }


        function closeRevisionForm() {

            revisionFormCard
                ?.classList
                .remove(
                    'active'
                );
        }


        openRevisionFormButton
            ?.addEventListener(
                'click',
                openRevisionForm
            );


        closeRevisionFormButton
            ?.addEventListener(
                'click',
                closeRevisionForm
            );


        revisionAttachment
            ?.addEventListener(
                'change',
                function () {

                    const file =
                        revisionAttachment
                            .files[0];


                    if (!file) {
                        return;
                    }


                    if (
                        !validateClientUpload(
                            revisionAttachment
                        )
                    ) {

                        revisionFilePreview
                            ?.classList
                            .remove(
                                'active'
                            );

                        if (revisionPreviewImage) {

                            revisionPreviewImage.innerHTML =
                                '';
                        }

                        if (revisionPreviewName) {

                            revisionPreviewName.textContent =
                                '';
                        }

                        if (revisionPreviewSize) {

                            revisionPreviewSize.textContent =
                                '';
                        }

                        return;
                    }


                    revisionFilePreview
                        ?.classList
                        .add(
                            'active'
                        );


                    if (revisionPreviewName) {

                        revisionPreviewName.textContent =
                            file.name;
                    }


                    if (revisionPreviewSize) {

                        revisionPreviewSize.textContent =
                            (
                                file.size
                                /
                                1024
                                /
                                1024
                            )
                            .toFixed(2)
                            +
                            ' MB';
                    }


                    if (revisionPreviewImage) {

                        revisionPreviewImage.innerHTML =
                            '';


                        if (
                            file.type
                                .startsWith(
                                    'image/'
                                )
                        ) {

                            const reader =
                                new FileReader();


                            reader.onload =
                                function (
                                    event
                                ) {

                                    const image =
                                        document.createElement(
                                            'img'
                                        );

                                    image.src =
                                        event.target.result;

                                    revisionPreviewImage
                                        .appendChild(
                                            image
                                        );
                                };


                            reader.readAsDataURL(
                                file
                            );
                        }
                    }
                }
            );


        removeRevisionAttachment
            ?.addEventListener(
                'click',
                function () {

                    if (revisionAttachment) {

                        revisionAttachment.value =
                            '';
                    }


                    revisionFilePreview
                        ?.classList
                        .remove(
                            'active'
                        );


                    if (revisionPreviewImage) {

                        revisionPreviewImage.innerHTML =
                            '';
                    }


                    if (revisionPreviewName) {

                        revisionPreviewName.textContent =
                            '';
                    }


                    if (revisionPreviewSize) {

                        revisionPreviewSize.textContent =
                            '';
                    }
                }
            );


        clientRevisionForm
            ?.addEventListener(
                'submit',
                function () {

                    if (!clientRevisionSubmit) {
                        return;
                    }


                    clientRevisionSubmit.disabled =
                        true;

                    clientRevisionSubmit.textContent =
                        'Submitting...';
                }
            );


        /*
        |--------------------------------------------------------------------------
        | REVISION AI
        |--------------------------------------------------------------------------
        */

        const revisionTitle =
            document.getElementById(
                'revisionTitle'
            );

        const revisionCategory =
            document.getElementById(
                'revisionCategory'
            );

        const revisionDescription =
            document.getElementById(
                'revisionDescription'
            );

        const structureRevisionAiButton =
            document.getElementById(
                'structureRevisionAiButton'
            );

        const revisionAiStatus =
            document.getElementById(
                'revisionAiStatus'
            );

        const revisionAiReview =
            document.getElementById(
                'revisionAiReview'
            );

        const revisionAiStructuredFeedback =
            document.getElementById(
                'revisionAiStructuredFeedback'
            );

        const revisionUsedAi =
            document.getElementById(
                'revisionUsedAi'
            );

        const discardRevisionAiButton =
            document.getElementById(
                'discardRevisionAiButton'
            );


        function showRevisionAiStatus(
            message,
            type = ''
        ) {

            if (!revisionAiStatus) {
                return;
            }


            revisionAiStatus.textContent =
                message;

            revisionAiStatus.className =
                'client-revision-ai-status';


            if (type) {

                revisionAiStatus
                    .classList
                    .add(
                        type
                    );
            }


            revisionAiStatus
                .classList
                .add(
                    'show'
                );
        }


        function hideRevisionAiStatus() {

            if (!revisionAiStatus) {
                return;
            }


            revisionAiStatus
                .classList
                .remove(
                    'show'
                );

            revisionAiStatus.textContent =
                '';
        }


        structureRevisionAiButton
            ?.addEventListener(
                'click',
                async function () {

                    const title =
                        revisionTitle
                            ?.value
                            .trim()
                        ??
                        '';

                    const description =
                        revisionDescription
                            ?.value
                            .trim()
                        ??
                        '';

                    const category =
                        revisionCategory
                            ?.value
                            .trim()
                        ??
                        '';


                    if (!title) {

                        showRevisionAiStatus(
                            'Add a revision title first.',
                            'error'
                        );

                        revisionTitle
                            ?.focus();

                        return;
                    }


                    if (!description) {

                        showRevisionAiStatus(
                            'Write your revision feedback first.',
                            'error'
                        );

                        revisionDescription
                            ?.focus();

                        return;
                    }


                    structureRevisionAiButton.disabled =
                        true;


                    showRevisionAiStatus(
                        'AI is organizing your revision request...',
                        'loading'
                    );


                    try {

                        const response =
                            await fetch(

                                @json(
                                    route(
                                        'client.projects.revisions.ai.structure',
                                        [
                                            'id' =>
                                                $selectedProject->id
                                        ]
                                    )
                                ),

                                {
                                    method:
                                        'POST',

                                    headers: {

                                        'Content-Type':
                                            'application/json',

                                        'Accept':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                            csrfToken,

                                        'X-Requested-With':
                                            'XMLHttpRequest'
                                    },

                                    body:
                                        JSON.stringify(
                                            {
                                                title:
                                                    title,

                                                description:
                                                    description,

                                                revision_category:
                                                    category
                                            }
                                        )
                                }
                            );


                        const data =
                            await response.json();


                        if (
                            !response.ok
                            ||
                            !data.success
                        ) {

                            let errorMessage =
                                data.message
                                ||
                                'Unable to structure the revision with AI.';


                            if (
                                data.errors
                                &&
                                typeof data.errors
                                ===
                                'object'
                            ) {

                                const firstError =
                                    Object
                                        .values(
                                            data.errors
                                        )
                                        .flat()[0];


                                if (firstError) {

                                    errorMessage =
                                        firstError;
                                }
                            }


                            throw new Error(
                                errorMessage
                            );
                        }


                        if (
                            revisionCategory
                            &&
                            data.category
                        ) {

                            revisionCategory.value =
                                data.category;
                        }


                        if (
                            revisionAiStructuredFeedback
                        ) {

                            revisionAiStructuredFeedback.value =
                                data.structured_feedback
                                ||
                                '';
                        }


                        if (revisionUsedAi) {

                            revisionUsedAi.value =
                                '1';
                        }


                        revisionAiReview
                            ?.classList
                            .add(
                                'active'
                            );


                        showRevisionAiStatus(
                            'AI structure is ready. Review and edit it before submitting.',
                            'success'
                        );


                        revisionAiStructuredFeedback
                            ?.focus();


                    } catch (error) {

                        showRevisionAiStatus(
                            error.message
                            ||
                            'Something went wrong while structuring the revision.',
                            'error'
                        );


                    } finally {

                        structureRevisionAiButton.disabled =
                            false;
                    }
                }
            );


        discardRevisionAiButton
            ?.addEventListener(
                'click',
                function () {

                    if (
                        revisionAiStructuredFeedback
                    ) {

                        revisionAiStructuredFeedback.value =
                            '';
                    }


                    if (revisionUsedAi) {

                        revisionUsedAi.value =
                            '0';
                    }


                    revisionAiReview
                        ?.classList
                        .remove(
                            'active'
                        );


                    hideRevisionAiStatus();
                }
            );


        if (
            revisionAiStructuredFeedback
            &&
            revisionAiStructuredFeedback
                .value
                .trim()
        ) {

            revisionAiReview
                ?.classList
                .add(
                    'active'
                );


            if (revisionUsedAi) {

                revisionUsedAi.value =
                    '1';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MEETING FORM
        |--------------------------------------------------------------------------
        */

        const meetingFormCard =
            document.getElementById(
                'clientMeetingFormCard'
            );

        const openMeetingFormButton =
            document.getElementById(
                'openMeetingFormButton'
            );

        const closeMeetingFormButton =
            document.getElementById(
                'closeMeetingFormButton'
            );

        const clientMeetingForm =
            document.getElementById(
                'clientMeetingForm'
            );

        const clientMeetingSubmit =
            document.getElementById(
                'clientMeetingSubmit'
            );

        const meetingDateInput =
            document.getElementById(
                'meetingDate'
            );

        const meetingAvailability =
            document.getElementById(
                'meetingAvailability'
            );

        const meetingAvailabilityDate =
            document.getElementById(
                'meetingAvailabilityDate'
            );

        const meetingAvailabilityContent =
            document.getElementById(
                'meetingAvailabilityContent'
            );


        const meetingAvailabilityUrl =
            @json(
                route(
                    'client.projects.meetings.availability',
                    [
                        'id' =>
                            $selectedProject->id
                    ]
                )
            );


        function openMeetingForm() {

            meetingFormCard
                ?.classList
                .add(
                    'active'
                );


            setTimeout(
                function () {

                    document
                        .getElementById(
                            'meetingTitle'
                        )
                        ?.focus();

                },
                100
            );


            if (
                meetingDateInput
                    ?.value
            ) {

                loadMeetingAvailability(
                    meetingDateInput.value
                );
            }
        }


        function closeMeetingForm() {

            meetingFormCard
                ?.classList
                .remove(
                    'active'
                );
        }


        function showAvailabilityMessage(
            message,
            type = ''
        ) {

            if (
                !meetingAvailability
                ||
                !meetingAvailabilityContent
            ) {
                return;
            }


            meetingAvailability.style.display =
                'block';


            meetingAvailability
                .classList
                .remove(
                    'loading',
                    'available',
                    'unavailable',
                    'error'
                );


            if (type) {

                meetingAvailability
                    .classList
                    .add(
                        type
                    );
            }


            meetingAvailabilityContent.innerHTML =
                message;
        }


        async function loadMeetingAvailability(
            dateValue
        ) {

            if (!dateValue) {

                if (meetingAvailability) {

                    meetingAvailability.style.display =
                        'none';
                }

                return;
            }


            if (meetingAvailabilityDate) {

                meetingAvailabilityDate.textContent =
                    new Date(
                        dateValue
                        +
                        'T00:00:00'
                    )
                    .toLocaleDateString(
                        'en-PH',
                        {
                            month:
                                'long',

                            day:
                                'numeric',

                            year:
                                'numeric'
                        }
                    );
            }


            showAvailabilityMessage(
                '<span>Checking architect schedule...</span>',
                'loading'
            );


            try {

                const url =
                    meetingAvailabilityUrl
                    +
                    '?date='
                    +
                    encodeURIComponent(
                        dateValue
                    );


                const response =
                    await fetch(
                        url,
                        {
                            method:
                                'GET',

                            headers: {

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            cache:
                                'no-store'
                        }
                    );


                const data =
                    await response.json();


                if (
                    !response.ok
                    ||
                    !data.success
                ) {

                    throw new Error(
                        data.message
                        ||
                        'Unable to check architect availability.'
                    );
                }


                const unavailableTimes =
                    Array.isArray(
                        data.unavailable_times
                    )
                        ?
                        data.unavailable_times
                        :
                        [];


                if (
                    unavailableTimes.length === 0
                ) {

                    showAvailabilityMessage(
                        '<strong>No blocked meeting times for this date.</strong><span>You may choose your preferred future time.</span>',
                        'available'
                    );

                    return;
                }


                const timeItems =
                    unavailableTimes
                        .map(
                            function (time) {

                                return `

                                    <span
                                        class="
                                            client-meeting-unavailable-slot
                                        "
                                    >
                                        ${escapeHtml(time.start_label)}
                                        –
                                        ${escapeHtml(time.end_label)}
                                    </span>

                                `;
                            }
                        )
                        .join('');


                showAvailabilityMessage(
                    '<strong>Unavailable times:</strong>'
                    +
                    '<div class="client-meeting-unavailable-list">'
                    +
                    timeItems
                    +
                    '</div>',
                    'unavailable'
                );


            } catch (error) {

                showAvailabilityMessage(
                    '<strong>Availability could not be loaded.</strong>'
                    +
                    '<span>'
                    +
                    escapeHtml(
                        error.message
                        ||
                        'Please try again.'
                    )
                    +
                    '</span>',
                    'error'
                );
            }
        }


        openMeetingFormButton
            ?.addEventListener(
                'click',
                openMeetingForm
            );


        closeMeetingFormButton
            ?.addEventListener(
                'click',
                closeMeetingForm
            );


        meetingDateInput
            ?.addEventListener(
                'change',
                function () {

                    loadMeetingAvailability(
                        meetingDateInput.value
                    );
                }
            );


        clientMeetingForm
            ?.addEventListener(
                'submit',
                function () {

                    if (!clientMeetingSubmit) {
                        return;
                    }


                    clientMeetingSubmit.disabled =
                        true;

                    clientMeetingSubmit.textContent =
                        'Submitting...';
                }
            );


        /*
        |--------------------------------------------------------------------------
        | AUTO OPEN SECTIONS
        |--------------------------------------------------------------------------
        */

        @if(
            request('section')
            ===
            'revisions'
        )

            if (revisionsPanel) {

                openWorkspaceSection(
                    revisionsPanel
                );
            }

        @endif


        @if(
            $errors->any()
            &&
            request('section')
            !==
            'meetings'
        )

            if (revisionsPanel) {

                openWorkspaceSection(
                    revisionsPanel
                );

                openRevisionForm();
            }

        @endif


        @if(
            request('section')
            ===
            'meetings'
        )

            if (meetingsPanel) {

                openWorkspaceSection(
                    meetingsPanel
                );
            }


            @if($errors->any())

                openMeetingForm();

            @endif

        @endif


        @if(
            request('section')
            ===
            'messages'
        )

            if (messagesPanel) {

                openWorkspaceSection(
                    messagesPanel
                );
            }

        @endif


        /*
        |--------------------------------------------------------------------------
        | LIVE ARCHITECT PRESENCE
        |--------------------------------------------------------------------------
        */

        const architectPresenceElement =
            document.querySelector(
                '#messagesWorkspacePanel .chat-status'
            );


        const architectPresenceUrl =
            @json(
                route(
                    'client.projects.architect-presence',
                    [
                        'id' =>
                            $selectedProject->id
                    ]
                )
            );


        function updateArchitectPresenceDisplay(
            status
        ) {

            const allowedStatuses = [
                'online',
                'idle',
                'away'
            ];


            if (!architectPresenceElement) {
                return;
            }


            if (
                !allowedStatuses
                    .includes(
                        status
                    )
            ) {

                status =
                    'away';
            }


            architectPresenceElement
                .classList
                .remove(
                    'online',
                    'idle',
                    'away'
                );


            architectPresenceElement
                .classList
                .add(
                    status
                );


            let statusText =
                'Away';


            if (status === 'online') {

                statusText =
                    'Online now';
            }


            if (status === 'idle') {

                statusText =
                    'Idle';
            }


            architectPresenceElement.innerHTML =
                '<span></span>'
                +
                statusText;
        }


        async function refreshArchitectPresence() {

            try {

                const response =
                    await fetch(
                        architectPresenceUrl,
                        {
                            method:
                                'GET',

                            headers: {

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            cache:
                                'no-store'
                        }
                    );


                if (!response.ok) {
                    return;
                }


                const data =
                    await response.json();


                updateArchitectPresenceDisplay(
                    data.status
                );


            } catch (error) {

                console.warn(
                    'Unable to refresh architect presence.'
                );
            }
        }


        refreshArchitectPresence();


        setInterval(
            refreshArchitectPresence,
            20000
        );


        document
            .addEventListener(
                'visibilitychange',
                function () {

                    if (!document.hidden) {

                        refreshArchitectPresence();
                    }
                }
            );


        scrollChatBottom();


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document
            .addEventListener(
                'keydown',
                function (
                    event
                ) {

                    if (
                        event.key !== 'Escape'
                    ) {
                        return;
                    }


                    if (
                        aiImageLightbox
                            .classList
                            .contains(
                                'active'
                            )
                    ) {

                        closeAiImageLightbox();

                        return;
                    }


                    if (
                        messagesWorkspaceLayout
                            ?.classList
                            .contains(
                                'ai-open'
                            )
                    ) {

                        closeAiPanel();


                        document
                            .querySelector(
                                '[data-composer-mode="message"]'
                            )
                            ?.click();


                        return;
                    }


                    const openPanel =
                        allPanels
                            .find(
                                function (panel) {

                                    return panel
                                        .classList
                                        .contains(
                                            'active'
                                        );
                                }
                            );


                    if (openPanel) {

                        closeWorkspaceSections();

                        return;
                    }


                    window.location.href =
                        @json(
                            route(
                                'client.projects.index'
                            )
                        );
                }
            );


        @endif

    }
);

</script>

</body>
</html>