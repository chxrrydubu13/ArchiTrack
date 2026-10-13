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















    <title>Edit Architect | ArchiTrack</title>















    @vite([







        'resources/css/app.css',







        'resources/css/architects.css',







        'resources/css/edit-architect.css',







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







        <header class="topbar edit-topbar">















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























            <div class="edit-topbar-copy">















                <span>







                    ACCOUNT MANAGEMENT







                </span>















                <h1>







                    Edit Architect







                </h1>















            </div>























            <div class="edit-topbar-user">















                <div>















                    <span>







                        SYSTEM ADMINISTRATOR







                    </span>















                    <strong>







                        {{ auth()->user()->name }}







                    </strong>















                </div>















                <div class="edit-topbar-avatar">







                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}







                </div>















            </div>















        </header>























        <div class="page-content edit-page">























            {{-- PAGE INTRO --}}







            <section class="edit-page-heading">















                <div>















                    <span class="edit-page-code">







                        ARCH-ADM / EDIT







                    </span>















                    <h2>







                        Architect Information







                    </h2>















                    <p>







                        Review and update the architect's account details,







                        email address, and current system access status.







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























            {{-- ERRORS --}}







            @if ($errors->any())















                <div class="edit-error">















                    <span class="error-bar"></span>















                    <div>















                        <strong>







                            Please review the information below.







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























            {{-- FORM PANEL --}}







            <section class="edit-workspace">























                <div class="edit-form-panel">















                    <div class="panel-heading">















                        <span>







                            ACCOUNT DETAILS







                        </span>















                        <h3>







                            Basic Information







                        </h3>















                        <p>







                            Fields marked with an asterisk are required.







                        </p>















                    </div>























                    <form







                        method="POST"







                        action="{{ route('admin.architects.update', $architect->id) }}"







                        class="edit-form"







                    >















                        @csrf







                        @method('PUT')























                        <div class="form-grid">















                            {{-- NAME --}}







                            <div class="form-group">















                                <label for="name">







                                    Full Name







                                    <span>\*</span>







                                </label>















                                <input







                                    type="text"







                                    id="name"







                                    name="name"







                                    value="{{ old('name', $architect->name) }}"







                                    placeholder="Enter architect name"







                                    maxlength="100"







                                    pattern="[A-Za-zÀ-ÿÑñ\s.'-]+"







                                    title="Name must only contain letters."







                                    required







                                >















                                <small>







                                    Letters only. Numbers are not allowed.







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







                                    value="{{ old('email', $architect->email) }}"







                                    placeholder="Enter email address"







                                    maxlength="255"







                                    required







                                >















                                <small>







                                    Use the architect's current email address.







                                </small>















                                @error('email')







                                    <p class="input-error">







                                        {{ $message }}







                                    </p>







                                @enderror















                            </div>























                            {{-- STATUS --}}







                            <div class="form-group form-group-full">















                                <label for="status">







                                    Account Status







                                    <span>\*</span>







                                </label>















                                <select







                                    id="status"







                                    name="status"







                                    required







                                >















                                    <option







                                        value="active"







                                        {{ old('status', $architect->status) === 'active' ? 'selected' : '' }}







                                    >







                                        Active







                                    </option>















                                    <option







                                        value="inactive"







                                        {{ old('status', $architect->status) === 'inactive' ? 'selected' : '' }}







                                    >







                                        Inactive







                                    </option>















                                    <option







                                        value="suspended"







                                        {{ old('status', $architect->status) === 'suspended' ? 'selected' : '' }}







                                    >







                                        Suspended







                                    </option>















                                </select>















                                <small>







                                    Active accounts can use ArchiTrack normally.







                                </small>















                                @error('status')







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







                                class="save-btn"







                            >







                                Save Changes







                            </button>















                        </div>















                    </form>















                </div>























                {{-- SIDE INFORMATION --}}







                <aside class="edit-side-panel">















                    <div class="architect-account-card">















                        <span class="account-card-label">







                            CURRENT ACCOUNT







                        </span>















                        <div class="account-avatar">







                            {{ strtoupper(substr($architect->name, 0, 1)) }}







                        </div>















                        <h3>







                            {{ $architect->name }}







                        </h3>















                        <p>







                            {{ $architect->email }}







                        </p>















                        <div class="account-status-line">















                            <span>







                                Status







                            </span>















                            <strong class="status-{{ strtolower($architect->status) }}">







                                <i></i>







                                {{ ucfirst($architect->status) }}







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







                                Account Access







                            </strong>















                            <p>







                                Changing the status can affect this architect's access







                                to ArchiTrack. Confirm the selected status before saving.







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
