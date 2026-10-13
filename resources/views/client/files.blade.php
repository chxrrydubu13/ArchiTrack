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



    <title>Files | ArchiTrack</title>



    @vite([

        'resources/css/app.css',

        'resources/css/client-dashboard.css',

        'resources/css/client-files.css',

        'resources/js/app.js'

    ])

</head>



<body>



<div class="client-app">



    {{-- =========================================================

         SHARED ARCHITECTURAL BACKGROUND

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



        <div class="draft-path draft-path-three">

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

         FIXED FLOATING TOPBAR

    ========================================================== --}}



    <header class="client-topbar">



        <div class="client-topbar-inner">



            <a

                href="{{ route('client.dashboard') }}"

                class="client-brand"

            >

                <div class="client-logo">

                    <img

                        src="{{ asset('images/arlogo.jpg') }}"

                        alt="ArchiTrack"

                    >

                </div>



                <span class="client-portal-label">

                    Client Portal

                </span>

            </a>





            <nav class="client-navigation">



                <a

                    href="{{ route('client.dashboard') }}"

                    class="client-nav-link"

                >

                    Home

                </a>



                <a

                    href="{{ route('client.projects.index') }}"

                    class="client-nav-link"

                >

                    My Project

                </a>

<a

                    href="{{ route('client.files.index') }}"

                    class="client-nav-link active"

                >

                    Files

                </a>



                <a

                    href="{{ route('client.meetings.index') }}"

                    class="client-nav-link"

                >

                    Meetings

                </a>



            </nav>





            <div class="client-account-area">



                <div class="notification-wrapper">



                    <button

                        type="button"

                        class="notification-button"

                        id="notificationButton"

                        aria-label="Notifications"

                        aria-expanded="false"

                    >

                        <svg viewBox="0 0 24 24">

                            <path

                                d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"

                            ></path>



                            <path

                                d="M13.73 21a2 2 0 0 1-3.46 0"

                            ></path>

                        </svg>



                        <span

                            class="notification-badge"

                            id="notificationBadge"

                            style="display: none;"

                        >

                            0

                        </span>

                    </button>



                    <div

                        class="notification-dropdown"

                        id="notificationDropdown"

                    >

                        <div class="notification-dropdown-header">

                            <div>

                                <span class="notification-small-label">

                                    Client Updates

                                </span>



                                <h3>

                                    Notifications

                                </h3>

                            </div>



                            <button

                                type="button"

                                class="mark-all-read-button"

                                id="markAllReadButton"

                            >

                                Mark all as read

                            </button>

                        </div>



                        <div

                            class="notification-list"

                            id="notificationList"

                        >

                            <div class="notification-empty">

                                Loading notifications...

                            </div>

                        </div>

                    </div>



                </div>





                <div class="client-profile">



                    <div class="client-avatar">



                        @if(Auth::user()->profile_image)



                            <img

                                src="{{ asset('storage/' . Auth::user()->profile_image) }}"

                                alt="{{ Auth::user()->name }}"

                            >



                        @else



                            {{ strtoupper(

                                substr(

                                    Auth::user()->name ?? 'C',

                                    0,

                                    1

                                )

                            ) }}



                        @endif



                    </div>



                    <div class="client-profile-text">

                        <strong>

                            {{ Auth::user()->name }}

                        </strong>



                        <span>

                            Client

                        </span>

                    </div>



                    <button

                        type="button"

                        class="profile-menu-button"

                        id="profileMenuButton"

                        aria-label="Profile Menu"

                    >

                        <svg viewBox="0 0 24 24">

                            <path d="m6 9 6 6 6-6"></path>

                        </svg>

                    </button>



                    <div

                        class="profile-dropdown"

                        id="profileDropdown"

                    >

                        <div class="dropdown-user">

                            <strong>

                                {{ Auth::user()->name }}

                            </strong>



                            <span>

                                {{ Auth::user()->email }}

                            </span>

                        </div>



                        <a href="{{ route('client.account.index') }}">

                            Account Settings

                        </a>



                        <form

                            method="POST"

                            action="{{ route('logout') }}"

                        >

                            @csrf



                            <button type="submit">

                                Log Out

                            </button>

                        </form>

                    </div>



                </div>



                <button

                    type="button"

                    class="mobile-menu-button"

                    id="mobileMenuButton"

                    aria-label="Menu"

                >

                    <svg viewBox="0 0 24 24">

                        <path d="M4 6h16"></path>

                        <path d="M4 12h16"></path>

                        <path d="M4 18h16"></path>

                    </svg>

                </button>



            </div>



        </div>



    </header>





    {{-- =========================================================

         MOBILE NAVIGATION

    ========================================================== --}}



    <nav

        class="mobile-navigation"

        id="mobileNavigation"

    >

        <a href="{{ route('client.dashboard') }}">

            Home

        </a>



        <a href="{{ route('client.projects.index') }}">

            My Project

        </a>

