<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>Reports Center | ArchiTrack</title>



    @vite([

        'resources/css/app.css',

        'resources/css/dashboard.css',

        'resources/css/admin-sidebar.css',

        'resources/css/admin-reports.css',

        'resources/js/app.js'

    ])


<style>
/* =========================================================
   ARCHITRACK ADMIN REPORTS — REDESIGN
   Presentation-only override. Existing report logic is kept.
========================================================= */
:root {
    --reports-ink: #26313a;
    --reports-muted: #68737c;
    --reports-soft: #8d969d;
    --reports-line: #ddd6ce;
    --reports-line-soft: #ebe5de;
    --reports-paper: rgba(255, 253, 249, .96);
    --reports-paper-solid: #fffdfa;
    --reports-warm: #f97316;
    --reports-warm-dark: #c95f17;
    --reports-warm-soft: #fff2e8;
    --reports-charcoal: #303940;
    --reports-success: #4f8265;
}

.reports-page,
.reports-page *,
.reports-page *::before,
.reports-page *::after {
    box-sizing: border-box;
}

.reports-page {
    width: min(100%, 1560px);
    margin: 0 auto;
    padding: 34px 34px 54px;
    font-family: "Segoe UI", Inter, Arial, sans-serif;
    color: var(--reports-ink);
}

.reports-hero {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 30px;
    min-height: 215px;
    padding: 34px 38px;
    margin-bottom: 22px;
    border: 1px solid var(--reports-line);
    background:
        linear-gradient(90deg, rgba(255,253,249,.98), rgba(255,250,244,.94)),
        repeating-linear-gradient(0deg, transparent 0 31px, rgba(55,65,73,.035) 31px 32px),
        repeating-linear-gradient(90deg, transparent 0 31px, rgba(55,65,73,.035) 31px 32px);
    box-shadow: 0 16px 36px rgba(48, 57, 64, .07);
}

.reports-hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: var(--reports-warm);
}

.reports-hero::after {
    content: "ADMINISTRATIVE REPORT";
    position: absolute;
    right: 28px;
    top: 20px;
    color: rgba(48,57,64,.055);
    font-size: clamp(28px, 4vw, 64px);
    line-height: 1;
    font-weight: 800;
    letter-spacing: .06em;
    white-space: nowrap;
    pointer-events: none;
}

.reports-hero-copy,
.reports-hero-meta {
    position: relative;
    z-index: 1;
}

.reports-code,
.reports-kicker,
.reports-panel-head > div > span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--reports-warm-dark);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .12em;
    text-transform: uppercase;
}

.reports-code::before,
.reports-kicker::before {
    content: "";
    width: 24px;
    height: 2px;
    background: var(--reports-warm);
}

.reports-hero h1 {
    margin: 11px 0 10px;
    color: var(--reports-charcoal);
    font-size: clamp(34px, 4vw, 52px);
    line-height: 1.02;
    letter-spacing: -.035em;
    font-weight: 760;
}

.reports-hero-copy > p {
    max-width: 720px;
    margin: 0;
    color: var(--reports-muted);
    font-size: 14px;
    line-height: 1.7;
}

.reports-hero-meta {
    flex: 0 0 auto;
    min-width: 250px;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    border: 1px solid var(--reports-line);
    background: rgba(255,255,255,.78);
    backdrop-filter: blur(5px);
}

.reports-hero-meta > div {
    min-width: 0;
    padding: 16px 18px;
}

.reports-hero-meta > div + div {
    border-left: 1px solid var(--reports-line);
}

.reports-hero-meta span,
.reports-hero-meta strong {
    display: block;
}

.reports-hero-meta span {
    margin-bottom: 5px;
    color: var(--reports-soft);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .09em;
}

.reports-hero-meta strong {
    color: var(--reports-charcoal);
    font-size: 13px;
    font-weight: 750;
}

.reports-summary-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 22px;
}

