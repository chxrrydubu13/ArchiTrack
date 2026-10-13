<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0"

    >

    <title>Projects | ArchiTrack</title>

    @vite([

        'resources/css/app.css',

        'resources/css/architect-dashboard.css',

        'resources/css/architect-projects.css',

        'resources/js/app.js'

    ])

    <style>
        html, body, button, input, textarea, select, option {
            font-family: "Segoe UI", Inter, Arial, sans-serif;
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

        <div class="architect-identity">

            <div class="identity-top">

                <div class="identity-avatar">

                    {{ strtoupper(substr($user->name, 0, 1)) }}

                </div>

                <div class="identity-info">

                    <strong>{{ $user->name }}</strong>

                    <span>Architect</span>

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

        <p class="menu-title">WORKSPACE</p>

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

            <span class="menu-text">Dashboard</span>

        </a>

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

            <span class="menu-text">Projects</span>

        </a>
<p class="menu-title">PROJECT TOOLS</p>

        <a

            href="{{ route('architect.files.index') }}"

            class="menu-link {{ request()->routeIs('architect.files.*') ? 'active' : '' }}"

        >

            <span class="menu-icon">

                <svg viewBox="0 0 24 24">

                    <path d="M3 6h6l2 2h10v10H3z"/>

                </svg>

            </span>

            <span class="menu-text">Files</span>

        </a>

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

            <span class="menu-text">Revisions</span>

        </a>

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

            <span class="menu-text">Meetings</span>

        </a>

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

            <span class="menu-text">Reports</span>

        </a>

        <p class="menu-title">ACCOUNT</p>

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

            <span class="menu-text">Settings</span>

        </a>

        <form

            method="POST"

            action="{{ route('logout') }}"

            class="logout-form"

        >

            @csrf

            <button type="submit" class="logout-btn">

                <span class="menu-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="M10 17l5-5-5-5"/>

                        <path d="M15 12H3"/>

                        <path d="M13 4h7v16h-7"/>

                    </svg>

                </span>

                <span class="menu-text">Log Out</span>

            </button>

        </form>

    </aside>

    <button

        type="button"

        class="sidebar-backdrop"

        id="sidebarBackdrop"

        aria-label="Close navigation"

    ></button>

    <!-- MAIN -->

    <main class="main-content">

        <!-- HEADER -->

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

            <div>

                <span class="workspace-label">

                    PROJECT WORKSPACE

                </span>

                <h1>

                    My Projects

                </h1>

                <p>

                    Manage project progress, client collaboration,

                    files, and revisions.

                </p>

            </div>

            <a

    href="{{ route('architect.projects.create') }}"

    class="create-project-btn"

>

    <svg viewBox="0 0 24 24">

        <path d="M12 5v14"/>

        <path d="M5 12h14"/>

    </svg>

    Create Project

</a>

        </header>

        <!-- CONTENT -->

        <div class="page-content">

            <!-- PROJECT SUMMARY -->

            <section class="summary-row">

                <div class="summary-box">

                    <span>

                        ALL PROJECTS

                    </span>

                    <strong class="orange-text">

                        {{ $totalProjects }}

                    </strong>

                    <p>

                        Total project workspaces

                    </p>

                </div>

                <div class="summary-box">

                    <span>

                        PLANNING

                    </span>

                    <strong class="brown-text">

                        {{ $planningProjects }}

                    </strong>

                    <p>

                        Preparing project requirements

                    </p>

                </div>

                <div class="summary-box">

                    <span>

                        ONGOING

                    </span>

                    <strong class="green-text">

                        {{ $ongoingProjects }}

                    </strong>

                    <p>

                        Currently active projects

                    </p>

                </div>

                <div class="summary-box">

                    <span>

                        COMPLETED

                    </span>

                    <strong class="blue-text">

                        {{ $completedProjects }}

                    </strong>

                    <p>

                        Finished project workspaces

                    </p>

                </div>

            </section>

            <!-- PROJECT PANEL -->

            <section class="projects-panel">

                <div class="panel-heading">

                    <div>

                        <span class="small-label">

                            PROJECT DIRECTORY

                        </span>

                        <h2>

                            Architectural Projects

                        </h2>

                        <p>

                            View and manage projects connected to your account.

                        </p>

                    </div>

                </div>

                <!-- FILTERS -->

                <form

                    method="GET"

                    action="{{ route('architect.projects.index') }}"

                    class="project-filters"

                >

                    <div class="search-box">

                        <span class="search-icon">

                            <svg viewBox="0 0 24 24">

                                <circle cx="11" cy="11" r="7"/>

                                <path d="M20 20l-4-4"/>

                            </svg>

                        </span>

                        <input

                            type="text"

                            name="search"

                            value="{{ request('search') }}"

                            placeholder="Search project or client..."

                        >

                    </div>

                    <select name="status">

                        <option

                            value="all"

                            {{ request('status', 'all') === 'all' ? 'selected' : '' }}

                        >

                            All Status

                        </option>

                        <option

                            value="planning"

                            {{ request('status') === 'planning' ? 'selected' : '' }}

                        >

                            Planning

                        </option>

                        <option

                            value="ongoing"

                            {{ request('status') === 'ongoing' ? 'selected' : '' }}

                        >

                            Ongoing

                        </option>

                        <option

                            value="completed"

                            {{ request('status') === 'completed' ? 'selected' : '' }}

                        >

                            Completed

                        </option>

                        <option

                            value="on_hold"

                            {{ request('status') === 'on_hold' ? 'selected' : '' }}

                        >

                            On Hold

                        </option>

                    </select>

                    <button

                        type="submit"

                        class="filter-btn"

                    >

                        Filter

                    </button>

                    @if(request()->filled('search') || (request('status') && request('status') !== 'all'))

                        <a

                            href="{{ route('architect.projects.index') }}"

                            class="clear-btn"

                        >

                            Clear

                        </a>

                    @endif

                </form>

                <!-- PROJECT CARDS -->

                @if($projects->count() > 0)

                    <div class="projects-grid">

                        @foreach($projects as $project)

                            <article class="project-card">

                                <!-- IMAGE -->

                                <div class="project-cover">

                                    @if(!empty($project->project_image))

                                        <img

                                            src="{{ asset('uploads/projects/' . $project->project_image) }}"

                                            alt="{{ $project->project_name }}"

                                        >

                                    @else

                                        <div class="default-cover">

                                            <div class="cover-grid"></div>

                                            <img

                                                src="{{ asset('images/lineart2.png') }}"

                                                alt=""

                                            >

                                            <span>

                                                ARCHITRACK PROJECT

                                            </span>

                                        </div>

                                    @endif

                                    <div

                                        class="status-badge

                                        status-{{ $project->status ?? 'planning' }}"

                                    >

                                        {{ ucfirst(

                                            str_replace(

                                                '_',

                                                ' ',

                                                $project->status ?? 'planning'

                                            )

                                        ) }}

                                    </div>

                                </div>

                                <!-- CARD BODY -->

                                <div class="project-card-body">

                                    <span class="project-type">

                                        ARCHITECTURAL PROJECT

                                    </span>

                                    <h3>

                                        {{ $project->project_name }}

                                    </h3>

                                    <div class="client-row">

                                        <div class="client-avatar">

                                            {{ !empty($project->client_name)

                                                ? strtoupper(substr($project->client_name, 0, 1))

                                                : 'C'

                                            }}

                                        </div>

                                        <div>

                                            <span>

                                                Client

                                            </span>

                                            <strong>

                                                {{ $project->client_name ?? 'No client assigned' }}

                                            </strong>

                                        </div>

                                    </div>

                                    <!-- PROGRESS -->

                                    <div class="progress-section">

                                        <div class="progress-heading">

                                            <span>

                                                Project Progress

                                            </span>

                                            <strong>

                                                {{ $project->progress ?? 0 }}%

                                            </strong>

                                        </div>

                                        <div class="progress-track">

                                            <div

                                                class="progress-value"

                                                style="width: {{ min(100, max(0, $project->progress ?? 0)) }}%;"

                                            ></div>

                                        </div>

                                    </div>

                                    <!-- DATES -->

                                    <div class="project-dates">

                                        <div>

                                            <span>

                                                START DATE

                                            </span>

                                            <strong>

                                                @if($project->start_date)

                                                    {{ \Carbon\Carbon::parse($project->start_date)

                                                        ->format('M d, Y')

                                                    }}

                                                @else

                                                    Not set

                                                @endif

                                            </strong>

                                        </div>

                                        <div>

                                            <span>

                                                TARGET DATE

                                            </span>

                                            <strong>

                                                @if($project->target_date)

                                                    {{ \Carbon\Carbon::parse($project->target_date)

                                                        ->format('M d, Y')

                                                    }}

                                                @else

                                                    Not set

                                                @endif

                                            </strong>

                                        </div>

                                    </div>

                                    <!-- ACTION -->

                                    <a

                                        href="{{ route('architect.projects.show', $project->id) }}"

                                        class="open-project-btn"

                                    >

                                        Open Project Workspace

                                        <span>

                                            →

                                        </span>

                                    </a>

                                </div>

                            </article>

                        @endforeach

                    </div>

                    @if($projects->hasPages())

                        <div class="pagination-area">

                            {{ $projects->links() }}

                        </div>

                    @endif

                @else

                    <!-- EMPTY STATE -->

                    <div class="empty-projects">

                        <div class="empty-visual">

                            <div class="empty-circle"></div>

                            <img

                                src="{{ asset('images/lineart1.png') }}"

                                alt=""

                            >

                        </div>

                        <div class="empty-content">

                            <span>

                                PROJECT WORKSPACE

                            </span>

                            <h3>

                                No projects found

                            </h3>

                            @if(request()->filled('search') || (request('status') && request('status') !== 'all'))

                                <p>

                                    No projects match your current search or filter.

                                </p>

                                <a

                                    href="{{ route('architect.projects.index') }}"

                                    class="empty-button"

                                >

                                    Clear Filters

                                </a>

                            @else

                                <p>

                                    Create your first project workspace to organize

                                    project information, files, revisions, and client collaboration.

                                </p>

                                <a

                                    href="#"

                                    class="empty-button"

                                >

                                    Create First Project

                                </a>

                            @endif

                        </div>

                    </div>

                @endif

            </section>

        </div>

    </main>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;

    const sidebarToggle = document.getElementById('sidebarToggle');

    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    const mobileSidebarLauncher = document.getElementById('mobileSidebarLauncher');

    const topbarMenuButton = document.getElementById('topbarMenuButton');

    const desktopMedia = window.matchMedia('(min-width: 701px)');

    function setDesktopCollapsed(collapsed) {

        if (!desktopMedia.matches) return;

        body.classList.toggle('sidebar-collapsed', collapsed);

        sidebarToggle?.setAttribute(

            'aria-expanded',

            collapsed ? 'false' : 'true'

        );

        sidebarToggle?.setAttribute(

            'aria-label',

            collapsed ? 'Maximize sidebar' : 'Minimize sidebar'

        );

        localStorage.setItem(

            'architrackArchitectSidebarCollapsed',

            collapsed ? '1' : '0'

        );

    }

    function openMobileSidebar() {

        if (desktopMedia.matches) return;

        body.classList.add('mobile-sidebar-open');

        mobileSidebarLauncher?.setAttribute('aria-expanded', 'true');

    }

    function closeMobileSidebar() {

        body.classList.remove('mobile-sidebar-open');

        mobileSidebarLauncher?.setAttribute('aria-expanded', 'false');

    }

    function syncSidebarForViewport() {

        closeMobileSidebar();

        if (desktopMedia.matches) {

            setDesktopCollapsed(

                localStorage.getItem(

                    'architrackArchitectSidebarCollapsed'

                ) === '1'

            );

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

    if (desktopMedia.addEventListener) {

        desktopMedia.addEventListener(

            'change',

            syncSidebarForViewport

        );

    } else {

        desktopMedia.addListener(syncSidebarForViewport);

    }

    syncSidebarForViewport();

});

</script>

</body>

</html>
