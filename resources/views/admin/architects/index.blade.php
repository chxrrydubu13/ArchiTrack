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

    <title>Architects | ArchiTrack</title>

    @vite([

        'resources/css/app.css',

        'resources/css/architects.css',

        'resources/css/admin-sidebar.css',

        'resources/js/app.js'

    ])

</head>

<body>

<div class="admin-app">

    {{-- =========================================================

        MOVING ARCHITECTURAL BACKGROUND

    ========================================================== --}}

    <div class="architectural-background">

        <div class="background-grid"></div>

        <div class="moving-draft draft-one">

            <span></span>

            <span></span>

        </div>

        <div class="moving-draft draft-two">

            <span></span>

            <span></span>

        </div>

        <img

            src="{{ asset('images/lineart2.png') }}"

            alt=""

            class="background-lineart"

        >

        <div class="visual-orbit orbit-one">

            <span class="orbit-ring"></span>

            <span class="orbit-dot"></span>

        </div>

        <div class="visual-orbit orbit-two">

            <span class="orbit-ring"></span>

            <span class="orbit-dot"></span>

        </div>

        <div class="scan-line scan-line-one"></div>

        <div class="scan-line scan-line-two"></div>

        <div class="coordinate-cluster cluster-one">

            <span></span>

            <span></span>

            <span></span>

            <span></span>

        </div>

        <div class="coordinate-cluster cluster-two">

            <span></span>

            <span></span>

            <span></span>

            <span></span>

        </div>

    </div>

    {{-- =========================================================

        MOBILE MENU

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

        SAME ADMIN SIDEBAR

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

            class="menu-link active"

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

            class="menu-link"

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

        MAIN CONTENT

    ========================================================== --}}

    <main class="main-content">

        {{-- =====================================================

            FORMAL TOPBAR

        ====================================================== --}}

        <header class="topbar executive-topbar">

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

            <div class="executive-topbar-title">

                <span>

                    ADMINISTRATION / ACCOUNT DIRECTORY

                </span>

                <h1>

                    Architect Accounts

                </h1>

            </div>

            <div class="executive-topbar-user">

                <div class="executive-user-copy">

                    <span>

                        SYSTEM ADMINISTRATOR

                    </span>

                    <strong>

                        {{ auth()->user()->name }}

                    </strong>

                </div>

                <div class="executive-user-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

            </div>

        </header>

        <div class="page-content executive-page">

            {{-- =================================================

                PAGE INTRO

            ================================================== --}}

            <section class="executive-intro">

                <div class="intro-copy">

                    <span class="intro-code">

                        ARCH-ADM / 01

                    </span>

                    <h2>

                        Architect Account Registry

                    </h2>

                    <p>

                        Review registered architect accounts, monitor current access status,

                        and manage account-level administrative actions.

                    </p>

                </div>

                <div class="intro-summary">

                    <div class="summary-block">

                        <span>

                            CURRENT ACCOUNTS

                        </span>

                        <strong>

                            {{ $architects->count() }}

                        </strong>

                    </div>

                    <a href="{{ route('admin.architects.archived') }}" class="executive-add-btn" style="margin-right:10px;">
                        <span>Archived Accounts</span>
                        <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="4" rx="1"></rect><path d="M5 9v11h14V9M10 13h4"></path></svg>
                    </a>
                    <a

                        href="{{ route('admin.architects.create') }}"

                        class="executive-add-btn"

                    >

                        <span>

                            Add Architect

                        </span>

                        <svg viewBox="0 0 24 24">

                            <path d="M12 5v14"></path>

                            <path d="M5 12h14"></path>

                        </svg>

                    </a>

                </div>

            </section>

            {{-- =================================================

                SUCCESS

            ================================================== --}}

            @if(session('success'))

                <div class="executive-alert">

                    <div class="alert-bar"></div>

                    <div>

                        <strong>

                            Account update completed

                        </strong>

                        <p>

                            {{ session('success') }}

                        </p>

                    </div>

                </div>

            @endif

            {{-- =================================================

                REGISTRY BOARD

            ================================================== --}}

            <section class="registry-board">

                <div class="registry-toolbar">

                    <div>

                        <span>

                            ARCHITECT DIRECTORY

                        </span>

                        <h3>

                            Registered Accounts

                        </h3>

                    </div>

                    <div class="registry-status-key">

                        <span>

                            <i class="key-dot active"></i>

                            Active

                        </span>

                        <span>

                            <i class="key-dot inactive"></i>
                            On Hold

                        </span>

                        

                    </div>

                </div>

                <div class="registry-columns">

                    <span>No.</span>

                    <span>Architect</span>

                    <span>Email Address</span>

                    <span>Status</span>

                    <span>Administrative Actions</span>

                </div>

                <div class="registry-list">

                    @forelse($architects as $architect)

                        <article class="registry-item">

                            <div class="registry-number">

                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}

                            </div>

                            <div class="registry-person">

                                <div class="registry-avatar">

                                    {{ strtoupper(substr($architect->name, 0, 1)) }}

                                </div>

                                <div>

                                    <strong>

                                        {{ $architect->name }}

                                    </strong>

                                    <span>

                                        Architect Account

                                    </span>

                                </div>

                            </div>

                            <div class="registry-email">

                                <span class="mobile-label">

                                    Email Address

                                </span>

                                <strong>

                                    {{ $architect->email }}

                                </strong>

                            </div>

                            <div class="registry-status">

                                <span class="mobile-label">

                                    Status

                                </span>

                                @if($architect->status === 'active')

                                    <span class="status-badge status-active">

                                        <i></i>

                                        Active

                                    </span>

                                @elseif($architect->status === 'on_hold')

                                    <span class="status-badge status-suspended">

                                        <i></i>

                                        On Hold

                                    </span>

                                @else

                                    <span class="status-badge status-inactive">

                                        <i></i>

                                        {{ ucfirst($architect->status) }}

                                    </span>

                                @endif

                                

                            </div>

                            <div class="registry-actions">

                                <a

                                    href="{{ route('admin.architects.edit', $architect->id) }}"

                                    class="registry-action primary-action"

                                >

                                    Edit

                                </a>

                                <form

                                    method="POST"

                                    action="{{ route('admin.architects.resetPassword', $architect->id) }}"

                                    onsubmit="return confirm('Reset this architect password and send a new temporary password by email?')"

                                >

                                    @csrf

                                    <button

                                        type="submit"

                                        class="registry-action neutral-action"

                                    >

                                        Reset Password

                                    </button>

                                </form>

                                <form method="POST" action="{{ route('admin.architects.archive', $architect->id) }}"
                                    onsubmit="return confirm('Archive this architect account? Access will be revoked. The account cannot be restored and is scheduled for permanent deletion after 30 days. Project records are retained for Admin.')">
                                    @csrf
                                    <button type="submit" class="registry-action danger-action">Archive</button>
                                </form>

                            </div>

                        </article>

                    @empty

                        <div class="registry-empty">

                            <span class="empty-code">

                                00

                            </span>

                            <h4>

                                No architect accounts available

                            </h4>

                            <p>

                                Create the first architect account to start building the directory.

                            </p>

                            <a

                                href="{{ route('admin.architects.create') }}"

                            >

                                Add Architect

                            </a>

                        </div>

                    @endforelse

                </div>

            </section>

            {{-- =================================================

                FORMAL FOOTER PANEL

            ================================================== --}}

            <section class="executive-footer-panel">

                <div class="footer-copy">

                    <span>

                        ARCHITRACK ADMINISTRATION

                    </span>

                    <h3>

                        Centralized account oversight for the architectural team.

                    </h3>

                </div>

                <div class="footer-linework">

                    <span class="line horizontal-one"></span>

                    <span class="line horizontal-two"></span>

                    <span class="line vertical-one"></span>

                    <span class="footer-node node-a"></span>

                    <span class="footer-node node-b"></span>

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
