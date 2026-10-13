<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Financial Overview | ArchiTrack</title>

    @vite([
        'resources/css/app.css',
        'resources/css/dashboard.css',
        'resources/css/admin-sidebar.css',
        'resources/css/admin-financial.css',
        'resources/js/app.js'
    ])
</head>

<body>
<div class="admin-app">

    {{-- ARCHITECTURAL BACKGROUND --}}
    <div class="architectural-background">
        <div class="blueprint-left">
            <div class="blueprint-grid"></div>
        </div>

        <img
            src="{{ asset('images/lineart2.png') }}"
            alt=""
            class="right-building-lineart"
        >
    </div>

    {{-- MOBILE SIDEBAR BUTTON --}}
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

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="adminSidebar">
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
                <strong>{{ auth()->user()->name }}</strong>
                <span>System Administrator</span>
            </div>

            <span class="admin-online-dot"></span>
        </div>

        <div class="sidebar-divider"></div>

        <nav class="admin-sidebar-nav">
            <p class="menu-title">MAIN</p>

            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                    </svg>
                </span>
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.architects.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M2 21a7 7 0 0 1 14 0"></path>
                        <circle cx="17" cy="8" r="3"></circle>
                        <path d="M16 14a6 6 0 0 1 6 6"></path>
                    </svg>
                </span>
                <span class="menu-text">Architects</span>
            </a>

            <a href="{{ route('admin.projects.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 7h7l2 2h9v10H3z"></path>
                        <path d="M3 7V5h7l2 2"></path>
                    </svg>
                </span>
                <span class="menu-text">Projects Overview</span>
            </a>

            <p class="menu-title">PLANNED</p>

            <a href="{{ route('admin.financial.index') }}" class="menu-link active">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V10"></path>
                        <path d="M10 20V4"></path>
                        <path d="M16 20v-7"></path>
                        <path d="M22 20V7"></path>
                    </svg>
                </span>
                <span class="menu-text">Financial Overview</span>
            </a>

            <a href="{{ route('admin.reports.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M6 3h9l4 4v14H6z"></path>
                        <path d="M15 3v5h5"></path>
                        <path d="M9 12h6"></path>
                        <path d="M9 16h6"></path>
                    </svg>
                </span>
                <span class="menu-text">Reports Center</span>
            </a>

            <p class="menu-title">MONITORING</p>

            <a href="{{ route('admin.audit-logs.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="4" width="14" height="17" rx="2"></rect>
                        <path d="M9 4V2h6v2"></path>
                        <path d="M9 9h6"></path>
                        <path d="M9 13h6"></path>
                        <path d="M9 17h4"></path>
                    </svg>
                </span>
                <span class="menu-text">Audit Logs</span>
            </a>

            <a href="{{ route('admin.bearo-analytics.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 19h16"></path>
                        <path d="M6 16l3-5 3 2 4-7 2 3"></path>
                    </svg>
                </span>
                <span class="menu-text">Bearo Analytics</span>
            </a>

            <p class="menu-title">ACCOUNT</p>

            <a href="{{ route('admin.bearo-settings.edit') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M5 5h14v10H9l-4 4z"></path>
                        <path d="M8 9h8"></path>
                        <path d="M8 12h5"></path>
                    </svg>
                </span>
                <span class="menu-text">Bearo Settings</span>
            </a>

            <a href="{{ route('admin.settings') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3"></circle>
                        <circle cx="12" cy="12" r="8"></circle>
                    </svg>
                </span>
                <span class="menu-text">Settings</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf

            <button type="submit" class="logout-btn">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M10 17l5-5-5-5"></path>
                        <path d="M15 12H3"></path>
                        <path d="M13 4h7v16h-7"></path>
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

    {{-- MAIN CONTENT --}}
    <main class="main-content">

        <header class="topbar financial-topbar">
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

            <div class="financial-topbar-copy">
                <span>PROJECT FINANCIAL MONITORING</span>
                <h1>Financial Overview</h1>
            </div>

            <div class="financial-topbar-meta">
                <div>
                    <span>{{ now('Asia/Manila')->format('l, F j, Y') }}</span>
                    <strong>{{ now('Asia/Manila')->format('h:i A') }} PH</strong>
                </div>

                <div class="financial-admin-chip">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <div class="financial-content">

            <section class="financial-command">
                <div class="financial-command-copy">
                    <span class="financial-kicker">ARCH-ADM / FINANCIAL CONTROL</span>
                    <h2>Project Financial Control Board</h2>
                    <p>
                        Monitor every project budget, recorded expense, and remaining
                        balance from one administrative workspace.
                    </p>
                </div>

                <div class="financial-command-stamp">
                    <span>MODE</span>
                    <strong>READ ONLY</strong>
                    <small>Administrative oversight</small>
                </div>
            </section>

            <section class="financial-metrics">
                <article class="financial-metric">
                    <span class="metric-code">01 / BUDGET</span>
                    <small>TOTAL BUDGET</small>
                    <strong>₱{{ number_format($totalBudget, 2) }}</strong>
                    <p>Combined approved project budgets.</p>
                </article>

                <article class="financial-metric">
                    <span class="metric-code">02 / SPEND</span>
                    <small>TOTAL EXPENSES</small>
                    <strong>₱{{ number_format($totalExpenses, 2) }}</strong>
                    <p>Expenses already recorded across projects.</p>
                </article>

                <article class="financial-metric">
                    <span class="metric-code">03 / BALANCE</span>
                    <small>REMAINING</small>
                    <strong class="{{ $totalRemaining < 0 ? 'negative-value' : '' }}">
                        ₱{{ number_format($totalRemaining, 2) }}
                    </strong>
                    <p>Available amount after recorded expenses.</p>
                </article>

                <article class="financial-metric">
                    <span class="metric-code">04 / COVERAGE</span>
                    <small>PROJECTS WITH BUDGET</small>
                    <strong>{{ $projectsWithBudget }}</strong>
                    <p>Out of {{ $projects->count() }} registered projects.</p>
                </article>
            </section>

            <section class="financial-board">
                <div class="financial-board-head">
                    <div>
                        <span class="financial-kicker">PROJECT LEDGER</span>
                        <h3>Budget & Expense Registry</h3>
                        <p>Current financial position of every project.</p>
                    </div>

                    <div class="financial-board-count">
                        <strong>{{ $projects->count() }}</strong>
                        <span>{{ Str::plural('PROJECT', $projects->count()) }}</span>
                    </div>
                </div>

                @if($projects->count() > 0)
                    <div class="financial-table-wrap">
                        <table class="financial-table">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Lead Architect</th>
                                    <th>Client</th>
                                    <th>Budget</th>
                                    <th>Expenses</th>
                                    <th>Remaining</th>
                                    <th>Usage</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($projects as $project)
                                    @php
                                        $budget = $project->budget !== null
                                            ? (float) $project->budget
                                            : null;

                                        $expenses = (float) (
                                            $project->expenses_sum_amount ?? 0
                                        );

                                        $remaining = $budget !== null
                                            ? $budget - $expenses
                                            : null;

                                        $usagePercent = $budget && $budget > 0
                                            ? min(
                                                100,
                                                round(($expenses / $budget) * 100)
                                            )
                                            : 0;

                                        $clientName =
                                            $project->client?->name
                                            ?? $project->client_name
                                            ?? 'Not assigned';
                                    @endphp

                                    <tr>
                                        <td>
                                            <div class="financial-project">
                                                <span class="financial-project-no">
                                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                                </span>

                                                <div>
                                                    <strong>{{ $project->project_name }}</strong>
                                                    <small>
                                                        Updated {{ $project->updated_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            {{ $project->architect?->name ?? 'Not assigned' }}
                                        </td>

                                        <td>
                                            {{ $clientName }}
                                        </td>

                                        <td>
                                            @if($budget !== null)
                                                <strong class="money-value">
                                                    ₱{{ number_format($budget, 2) }}
                                                </strong>
                                            @else
                                                <span class="financial-not-set">Not set</span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong class="money-value">
                                                ₱{{ number_format($expenses, 2) }}
                                            </strong>
                                        </td>

                                        <td>
                                            @if($remaining !== null)
                                                <strong class="money-value {{ $remaining < 0 ? 'negative-value' : '' }}">
                                                    ₱{{ number_format($remaining, 2) }}
                                                </strong>
                                            @else
                                                <span class="financial-not-set">—</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($budget !== null && $budget > 0)
                                                <div class="budget-usage">
                                                    <div class="budget-usage-track">
                                                        <span
                                                            class="{{ $expenses > $budget ? 'over-budget' : '' }}"
                                                            style="width: {{ $usagePercent }}%;"
                                                        ></span>
                                                    </div>

                                                    <strong>{{ $usagePercent }}%</strong>
                                                </div>
                                            @else
                                                <span class="financial-not-set">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="financial-empty">
                        <span>00</span>
                        <h4>No projects available</h4>
                        <p>
                            Project financial records will appear here once projects
                            are available in ArchiTrack.
                        </p>
                    </div>
                @endif
            </section>

            <section class="financial-footnote">
                <div class="financial-footnote-number">05</div>

                <div>
                    <span>FINANCIAL DATA</span>
                    <h3>Administrative monitoring only</h3>
                    <p>
                        This page displays project budget and expense records without
                        changing the architect or client workflow.
                    </p>
                </div>
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

    const desktopMedia = window.matchMedia('(min-width: 701px)');

    function setDesktopCollapsed(collapsed) {
        if (!desktopMedia.matches) {
            return;
        }

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
            'architrackAdminSidebarCollapsed',
            collapsed ? '1' : '0'
        );
    }

    function openMobileSidebar() {
        if (desktopMedia.matches) {
            return;
        }

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
                    'architrackAdminSidebarCollapsed'
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
            && body.classList.contains('mobile-sidebar-open')
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

@include('partials.session-timeout-warning')
</body>
</html>