.reports-card {
    position: relative;
    overflow: hidden;
    min-height: 158px;
    padding: 21px 22px;
    border: 1px solid var(--reports-line);
    background: var(--reports-paper);
    box-shadow: 0 8px 22px rgba(48,57,64,.045);
}

.reports-card::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, var(--reports-warm), transparent 72%);
}

.reports-card-index {
    position: absolute;
    right: 17px;
    top: 14px;
    color: #d8d0c7;
    font-size: 24px;
    font-weight: 800;
    line-height: 1;
}

.reports-card small {
    display: block;
    padding-right: 44px;
    color: var(--reports-muted);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .09em;
}

.reports-card > strong {
    display: block;
    margin: 12px 0 7px;
    color: var(--reports-charcoal);
    font-size: 32px;
    line-height: 1;
    font-weight: 760;
}

.reports-card p {
    margin: 0;
    color: var(--reports-muted);
    font-size: 12px;
    line-height: 1.5;
}

.reports-filter-panel,
.reports-panel {
    border: 1px solid var(--reports-line);
    background: var(--reports-paper);
    box-shadow: 0 10px 28px rgba(48,57,64,.05);
}

.reports-filter-panel {
    margin-bottom: 22px;
}

.reports-filter-head,
.reports-panel-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 18px 20px;
    border-bottom: 1px solid var(--reports-line-soft);
    background: rgba(250,247,243,.7);
}

.reports-filter-head h2,
.reports-panel-head h3 {
    margin: 5px 0 0;
    color: var(--reports-charcoal);
    line-height: 1.2;
}

.reports-filter-head h2 {
    font-size: 18px;
}

.reports-panel-head h3 {
    font-size: 17px;
}

.reports-filter-badge {
    display: inline-flex;
    align-items: center;
    min-height: 28px;
    padding: 0 10px;
    border: 1px solid #efc29f;
    background: var(--reports-warm-soft);
    color: var(--reports-warm-dark);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .08em;
}

.reports-filter-form {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr)) auto;
    align-items: end;
    gap: 14px;
    padding: 20px;
}

.reports-filter-field {
    min-width: 0;
}

.reports-filter-field label {
    display: block;
    margin-bottom: 7px;
    color: #505b64;
    font-size: 12px;
    font-weight: 700;
}

.reports-filter-field select {
    width: 100%;
    height: 42px;
    padding: 0 36px 0 12px;
    border: 1px solid #d7d0c8;
    border-radius: 2px;
    background: #fff;
    color: var(--reports-ink);
    font: 13px "Segoe UI", Inter, Arial, sans-serif;
    outline: none;
}

.reports-filter-field select:focus {
    border-color: #e89558;
    box-shadow: 0 0 0 3px rgba(249,115,22,.08);
}

.reports-filter-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}

.reports-button,
.reports-clear {
    min-height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 16px;
    border-radius: 2px;
    font-size: 12px;
    font-weight: 750;
    text-decoration: none;
    white-space: nowrap;
}

.reports-button {
    border: 1px solid var(--reports-warm);
    background: var(--reports-warm);
    color: #fff;
    cursor: pointer;
}

.reports-button:hover {
    background: #e8660d;
}

.reports-clear {
    border: 1px solid #d8d1c9;
    background: #fff;
    color: var(--reports-muted);
}

.reports-main-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 20px;
    align-items: start;
}

.reports-primary,
.reports-secondary {
    min-width: 0;
    display: grid;
    gap: 20px;
}

.reports-panel {
    min-width: 0;
    overflow: hidden;
}

.reports-panel-body {
    padding: 20px;
}

.reports-record-count {
    flex: 0 0 auto;
    min-width: 70px;
    padding-left: 18px;
    border-left: 1px solid var(--reports-line);
    text-align: right;
}

.reports-record-count strong,
.reports-record-count span {
    display: block;
}

.reports-record-count strong {
    color: var(--reports-charcoal);
    font-size: 20px;
    line-height: 1;
}

.reports-record-count span {
    margin-top: 4px;
    color: var(--reports-soft);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .08em;
}

