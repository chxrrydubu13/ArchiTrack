<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files | ArchiTrack</title>
    @vite([
        'resources/css/app.css',
        'resources/css/architect-dashboard.css',
        'resources/js/app.js'
    ])
<style>
/* =========================================================
   ARCHITECT FILE LIBRARY — DASHBOARD / PROJECTS STANDARD
   Old architect-files.css intentionally not loaded.
\========================================================= */
:root {
    --file-bg: #f4f1ec;
    --file-surface: #fffdf9;
    --file-surface-soft: #f8f4ee;
    --file-border: #ddd5cc;
    --file-border-strong: #cfc5ba;
    --file-text: #283137;
    --file-muted: #778086;
    --file-orange: #f47a1f;
    --file-orange-dark: #c85d16;
    --file-green: #557a64;
    --file-red: #a8564c;
}
/* Main workspace */
.main-content {
    background:
        linear-gradient(rgba(62, 69, 74, .025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(62, 69, 74, .025) 1px, transparent 1px),
        var(--file-bg) !important;
    background-size: 36px 36px !important;
}
.topbar {
    min-height: 76px !important;
    padding: 13px 28px !important;
    border-bottom: 1px solid var(--file-border) !important;
    background: #fffdfa !important;
    box-shadow: none !important;
}
.workspace-label {
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .12em !important;
}
.topbar-heading h1 {
    margin-top: 3px !important;
    color: #273036 !important;
    font-size: 24px !important;
    font-weight: 650 !important;
    letter-spacing: -.03em !important;
}
.top-date {
    padding-left: 18px !important;
    border-left: 1px solid var(--file-border) !important;
}
.top-date span {
    color: var(--file-muted) !important;
    font-size: 13px !important;
}
.top-date strong {
    color: #30383d !important;
    font-size: 14px !important;
}
/* Page */
.files-page {
    width: min(1480px, calc(100% - 48px)) !important;
    margin: 0 auto !important;
    padding: 30px 0 46px !important;
}
/* Hero / intro */
.library-intro {
    position: relative;
    display: grid !important;
    grid-template-columns: minmax(0, 1.2fr) minmax(420px, .8fr) !important;
    align-items: center !important;
    gap: 34px !important;
    min-height: 190px !important;
    margin-bottom: 18px !important;
    padding: 28px 30px !important;
    overflow: hidden;
    border: 1px solid var(--file-border) !important;
    border-radius: 2px !important;
    background:
        linear-gradient(
            92deg,
            #fffdfa 0%,
            #fffdfa 62%,
            #fff6ed 100%
        ) !important;
    box-shadow: none !important;
}
.library-intro::after {
    content: "";
    position: absolute;
    right: 26px;
    bottom: 22px;
    width: 230px;
    height: 90px;
    background:
        linear-gradient(rgba(63,69,74,.075) 1px, transparent 1px),
        linear-gradient(90deg, rgba(63,69,74,.075) 1px, transparent 1px);
    background-size: 18px 18px;
    opacity: .52;
}
.library-title,
.library-counts {
    position: relative;
    z-index: 2;
}
.library-eyebrow {
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .11em !important;
}
.library-title h2 {
    max-width: 680px;
    margin: 7px 0 9px !important;
    color: #263036 !important;
    font-size: 31px !important;
    line-height: 1.08 !important;
    font-weight: 650 !important;
    letter-spacing: -.035em !important;
}
.library-title p {
    max-width: 640px;
    margin: 0 !important;
    color: #717a80 !important;
    font-size: 14px !important;
    line-height: 1.6 !important;
}
/* Metrics */
.library-counts {
    display: grid !important;
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: 10px !important;
}
.library-count {
    position: relative;
    min-height: 86px !important;
    display: grid !important;
    grid-template-columns: 42px minmax(0,1fr) !important;
    grid-template-rows: auto auto !important;
    align-items: center !important;
    gap: 0 11px !important;
    padding: 13px !important;
    border: 1px solid #dfd7cf !important;
    border-radius: 2px !important;
    background: rgba(255,255,255,.78) !important;
    box-shadow: none !important;
}
.metric-icon {
    grid-row: 1 / 3;
    width: 40px !important;
    height: 40px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 0 !important;
    background: #fff0e3 !important;
    color: var(--file-orange-dark) !important;
}
.metric-icon svg {
    width: 18px !important;
    height: 18px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.7 !important;
}
.library-count strong {
    color: #2d353a !important;
    font-size: 24px !important;
    font-weight: 650 !important;
    line-height: 1 !important;
}
.library-count span {
    color: #7a8287 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
}
.metric-pointer,
.metric-node {
    display: none !important;
}
/* Section shells */
.recent-section,
.master-library {
    margin-bottom: 18px !important;
    overflow: hidden;
    border: 1px solid var(--file-border) !important;
    border-radius: 2px !important;
    background: var(--file-surface) !important;
    box-shadow: none !important;
}
.section-heading,
.master-library-heading {
    min-height: 68px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 18px !important;
    padding: 15px 20px !important;
    border-bottom: 1px solid var(--file-border) !important;
    background: #fbf8f4 !important;
}
.section-heading h3,
.master-library-heading h3 {
    margin: 0 !important;
    color: #2d353a !important;
    font-size: 17px !important;
    font-weight: 650 !important;
}
.section-heading p,
.master-library-heading span,
.library-note {
    color: #7c8489 !important;
    font-size: 12px !important;
}
.section-heading a {
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
}
/* Recent uploads */
.recent-files {
    display: grid !important;
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    gap: 10px !important;
    padding: 14px !important;
}
.recent-file-card {
    min-width: 0;
    min-height: 88px !important;
    display: flex !important;
    align-items: center !important;
    gap: 11px !important;
    padding: 12px !important;
    border: 1px solid #e0d8d0 !important;
    border-radius: 2px !important;
    background: #fffdfa !important;
    color: inherit !important;
    text-decoration: none !important;
    transition: .15s ease !important;
}
.recent-file-card:hover {
    border-color: #dfb995 !important;
    background: #fff9f3 !important;
}
.recent-file-type {
    width: 44px !important;
    height: 44px !important;
    flex: 0 0 44px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 0 !important;
    background: #fff0e3 !important;
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
}
.recent-file-info {
    min-width: 0;
}
.recent-file-info strong {
    display: block !important;
    overflow: hidden !important;
    color: #30383d !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    text-overflow: ellipsis !important;
}
.recent-file-info span {
    display: block !important;
    margin-top: 4px !important;
    color: var(--file-orange-dark) !important;
    font-size: 11px !important;
    font-weight: 650 !important;
}
.recent-file-info small {
    display: block !important;
    margin-top: 3px !important;
    color: #8b9296 !important;
    font-size: 11px !important;
}
/* Tabs */
.file-view-tabs {
    display: flex !important;
    gap: 0 !important;
    margin-bottom: 12px !important;
    overflow-x: auto;
    border: 1px solid var(--file-border) !important;
    border-radius: 2px !important;
    background: #f8f4ee !important;
}
.file-view-tabs a {
    min-height: 42px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 17px !important;
    border-right: 1px solid #e1dad2 !important;
    color: #667076 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
}
.file-view-tabs a.active {
    background: #fffdfa !important;
    color: var(--file-orange-dark) !important;
    box-shadow: inset 0 -3px 0 var(--file-orange) !important;
}
/* Filters */
.library-filters {
    display: grid !important;
    grid-template-columns:
        minmax(290px, 1.5fr)
        repeat(4, minmax(130px, .65fr))
        auto
        auto !important;
    align-items: center !important;
    gap: 9px !important;
    margin-bottom: 18px !important;
    padding: 14px !important;
    border: 1px solid var(--file-border) !important;
    border-radius: 2px !important;
    background: var(--file-surface) !important;
}
.library-search {
    position: relative;
}
.library-search svg {
    position: absolute !important;
    left: 12px !important;
    top: 50% !important;
    width: 16px !important;
    height: 16px !important;
    transform: translateY(-50%) !important;
    fill: none !important;
    stroke: #92999d !important;
    stroke-width: 1.7 !important;
}
.library-search input,
.library-filters select {
    width: 100% !important;
    min-height: 40px !important;
    border: 1px solid #d7cfc6 !important;
    border-radius: 2px !important;
    background: #ffffff !important;
    color: #333c41 !important;
    font-family: inherit !important;
    font-size: 12px !important;
    outline: none !important;
}
.library-search input {
    padding: 0 11px 0 37px !important;
}
.library-filters select {
    padding: 0 10px !important;
}
.library-search input:focus,
.library-filters select:focus {
    border-color: #dfa16f !important;
    box-shadow: 0 0 0 2px rgba(244,122,31,.07) !important;
}
.filter-button,
.reset-filter {
    min-height: 40px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 14px !important;
    border-radius: 2px !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
}
.filter-button {
    border: 1px solid var(--file-orange) !important;
    background: var(--file-orange) !important;
    color: #ffffff !important;
}
.filter-button:hover {
    background: #de6818 !important;
}
.reset-filter {
    border: 1px solid #d6cec5 !important;
    background: #ffffff !important;
    color: #606a70 !important;
}
/* Master library */
.master-library {
    overflow: hidden;
}
.master-file-row {
    display: grid !important;
    grid-template-columns: 50px minmax(0,1fr) auto !important;
    align-items: center !important;
    gap: 14px !important;
    min-height: 94px !important;
    padding: 15px 18px !important;
    border-bottom: 1px solid #ebe4dc !important;
    background: #fffdfa !important;
}
.master-file-row:last-child {
    border-bottom: 0 !important;
}
.master-file-row:hover {
    background: #fffaf5 !important;
}
.master-file-icon {
    width: 46px !important;
    height: 46px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 1px solid #e5c7ad !important;
    border-radius: 0 !important;
    background: #fff0e3 !important;
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
}
.master-file-details {
    min-width: 0;
}
.file-title-line {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.file-title-line > strong {
    min-width: 0;
    overflow: hidden !important;
    color: #2f373c !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    text-overflow: ellipsis !important;
}
.file-state {
    flex-shrink: 0;
    padding: 3px 6px !important;
    border-radius: 2px !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
}
.file-state.active {
    border: 1px solid #c9dacd !important;
    background: #f2f7f3 !important;
    color: #4f745c !important;
}
.file-state.archived {
    border: 1px solid #ddd3ca !important;
    background: #f3f0ed !important;
    color: #746e69 !important;
}
.master-project-name {
    display: inline-block !important;
    margin-top: 4px !important;
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 650 !important;
    text-decoration: none !important;
}
.file-metadata {
    display: flex !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 7px !important;
    margin-top: 5px !important;
    color: #8a9195 !important;
    font-size: 11px !important;
}
.file-metadata strong {
    color: #666f74 !important;
}
.metadata-dot {
    width: 3px !important;
    height: 3px !important;
    border-radius: 50% !important;
    background: #bbb4ad !important;
}
/* Actions */
.master-file-actions {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    gap: 7px !important;
}
.master-file-actions form {
    margin: 0 !important;
}
.file-download-button,
.file-project-button,
.file-more-button {
    min-height: 35px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 10px !important;
    border-radius: 2px !important;
    font-family: inherit !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    cursor: pointer !important;
}
.file-download-button {
    border: 1px solid var(--file-orange) !important;
    background: var(--file-orange) !important;
    color: #ffffff !important;
}
.file-project-button,
.file-more-button {
    border: 1px solid #d6cec5 !important;
    background: #ffffff !important;
    color: #5f686d !important;
}
.file-project-button:hover,
.file-more-button:hover {
    border-color: #d8b89e !important;
    background: #fff9f3 !important;
}
/* Empty state */
.master-empty {
    padding: 56px 20px !important;
    text-align: center !important;
}
.master-empty-icon {
    width: 56px !important;
    height: 56px !important;
    margin: 0 auto 14px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 0 !important;
    background: #fff0e3 !important;
    color: var(--file-orange-dark) !important;
}
.master-empty-icon svg {
    width: 24px !important;
    height: 24px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.7 !important;
}
.master-empty h3 {
    margin: 0 !important;
    color: #30383d !important;
    font-size: 16px !important;
}
.master-empty p {
    max-width: 460px;
    margin: 7px auto 0 !important;
    color: #7f878c !important;
    font-size: 13px !important;
    line-height: 1.55 !important;
}
.master-empty a {
    display: inline-flex !important;
    margin-top: 13px !important;
    color: var(--file-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
}
/* Responsive */
@media (max-width: 1250px) {
    .library-intro {
        grid-template-columns: 1fr !important;
    }
    .library-counts {
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    }
    .recent-files {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
    .library-filters {
        grid-template-columns: repeat(4, minmax(120px,1fr)) !important;
    }
    .library-search {
        grid-column: 1 / -1;
    }
}
@media (max-width: 900px) {
    .files-page {
        width: calc(100% - 28px) !important;
    }
    .library-counts,
    .library-filters {
        grid-template-columns: repeat(2, minmax(0,1fr)) !important;
    }
    .library-search {
        grid-column: 1 / -1;
    }
    .master-file-row {
        grid-template-columns: 46px minmax(0,1fr) !important;
    }
    .master-file-actions {
        grid-column: 1 / -1;
        justify-content: flex-start !important;
        flex-wrap: wrap !important;
    }
}
@media (max-width: 700px) {
    .top-date {
        display: none !important;
    }
    .files-page {
        width: calc(100% - 20px) !important;
        padding-top: 18px !important;
    }
    .library-intro {
        padding: 22px 18px !important;
    }
    .library-title h2 {
        font-size: 26px !important;
    }
    .library-counts,
    .recent-files,
    .library-filters {
        grid-template-columns: 1fr !important;
    }
    .library-search {
        grid-column: auto;
    }
}
/* Uniform Architect UI font */
html, body, body *, button, input, select, textarea, option, a, span, p, strong, small, label {
    font-family: "Segoe UI", Arial, sans-serif !important;
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
    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}
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
                    {{ strtoupper(substr($architect->name, 0, 1)) }}
                </div>
                <div class="identity-info">
                    <strong>
                        {{ $architect->name }}
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
    {{-- =====================================================
         MAIN
    ====================================================== --}}
    <main class="main-content">
        {{-- TOPBAR --}}
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
                <h1>File Library</h1>
            </div>
            <div class="top-date">
                <span>
                    {{ now('Asia/Manila')->format('F d, Y') }}
                </span>
                <strong>
                    {{ now('Asia/Manila')->format('h:i A') }} PH
                </strong>
            </div>
        </header>
        <div class="files-page">
            {{-- =====================================================
                 INTRO
            ====================================================== --}}
            <section class="library-intro">
                <div class="library-title">
                    <span class="library-eyebrow">
                        MASTER FILE LIBRARY
                    </span>
                    <h2>
                        All your project files in one place.
                    </h2>
                    <p>
                        Search, organize and access files across all
                        projects assigned to you.
                    </p>
                </div>
                {{-- =================================================
                     OPTION 2 METRICS
                ================================================== --}}
                <div class="library-counts">
                    {{-- TOTAL --}}
                    <div class="library-count metric-total">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 7h6l2 2h10v9H3z"/>
                                <path d="M3 7V5h6l2 2"/>
                            </svg>
                        </div>
                        <strong>{{ $totalCount }}</strong>
                        <span>Total</span>
                        <div class="metric-pointer"></div>
                        <div class="metric-node"></div>
                    </div>
                    {{-- ACTIVE --}}
                    <div class="library-count metric-active">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="8"/>
                                <path d="M8.5 12l2.2 2.2L15.8 9"/>
                            </svg>
                        </div>
                        <strong>{{ $activeCount }}</strong>
                        <span>Active</span>
                        <div class="metric-pointer"></div>
                        <div class="metric-node"></div>
                    </div>
                    {{-- ARCHIVED --}}
                    <div class="library-count metric-archived">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M5 8h14v11H5z"/>
                                <path d="M4 5h16v3H4z"/>
                                <path d="M9 12h6"/>
                            </svg>
                        </div>
                        <strong>{{ $archivedCount }}</strong>
                        <span>Archived</span>
                        <div class="metric-pointer"></div>
                        <div class="metric-node"></div>
                    </div>
                    {{-- THIS WEEK --}}
                    <div class="library-count metric-week">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="4" y="5" width="16" height="15" rx="2"/>
                                <path d="M8 3v4"/>
                                <path d="M16 3v4"/>
                                <path d="M4 10h16"/>
                                <path d="M8 14h2"/>
                                <path d="M12 14h2"/>
                                <path d="M16 14h1"/>
                            </svg>
                        </div>
                        <strong>{{ $recentCount }}</strong>
                        <span>This Week</span>
                        <div class="metric-pointer"></div>
                        <div class="metric-node"></div>
                    </div>
                </div>
            </section>
            {{-- =====================================================
                 RECENT UPLOADS
            ====================================================== --}}
            @if($recentFiles->count() > 0)
                <section class="recent-section">
                    <div class="section-heading">
                        <div>
                            <h3>Recent Uploads</h3>
                            <p>Latest files across your projects</p>
                        </div>
                        <a
                            href="{{ route('architect.files.index', [
                                'view' => 'recent'
                            ]) }}"
                        >
                            View recent files
                        </a>
                    </div>
                    <div class="recent-files">
                        @foreach($recentFiles as $file)
                            @php
                                $recentExtension = strtolower(
                                    pathinfo(
                                        $file->original_name ?? '',
                                        PATHINFO_EXTENSION
                                    )
                                );
                            @endphp
                            <a
                                href="{{ route(
                                    'project.files.secure.download',
                                    [
                                        'projectId' => $file->project_id,
                                        'fileId' => $file->id
                                    ]
                                ) }}"
                                class="recent-file-card"
                            >
                                <div class="recent-file-type">
                                    {{ strtoupper(
                                        substr(
                                            $recentExtension ?: 'FILE',
                                            0,
                                            3
                                        )
                                    ) }}
                                </div>
                                <div class="recent-file-info">
                                    <strong
                                        title="{{ $file->original_name }}"
                                    >
                                        {{ $file->original_name ?? 'Untitled File' }}
                                    </strong>
                                    <span>
                                        {{ $file->project_data->project_name ?? 'Project' }}
                                    </span>
                                    <small>
                                        {{ optional($file->created_at)->diffForHumans() }}
                                    </small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
            {{-- =====================================================
                 QUICK VIEW TABS
            ====================================================== --}}
            <nav class="file-view-tabs">
                <a
                    href="{{ route('architect.files.index', [
                        'view' => 'all'
                    ]) }}"
                    class="{{ $view === 'all' ? 'active' : '' }}"
                >
                    All Files
                </a>
                <a
                    href="{{ route('architect.files.index', [
                        'view' => 'recent'
                    ]) }}"
                    class="{{ $view === 'recent' ? 'active' : '' }}"
                >
                    Recent
                </a>
                <a
                    href="{{ route('architect.files.index', [
                        'view' => 'images'
                    ]) }}"
                    class="{{ $view === 'images' ? 'active' : '' }}"
                >
                    Images
                </a>
                <a
                    href="{{ route('architect.files.index', [
                        'view' => 'documents'
                    ]) }}"
                    class="{{ $view === 'documents' ? 'active' : '' }}"
                >
                    Documents
                </a>
                <a
                    href="{{ route('architect.files.index', [
                        'view' => 'archived'
                    ]) }}"
                    class="{{ $view === 'archived' ? 'active' : '' }}"
                >
                    Archived
                </a>
            </nav>
            {{-- =====================================================
                 FILTERS
            ====================================================== --}}
            <form
                method="GET"
                action="{{ route('architect.files.index') }}"
                class="library-filters"
            >
                <input
                    type="hidden"
                    name="view"
                    value="{{ $view }}"
                >
                {{-- SEARCH --}}
                <div class="library-search">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="M20 20l-4-4"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search file, project or uploader..."
                    >
                </div>
                {{-- PROJECT --}}
                <select name="project">
                    <option value="">
                        All Projects
                    </option>
                    @foreach($projects as $project)
                        <option
                            value="{{ $project->id }}"
                            {{ (string) $projectId === (string) $project->id ? 'selected' : '' }}
                        >
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
                {{-- TYPE --}}
                <select name="type">
                    <option value="">
                        All Types
                    </option>
                    <option
                        value="image"
                        {{ $type === 'image' ? 'selected' : '' }}
                    >
                        Images
                    </option>
                    <option
                        value="document"
                        {{ $type === 'document' ? 'selected' : '' }}
                    >
                        Documents
                    </option>
                    <option
                        value="pdf"
                        {{ $type === 'pdf' ? 'selected' : '' }}
                    >
                        PDF
                    </option>
                    <option
                        value="other"
                        {{ $type === 'other' ? 'selected' : '' }}
                    >
                        Other
                    </option>
                </select>
                {{-- STATUS --}}
                <select name="status">
                    <option value="">
                        Any Status
                    </option>
                    <option
                        value="active"
                        {{ $status === 'active' ? 'selected' : '' }}
                    >
                        Active
                    </option>
                    <option
                        value="archived"
                        {{ $status === 'archived' ? 'selected' : '' }}
                    >
                        Archived
                    </option>
                </select>
                {{-- SORT --}}
                <select name="sort">
                    <option
                        value="newest"
                        {{ $sort === 'newest' ? 'selected' : '' }}
                    >
                        Newest
                    </option>
                    <option
                        value="oldest"
                        {{ $sort === 'oldest' ? 'selected' : '' }}
                    >
                        Oldest
                    </option>
                    <option
                        value="name"
                        {{ $sort === 'name' ? 'selected' : '' }}
                    >
                        File Name
                    </option>
                    <option
                        value="project"
                        {{ $sort === 'project' ? 'selected' : '' }}
                    >
                        Project
                    </option>
                </select>
                <button
                    type="submit"
                    class="filter-button"
                >
                    Apply
                </button>
                @if(
                    $search ||
                    $projectId ||
                    $type ||
                    $status ||
                    $sort !== 'newest'
                )
                    <a
                        href="{{ route('architect.files.index', [
                            'view' => $view
                        ]) }}"
                        class="reset-filter"
                    >
                        Reset
                    </a>
                @endif
            </form>
            {{-- =====================================================
                 MASTER LIBRARY
            ====================================================== --}}
            <section class="master-library">
                <div class="master-library-heading">
                    <div>
                        <h3>
                            @if($view === 'recent')
                                Recent Files
                            @elseif($view === 'images')
                                Images
                            @elseif($view === 'documents')
                                Documents
                            @elseif($view === 'archived')
                                Archived Files
                            @else
                                All Files
                            @endif
                        </h3>
                        <span>
                            {{ $allFiles->count() }}
                            {{ $allFiles->count() === 1 ? 'file' : 'files' }}
                        </span>
                    </div>
                    <div class="library-note">
                        Files from
                        {{ $projects->count() }}
                        {{ $projects->count() === 1 ? 'project' : 'projects' }}
                    </div>
                </div>
                {{-- =================================================
                     FILE ROWS
                ================================================== --}}
                @forelse($allFiles as $file)
                    @php
                        $extension = strtolower(
                            pathinfo(
                                $file->original_name ?? '',
                                PATHINFO_EXTENSION
                            )
                        );
                        $displayType = strtoupper(
                            $extension ?: 'FILE'
                        );
                        $isArchived = (bool) $file->is_archived;
                        $size = null;
                        if (isset($file->file_size) && $file->file_size) {
                            if ($file->file_size >= 1048576) {
                                $size = number_format(
                                    $file->file_size / 1048576,
                                    1
                                ) . ' MB';
                            } elseif ($file->file_size >= 1024) {
                                $size = number_format(
                                    $file->file_size / 1024,
                                    1
                                ) . ' KB';
                            } else {
                                $size = $file->file_size . ' B';
                            }
                        }
                    @endphp
                    <article class="master-file-row">
                        {{-- FILE TYPE --}}
                        <div class="master-file-icon">
                            {{ substr($displayType, 0, 3) }}
                        </div>
                        {{-- FILE DETAILS --}}
                        <div class="master-file-details">
                            <div class="file-title-line">
                                <strong
                                    title="{{ $file->original_name }}"
                                >
                                    {{ $file->original_name ?? 'Untitled File' }}
                                </strong>
                                @if($isArchived)
                                    <span class="file-state archived">
                                        Archived
                                    </span>
                                @else
                                    <span class="file-state active">
                                        Active
                                    </span>
                                @endif
                            </div>
                            <a
                                href="{{ route(
                                    'architect.projects.show',
                                    $file->project_id
                                ) }}"
                                class="master-project-name"
                            >
                                {{ $file->project_data->project_name ?? 'Project' }}
                            </a>
                            <div class="file-metadata">
                                <span>
                                    Uploaded by
                                    <strong>
                                        {{ $file->uploader->name ?? 'Unknown' }}
                                    </strong>
                                </span>
                                <span class="metadata-dot"></span>
                                <span>
                                    {{ optional($file->created_at)->format('M d, Y') }}
                                </span>
                                <span class="metadata-dot"></span>
                                <span>
                                    {{ $displayType }}
                                </span>
                                @if($size)
                                    <span class="metadata-dot"></span>
                                    <span>
                                        {{ $size }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- ACTIONS --}}
                        <div class="master-file-actions">
                            <a
                                href="{{ route(
                                    'project.files.secure.download',
                                    [
                                        'projectId' => $file->project_id,
                                        'fileId' => $file->id
                                    ]
                                ) }}"
                                class="file-download-button"
                            >
                                Download
                            </a>
                            <a
                                href="{{ route(
                                    'architect.projects.show',
                                    $file->project_id
                                ) }}"
                                class="file-project-button"
                            >
                                View Project
                            </a>
                            @if($isArchived)
                                <form
                                    method="POST"
                                    action="{{ route(
                                        'architect.projects.files.restore',
                                        [
                                            'id' => $file->project_id,
                                            'file' => $file->id
                                        ]
                                    ) }}"
                                >
                                    @csrf
                                    <button
                                        type="submit"
                                        class="file-more-button"
                                    >
                                        Restore
                                    </button>
                                </form>
                            @else
                                <form
                                    method="POST"
                                    action="{{ route(
                                        'architect.projects.files.archive',
                                        [
                                            'id' => $file->project_id,
                                            'file' => $file->id
                                        ]
                                    ) }}"
                                    onsubmit="return confirm('Archive this file?')"
                                >
                                    @csrf
                                    <button
                                        type="submit"
                                        class="file-more-button"
                                    >
                                        Archive
                                    </button>
                                </form>
                            @endif
                        </div>
                    </article>
                @empty
                    {{-- =================================================
                         EMPTY STATE
                    ================================================== --}}
                    <div class="master-empty">
                        <div class="master-empty-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 6h6l2 2h10v10H3z"/>
                            </svg>
                        </div>
                        <h3>No files found</h3>
                        <p>
                            @if(
                                $search ||
                                $projectId ||
                                $type ||
                                $status ||
                                $view !== 'all'
                            )
                                No files match the selected filters.
                                Try changing or resetting them.
                            @else
                                Files uploaded inside your project
                                workspaces will appear here.
                            @endif
                        </p>
                        @if(
                            $search ||
                            $projectId ||
                            $type ||
                            $status ||
                            $view !== 'all'
                        )
                            <a href="{{ route('architect.files.index') }}">
                                Show all files
                            </a>
                        @endif
                    </div>
                @endforelse
            </section>
        </div>
    </main>
</div>
    @include('partials.session-timeout-warning')
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