<a

            href="{{ route('client.files.index') }}"

            class="active"

        >

            Files

        </a>



        <a href="{{ route('client.meetings.index') }}">

            Meetings

        </a>



        <a href="{{ route('client.account.index') }}">

            Account

        </a>

    </nav>





    {{-- =========================================================

         MAIN

    ========================================================== --}}



    <main class="files-main">



        <section class="files-page-heading">



            <div class="files-heading-copy">



                <div class="files-heading-line"></div>



                <div>

                    <span class="files-heading-label">

                        Project Library

                    </span>



                    <h1>

                        Files

                    </h1>



                    <p>

                        Browse drawings, documents, images, and project

                        files from all of your projects in one place.

                    </p>

                </div>



            </div>



        </section>





        {{-- =====================================================

             SUMMARY CARDS

        ====================================================== --}}



        <section class="files-summary-grid">



            <a

                href="{{ route('client.files.index') }}"

                class="file-summary-card {{ $view === 'all' && !$status ? 'active' : '' }}"

            >

                <span class="file-summary-label">

                    All Files

                </span>



                <strong>

                    {{ $totalCount }}

                </strong>



                <small>

                    Across {{ $projects->count() }}

                    {{ $projects->count() === 1 ? 'project' : 'projects' }}

                </small>

            </a>



            <a

                href="{{ route('client.files.index', ['status' => 'active']) }}"

                class="file-summary-card"

            >

                <span class="file-summary-label">

                    Active Files

                </span>



                <strong>

                    {{ $activeCount }}

                </strong>



                <small>

                    Current project files

                </small>

            </a>



            <a

                href="{{ route('client.files.index', ['view' => 'recent']) }}"

                class="file-summary-card"

            >

                <span class="file-summary-label">

                    Recent Uploads

                </span>



                <strong>

                    {{ $recentCount }}

                </strong>



                <small>

                    Added in the last 7 days

                </small>

            </a>



            <a

                href="{{ route('client.files.index', ['view' => 'archived']) }}"

                class="file-summary-card"

            >

                <span class="file-summary-label">

                    Archived

                </span>



                <strong>

                    {{ $archivedCount }}

                </strong>



                <small>

                    Previous or archived files

                </small>

            </a>



        </section>





        {{-- =====================================================

             FILE LIBRARY

        ====================================================== --}}



        <section class="files-library">



            <div class="files-library-head">



                <div>

                    <span class="files-section-label">

                        Centralized Library

                    </span>



                    <h2>

                        Project Files

                    </h2>

                </div>



                <span class="files-result-count">

                    {{ $allFiles->count() }}

                    {{ $allFiles->count() === 1 ? 'file' : 'files' }}

                </span>



            </div>





            {{-- QUICK VIEWS --}}



            <div class="files-quick-tabs">



                <a

                    href="{{ route('client.files.index', ['view' => 'all']) }}"

                    class="{{ $view === 'all' ? 'active' : '' }}"

                >

                    All

                </a>



                <a

                    href="{{ route('client.files.index', ['view' => 'recent']) }}"

                    class="{{ $view === 'recent' ? 'active' : '' }}"

                >

                    Recent

                </a>



                <a

                    href="{{ route('client.files.index', ['view' => 'images']) }}"

                    class="{{ $view === 'images' ? 'active' : '' }}"

                >

                    Images

                </a>



                <a

                    href="{{ route('client.files.index', ['view' => 'documents']) }}"

                    class="{{ $view === 'documents' ? 'active' : '' }}"

                >

                    Documents

                </a>



                <a

                    href="{{ route('client.files.index', ['view' => 'archived']) }}"

                    class="{{ $view === 'archived' ? 'active' : '' }}"

                >

                    Archived

                </a>



            </div>





            {{-- FILTERS --}}



            <form

                method="GET"

                action="{{ route('client.files.index') }}"

                class="files-filter-bar"

            >



                <input

                    type="hidden"

                    name="view"

                    value="{{ $view }}"

                >



                <div class="files-search-field">



                    <svg viewBox="0 0 24 24">

                        <circle

                            cx="11"

                            cy="11"

                            r="8"

                        ></circle>



                        <path d="m21 21-4.35-4.35"></path>

                    </svg>



                    <input

                        type="search"

                        name="search"

                        value="{{ $search }}"

                        placeholder="Search files, projects, uploader..."

                    >



                </div>





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





                <select name="status">

                    <option value="">

                        All Status

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





                <select name="sort">

                    <option

                        value="newest"

                        {{ $sort === 'newest' ? 'selected' : '' }}

                    >

                        Newest First

                    </option>



                    <option

                        value="oldest"

                        {{ $sort === 'oldest' ? 'selected' : '' }}

                    >

                        Oldest First

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





                <button type="submit">

                    Apply

                </button>



                @if(

                    $search

                    || $projectId

                    || $type

                    || $status

                    || $sort !== 'newest'

                    || $view !== 'all'

                )

                    <a

                        href="{{ route('client.files.index') }}"

                        class="files-clear-filter"

                    >

                        Clear

                    </a>

                @endif



            </form>





            {{-- FILES --}}



            <div class="files-list">



                @forelse($allFiles as $file)



                    @php



                        $displayName =

                            $file->original_name

                            ?? $file->file_name

                            ?? 'Project File';



                        $extension = strtolower(

                            pathinfo(

                                $displayName,

                                PATHINFO_EXTENSION

                            )

                        );



                        $imageExtensions = [

                            'jpg',

                            'jpeg',

                            'png',

                            'webp',

                            'gif'

                        ];



                        $isImage = in_array(

                            $extension,

                            $imageExtensions

                        );



                        $fileViewUrl = $file->file_path

                            ? route(

                                'project.files.secure.view',

                                [

                                    'projectId' => $file->project_id,

                                    'fileId' => $file->id,

                                ]

                            )

                            : null;



                        $fileDownloadUrl = $file->file_path

                            ? route(

                                'project.files.secure.download',

                                [

                                    'projectId' => $file->project_id,

                                    'fileId' => $file->id,

                                ]

                            )

                            : null;



                        $fileSize = null;



                        if ($file->file_size) {



                            if ($file->file_size >= 1048576) {



                                $fileSize =

                                    number_format(

                                        $file->file_size / 1048576,

                                        1

                                    )

                                    . ' MB';



                            } elseif ($file->file_size >= 1024) {



                                $fileSize =

                                    number_format(

                                        $file->file_size / 1024,

                                        1

                                    )

                                    . ' KB';



                            } else {



                                $fileSize =

                                    $file->file_size

                                    . ' B';

                            }

                        }



                        $projectName =

                            $file->project_data->project_name

                            ?? 'Project';



                        $uploaderName =

                            $file->uploader?->name

                            ?? 'Project Team';



                    @endphp





                    <article class="file-row">



                        <div class="file-preview">



                            @if($isImage && $fileViewUrl)



                                <img

                                    src="{{ $fileViewUrl }}"

                                    alt="{{ $displayName }}"

                                >



                            @else



                                <div class="file-extension-icon">

                                    {{ $extension

                                        ? strtoupper($extension)

                                        : 'FILE'

                                    }}

                                </div>



                            @endif



                        </div>





                        <div class="file-primary">



                            <div class="file-name-row">



                                <strong title="{{ $displayName }}">

                                    {{ $displayName }}

                                </strong>



                                @if($file->is_latest)

                                    <span class="latest-badge">

                                        Latest

                                    </span>

                                @endif



                                @if($file->is_archived)

                                    <span class="archived-badge">

                                        Archived

                                    </span>

                                @endif



                            </div>



                            <span class="file-project-name">

                                {{ $projectName }}

                            </span>



                            @if($file->description)

                                <p>

                                    {{ \Illuminate\Support\Str::limit(

                                        $file->description,

                                        90

                                    ) }}

                                </p>

                            @endif



                        </div>





                        <div class="file-detail">

                            <span>Category</span>

                            <strong>

                                {{ $file->category

                                    ? ucfirst($file->category)

                                    : 'General'

                                }}

                            </strong>

                        </div>





                        <div class="file-detail">

                            <span>Uploaded By</span>

                            <strong>

                                {{ $uploaderName }}

                            </strong>

                        </div>





                        <div class="file-detail">

                            <span>Version</span>

                            <strong>

                                V{{ $file->version_number ?? 1 }}

                            </strong>

                        </div>





                        <div class="file-detail">

                            <span>Uploaded</span>

                            <strong>

                                {{ $file->created_at

                                    ? $file->created_at

                                        ->timezone('Asia/Manila')

                                        ->format('M d, Y')

                                    : '—'

                                }}

                            </strong>



                            @if($fileSize)

                                <small>

                                    {{ $fileSize }}

                                </small>

                            @endif

                        </div>





                        <div class="file-actions">



                            @if($fileViewUrl && $fileDownloadUrl)



                                <a

                                    href="{{ $fileViewUrl }}"

                                    target="_blank"

                                    rel="noopener"

                                    class="file-open-button"

                                >

                                    Open

                                </a>



                                <a

                                    href="{{ $fileDownloadUrl }}"

                                    class="file-download-button"

                                    title="Download"

                                >

                                    <svg viewBox="0 0 24 24">

                                        <path d="M12 3v12"></path>

                                        <path d="m7 10 5 5 5-5"></path>

                                        <path d="M5 21h14"></path>

                                    </svg>

                                </a>



                            @endif



                        </div>



                    </article>





                @empty



                    <div class="files-empty">



                        <div class="files-empty-icon">

                            <svg viewBox="0 0 24 24">

                                <path

                                    d="M3 6h6l2 2h10v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"

                                ></path>



                                <path d="M3 10h18"></path>

                            </svg>

                        </div>



                        <h3>

                            No files found

                        </h3>



                        <p>

                            Files shared through your projects will

                            appear here. Try changing your filters

                            if you are looking for a specific file.

                        </p>



                    </div>



                @endforelse



            </div>



        </section>



    </main>



