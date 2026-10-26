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

    <title>Archived Architects | ArchiTrack</title>

    @vite([

        'resources/css/app.css',

        'resources/css/architects.css',

        'resources/css/admin-sidebar.css',

        'resources/js/app.js'

    ])

<style>
.archive-notice{background:#fffaf3;border:1px solid #f1d5ac;border-left:4px solid #e28b2d;border-radius:12px;padding:18px 22px;margin:20px 0 26px;color:#6b4a27}
.archive-notice strong{display:block;font-size:14px;margin-bottom:6px}.archive-notice p{font-size:13px;line-height:1.6;margin:0}
.archive-total{font-size:12px;font-weight:700;color:#a35c19;background:#fff3e6;border-radius:30px;padding:8px 13px}
.archive-table-wrap{width:100%;overflow-x:auto}.archive-table{width:100%;border-collapse:collapse;text-align:left;min-width:860px}
.archive-table th{padding:16px 18px;background:#fff8f0;color:#876448;font-size:11px;letter-spacing:.08em;text-transform:uppercase;font-weight:700}
.archive-table td{padding:19px 18px;border-top:1px solid #ece9e4;color:#393939;font-size:13px;vertical-align:middle}
.archive-person{display:flex;align-items:center;gap:11px}.archive-person strong{display:block}.archive-person small,.archive-subline{display:block;color:#8a8a8a;font-size:11px;margin-top:5px}
.archive-avatar{width:38px;height:38px;display:grid;place-items:center;border-radius:12px;background:#fff0de;color:#bd6919;font-weight:800;flex-shrink:0}
.archive-email{overflow-wrap:anywhere}.archive-delete-disabled{border:1px solid #e2dfda;border-radius:8px;padding:10px 12px;background:#f5f5f5;color:#888;cursor:not-allowed;font-size:12px;font-weight:700;white-space:nowrap}
.archive-empty{text-align:center;padding:55px 18px!important}.archive-empty p{margin:8px 0 0;color:#888}.archive-pagination{padding:20px}
@media(max-width:700px){.archive-table{min-width:0}.archive-table thead{display:none}.archive-table tr{display:block;border-top:1px solid #eee;padding:10px 0}.archive-table td{display:flex;justify-content:space-between;align-items:flex-start;gap:15px;border:0;padding:10px 16px;text-align:right}.archive-table td:before{content:attr(data-label);font-weight:700;color:#8c7866;text-align:left;flex-shrink:0}.archive-table td.archive-empty{display:block;text-align:center}.archive-table td.archive-empty:before{display:none}.archive-person{text-align:left}}
</style>
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

            <a href="{{ route('admin.architects.archived') }}" class="menu-link active">
            <span class="menu-icon"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="15" rx="2"></rect><path d="M3 9h18M9 13h6"></path></svg></span>
            <span class="menu-text">Archived Accounts</span>
        </a>
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
        <header class="topbar executive-topbar">
            <button type="button" class="topbar-menu-button" id="topbarMenuButton" aria-label="Open navigation">
                <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="executive-topbar-title"><span>ADMINISTRATION / ARCHIVED ACCOUNTS</span><h1>Archived Architects</h1></div>
            <div class="executive-topbar-user">
                <div class="executive-user-copy"><span>SYSTEM ADMINISTRATOR</span><strong>{{ auth()->user()->name }}</strong></div>
                <div class="executive-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </header>
        <div class="page-content executive-page">
            <section class="executive-intro">
                <div class="intro-copy">
                    <span class="intro-code">ARCH-ADM / ARCHIVE</span>
                    <h2>Archived Account Registry</h2>
                    <p>View archived architect accounts and their 30-day retention timeline. Archived accounts cannot be reactivated.</p>
                </div>
                <div class="intro-summary">
                    <div class="summary-block"><span>ARCHIVED</span><strong>{{ $architects->total() }}</strong></div>
                    <a href="{{ route('admin.architects.index') }}" class="executive-add-btn">← Architect Directory</a>
                </div>
            </section>

            @if(session('success'))
                <div class="executive-alert"><div class="alert-bar"></div><div><strong>Account update completed</strong><p>{{ session('success') }}</p></div></div>
            @endif

            <section class="archive-notice" role="note">
                <strong>Account deletion safeguards</strong>
                <p>Accounts become eligible for permanent deletion 30 days after archiving. Actual deletion is not enabled yet. Project history and files must remain protected and accessible to administrators only before deletion can be activated.</p>
            </section>

            <section class="registry-board">
                <div class="registry-toolbar">
                    <div><span>ACCOUNT RETENTION</span><h3>Archived Accounts</h3></div>
                    <span class="archive-total">{{ $architects->total() }} archived</span>
                </div>
                <div class="archive-table-wrap">
                    <table class="archive-table">
                        <thead><tr><th>No.</th><th>Architect</th><th>Email Address</th><th>Archived On</th><th>Deletion Eligible</th><th>Action</th></tr></thead>
                        <tbody>
                            @forelse($architects as $architect)
                                @php
                                    $archivedAt = $architect->archived_at ? \Illuminate\Support\Carbon::parse($architect->archived_at) : null;
                                    $eligibleAt = $archivedAt ? $archivedAt->copy()->addDays(30) : null;
                                    $daysLeft = $eligibleAt ? max(0, (int) now()->diffInDays($eligibleAt, false)) : null;
                                @endphp
                                <tr>
                                    <td data-label="No.">{{ str_pad(($architects->firstItem() ?? 1) + $loop->index, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td data-label="Architect"><div class="archive-person"><span class="archive-avatar">{{ strtoupper(substr($architect->name, 0, 1)) }}</span><div><strong>{{ $architect->name }}</strong><small>Archived architect</small></div></div></td>
                                    <td data-label="Email"><span class="archive-email">{{ $architect->email }}</span></td>
                                    <td data-label="Archived On">{{ $archivedAt ? $archivedAt->format('M d, Y') : 'Not recorded' }}</td>
                                    <td data-label="Deletion Eligible">
                                        <strong>{{ $eligibleAt ? $eligibleAt->format('M d, Y') : 'Not scheduled' }}</strong>
                                        @if($eligibleAt)
                                            <small class="archive-subline">{{ $eligibleAt->isPast() ? 'Retention period reached' : $daysLeft . ' day(s) remaining' }}</small>
                                        @endif
                                    </td>
                                    <td data-label="Action"><button class="archive-delete-disabled" type="button" disabled title="Available after project access safeguards are verified">Delete Immediately</button><small class="archive-subline">Not enabled yet</small></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="archive-empty"><strong>No archived accounts yet.</strong><p>Architect accounts you archive will appear here.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($architects->hasPages())
                    <div class="archive-pagination">{{ $architects->links() }}</div>
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
