<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0"

    >

    <title>Create Project | ArchiTrack</title>

    @vite([

        'resources/css/app.css',

        'resources/css/architect-dashboard.css',

        'resources/css/create-architect-project.css',

        'resources/js/app.js'

    ])

    <style>
        html, body, button, input, select, textarea {
            font-family: "Segoe UI", Arial, sans-serif;
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

            class="menu-link {{ request()->routeIs('architect.files.\*') ? 'active' : '' }}"

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

            class="menu-link {{ request()->routeIs('architect.revisions.\*') ? 'active' : '' }}"

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

            class="menu-link {{ request()->routeIs('architect.meetings.\*') ? 'active' : '' }}"

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

            class="menu-link {{ request()->routeIs('architect.reports.\*') ? 'active' : '' }}"

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

            class="menu-link {{ request()->routeIs('architect.settings.\*') ? 'active' : '' }}"

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

                    Create Project

                </h1>

                <p>

                    Create a project workspace and connect

                    a client account.

                </p>

            </div>

            <a

                href="{{ route('architect.projects.index') }}"

                class="back-btn"

            >

                ← Back to Projects

            </a>

        </header>

        <div class="page-content">

            <section class="form-card">

                <div class="form-heading">

                    <span>

                        NEW PROJECT

                    </span>

                    <h2>

                        Project Information

                    </h2>

                    <p>

                        Enter the project details and select

                        or create a client account.

                    </p>

                </div>

                @if($errors->any())

                    <div class="error-box">

                        <strong>

                            Please check the information below.

                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>

                                    {{ $error }}

                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form

                    method="POST"

                    action="{{ route('architect.projects.store') }}"

                    enctype="multipart/form-data"

                    class="project-form"

                >

                    @csrf

                    <!-- PROJECT NAME -->

                    <div class="form-group full">

                        <label for="project_name">

                            Project Name

                            <span>\*</span>

                        </label>

                        <input

                            type="text"

                            id="project_name"

                            name="project_name"

                            value="{{ old('project_name') }}"

                            placeholder="Example: Dela Cruz Residence"

                            maxlength="255"

                            required

                        >

                    </div>

                    <!-- DESCRIPTION -->

                    <div class="form-group full">

                        <label for="description">

                            Project Description

                        </label>

                        <textarea

                            id="description"

                            name="description"

                            rows="5"

                            maxlength="2000"

                            placeholder="Briefly describe the project..."

                        >{{ old('description') }}</textarea>

                        <small>

                            Optional. Maximum of 2,000 characters.

                        </small>

                    </div>

                    <!-- CLIENT -->

                    <div class="form-section">

                        <div class="section-title">

                            <span>

                                01

                            </span>

                            <div>

                                <strong>

                                    Client Account

                                </strong>

                                <p>

                                    Select an existing client or create

                                    a new client account.

                                </p>

                            </div>

                        </div>

                        <!-- CLIENT TYPE -->

                        <div class="client-type-options">

                            <label class="client-option">

                                <input

                                    type="radio"

                                    name="client_type"

                                    value="new"

                                    {{ old('client_type', 'new') === 'new' ? 'checked' : '' }}

                                    onchange="changeClientType()"

                                >

                                <div>

                                    <strong>

                                        New Client

                                    </strong>

                                    <span>

                                        Create a new ArchiTrack client account.

                                    </span>

                                </div>

                            </label>

                            <label class="client-option">

                                <input

                                    type="radio"

                                    name="client_type"

                                    value="existing"

                                    {{ old('client_type') === 'existing' ? 'checked' : '' }}

                                    onchange="changeClientType()"

                                >

                                <div>

                                    <strong>

                                        Existing Client

                                    </strong>

                                    <span>

                                        Use a client already connected to you.

                                    </span>

                                </div>

                            </label>

                        </div>

                        <!-- NEW CLIENT -->

                        <div

                            id="newClientArea"

                            class="client-area"

                        >

                            <div class="form-grid">

                                <div class="form-group">

                                    <label for="client_name">

                                        Client Name

                                        <span>\*</span>

                                    </label>

                                    <input

                                        type="text"

                                        id="client_name"

                                        name="client_name"

                                        value="{{ old('client_name') }}"

                                        placeholder="Example: Juan Dela Cruz"

                                    >

                                </div>

                                <div class="form-group">

                                    <label for="client_email">

                                        Client Email

                                        <span>\*</span>

                                    </label>

                                    <input

                                        type="email"

                                        id="client_email"

                                        name="client_email"

                                        value="{{ old('client_email') }}"

                                        placeholder="client\@email.com"

                                    >

                                </div>

                            </div>

                            <div class="new-client-note">

                                A new client account will be created.

                                Temporary login credentials will be

                                sent to this email address.

                            </div>

                        </div>

                        <!-- EXISTING CLIENT -->

                        <div

                            id="existingClientArea"

                            class="client-area"

                        >

                            <div class="form-group full">

                                <label for="existing_client_id">

                                    Select Existing Client

                                    <span>\*</span>

                                </label>

                                <select

                                    id="existing_client_id"

                                    name="existing_client_id"

                                >

                                    <option value="">

                                        Select client

                                    </option>

                                    @foreach($existingClients as $client)

                                        <option

                                            value="{{ $client->id }}"

                                            {{ old('existing_client_id') == $client->id ? 'selected' : '' }}

                                        >

                                            {{ $client->name }}

                                            —

                                            {{ $client->email }}

                                        </option>

                                    @endforeach

                                </select>

                                @if($existingClients->isEmpty())

                                    <small>

                                        You do not have existing clients yet.

                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>

                    <!-- SCHEDULE -->

                    <div class="form-section">

                        <div class="section-title">

                            <span>

                                02

                            </span>

                            <div>

                                <strong>

                                    Project Schedule

                                </strong>

                                <p>

                                    Set the project status and dates.

                                </p>

                            </div>

                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label for="status">

                                    Project Status

                                    <span>\*</span>

                                </label>

                                <select

                                    id="status"

                                    name="status"

                                    required

                                >

                                    <option

                                        value="planning"

                                        {{ old('status', 'planning') === 'planning' ? 'selected' : '' }}

                                    >

                                        Planning

                                    </option>

                                    <option

                                        value="ongoing"

                                        {{ old('status') === 'ongoing' ? 'selected' : '' }}

                                    >

                                        Ongoing

                                    </option>

                                    <option

                                        value="on_hold"

                                        {{ old('status') === 'on_hold' ? 'selected' : '' }}

                                    >

                                        On Hold

                                    </option>

                                    <option

                                        value="completed"

                                        {{ old('status') === 'completed' ? 'selected' : '' }}

                                    >

                                        Completed

                                    </option>

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="start_date">

                                    Start Date

                                </label>

                                <input

                                    type="date"

                                    id="start_date"

                                    name="start_date"

                                    value="{{ old('start_date') }}"

                                >

                            </div>

                            <div class="form-group">

                                <label for="target_date">

                                    Target Date

                                </label>

                                <input

                                    type="date"

                                    id="target_date"

                                    name="target_date"

                                    value="{{ old('target_date') }}"

                                >

                            </div>

                        </div>

                    </div>

                    <!-- IMAGE -->

                    <div class="form-section">

                        <div class="section-title">

                            <span>

                                03

                            </span>

                            <div>

                                <strong>

                                    Project Cover

                                </strong>

                                <p>

                                    Add a project image if available.

                                </p>

                            </div>

                        </div>

                        <div class="image-upload">

                            <input

                                type="file"

                                id="project_image"

                                name="project_image"

                                accept=".jpg,.jpeg,.png,.webp"

                                onchange="previewProjectImage(event)"

                            >

                            <label

                                for="project_image"

                                class="upload-box"

                            >

                                <div

                                    class="default-preview"

                                    id="defaultPreview"

                                >

                                    <img

                                        src="{{ asset('images/lineart2.png') }}"

                                        alt=""

                                    >

                                    <div>

                                        <strong>

                                            Upload Project Image

                                        </strong>

                                        <span>

                                            JPG, PNG or WEBP • Maximum 5 MB

                                        </span>

                                    </div>

                                </div>

                                <img

                                    id="projectPreview"

                                    class="project-preview"

                                    alt="Project preview"

                                >

                            </label>

                        </div>

                    </div>

                    <!-- NOTE -->

                    <div class="project-note">

                        <div class="note-icon">

                            i

                        </div>

                        <div>

                            <strong>

                                Client Account & Project Workspace

                            </strong>

                            <p>

                                A new client will receive login details

                                by email. Existing clients will use their

                                current ArchiTrack login for the new project.

                            </p>

                        </div>

                    </div>

                    <!-- ACTIONS -->

                    <div class="form-actions">

                        <a

                            href="{{ route('architect.projects.index') }}"

                            class="cancel-btn"

                        >

                            Cancel

                        </a>

                        <button

                            type="submit"

                            class="submit-btn"

                        >

                            Create Project Workspace

                            <span>

                                →

                            </span>

                        </button>

                    </div>

                </form>

            </section>

            <!-- RIGHT -->

            <aside class="preview-side">

                <div class="preview-card">

                    <span class="preview-label">

                        ARCHITRACK WORKSPACE

                    </span>

                    <h3>

                        One client account. Multiple projects.

                    </h3>

                    <p>

                        Existing clients can be connected to new

                        projects without creating another account.

                    </p>

                    <div class="workspace-features">

                        <div>

                            <strong>

                                01

                            </strong>

                            <span>

                                Project Progress

                            </span>

                        </div>

                        <div>

                            <strong>

                                02

                            </strong>

                            <span>

                                Design Files

                            </span>

                        </div>

                        <div>

                            <strong>

                                03

                            </strong>

                            <span>

                                Client Revisions

                            </span>

                        </div>

                        <div>

                            <strong>

                                04

                            </strong>

                            <span>

                                Meeting Requests

                            </span>

                        </div>

                    </div>

                    <img

                        src="{{ asset('images/lineart1.png') }}"

                        alt=""

                    >

                </div>

            </aside>

        </div>

    </main>

</div>

<script>

function changeClientType()

{

    const selected =

        document.querySelector(

            'input[name="client_type"]:checked'

        );

    const newArea =

        document.getElementById(

            'newClientArea'

        );

    const existingArea =

        document.getElementById(

            'existingClientArea'

        );

    if (!selected) {

        return;

    }

    if (selected.value === 'existing') {

        newArea.style.display =

            'none';

        existingArea.style.display =

            'block';

    } else {

        newArea.style.display =

            'block';

        existingArea.style.display =

            'none';

    }

}

function previewProjectImage(event)

{

    const file =

        event.target.files[0];

    const preview =

        document.getElementById(

            'projectPreview'

        );

    const defaultPreview =

        document.getElementById(

            'defaultPreview'

        );

    if (file) {

        const reader =

            new FileReader();

        reader.onload =

            function(e)

            {

                preview.src =

                    e.target.result;

                preview.style.display =

                    'block';

                defaultPreview.style.display =

                    'none';

            };

        reader.readAsDataURL(file);

    } else {

        preview.style.display =

            'none';

        defaultPreview.style.display =

            'flex';

    }

}

document.addEventListener(

    'DOMContentLoaded',

    function()

    {

        changeClientType();

    }

);

</script>

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
