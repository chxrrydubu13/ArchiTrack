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

    <title>Audit Logs | ArchiTrack</title>

    @vite([

        'resources/css/app.css',

        'resources/css/auditlogs.css',

        'resources/css/admin-sidebar.css',

        'resources/js/app.js'

    ])

    <style>
        /* Audit Logs: consistent spacing and column alignment. */
        .audit-page { padding-bottom: 36px; }
        .audit-heading { gap: 20px; }
        .audit-filter-panel { margin-bottom: 24px; }
        .audit-filter-form { gap: 16px; }
        .filter-field { min-width: 0; }
        .filter-field input, .filter-field select { box-sizing: border-box; width: 100%; }
        .audit-registry-head { margin-bottom: 16px; }
        .audit-columns, .audit-row {
            display: grid;
            grid-template-columns: minmax(155px, 1.15fr) minmax(130px, 1fr) minmax(120px, .9fr) minmax(145px, 1fr) minmax(200px, 1.7fr);
            column-gap: 20px;
            align-items: center;
        }
        .audit-columns { padding: 15px 22px; }
        .audit-row { padding: 18px 22px; row-gap: 12px; }
        .audit-columns > *, .audit-row > * { min-width: 0; }
        .audit-user { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .audit-user > div:last-child { min-width: 0; overflow-wrap: anywhere; }
        .audit-action, .audit-date, .audit-project, .audit-details { min-width: 0; overflow-wrap: anywhere; }
        .audit-details { line-height: 1.55; }
        .pagination-area { margin-top: 22px; }
        @media (max-width: 1050px) {
            .audit-columns, .audit-row { column-gap: 12px; }
            .audit-columns { padding: 14px 16px; }
            .audit-row { padding: 16px; }
        }
        @media (max-width: 800px) {
            .audit-columns { display: none; }
            .audit-row { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px 18px; }
            .audit-user { grid-column: 1 / -1; }
            .audit-details { grid-column: 1 / -1; }
        }
        @media (max-width: 480px) {
            .audit-row { grid-template-columns: minmax(0, 1fr); }
            .audit-user, .audit-details { grid-column: auto; }
        }
    </style>
</head>

<body>

<div class="admin-app">

    {{-- =========================================================

        BACKGROUND

    ========================================================== --}}

    <div class="architectural-background">

        <div class="background-grid"></div>

        <img

            src="{{ asset('images/lineart2.png') }}"

            alt=""

            class="background-lineart"

        >

    </div>

    {{-- =========================================================

        MOBILE SIDEBAR BUTTON

    ========================================================== --}}

    <button

        type="button"

        class="mobile-sidebar-launcher"

        id="mobileSidebarLauncher"

        aria-label="Open navigation"

        aria-controls="adminSidebar"

        aria-expanded="false"

    >

        <svg viewBox="0 0 24 24">

            <path d="M4 6h16"></path>

            <path d="M4 12h16"></path>

            <path d="M4 18h16"></path>

        </svg>

    </button>

    {{-- =========================================================

        SIDEBAR

    ========================================================== --}}

    <aside

        class="sidebar"

        id="adminSidebar"

    >

        <div class="sidebar-top">

            <a

                href="{{ route('admin.dashboard') }}"

                class="sidebar-logo"

                aria-label="ArchiTrack Admin Dashboard"

            >

                <img

                    src="{{ asset('images/arlogo.jpg') }}"

                    alt="ArchiTrack"

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

                    <path d="M15 18l-6-6 6-6"></path>

                </svg>

            </button>

        </div>

        <div class="admin-identity">

            <div class="admin-avatar">

                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

            </div>

            <div class="admin-identity-copy">

                <strong>

                    {{ auth()->user()->name }}

                </strong>

                <span>

                    System Administrator

                </span>

            </div>

            <span class="admin-online-dot"></span>

        </div>

        <div class="sidebar-divider"></div>

        <nav class="admin-sidebar-nav">

            <p class="menu-title">

                MAIN

            </p>

        <a

            href="{{ route('admin.dashboard') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <rect x="3" y="3" width="7" height="7" rx="1"></rect>

        <rect x="14" y="3" width="7" height="7" rx="1"></rect>

        <rect x="3" y="14" width="7" height="7" rx="1"></rect>

        <rect x="14" y="14" width="7" height="7" rx="1"></rect>

    </svg>

            </span>

            <span class="menu-text">

                Dashboard

            </span>

        </a>

        <a

            href="{{ route('admin.architects.index') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <circle cx="9" cy="7" r="4"></circle>

        <path d="M2 21a7 7 0 0 1 14 0"></path>

        <circle cx="17" cy="8" r="3"></circle>

        <path d="M16 14a6 6 0 0 1 6 6"></path>

    </svg>

            </span>

            <span class="menu-text">

                Architects

            </span>

        </a>

        <a

            href="{{ route('admin.projects.index') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <path d="M3 7h7l2 2h9v10H3z"></path>

        <path d="M3 7V5h7l2 2"></path>

    </svg>

            </span>

            <span class="menu-text">

                Projects Overview

            </span>

        </a>

            <p class="menu-title">

                PLANNED

            </p>

        <a

            href="{{ route('admin.financial.index') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <path d="M4 20V10"></path>

        <path d="M10 20V4"></path>

        <path d="M16 20v-7"></path>

        <path d="M22 20V7"></path>

    </svg>

            </span>

            <span class="menu-text">

                Financial Overview

            </span>

        </a>

        <a

            href="{{ route('admin.reports.index') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

                    <path d="M6 3h9l4 4v14H6z"></path>

                    <path d="M15 3v5h5"></path>

                    <path d="M9 12h6"></path>

                    <path d="M9 16h6"></path>

                </svg>

            </span>

            <span class="menu-text">

                Reports Center

            </span>

        </a>

            <p class="menu-title">

                MONITORING

            </p>

        <a

            href="{{ route('admin.audit-logs.index') }}"

            class="menu-link active"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <rect x="5" y="4" width="14" height="17" rx="2"></rect>

        <path d="M9 4V2h6v2"></path>

        <path d="M9 9h6"></path>

        <path d="M9 13h6"></path>

        <path d="M9 17h4"></path>

    </svg>

            </span>

            <span class="menu-text">

                Audit Logs

            </span>

        </a>

        <a

            href="{{ route('admin.bearo-analytics.index') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <path d="M4 19h16"></path>

        <path d="M6 16l3-5 3 2 4-7 2 3"></path>

    </svg>

            </span>

            <span class="menu-text">

                Bearo Analytics

            </span>

        </a>

            <p class="menu-title">

                ACCOUNT

            </p>

        <a

            href="{{ route('admin.bearo-settings.edit') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <path d="M5 5h14v10H9l-4 4z"></path>

        <path d="M8 9h8"></path>

        <path d="M8 12h5"></path>

    </svg>

            </span>

            <span class="menu-text">

                Bearo Settings

            </span>

        </a>

        <a

            href="{{ route('admin.settings') }}"

            class="menu-link"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

        <circle cx="12" cy="12" r="3"></circle>

        <circle cx="12" cy="12" r="8"></circle>

    </svg>

            </span>

            <span class="menu-text">

                Settings

            </span>

        </a>

        </nav>

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

        <path d="M10 17l5-5-5-5"></path>

        <path d="M15 12H3"></path>

        <path d="M13 4h7v16h-7"></path>

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

    ========================================================== --}}

    <main class="main-content">

        {{-- TOPBAR --}}

        <header class="topbar audit-topbar">

            <button

                type="button"

                class="topbar-menu-button"

                id="topbarMenuButton"

                aria-label="Open navigation"

            >

                <svg viewBox="0 0 24 24">

                    <path d="M4 6h16"></path>

                    <path d="M4 12h16"></path>

                    <path d="M4 18h16"></path>

                </svg>

            </button>

            <div class="audit-topbar-copy">

                <span>

                    SYSTEM MONITORING

                </span>

                <h1>

                    Audit Logs

                </h1>

            </div>

            <div class="audit-topbar-user">

                <div>

                    <span>

                        SYSTEM ADMINISTRATOR

                    </span>

                    <strong>

                        {{ auth()->user()->name }}

                    </strong>

                </div>

                <div class="audit-topbar-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

            </div>

        </header>

        <div class="page-content audit-page">

            {{-- PAGE INTRO --}}

            <section class="audit-heading">

                <div>

                    <span class="audit-code">

                        ARCH-ADM / MONITOR

                    </span>

                    <h2>

                        System Activity Registry

                    </h2>

                    <p>

                        Review recorded user actions, account changes,

                        project activity, revisions, meetings, uploads,

                        and other monitored events across ArchiTrack.

                    </p>

                </div>

                <div class="audit-total">

                    <span>

                        TOTAL RECORDS

                    </span>

                    <strong>

                        {{ $logs->total() }}

                    </strong>

                </div>

            </section>

            {{-- FILTERS --}}

            <section class="audit-filter-panel">

                <div class="filter-heading">

                    <div>

                        <span>

                            FILTER REGISTRY

                        </span>

                        <h3>

                            Search Audit Records

                        </h3>

                    </div>

                </div>

                <form

                    method="GET"

                    action="{{ route('admin.audit-logs.index') }}"

                    class="audit-filter-form"

                >

                    <div class="filter-field search-field">

                        <label for="search">

                            Search Logs

                        </label>

                        <div class="filter-input-wrap">

                            <span class="filter-input-icon">

                                <svg viewBox="0 0 24 24">

                                    <circle cx="11" cy="11" r="7"></circle>

                                    <path d="M20 20l-4-4"></path>

                                </svg>

                            </span>

                            <input

                                type="text"

                                id="search"

                                name="search"

                                value="{{ request('search') }}"

                                maxlength="100"

                                placeholder="Search user, action, project, or details..."

                            >

                        </div>

                    </div>

                    <div class="filter-field">

                        <label for="action">

                            Action

                        </label>

                        <select

                            id="action"

                            name="action"

                        >

                            <option value="">

                                All Actions

                            </option>

                            @isset($actions)

                                @foreach($actions as $actionOption)

                                    <option

                                        value="{{ $actionOption }}"

                                        {{ request('action') === $actionOption ? 'selected' : '' }}

                                    >

                                        {{ ucwords(str_replace(['_', '-'], ' ', $actionOption)) }}

                                    </option>

                                @endforeach

                            @endisset

                        </select>

                    </div>

                    <div class="filter-field">

                        <label for="role">

                            User Role

                        </label>

                        <select

                            id="role"

                            name="role"

                        >

                            <option value="">

                                All Roles

                            </option>

                            <option

                                value="admin"

                                {{ request('role') === 'admin' ? 'selected' : '' }}

                            >

                                Admin

                            </option>

                            <option

                                value="architect"

                                {{ request('role') === 'architect' ? 'selected' : '' }}

                            >

                                Architect

                            </option>

                            <option

                                value="client"

                                {{ request('role') === 'client' ? 'selected' : '' }}

                            >

                                Client

                            </option>

                        </select>

                    </div>

                    <div class="filter-field">

                        <label for="date">

                            Date

                        </label>

                        <input

                            type="date"

                            id="date"

                            name="date"

                            value="{{ request('date') }}"

                            max="{{ now('Asia/Manila')->format('Y-m-d') }}"

                        >

                    </div>

                    <div class="filter-buttons">

                        <button

                            type="submit"

                            class="filter-button"

                        >

                            Apply Filters

                        </button>

                        <a

                            href="{{ route('admin.audit-logs.index') }}"

                            class="clear-filter-button"

                        >

                            Clear

                        </a>

                    </div>

                </form>

                @if(

                    request('search') ||

                    request('action') ||

                    request('role') ||

                    request('date')

                )

                    <div class="filter-result-info">

                        <span>

                            FILTERED RESULT

                        </span>

                        <strong>

                            {{ $logs->total() }}

                            {{ $logs->total() === 1 ? 'record' : 'records' }}

                        </strong>

                    </div>

                @endif

            </section>

            {{-- AUDIT REGISTRY --}}

            <section class="audit-registry">

                <div class="audit-registry-head">

                    <div>

                        <span>

                            SYSTEM RECORDS

                        </span>

                        <h3>

                            Recent Audit Logs

                        </h3>

                        <p>

                            @if(

                                request('search') ||

                                request('action') ||

                                request('role') ||

                                request('date')

                            )

                                Audit records matching your selected filters.

                            @else

                                Latest recorded actions from registered users.

                            @endif

                        </p>

                    </div>

                </div>

                <div class="audit-columns">

                    <span>Updated By</span>

                    <span>Action</span>

                    <span>Date & Time</span>

                    <span>Affected Project</span>

                    <span>Details</span>

                </div>

                <div class="audit-list">

                    @forelse($logs as $log)

                        @php

                            $actionText = strtolower($log->action ?? '');

                        @endphp

                        <article class="audit-row">

                            <div class="audit-user">

                                <div class="user-avatar">

                                    {{ !empty($log->user_name)

                                        ? strtoupper(substr($log->user_name, 0, 1))

                                        : 'S'

                                    }}

                                </div>

                                <div>

                                    <strong>

                                        {{ $log->user_name ?? 'System' }}

                                    </strong>

                                    <span>

                                        @if($log->user && $log->user->role)

                                            {{ ucfirst($log->user->role) }}

                                        @else

                                            System

                                        @endif

                                    </span>

                                </div>

                            </div>

                            <div class="audit-action">

                                @if(str_contains($actionText, 'login'))

                                    <span class="action-badge login-action">

                                        {{ $log->action }}

                                    </span>

                                @elseif(str_contains($actionText, 'logout'))

                                    <span class="action-badge logout-action">

                                        {{ $log->action }}

                                    </span>

                                @elseif(

                                    str_contains($actionText, 'upload') ||

                                    str_contains($actionText, 'file')

                                )

                                    <span class="action-badge upload-action">

                                        {{ $log->action }}

                                    </span>

                                @elseif(str_contains($actionText, 'revision'))

                                    <span class="action-badge revision-action">

                                        {{ $log->action }}

                                    </span>

                                @elseif(str_contains($actionText, 'meeting'))

                                    <span class="action-badge meeting-action">

                                        {{ $log->action }}

                                    </span>

                                @elseif(

                                    str_contains($actionText, 'account') ||

                                    str_contains($actionText, 'architect') ||

                                    str_contains($actionText, 'client')

                                )

                                    <span class="action-badge account-action">

                                        {{ $log->action }}

                                    </span>

                                @else

                                    <span class="action-badge default-action">

                                        {{ $log->action ?? 'Activity' }}

                                    </span>

                                @endif

                            </div>

                            <div class="audit-date">

                                <strong>

                                    {{ optional($log->created_at)

                                        ?->timezone('Asia/Manila')

                                        ?->format('M d, Y')

                                        ?? '—'

                                    }}

                                </strong>

                                <span>

                                    {{ optional($log->created_at)

                                        ?->timezone('Asia/Manila')

                                        ?->format('h:i A')

                                        ?? ''

                                    }}

                                    @if($log->created_at)

                                        PH Time

                                    @endif

                                </span>

                            </div>

                            <div class="audit-project">

                                @if(!empty($log->project_name))

                                    <strong>

                                        {{ $log->project_name }}

                                    </strong>

                                    <span>

                                        Project-related activity

                                    </span>

                                @elseif($log->project)

                                    <strong>

                                        {{ $log->project->project_name ?? 'Project' }}

                                    </strong>

                                    <span>

                                        Project-related activity

                                    </span>

                                @else

                                    <span class="no-project">

                                        —

                                    </span>

                                @endif

                            </div>

                            <div class="audit-details">

                                {{ !empty($log->details)

                                    ? $log->details

                                    : 'No additional details.'

                                }}

                            </div>

                        </article>

                    @empty

                        <div class="audit-empty">

                            <span class="empty-code">

                                00

                            </span>

                            @if(

                                request('search') ||

                                request('action') ||

                                request('role') ||

                                request('date')

                            )

                                <h4>

                                    No matching audit logs

                                </h4>

                                <p>

                                    No records matched your current filters.

                                    Clear the filters to show all available audit logs.

                                </p>

                                <a

                                    href="{{ route('admin.audit-logs.index') }}"

                                    class="clear-empty-filter"

                                >

                                    Clear Filters

                                </a>

                            @else

                                <h4>

                                    No audit logs yet

                                </h4>

                                <p>

                                    Login activity, account updates,

                                    uploads, revisions, meetings,

                                    and other monitored actions will appear here.

                                </p>

                            @endif

                        </div>

                    @endforelse

                </div>

                @if($logs->hasPages())

                    <div class="pagination-area">

                        {{ $logs->withQueryString()->links() }}

                    </div>

                @endif

            </section>

        </div>

    </main>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;

    const sidebar = document.getElementById('adminSidebar');

    const sidebarToggle = document.getElementById('sidebarToggle');

    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    const mobileSidebarLauncher = document.getElementById('mobileSidebarLauncher');

    const topbarMenuButton = document.getElementById('topbarMenuButton');

    const desktopMedia =

        window.matchMedia('(min-width: 701px)');

    function setDesktopCollapsed(collapsed) {

        if (!desktopMedia.matches) {

            return;

        }

        body.classList.toggle(

            'sidebar-collapsed',

            collapsed

        );

        sidebarToggle?.setAttribute(

            'aria-expanded',

            collapsed ? 'false' : 'true'

        );

        sidebarToggle?.setAttribute(

            'aria-label',

            collapsed

                ? 'Maximize sidebar'

                : 'Minimize sidebar'

        );

        localStorage.setItem(

            'architrackAdminSidebarCollapsed',

            collapsed ? '1' : '0'

        );

    }

    function openMobileSidebar() {

        if (desktopMedia.matches) {

            return;

        }

        body.classList.add(

            'mobile-sidebar-open'

        );

        mobileSidebarLauncher?.setAttribute(

            'aria-expanded',

            'true'

        );

    }

    function closeMobileSidebar() {

        body.classList.remove(

            'mobile-sidebar-open'

        );

        mobileSidebarLauncher?.setAttribute(

            'aria-expanded',

            'false'

        );

    }

    function syncSidebarForViewport() {

        closeMobileSidebar();

        if (desktopMedia.matches) {

            const collapsed =

                localStorage.getItem(

                    'architrackAdminSidebarCollapsed'

                ) === '1';

            setDesktopCollapsed(collapsed);

        } else {

            body.classList.remove(

                'sidebar-collapsed'

            );

        }

    }

    sidebarToggle?.addEventListener(

        'click',

        function () {

            if (desktopMedia.matches) {

                setDesktopCollapsed(

                    !body.classList.contains(

                        'sidebar-collapsed'

                    )

                );

            } else {

                closeMobileSidebar();

            }

        }

    );

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

    document.addEventListener(

        'keydown',

        function (event) {

            if (

                event.key === 'Escape'

                &&

                body.classList.contains(

                    'mobile-sidebar-open'

                )

            ) {

                closeMobileSidebar();

            }

        }

    );

    sidebar?.querySelectorAll('a').forEach(

        function (link) {

            link.addEventListener(

                'click',

                function () {

                    if (!desktopMedia.matches) {

                        closeMobileSidebar();

                    }

                }

            );

        }

    );

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