.reports-table-wrap {
    width: 100%;
    overflow-x: auto;
    border: 1px solid var(--reports-line-soft);
}

.reports-table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
    background: #fff;
}

.reports-table th {
    padding: 12px 13px;
    border-bottom: 1px solid var(--reports-line);
    background: #f7f4f0;
    color: #707981;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .055em;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
}

.reports-table td {
    padding: 14px 13px;
    border-bottom: 1px solid #eee9e3;
    color: #46515a;
    font-size: 12px;
    line-height: 1.45;
    vertical-align: middle;
}

.reports-table tbody tr:last-child td {
    border-bottom: 0;
}

.reports-table tbody tr:hover {
    background: #fffaf5;
}

.reports-project-name {
    display: block;
    color: var(--reports-charcoal);
    font-size: 13px;
    font-weight: 750;
}

.reports-subtext {
    display: block;
    margin-top: 3px;
    color: var(--reports-soft);
    font-size: 11px;
}

.reports-status {
    display: inline-flex;
    align-items: center;
    min-height: 26px;
    padding: 0 9px;
    border: 1px solid #e3d6c9;
    background: #fff8f1;
    color: #b65a1d;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .035em;
    text-transform: uppercase;
}

.reports-progress-value {
    margin-bottom: 6px;
    color: var(--reports-charcoal);
    font-size: 12px;
    font-weight: 750;
}

.reports-progress-track {
    width: 110px;
    height: 5px;
    overflow: hidden;
    background: #ece8e3;
}

.reports-progress-track span {
    display: block;
    height: 100%;
    background: var(--reports-warm);
}

.reports-workload-list,
.reports-phase-list,
.reports-finance-list {
    display: grid;
}

.reports-workload-row,
.reports-phase-row,
.reports-finance-row {
    border-bottom: 1px solid var(--reports-line-soft);
}

.reports-workload-row:last-child,
.reports-phase-row:last-child,
.reports-finance-row:last-child {
    border-bottom: 0;
}

.reports-workload-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 14px 0;
}

.reports-workload-name {
    min-width: 0;
}

.reports-workload-name strong {
    display: block;
    color: var(--reports-charcoal);
    font-size: 13px;
}

.reports-workload-name span {
    display: block;
    margin-top: 4px;
    color: var(--reports-muted);
    font-size: 11px;
}

.reports-workload-total {
    flex: 0 0 58px;
    min-height: 50px;
    display: grid;
    place-content: center;
    border-left: 3px solid var(--reports-warm);
    background: #faf6f1;
    text-align: center;
}

.reports-workload-total strong {
    color: var(--reports-charcoal);
    font-size: 18px;
    line-height: 1;
}

.reports-workload-total span {
    margin-top: 4px;
    color: var(--reports-soft);
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .08em;
}

.reports-phase-row,
.reports-finance-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 12px 0;
}

.reports-phase-row span,
.reports-finance-row span {
    color: var(--reports-muted);
    font-size: 12px;
}

.reports-phase-row strong,
.reports-finance-row strong {
    color: var(--reports-charcoal);
    font-size: 13px;
}

.reports-phase-row strong {
    min-width: 30px;
    min-height: 28px;
    display: inline-grid;
    place-items: center;
    border: 1px solid #e3dbd2;
    background: #faf7f3;
}

.reports-financial-panel {
    border-top: 3px solid var(--reports-warm);
}

.reports-finance-row-main {
    margin: 7px -20px -20px;
    padding: 16px 20px;
    border: 0;
    background: var(--reports-charcoal);
}

.reports-finance-row-main span,
.reports-finance-row-main strong {
    color: #fff;
}

.reports-finance-row-main strong {
    font-size: 16px;
}

.reports-empty {
    padding: 34px 18px;
    border: 1px dashed #d8d0c7;
    background: #fcfaf7;
    color: var(--reports-muted);
    font-size: 13px;
    text-align: center;
}