</div>





<script>

document.addEventListener('DOMContentLoaded', function () {



    const profileMenuButton =

        document.getElementById('profileMenuButton');



    const profileDropdown =

        document.getElementById('profileDropdown');



    const mobileMenuButton =

        document.getElementById('mobileMenuButton');



    const mobileNavigation =

        document.getElementById('mobileNavigation');





    const notificationButton =

        document.getElementById('notificationButton');



    const notificationDropdown =

        document.getElementById('notificationDropdown');



    const notificationBadge =

        document.getElementById('notificationBadge');



    const notificationList =

        document.getElementById('notificationList');



    const markAllReadButton =

        document.getElementById('markAllReadButton');



    const csrfToken =

        document

            .querySelector('meta[name="csrf-token"]')

            ?.getAttribute('content');





    if (

        profileMenuButton

        &&

        profileDropdown

    ) {

        profileMenuButton.addEventListener(

            'click',

            function (event) {

                event.stopPropagation();



                profileDropdown.classList.toggle(

                    'show'

                );

            }

        );

    }





    if (

        mobileMenuButton

        &&

        mobileNavigation

    ) {

        mobileMenuButton.addEventListener(

            'click',

            function (event) {

                event.stopPropagation();



                mobileNavigation.classList.toggle(

                    'show'

                );

            }

        );

    }





    document.addEventListener(

        'click',

        function (event) {



            if (

                profileDropdown

                &&

                profileMenuButton

                &&

                !profileDropdown.contains(event.target)

                &&

                !profileMenuButton.contains(event.target)

            ) {

                profileDropdown.classList.remove(

                    'show'

                );

            }



            if (

                mobileNavigation

                &&

                mobileMenuButton

                &&

                !mobileNavigation.contains(event.target)

                &&

                !mobileMenuButton.contains(event.target)

            ) {

                mobileNavigation.classList.remove(

                    'show'

                );

            }



            if (

                notificationDropdown

                &&

                notificationButton

                &&

                !notificationDropdown.contains(event.target)

                &&

                !notificationButton.contains(event.target)

            ) {

                notificationDropdown.classList.remove(

                    'show'

                );



                notificationButton.setAttribute(

                    'aria-expanded',

                    'false'

                );

            }

        }

    );





    function escapeHtml(value) {

        const div =

            document.createElement('div');



        div.textContent =

            value ?? '';



        return div.innerHTML;

    }





    function formatNotificationTime(dateValue) {

        if (!dateValue) {

            return '';

        }



        const date =

            new Date(dateValue);



        if (Number.isNaN(date.getTime())) {

            return '';

        }



        return date.toLocaleString(

            'en-PH',

            {

                month: 'short',

                day: 'numeric',

                year: 'numeric',

                hour: 'numeric',

                minute: '2-digit'

            }

        );

    }





    function updateNotificationBadge(count) {

        if (!notificationBadge) {

            return;

        }



        const unreadCount =

            Number(count) || 0;



        notificationBadge.textContent =

            unreadCount > 99

                ? '99+'

                : unreadCount;



        notificationBadge.style.display =

            unreadCount > 0

                ? 'flex'

                : 'none';

    }





    function getNotificationIcon(type) {

        if (type === 'message') {

            return `

                <svg viewBox="0 0 24 24">

                    <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>

                </svg>

            `;

        }



        if (type === 'file') {

            return `

                <svg viewBox="0 0 24 24">

                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>

                    <path d="M14 2v6h6"></path>

                </svg>

            `;

        }



        if (type === 'revision') {

            return `

                <svg viewBox="0 0 24 24">

                    <path d="M3 12a9 9 0 1 0 3-6.7L3 8"></path>

                    <path d="M3 3v5h5"></path>

                </svg>

            `;

        }



        if (type === 'meeting') {

            return `

                <svg viewBox="0 0 24 24">

                    <rect x="3" y="5" width="18" height="16" rx="2"></rect>

                    <path d="M16 3v4"></path>

                    <path d="M8 3v4"></path>

                    <path d="M3 11h18"></path>

                </svg>

            `;

        }



        return `

            <svg viewBox="0 0 24 24">

                <circle cx="12" cy="12" r="9"></circle>

                <path d="M12 8v4"></path>

                <path d="M12 16h.01"></path>

            </svg>

        `;

    }





    function renderNotifications(notifications) {

        if (!notificationList) {

            return;

        }



        if (

            !Array.isArray(notifications)

            ||

            notifications.length === 0

        ) {

            notificationList.innerHTML = `

                <div class="notification-empty">

                    <strong>No notifications yet</strong>

                    <span>

                        Project updates from your architect will appear here.

                    </span>

                </div>

            `;



            return;

        }



        notificationList.innerHTML =

            notifications

                .map(function (notification) {



                    const data =

                        notification.data || {};



                    const isUnread =

                        !notification.read_at;



                    const title =

                        escapeHtml(

                            data.title || 'Project Update'

                        );



                    const message =

                        escapeHtml(

                            data.message || ''

                        );



                    const type =

                        escapeHtml(

                            data.type || 'general'

                        );



                    const url =

                        data.url

                            ? escapeHtml(data.url)

                            : '';



                    const time =

                        escapeHtml(

                            formatNotificationTime(

                                notification.created_at

                            )

                        );



                    return `

                        <button

                            type="button"

                            class="notification-item ${isUnread ? 'unread' : ''}"

                            data-notification-id="${escapeHtml(notification.id)}"

                            data-notification-url="${url}"

                            data-type="${type}"

                        >

                            <span class="notification-type-icon">

                                ${getNotificationIcon(data.type)}

                            </span>



                            <span class="notification-content">



                                <span class="notification-item-top">



                                    <strong class="notification-item-title">

                                        ${title}

                                    </strong>



                                    ${isUnread

                                        ? '<span class="notification-unread-dot"></span>'

                                        : ''

                                    }



                                </span>



                                <span class="notification-item-message">

                                    ${message}

                                </span>



                                <time class="notification-item-time">

                                    ${time}

                                </time>



                            </span>

                        </button>

                    `;

                })

                .join('');

    }





    async function loadNotifications() {

        if (!notificationList) {

            return;

        }



        try {

            const response =

                await fetch(

                    @json(route('client.notifications.index')),

                    {

                        headers: {

                            'Accept':

                                'application/json'

                        }

                    }

                );



            const data =

                await response.json();



            if (!response.ok) {

                throw new Error(

                    'Unable to load notifications.'

                );

            }



            renderNotifications(

                data.notifications || []

            );



            updateNotificationBadge(

                data.unread_count || 0

            );



        } catch (error) {

            notificationList.innerHTML = `

                <div class="notification-empty">

                    Unable to load notifications.

                </div>

            `;

        }

    }





    async function markNotificationAsRead(

        notificationId

    ) {

        const url =

            @json(

                route(

                    'client.notifications.read',

                    ['id' => '__NOTIFICATION__']

                )

            )

            .replace(

                '__NOTIFICATION__',

                notificationId

            );



        const response =

            await fetch(

                url,

                {

                    method: 'POST',



                    headers: {

                        'Accept':

                            'application/json',



                        'X-CSRF-TOKEN':

                            csrfToken

                    }

                }

            );



        if (!response.ok) {

            throw new Error(

                'Unable to mark notification as read.'

            );

        }



        return response.json();

    }





    notificationButton?.addEventListener(

        'click',

        function (event) {

            event.stopPropagation();



            const isOpen =

                notificationDropdown

                    ?.classList

                    .toggle('show');



            notificationButton.setAttribute(

                'aria-expanded',

                isOpen

                    ? 'true'

                    : 'false'

            );



            profileDropdown

                ?.classList

                .remove('show');



            mobileNavigation

                ?.classList

                .remove('show');

        }

    );





    notificationList?.addEventListener(

        'click',

        async function (event) {



            const item =

                event.target.closest(

                    '.notification-item'

                );



            if (!item) {

                return;

            }



            const notificationId =

                item.dataset.notificationId;



            const notificationUrl =

                item.dataset.notificationUrl;



            if (

                notificationId

                &&

                item.classList.contains('unread')

            ) {

                try {

                    await markNotificationAsRead(

                        notificationId

                    );



                    item.classList.remove(

                        'unread'

                    );



                    item

                        .querySelector(

                            '.notification-unread-dot'

                        )

                        ?.remove();



                    await loadNotifications();



                } catch (error) {

                    console.error(error);

                }

            }



            if (notificationUrl) {

                window.location.href =

                    notificationUrl;

            }

        }

    );





    markAllReadButton?.addEventListener(

        'click',

        async function (event) {

            event.stopPropagation();



            markAllReadButton.disabled =

                true;



            try {

                const response =

                    await fetch(

                        @json(

                            route(

                                'client.notifications.readAll'

                            )

                        ),

                        {

                            method: 'POST',



                            headers: {

                                'Accept':

                                    'application/json',



                                'X-CSRF-TOKEN':

                                    csrfToken

                            }

                        }

                    );



                if (!response.ok) {

                    throw new Error(

                        'Unable to mark all notifications as read.'

                    );

                }



                await loadNotifications();



            } catch (error) {

                console.error(error);



            } finally {

                markAllReadButton.disabled =

                    false;

            }

        }

    );





    loadNotifications();



});

</script>





    @include('partials.session-timeout-warning')



</body>

</html>
