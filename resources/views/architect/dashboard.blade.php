<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>Architect Dashboard | ArchiTrack</title>
    @vite([
        'resources/css/app.css',
        'resources/css/architect-dashboard.css',
        'resources/js/app.js'
    ])
<style>
        html, body, button, input, select, textarea {
            font-family: "Segoe UI", Arial, sans-serif !important;
        }

        /* Pending requests on the architect sidebar */
        .sidebar .menu-link .sidebar-badge {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 21px;
            height: 21px;
            padding: 0 6px;
            border-radius: 999px;
            background: #ef4444;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            flex-shrink: 0;
        }
        .sidebar-collapsed .sidebar .menu-link .sidebar-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            min-width: 17px;
            height: 17px;
            padding: 0 3px;
            font-size: 9px;
        }
    </style>
</head>
<body>
<div class="architect-layout">
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
    <!-- =====================================================
         SIDEBAR
    ====================================================== -->
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
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="identity-info">
                    <strong>
                        {{ $user->name }}
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
            @if(($pendingRevisionCount ?? 0) > 0)
                <span class="sidebar-badge" aria-label="{{ $pendingRevisionCount }} pending revision requests">
                    {{ $pendingRevisionCount > 99 ? '99+' : $pendingRevisionCount }}
                </span>
            @endif
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
            @if(($pendingMeetingCount ?? 0) > 0)
                <span class="sidebar-badge" aria-label="{{ $pendingMeetingCount }} pending meeting requests">
                    {{ $pendingMeetingCount > 99 ? '99+' : $pendingMeetingCount }}
                </span>
            @endif
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
    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->
    <main class="main-content">
        <!-- =================================================
             TOPBAR
        ================================================== -->
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
                <h1>
                    Project Management Workspace
                </h1>
            </div>
            <div class="top-date">
                <span>
                    {{ $currentDate }}
                </span>
                <strong>
                    {{ $currentTime }} PH
                </strong>
            </div>
        </header>
        <!-- =================================================
             DASHBOARD CONTENT
        ================================================== -->
        <div class="dashboard-content">
            <!-- =================================================
                 HERO
            ================================================== -->
            <section class="architect-hero">
                <div class="hero-grid"></div>
                <div class="hero-orb orb-one"></div>
                <div class="hero-orb orb-two"></div>
                <div class="hero-content">
                    <span class="hero-kicker">
                        ARCHITECT PROJECT CONTROL
                    </span>
                    <h2>
                        {{ $greeting }},<br>
                        {{ $user->name }}.
                    </h2>
                    <p>
                        Keep track of your architectural projects,
                        design files, client revisions, and meeting
                        requests from one organized workspace.
                    </p>
                    <div class="hero-actions">
                        <a
                            href="{{ route('architect.projects.index') }}"
                            class="primary-action"
                        >
                            View Projects
                        </a>
                        <a
                            href="{{ route('architect.files.index') }}"
                            class="secondary-action"
                        >
                            Upload Files
                        </a>
                    </div>
                </div>
                <div class="hero-visual">
                    <img
                        src="{{ asset('images/lineart1.png') }}"
                        class="hero-lineart lineart-main"
                        alt=""
                    >
                    <img
                        src="{{ asset('images/lineart3.png') }}"
                        class="hero-lineart lineart-back"
                        alt=""
                    >
                    <div class="visual-card">
                        <span>
                            PROJECT SNAPSHOT
                        </span>
                        <strong>
                            {{ $totalProjects }}
                        </strong>
                        <p>
                            Total assigned projects
                        </p>
                    </div>
                </div>
            </section>
            <!-- =================================================
                 STATS
            ================================================== -->
            <section class="stat-row">
                <!-- TOTAL PROJECTS -->
                <div class="stat-box">
                    <div class="stat-number orange-number">
                        {{ $totalProjects }}
                    </div>
                    <div class="stat-text">
                        <span>
                            TOTAL
                        </span>
                        <strong>
                            Projects
                        </strong>
                        <p>
                            All assigned projects
                        </p>
                    </div>
                </div>
                <!-- ONGOING -->
                <div class="stat-box">
                    <div class="stat-number green-number">
                        {{ $ongoingProjects }}
                    </div>
                    <div class="stat-text">
                        <span>
                            ACTIVE
                        </span>
                        <strong>
                            Ongoing
                        </strong>
                        <p>
                            Projects currently in progress
                        </p>
                    </div>
                </div>
                <!-- COMPLETED -->
                <div class="stat-box">
                    <div class="stat-number blue-number">
                        {{ $completedProjects }}
                    </div>
                    <div class="stat-text">
                        <span>
                            FINISHED
                        </span>
                        <strong>
                            Completed
                        </strong>
                        <p>
                            Completed architectural work
                        </p>
                    </div>
                </div>
                <!-- PLANNING -->
                <div class="stat-box">
                    <div class="stat-number beige-number">
                        {{ $planningProjects }}
                    </div>
                    <div class="stat-text">
                        <span>
                            UPCOMING
                        </span>
                        <strong>
                            Planning
                        </strong>
                        <p>
                            Projects in planning stage
                        </p>
                    </div>
                </div>
            </section>
            <!-- =================================================
                 PROJECT ANALYTICS CALCULATIONS
            ================================================== -->
            @php
                $analyticsTotal = max(
                    $totalProjects,
                    1
                );
                $planningPercent = round(
                    (
                        $planningProjects
                        /
                        $analyticsTotal
                    )
                    *
                    100
                );
                $ongoingPercent = round(
                    (
                        $ongoingProjects
                        /
                        $analyticsTotal
                    )
                    *
                    100
                );
                $completedPercent = round(
                    (
                        $completedProjects
                        /
                        $analyticsTotal
                    )
                    *
                    100
                );
                $completionRate = $totalProjects > 0
                    ? round(
                        (
                            $completedProjects
                            /
                            $totalProjects
                        )
                        *
                        100
                    )
                    : 0;
                $activeRate = $totalProjects > 0
                    ? round(
                        (
                            $ongoingProjects
                            /
                            $totalProjects
                        )
                        *
                        100
                    )
                    : 0;
                $remainingProjects =
                    $planningProjects
                    +
                    $ongoingProjects;
            @endphp
            <!-- =================================================
                 PROJECT ANALYTICS
            ================================================== -->
            <section class="project-analytics-section">
                <!-- ANALYTICS HEADING -->
                <div class="analytics-heading">
                    <div>
                        <span>
                            PROJECT ANALYTICS
                        </span>
                        <h3>
                            Project Overview
                        </h3>
                        <p>
                            Monitor project distribution,
                            completion rate, and your current
                            architectural workload.
                        </p>
                    </div>
                    <div class="analytics-period">
                        Current Projects
                    </div>
                </div>
                <div class="analytics-grid">
                    <!-- =========================================
                         STATUS DISTRIBUTION
                    ========================================== -->
                    <div class="analytics-card status-analytics-card">
                        <div class="analytics-card-heading">
                            <div>
                                <span>
                                    STATUS DISTRIBUTION
                                </span>
                                <h4>
                                    Project Status
                                </h4>
                            </div>
                            <strong>
                                {{ $totalProjects }}
                            </strong>
                        </div>
                        <div class="analytics-status-list">
                            <!-- PLANNING -->
                            <div class="analytics-status-row">
                                <div class="analytics-status-copy">
                                    <div class="analytics-status-name">
                                        <i class="analytics-dot planning-dot"></i>
                                        <span>
                                            Planning
                                        </span>
                                    </div>
                                    <strong>
                                        {{ $planningProjects }}
                                    </strong>
                                </div>
                                <div class="analytics-bar">
                                    <span
                                        class="planning-bar"
                                        style="width: {{ $planningPercent }}%;"
                                    ></span>
                                </div>
                                <small>
                                    {{ $planningPercent }}%
                                </small>
                            </div>
                            <!-- ONGOING -->
                            <div class="analytics-status-row">
                                <div class="analytics-status-copy">
                                    <div class="analytics-status-name">
                                        <i class="analytics-dot ongoing-dot"></i>
                                        <span>
                                            Ongoing
                                        </span>
                                    </div>
                                    <strong>
                                        {{ $ongoingProjects }}
                                    </strong>
                                </div>
                                <div class="analytics-bar">
                                    <span
                                        class="ongoing-bar"
                                        style="width: {{ $ongoingPercent }}%;"
                                    ></span>
                                </div>
                                <small>
                                    {{ $ongoingPercent }}%
                                </small>
                            </div>
                            <!-- COMPLETED -->
                            <div class="analytics-status-row">
                                <div class="analytics-status-copy">
                                    <div class="analytics-status-name">
                                        <i class="analytics-dot completed-dot"></i>
                                        <span>
                                            Completed
                                        </span>
                                    </div>
                                    <strong>
                                        {{ $completedProjects }}
                                    </strong>
                                </div>
                                <div class="analytics-bar">
                                    <span
                                        class="completed-bar"
                                        style="width: {{ $completedPercent }}%;"
                                    ></span>
                                </div>
                                <small>
                                    {{ $completedPercent }}%
                                </small>
                            </div>
                        </div>
                    </div>
                    <!-- =========================================
                         COMPLETION RATE
                    ========================================== -->
                    <div class="analytics-card completion-analytics-card">
                        <div class="analytics-card-heading">
                            <div>
                                <span>
                                    PERFORMANCE
                                </span>
                                <h4>
                                    Completion Rate
                                </h4>
                            </div>
                        </div>
                        <div class="completion-meter-area">
                            <div
                                class="completion-meter"
                                style="
                                    --completion:
                                    {{ $completionRate * 3.6 }}deg;
                                "
                            >
                                <div class="completion-meter-inner">
                                    <strong>
                                        {{ $completionRate }}%
                                    </strong>
                                    <span>
                                        completed
                                    </span>
                                </div>
                            </div>
                            <div class="completion-copy">
                                <strong>
                                    {{ $completedProjects }}
                                    of
                                    {{ $totalProjects }}
                                </strong>
                                <span>
                                    projects completed
                                </span>
                                <p>
                                    @if($totalProjects <= 0)
                                        No project data is available yet.
                                    @elseif($completionRate >= 75)
                                        Most assigned projects have
                                        already been completed.
                                    @elseif($completionRate >= 40)
                                        Project completion is progressing
                                        steadily.
                                    @else
                                        Most projects are still in the
                                        active or planning stage.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- =========================================
                         CURRENT WORKLOAD
                    ========================================== -->
                    <div class="analytics-card workload-analytics-card">
                        <div class="analytics-card-heading">
                            <div>
                                <span>
                                    WORKLOAD
                                </span>
                                <h4>
                                    Current Activity
                                </h4>
                            </div>
                        </div>
                        <div class="workload-main">
                            <div class="workload-number">
                                <strong>
                                    {{ $ongoingProjects }}
                                </strong>
                                <span>
                                    Active Projects
                                </span>
                            </div>
                            <div class="workload-rate">
                                <span>
                                    Active workload
                                </span>
                                <strong>
                                    {{ $activeRate }}%
                                </strong>
                            </div>
                            <div class="workload-track">
                                <span
                                    style="width: {{ $activeRate }}%;"
                                ></span>
                            </div>
                        </div>
                        <div class="workload-breakdown">
                            <div>
                                <span>
                                    Planning
                                </span>
                                <strong>
                                    {{ $planningProjects }}
                                </strong>
                            </div>
                            <div>
                                <span>
                                    Ongoing
                                </span>
                                <strong>
                                    {{ $ongoingProjects }}
                                </strong>
                            </div>
                            <div>
                                <span>
                                    Remaining
                                </span>
                                <strong>
                                    {{ $remainingProjects }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- =================================================
                 WORKSPACE GRID
            ================================================== -->
            <section class="workspace-grid">
                <!-- =============================================
                     RECENT PROJECTS
                ============================================== -->
                <div class="recent-projects">
                    <div class="section-heading">
                        <div>
                            <span>
                                PROJECTS
                            </span>
                            <h3>
                                Recent Work
                            </h3>
                            <p>
                                Latest projects assigned to your account
                            </p>
                        </div>
                        <a href="{{ route('architect.projects.index') }}">
                            View All
                        </a>
                    </div>
                    <div class="project-list">
                        @forelse($recentProjects as $project)
                            <div class="project-item">
                                <!-- PROJECT IMAGE -->
                                <div class="project-image">
                                    @if(!empty($project->project_image))
                                        <img
                                            src="{{ asset('uploads/projects/' . $project->project_image) }}"
                                            alt="{{ $project->project_name }}"
                                        >
                                    @else
                                        <div class="project-fallback">
                                            <img
                                                src="{{ asset('images/lineart2.png') }}"
                                                alt=""
                                            >
                                        </div>
                                    @endif
                                </div>
                                <!-- PROJECT DETAILS -->
                                <div class="project-details">
                                    <span class="project-label">
                                        {{ strtoupper(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $project->status ?? 'Planning'
                                            )
                                        ) }}
                                    </span>
                                    <strong>
                                        {{ $project->project_name }}
                                    </strong>
                                    <p>
                                        {{ $project->client_name ?? 'No client assigned' }}
                                    </p>
                                </div>
                                <div class="project-arrow">
                                    →
                                </div>
                            </div>
                        @empty
                            <div class="empty-projects">
                                <div class="empty-lineart">
                                    <img
                                        src="{{ asset('images/lineart2.png') }}"
                                        alt=""
                                    >
                                </div>
                                <div class="empty-copy">
                                    <span>
                                        PROJECT WORKSPACE
                                    </span>
                                    <h4>
                                        No projects assigned yet
                                    </h4>
                                    <p>
                                        Your projects will appear here once a
                                        project workspace is created.
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- =============================================
                     RIGHT SIDE
                ============================================== -->
                <aside class="workspace-side">
                    <!-- QUICK TASKS -->
                    <div class="side-card">
                        <div class="side-heading">
                            <span>
                                QUICK TASKS
                            </span>
                            <h3>
                                Start Working
                            </h3>
                        </div>
                        <!-- CREATE PROJECT -->
                        <a
                            href="{{ route('architect.projects.index') }}"
                            class="task-link"
                        >
                            <div class="task-icon orange-task">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>
                            </div>
                            <div>
                                <strong>
                                    Create Project
                                </strong>
                                <span>
                                    Start a new project workspace
                                </span>
                            </div>
                        </a>
                        <!-- UPLOAD FILES -->
                        <a
                            href="{{ route('architect.files.index') }}"
                            class="task-link"
                        >
                            <div class="task-icon green-task">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 3v12"/>
                                    <path d="M7 8l5-5 5 5"/>
                                    <path d="M5 17v3h14v-3"/>
                                </svg>
                            </div>
                            <div>
                                <strong>
                                    Upload Files
                                </strong>
                                <span>
                                    Add drawings and documents
                                </span>
                            </div>
                        </a>
                        <!-- CLIENT REVISIONS -->
                        <a
                            href="{{ route('architect.revisions.index') }}"
                            class="task-link"
                        >
                            <div class="task-icon blue-task">
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 4h16v12H7l-3 3z"/>
                                    <path d="M8 8h8"/>
                                    <path d="M8 12h5"/>
                                </svg>
                            </div>
                            <div>
                                <strong>
                                    Client Revisions
                                </strong>
                                <span>
                                    Review requested changes
                                </span>
                            </div>
                        </a>
                    </div>
                    <!-- DESIGN CARD -->
                    <div class="design-card">
                        <div class="design-line"></div>
                        <span>
                            ARCHITRACK
                        </span>
                        <h3>
                            Keep your project workflow organized.
                        </h3>
                        <p>
                            Files, feedback, revisions, and project
                            updates stay connected to the correct
                            workspace.
                        </p>
                        <img
                            src="{{ asset('images/lineart3.png') }}"
                            alt=""
                        >
                    </div>
                </aside>
            </section>
        </div>
    </main>
</div>
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