@media (max-width: 1250px) {
    .reports-main-grid {
        grid-template-columns: 1fr;
    }

    .reports-secondary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 1050px) {
    .reports-summary-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .reports-filter-form {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .reports-filter-actions {
        grid-column: 1 / -1;
    }
}

@media (max-width: 760px) {
    .reports-page {
        padding: 22px 14px 40px;
    }

    .reports-hero {
        min-height: 0;
        align-items: stretch;
        flex-direction: column;
        padding: 26px 22px;
    }

    .reports-hero::after {
        display: none;
    }

    .reports-hero-meta {
        width: 100%;
        min-width: 0;
    }

    .reports-summary-grid,
    .reports-filter-form,
    .reports-secondary {
        grid-template-columns: 1fr;
    }

    .reports-filter-actions {
        grid-column: auto;
        align-items: stretch;
        flex-direction: column;
    }

    .reports-button,
    .reports-clear {
        width: 100%;
    }

    .reports-filter-head,
    .reports-panel-head {
        align-items: flex-start;
    }

    .reports-card {
        min-height: 140px;
    }
}

@media (max-width: 480px) {
    .reports-hero-meta {
        grid-template-columns: 1fr;
    }

    .reports-hero-meta > div + div {
        border-left: 0;
        border-top: 1px solid var(--reports-line);
    }

    .reports-filter-head {
        flex-direction: column;
    }
}
</style>

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



            <a href="{{ route('admin.financial.index') }}" class="menu-link">

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



            <a href="{{ route('admin.reports.index') }}" class="menu-link active">

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



    {{-- MAIN --}}

    <main class="main-content">



        <div class="reports-page">



            <section class="reports-hero">



                <div class="reports-hero-copy">

                    <span class="reports-code">ARCH-ADM / REPORTING</span>



                    <h1>Reports Center</h1>



                    <p>

                        A consolidated administrative view of project progress,

                        architect workload, phase activity, and financial position.

                    </p>

                </div>



                <div class="reports-hero-meta">

                    <div>

                        <span>REPORT DATE</span>

                        <strong>{{ now('Asia/Manila')->format('M d, Y') }}</strong>

                    </div>



                    <div>

                        <span>STATUS</span>

                        <strong>LIVE DATA</strong>

                    </div>

                </div>



            </section>



            <section class="reports-summary-grid">



                <article class="reports-card">

                    <span class="reports-card-index">01</span>

                    <small>TOTAL PROJECTS</small>

                    <strong>{{ number_format($totalProjects) }}</strong>

                    <p>All projects currently registered in ArchiTrack.</p>

                </article>



                <article class="reports-card">

                    <span class="reports-card-index">02</span>

                    <small>ACTIVE</small>

                    <strong>{{ number_format($activeProjects) }}</strong>

                    <p>Projects currently in active development.</p>

                </article>



                <article class="reports-card">

                    <span class="reports-card-index">03</span>

                    <small>COMPLETED</small>

                    <strong>{{ number_format($completedProjects) }}</strong>

                    <p>Projects already marked as completed.</p>

                </article>



                <article class="reports-card">

                    <span class="reports-card-index">04</span>

                    <small>ARCHIVED</small>

                    <strong>{{ number_format($archivedProjects) }}</strong>

                    <p>Projects retained for administrative reference.</p>

                </article>



            </section>



            <section class="reports-filter-panel">



                <div class="reports-filter-head">

                    <div>

                        <span class="reports-kicker">REPORT PARAMETERS</span>

                        <h2>Filter Project Records</h2>

                    </div>



                    <span class="reports-filter-badge">

                        ADMIN VIEW

                    </span>

                </div>



                <form

                    method="GET"

                    action="{{ route('admin.reports.index') }}"

                    class="reports-filter-form"

                >



                    <div class="reports-filter-field">

                        <label for="status">Project Status</label>



                        <select

                            id="status"

                            name="status"

                        >

                            <option value="">All Statuses</option>

                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>

                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>

                            <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>

                        </select>

                    </div>



                    <div class="reports-filter-field">

                        <label for="architect">Architect</label>



                        <select

                            id="architect"

                            name="architect"

                        >

                            <option value="">All Architects</option>



                            @foreach($architects as $architect)

                                <option

                                    value="{{ $architect->id }}"

                                    {{ (string) request('architect') === (string) $architect->id ? 'selected' : '' }}

                                >

                                    {{ $architect->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    <div class="reports-filter-field">

                        <label for="phase">Current Phase</label>



                        <select

                            id="phase"

                            name="phase"

                        >

                            <option value="">All Phases</option>



                            @foreach($phaseNames as $phaseName)

                                <option

                                    value="{{ $phaseName }}"

                                    {{ request('phase') === $phaseName ? 'selected' : '' }}

                                >

                                    {{ $phaseName }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    <div class="reports-filter-actions">

                        <button

                            type="submit"

                            class="reports-button"

                        >

                            Apply Filters

                        </button>



                        <a

                            href="{{ route('admin.reports.index') }}"

                            class="reports-clear"

                        >

                            Clear

                        </a>

                    </div>



                </form>



            </section>



            <section class="reports-main-grid">



                <div class="reports-primary">



                    <section class="reports-panel reports-panel-large">



                        <div class="reports-panel-head">

                            <div>

                                <span>PROJECT SUMMARY</span>

                                <h3>Project Progress Report</h3>

                            </div>



                            <div class="reports-record-count">

                                <strong>{{ $projects->count() }}</strong>

                                <span>{{ $projects->count() === 1 ? 'RECORD' : 'RECORDS' }}</span>

                            </div>

                        </div>



                        <div class="reports-panel-body">



                            @if($projects->isEmpty())



                                <div class="reports-empty">

                                    No projects matched the selected filters.

                                </div>



                            @else



                                <div class="reports-table-wrap">



                                    <table class="reports-table">



                                        <thead>

                                            <tr>

                                                <th>Project</th>

                                                <th>Lead Architect</th>

                                                <th>Client</th>

                                                <th>Status</th>

                                                <th>Current Phase</th>

                                                <th>Progress</th>

                                                <th>Activity</th>

                                            </tr>

                                        </thead>



                                        <tbody>



                                            @foreach($projects as $project)



                                                @php

                                                    $sortedPhases = $project->phases->sortBy('phase_order');



                                                    $currentPhase = $sortedPhases->first(function ($phase) {

                                                        return strtolower((string) $phase->status) !== 'completed';

                                                    });



                                                    if (!$currentPhase) {

                                                        $currentPhase = $sortedPhases->last();

                                                    }



                                                    $projectProgress = (float) ($project->progress ?? 0);

                                                    $projectProgress = max(0, min(100, $projectProgress));

                                                @endphp



                                                <tr>



                                                    <td>

                                                        <span class="reports-project-name">

                                                            {{ $project->project_name ?? $project->name ?? 'Untitled Project' }}

                                                        </span>



                                                        <span class="reports-subtext">

                                                            Updated {{ optional($project->updated_at)->timezone('Asia/Manila')->format('M d, Y') ?? '—' }}

                                                        </span>

                                                    </td>



                                                    <td>

                                                        {{ $project->architect->name ?? 'Unassigned' }}

                                                    </td>



                                                    <td>

                                                        {{ $project->client->name ?? 'No client assigned' }}

                                                    </td>



                                                    <td>

                                                        <span class="reports-status">

                                                            {{ $project->status ?? 'Unknown' }}

                                                        </span>

                                                    </td>



                                                    <td>

                                                        {{ $currentPhase->phase_name ?? '—' }}

                                                    </td>



                                                    <td>

                                                        <div class="reports-progress-value">

                                                            {{ number_format($projectProgress, 0) }}%

                                                        </div>



                                                        <div class="reports-progress-track">

                                                            <span style="width: {{ $projectProgress }}%;"></span>

                                                        </div>

                                                    </td>



                                                    <td>

                                                        <span class="reports-subtext">

                                                            Files: {{ $project->files_count ?? 0 }}

                                                        </span>



                                                        <span class="reports-subtext">

                                                            Revisions: {{ $project->revisions_count ?? 0 }}

                                                        </span>



                                                        <span class="reports-subtext">

                                                            Meetings: {{ $project->meetings_count ?? 0 }}

                                                        </span>

                                                    </td>



                                                </tr>



                                            @endforeach



                                        </tbody>



                                    </table>



                                </div>



                            @endif



                        </div>



                    </section>



                    <section class="reports-panel">



                        <div class="reports-panel-head">

                            <div>

                                <span>TEAM CAPACITY</span>

                                <h3>Architect Workload</h3>

                            </div>

                        </div>



                        <div class="reports-panel-body">



                            <div class="reports-workload-list">



                                @forelse($architectWorkload as $workload)



                                    <div class="reports-workload-row">



                                        <div class="reports-workload-name">

                                            <strong>{{ $workload['name'] }}</strong>



                                            <span>

                                                Lead: {{ $workload['lead_projects'] }}

                                                · Collaborator: {{ $workload['collaborator_projects'] }}

                                            </span>

                                        </div>



                                        <div class="reports-workload-total">

                                            <strong>{{ $workload['total_projects'] }}</strong>

                                            <span>TOTAL</span>

                                        </div>



                                    </div>



                                @empty



                                    <div class="reports-empty">

                                        No architect accounts found.

                                    </div>



                                @endforelse



                            </div>



                        </div>



                    </section>



                </div>



                <aside class="reports-secondary">



                    <section class="reports-panel">



                        <div class="reports-panel-head">

                            <div>

                                <span>10-PHASE WORKFLOW</span>

                                <h3>Current Phase Distribution</h3>

                            </div>

                        </div>



                        <div class="reports-panel-body">



                            <div class="reports-phase-list">



                                @foreach($phaseSummary as $phaseItem)



                                    <div class="reports-phase-row">

                                        <span>{{ $phaseItem['phase'] }}</span>

                                        <strong>{{ $phaseItem['count'] }}</strong>

                                    </div>



                                @endforeach



                            </div>



                        </div>



                    </section>



                    <section class="reports-panel reports-financial-panel">



                        <div class="reports-panel-head">

                            <div>

                                <span>FINANCIAL SUMMARY</span>

                                <h3>Project Financial Overview</h3>

                            </div>

                        </div>



                        <div class="reports-panel-body">



                            <div class="reports-finance-list">



                                <div class="reports-finance-row">

                                    <span>Total Budget</span>

                                    <strong>₱{{ number_format($totalBudget, 2) }}</strong>

                                </div>



                                <div class="reports-finance-row">

                                    <span>Total Expenses</span>

                                    <strong>₱{{ number_format($totalExpenses, 2) }}</strong>

                                </div>



                                <div class="reports-finance-row reports-finance-row-main">

                                    <span>Remaining Budget</span>

                                    <strong>₱{{ number_format($totalRemaining, 2) }}</strong>

                                </div>



                            </div>



                        </div>



                    </section>



                </aside>



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



    const desktopMedia = window.matchMedia('(min-width: 701px)');



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

            const collapsed =

                localStorage.getItem(

                    'architrackAdminSidebarCollapsed'

                ) === '1';



            setDesktopCollapsed(collapsed);

        } else {

            body.classList.remove('sidebar-collapsed');

        }

    }



    sidebarToggle?.addEventListener(

        'click',

        function () {

            if (desktopMedia.matches) {

                setDesktopCollapsed(

                    !body.classList.contains('sidebar-collapsed')

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



    sidebarBackdrop?.addEventListener(

        'click',

        closeMobileSidebar

    );



    document.addEventListener(

        'keydown',

        function (event) {

            if (

                event.key === 'Escape'

                && body.classList.contains('mobile-sidebar-open')

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
