<!DOCTYPE html>



<html lang="en">







<head>



    <meta charset="UTF-8">







    <meta name="csrf-token" content="{{ csrf_token() }}">







    <meta



        name="viewport"



        content="width=device-width, initial-scale=1.0"



    >







    <title>Admin Dashboard | ArchiTrack</title>





        @vite([
        'resources/css/app.css',
        'resources/css/dashboard.css',
        'resources/css/admin-sidebar.css',
        'resources/js/app.js',
    ])  



</head>







<body>







<div class="admin-app">







    {{-- =========================================================



        CLIENT-THEME ARCHITECTURAL BACKGROUND



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







        <div class="bottom-dimension">



            <span></span>



            <small>7.50 m</small>



        </div>







    </div>











    {{-- =========================================================



        MOBILE FLOATING MENU BUTTON



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



        FLOATING SIDEBAR



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



            class="menu-link active"



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



        MAIN



    ========================================================== --}}







    <main class="main-content">







        {{-- =====================================================



            TOPBAR



        ====================================================== --}}







        <header class="topbar admin-studio-topbar">







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











            <div class="studio-topbar-copy">







                <span>



                    ADMIN CONTROL CENTER



                </span>







                <h1>



                    ArchiTrack Overview



                </h1>







            </div>











            <div class="studio-topbar-meta">







                <div>



                    <span>



                        {{ $currentDate }}



                    </span>







                    <strong>



                        {{ $currentTime }} PH



                    </strong>



                </div>







                <div class="studio-admin-chip">



                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}



                </div>







            </div>







        </header>











        <div class="dashboard-content admin-studio-dashboard">







            {{-- =================================================



                EDITORIAL HERO



            ================================================== --}}







            <section class="studio-hero">







                <div class="studio-hero-main">







                    <span class="studio-kicker">



                        VERO DESIGNS ARCHITECTURAL SERVICES



                    </span>







                    <h2>



                        {{ $greeting }},<br>



                        {{ auth()->user()->name }}.



                    </h2>







                    <p>



                        Keep architect accounts, registered users,



                        and system activity organized from one



                        focused administrative workspace.



                    </p>







                    <div class="studio-hero-actions">







                        <a



                            href="{{ route('admin.architects.index') }}"



                            class="studio-primary-btn"



                        >



                            Manage Architects







                            <svg viewBox="0 0 24 24">



                                <path d="M5 12h14"></path>



                                <path d="M13 6l6 6-6 6"></path>



                            </svg>



                        </a>







                        <a



                            href="{{ route('admin.audit-logs.index') }}"



                            class="studio-text-link"



                        >



                            Review system activity



                        </a>







                    </div>







                </div>











                <div class="studio-hero-visual">







                    <div class="studio-drawing-frame">







                        <span class="drawing-label">



                            SYSTEM MAP / 01



                        </span>







                        <img



                            src="{{ asset('images/lineart1.png') }}"



                            alt=""



                        >







                        <div class="drawing-measure measure-a">



                            12.40



                        </div>







                        <div class="drawing-measure measure-b">



                            08.60



                        </div>







                        <div class="drawing-axis axis-one">



                            A



                        </div>







                        <div class="drawing-axis axis-two">



                            B



                        </div>







                    </div>







                </div>







            </section>











            {{-- =================================================



                SYSTEM SNAPSHOT



            ================================================== --}}







            <section class="studio-snapshot">







                <div class="snapshot-intro">







                    <span>



                        LIVE SNAPSHOT



                    </span>







                    <h3>



                        System at a glance



                    </h3>







                    <p>



                        Current account and user totals across ArchiTrack.



                    </p>







                </div>











                <div class="snapshot-metric">







                    <span>



                        01



                    </span>







                    <strong>



                        {{ $totalArchitects }}



                    </strong>







                    <p>



                        Total Architects



                    </p>







                </div>











                <div class="snapshot-metric">







                    <span>



                        02



                    </span>







                    <strong>



                        {{ $activeArchitects }}



                    </strong>







                    <p>



                        Active Architects



                    </p>







                    <small>



                        {{ $inactiveArchitects }} inactive / suspended



                    </small>







                </div>











                <div class="snapshot-metric">







                    <span>



                        03



                    </span>







                    <strong>



                        {{ $totalUsers }}



                    </strong>







                    <p>



                        Registered Users



                    </p>







                </div>







            </section>











            {{-- =================================================



                CONTENT GRID



            ================================================== --}}







            <section class="studio-content-grid">







                {{-- RECENT USERS --}}







                <article class="studio-panel studio-users-panel">







                    <div class="studio-panel-heading">







                        <div>







                            <span>



                                ACCOUNT ACTIVITY



                            </span>







                            <h3>



                                Recently Registered



                            </h3>







                        </div>







                        <a href="{{ route('admin.architects.index') }}">



                            View accounts



                        </a>







                    </div>











                    @if($recentUsers->count() > 0)







                        <div class="studio-user-list">







                            @foreach($recentUsers as $user)







                                <div class="studio-user-row">







                                    <div class="studio-user-number">



                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}



                                    </div>











                                    <div class="studio-user-avatar">



                                        {{ strtoupper(substr($user->name, 0, 1)) }}



                                    </div>











                                    <div class="studio-user-info">







                                        <strong>



                                            {{ $user->name }}



                                        </strong>







                                        <div>







                                            <span>



                                                {{ ucfirst($user->role) }}



                                            </span>







                                            @if($user->status)







                                                <i class="{{ strtolower($user->status ?? '') === 'active' ? 'is-active' : 'is-inactive' }}"></i>







                                                <small>



                                                    {{ ucfirst($user->status) }}



                                                </small>







                                            @endif







                                        </div>







                                    </div>











                                    <div class="studio-user-date">







                                        <span>



                                            REGISTERED



                                        </span>







                                        <strong>



                                            {{ $user->created_at



                                                ->timezone('Asia/Manila')



                                                ->format('M d, Y')



                                            }}



                                        </strong>







                                    </div>







                                </div>







                            @endforeach







                        </div>







                    @else







                        <div class="studio-empty">







                            <span>



                                00



                            </span>







                            <h4>



                                No registered users yet



                            </h4>







                            <p>



                                Newly created system accounts will appear here.



                            </p>







                        </div>







                    @endif







                </article>











                {{-- QUICK CONTROL --}}







                <aside class="studio-side-column">







                    <article class="studio-panel studio-control-panel">







                        <div class="studio-panel-heading">







                            <div>







                                <span>



                                    QUICK CONTROL



                                </span>







                                <h3>



                                    Admin Actions



                                </h3>







                            </div>







                        </div>











                        <div class="studio-action-list">







                            <a



                                href="{{ route('admin.architects.index') }}"



                                class="studio-action"



                            >







                                <span class="studio-action-index">



                                    01



                                </span>







                                <div>



                                    <strong>



                                        Manage Architects



                                    </strong>







                                    <p>



                                        Edit, suspend, activate, or reset accounts.



                                    </p>



                                </div>







                                <b>↗</b>







                            </a>











                            <a



                                href="{{ route('admin.architects.create') }}"



                                class="studio-action"



                            >







                                <span class="studio-action-index">



                                    02



                                </span>







                                <div>



                                    <strong>



                                        Add Architect



                                    </strong>







                                    <p>



                                        Create a new architect account.



                                    </p>



                                </div>







                                <b>↗</b>







                            </a>















                            <a



                                href="{{ route('admin.projects.index') }}"



                                class="studio-action"



                            >







                                <span class="studio-action-index">



                                    03



                                </span>







                                <div>



                                    <strong>



                                        Projects Overview



                                    </strong>







                                    <p>



                                        Review project progress, teams, phases, and activity.



                                    </p>



                                </div>







                                <b>↗</b>







                            </a>











                            <a



                                href="{{ route('admin.financial.index') }}"



                                class="studio-action"



                            >







                                <span class="studio-action-index">



                                    04



                                </span>







                                <div>



                                    <strong>



                                        Financial Overview



                                    </strong>







                                    <p>



                                        Review project budgets, expenses, and remaining balances.



                                    </p>



                                </div>







                                <b>↗</b>







                            </a>







                            <a



                                href="{{ route('admin.audit-logs.index') }}"



                                class="studio-action"



                            >







                                <span class="studio-action-index">



                                    05



                                </span>







                                <div>



                                    <strong>



                                        Audit Logs



                                    </strong>







                                    <p>



                                        Review recorded system activities.



                                    </p>



                                </div>







                                <b>↗</b>







                            </a>











                            <a



                                href="{{ route('admin.bearo-settings.edit') }}"



                                class="studio-action"



                            >







                                <span class="studio-action-index">



                                    06



                                </span>







                                <div>



                                    <strong>



                                        Bearo Settings



                                    </strong>







                                    <p>



                                        Manage assistant behavior and controls.



                                    </p>



                                </div>







                                <b>↗</b>







                            </a>







                        </div>







                    </article>











                    <article class="studio-note-card">







                        <div class="studio-note-line"></div>







                        <span>



                            ARCHITRACK ADMIN



                        </span>







                        <h3>



                            Built for clear oversight.



                        </h3>







                        <p>



                            Account management and system monitoring



                            stay separate from architectural project work.



                        </p>







                        <img



                            src="{{ asset('images/lineart3.png') }}"



                            alt=""



                        >







                    </article>







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







    const desktopMedia = window.matchMedia('(min-width: 701px)');







    function setDesktopCollapsed(collapsed) {







        if (!desktopMedia.matches) {



            return;



        }







        body.classList.toggle(



            'sidebar-collapsed',



            collapsed



        );







        if (sidebarToggle) {







            sidebarToggle.setAttribute(



                'aria-expanded',



                collapsed ? 'false' : 'true'



            );







            sidebarToggle.setAttribute(



                'aria-label',



                collapsed



                    ? 'Maximize sidebar'



                    : 'Minimize sidebar'



            );







        }







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







            const savedCollapsed =



                localStorage.getItem(



                    'architrackAdminSidebarCollapsed'



                ) === '1';







            setDesktopCollapsed(



                savedCollapsed



            );







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











@include('partials.session-timeout-warning')







</body>







</html>
