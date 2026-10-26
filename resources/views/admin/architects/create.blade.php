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
    <title>Add Architect | ArchiTrack</title>
    @vite([
        'resources/css/app.css',
        'resources/css/architects.css',
        'resources/css/create-architect.css',
        'resources/css/admin-sidebar.css',
        'resources/js/app.js'
    ])
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
            <a href="{{ route('admin.architects.index') }}" class="menu-link active">
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

    {{-- =========================================================
        MAIN
    ========================================================== --}}

    <main class="main-content">
        {{-- TOPBAR --}}
        <header class="topbar create-topbar">
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
            <div class="create-topbar-copy">
                <span>
                    ACCOUNT MANAGEMENT
                </span>
                <h1>
                    Add Architect
                </h1>
            </div>
            <div class="create-topbar-user">
                <div>
                    <span>
                        SYSTEM ADMINISTRATOR
                    </span>
                    <strong>
                        {{ auth()->user()->name }}
                    </strong>
                </div>
                <div class="create-topbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>
        <div class="page-content create-page">
            {{-- PAGE INTRO --}}
            <section class="create-page-heading">
                <div>
                    <span class="create-page-code">
                        ARCH-ADM / NEW
                    </span>
                    <h2>
                        Create Architect Account
                    </h2>
                    <p>
                        Add a new architect to ArchiTrack. A temporary password
                        will be generated and sent to the registered email address.
                    </p>
                </div>
                <a
                    href="{{ route('admin.architects.index') }}"
                    class="back-btn"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6"></path>
                    </svg>
                    Back to Directory
                </a>
            </section>
            {{-- VALIDATION --}}
            @if ($errors->any())
                <div class="error-box">
                    <span class="error-bar"></span>
                    <div>
                        <strong>
                            Please check the information you entered.
                        </strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            {{-- CREATE WORKSPACE --}}
            <section class="create-workspace">
                <div class="create-form-panel">
                    <div class="panel-heading">
                        <span>
                            NEW ACCOUNT
                        </span>
                        <h3>
                            Architect Information
                        </h3>
                        <p>
                            Enter the required account details below.
                        </p>
                    </div>
                    <form
                        method="POST"
                        action="{{ route('admin.architects.store') }}"
                        class="create-form"
                    >
                        @csrf
                        <div class="form-grid">
                            {{-- FULL NAME --}}
                            <div class="form-group">
                                <label for="name">
                                    Full Name
                                    <span>\*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Example: Juan Dela Cruz"
                                    minlength="2"
                                    maxlength="100"
                                    autocomplete="name"
                                    title="Use letters and standard name separators. No numbers or symbols."
                                    required
                                >
                                <small>
                                    Use your full name. Letters, spaces, apostrophes, periods, and hyphens are accepted; numbers and symbols are not.
                                </small>
                                @error('name')
                                    <p class="input-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            {{-- EMAIL --}}
                            <div class="form-group">
                                <label for="email">
                                    Email Address
                                    <span>\*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Example: architect@email.com"
                                    maxlength="255"
                                    autocomplete="email"
                                    required
                                >
                                <small>
                                    Temporary login credentials will be sent here.
                                </small>
                                @error('email')
                                    <p class="input-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-actions">
                            <a
                                href="{{ route('admin.architects.index') }}"
                                class="cancel-btn"
                            >
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="create-btn"
                            >
                                <svg viewBox="0 0 24 24">
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M2 21a7 7 0 0 1 14 0"></path>
                                    <path d="M19 8v6"></path>
                                    <path d="M16 11h6"></path>
                                </svg>
                                Create Architect Account
                            </button>
                        </div>
                    </form>
                </div>
                {{-- SIDE INFORMATION --}}
                <aside class="create-side-panel">
                    <div class="account-info">
                        <span class="account-info-label">
                            ACCOUNT DEFAULTS
                        </span>
                        <div class="info-row">
                            <span>
                                Role
                            </span>
                            <strong>
                                Architect
                            </strong>
                        </div>
                        <div class="info-row">
                            <span>
                                Status
                            </span>
                            <strong class="active-default">
                                <i></i>
                                Active
                            </strong>
                        </div>
                        <div class="info-row">
                            <span>
                                Password
                            </span>
                            <strong>
                                Temporary
                            </strong>
                        </div>
                    </div>
                    <div class="account-note">
                        <div class="note-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M12 11v5"></path>
                                <path d="M12 8h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>
                                Account Information
                            </strong>
                            <p>
                                The architect will receive a temporary password
                                and will be required to change it during the first login.
                            </p>
                        </div>
                    </div>
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
