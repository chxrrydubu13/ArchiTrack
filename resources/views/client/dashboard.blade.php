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
    <title>
        Client Dashboard | ArchiTrack
    </title>
    @vite([
        'resources/css/app.css',
        'resources/css/client-dashboard.css',
        'resources/js/app.js'
    ])
<style>
.client-profile{position:relative!important;}
.profile-dropdown{display:none;position:absolute;top:calc(100% + 12px);right:0;z-index:99999;min-width:230px;}
.profile-dropdown.show{display:block!important;}
</style>
</head>
<body>
<div class="client-app">
    {{-- =========================================================
        ARCHITECTURAL BACKGROUND
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
                <span class="bp-axis axis-a">
                    A
                </span>
                <span class="bp-axis axis-b">
                    B
                </span>
                <span class="bp-axis axis-c">
                    C
                </span>
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
            <small>
                7.50 m
            </small>
        </div>
    </div>
    {{-- =========================================================
        TOPBAR
    ========================================================== --}}
    <header class="client-topbar">
        <div class="client-topbar-inner">
            {{-- BRAND --}}
            <div class="client-brand">
                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Open navigation"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 17h16"></path>
                    </svg>
                </button>
                <a
                    href="{{ route('client.dashboard') }}"
                    class="client-logo"
                >
                    <img
                        src="{{ asset('images/arlogo.jpg') }}"
                        alt="ArchiTrack"
                    >
                </a>
                <span class="client-portal-label">
                    Client Portal
                </span>
            </div>
            {{-- NAVIGATION --}}
            <nav class="client-navigation">
                <a
                    href="{{ route('client.dashboard') }}"
                    class="client-nav-link active"
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
                    class="client-nav-link"
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
            {{-- ACCOUNT AREA --}}
            <div class="client-account-area">
                {{-- =================================================
                    NOTIFICATIONS
                ================================================== --}}
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
                                d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"
                            ></path>
                            <path d="M10 20h4"></path>
                        </svg>
                        <span
                            class="notification-badge"
                            id="notificationBadge"
                            hidden
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
                                    Project Updates
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
                                Mark all read
                            </button>
                        </div>
                        <div
                            class="notification-list"
                            id="notificationList"
                        >
                            <div class="notification-loading">
                                Loading notifications...
                            </div>
                        </div>
                    </div>
                </div>
                {{-- =================================================
                    PROFILE
                ================================================== --}}
                <div class="client-profile">
                    <div class="client-avatar">
                        @if($user->profile_image)
                            <img
                                src="{{ asset('storage/' . $user->profile_image) }}"
                                alt="{{ $user->name }}"
                            >
                        @else
                            {{ strtoupper(
                                substr(
                                    $user->name,
                                    0,
                                    1
                                )
                            ) }}
                        @endif
                    </div>
                    <div class="client-profile-text">
                        <strong>
                            {{ $user->name }}
                        </strong>
                        <span>
                            Client
                        </span>
                    </div>
                    <button
                        type="button"
                        class="profile-menu-button"
                        id="profileMenuButton"
                        aria-label="Open profile menu"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5"></path>
                        </svg>
                    </button>
                    <div
                        class="profile-dropdown"
                        id="profileDropdown"
                    >
                        <div class="dropdown-user">
                            <strong>
                                {{ $user->name }}
                            </strong>
                            <span>
                                {{ $user->email }}
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
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- =========================================================
        MOBILE NAVIGATION
    ========================================================== --}}
    <div
        class="mobile-navigation"
        id="mobileNavigation"
    >
        <a
            href="{{ route('client.dashboard') }}"
            class="active"
        >
            Home
        </a>
        <a href="{{ route('client.projects.index') }}">
            My Project
        </a>
        <a href="{{ route('client.files.index') }}">
            Files
        </a>
        <a href="{{ route('client.meetings.index') }}">
            Meetings
        </a>
        <a href="{{ route('client.account.index') }}">
            Account
        </a>
    </div>
    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <main class="client-main">
        {{-- WELCOME --}}
        <section class="client-welcome">
            <div class="welcome-line"></div>
            <div>
                <span class="welcome-date">
                    {{ strtoupper(
                        $phTime->format(
                            'l, F d, Y'
                        )
                    ) }}
                </span>
                <h1>
                    {{ $greeting }},
                    {{ explode(
                        ' ',
                        $user->name
                    )[0] }}!
                </h1>
                <p>
                    Here's the latest on your project.
                </p>
            </div>
        </section>
        @if($currentProject)
            <section class="dashboard-main-grid">
                {{-- =================================================
                    CURRENT PROJECT
                ================================================== --}}
                <article class="client-card project-card">
                    <div class="card-top">
                        <div>
                            <span class="card-label">
                                Current Project
                            </span>
                            <h2>
                                {{ $currentProject->project_name }}
                            </h2>
                            <p>
                                Architect:
                                <strong>
                                    {{ optional(
                                        $currentProject->architect
                                    )->name
                                        ?? 'Assigned Architect'
                                    }}
                                </strong>
                            </p>
                        </div>
                        <div class="progress-summary">
                            <span>
                                Overall Progress
                            </span>
                            <strong>
                                {{ $currentProject->progress ?? 0 }}%
                            </strong>
                            <div class="progress-track">
                                <div
                                    class="progress-fill"
                                    style="
                                        width:
                                        {{ min(
                                            100,
                                            max(
                                                0,
                                                $currentProject->progress ?? 0
                                            )
                                        ) }}%;
                                    "
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div class="project-card-body">
                        {{-- =================================================
                            PROJECT IMAGE / PREVIEW
                        ================================================== --}}
                        <div
                            class="project-image
                                {{ !$hasCustomProjectImage
                                    ? 'default-project-image'
                                    : ''
                                }}"
                        >
                            <img
                                src="{{ $projectImageUrl }}"
                                alt="{{ $currentProject->project_name }}"
                                onerror="
                                    this.style.display='none';
                                    this.parentElement.classList.add('default-project-image');
                                    this.parentElement.querySelector('.default-project-overlay').style.display='flex';
                                "
                            >
                            <div
                                class="default-project-overlay"
                                style="{{ $hasCustomProjectImage ? 'display: none;' : '' }}"
                            >
                                <div class="default-project-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M3 21V9l9-6 9 6v12"></path>
                                        <path d="M9 21v-7h6v7"></path>
                                        <path d="M3 9l9-6 9 6"></path>
                                    </svg>
                                </div>
                                <strong>
                                    Project Preview
                                </strong>
                                <span>
                                    Your project image will appear here
                                    once updated by your architect.
                                </span>
                            </div>
                        </div>
                        <div class="project-info-column">
                            <div class="project-info-box">
                                <div class="info-icon">
                                    <svg viewBox="0 0 24 24">
                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="16"
                                            rx="2"
                                        ></rect>
                                        <path d="M8 3v4"></path>
                                        <path d="M16 3v4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span>
                                        Target Completion
                                    </span>
                                    <strong>
                                        @if($currentProject->target_date)
                                            {{ \Carbon\Carbon::parse(
                                                $currentProject->target_date
                                            )->format('M d, Y') }}
                                        @else
                                            Not set
                                        @endif
                                    </strong>
                                </div>
                            </div>
                            <div class="project-info-box">
                                <div class="info-icon">
                                    <svg viewBox="0 0 24 24">
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        ></circle>
                                        <path d="M12 7v5l3 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span>
                                        Time Remaining
                                    </span>
                                    <strong>
                                        @if(
                                            $daysLeft !== null
                                            && $daysLeft > 0
                                        )
                                            {{ $daysLeft }} days left
                                        @elseif($daysLeft === 0)
                                            Due today
                                        @elseif(
                                            $daysLeft !== null
                                            && $daysLeft < 0
                                        )
                                            Past target
                                        @else
                                            Not available
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        href="{{ route('client.projects.index') }}"
                        class="orange-outline-button"
                    >
                        View Project Details
                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14"></path>
                            <path d="M14 7l5 5-5 5"></path>
                        </svg>
                    </a>
                </article>
                {{-- =================================================
                    NEXT MEETING
                ================================================== --}}
                <article class="client-card meeting-card">
                    <div class="meeting-card-heading">
                        <div>
                            <span class="card-label">
                                Next Up
                            </span>
                            <h2>
                                Upcoming Meeting
                            </h2>
                        </div>
                        <div class="calendar-icon">
                            <svg viewBox="0 0 24 24">
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="16"
                                    rx="2"
                                ></rect>
                                <path d="M8 3v4"></path>
                                <path d="M16 3v4"></path>
                                <path d="M3 10h18"></path>
                            </svg>
                        </div>
                    </div>
                    @if($nextMeeting)
                        <div class="meeting-detail-box">
                            <div class="meeting-detail-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="16"
                                        rx="2"
                                    ></rect>
                                    <path d="M8 3v4"></path>
                                    <path d="M16 3v4"></path>
                                </svg>
                            </div>
                            <div>
                                <strong>
                                    {{ $nextMeeting->title
                                        ?? 'Project Meeting'
                                    }}
                                </strong>
                                <span>
                                    {{ \Carbon\Carbon::parse(
                                        $nextMeeting->meeting_date
                                    )->format(
                                        'M d, Y'
                                    ) }}
                                </span>
                                <small>
                                    {{ \Carbon\Carbon::parse(
                                        $nextMeeting->start_time
                                        ?? $nextMeeting->meeting_date
                                    )->format(
                                        'g:i A'
                                    ) }}
                                </small>
                            </div>
                        </div>
                        <div class="meeting-countdown">
                            <strong>
                                @if($meetingDaysLeft === 0)
                                    Today
                                @else
                                    {{ (int) round($meetingDaysLeft) }}
                                @endif
                            </strong>
                            <div>
                                <span>
                                    @if($meetingDaysLeft === 0)
                                        Meeting Day
                                    @elseif($meetingDaysLeft === 1)
                                        Day Left
                                    @else
                                        Days Left
                                    @endif
                                </span>
                                <small>
                                    until your next meeting
                                </small>
                            </div>
                        </div>
                        <a
                            href="{{ route('client.meetings.index') }}"
                            class="orange-outline-button meeting-link"
                        >
                            View Meeting
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14"></path>
                                <path d="M14 7l5 5-5 5"></path>
                            </svg>
                        </a>
                    @else
                        <div class="empty-meeting-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12l4 4 10-10"></path>
                                </svg>
                            </div>
                            <strong>
                                No upcoming meeting
                            </strong>
                            <span>
                                You're all caught up for now.
                            </span>
                        </div>
                    @endif
                </article>
            </section>
            {{-- =====================================================
                QUICK ACCESS
            ====================================================== --}}
            <section class="quick-access-section">
                <div class="quick-access-title">
                    <span class="card-label">
                        Quick Access
                    </span>
                    <h2>
                        What would you like to do?
                    </h2>
                </div>
                <div class="quick-access-grid">
                    <a
                        href="{{ route('client.messages.index') }}"
                        class="quick-access-item"
                    >
                        <div class="quick-icon orange">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 5h16v11H8l-4 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>
                                Message Architect
                            </strong>
                            <span>
                                Send a message or ask a question.
                            </span>
                        </div>
                        <svg
                            class="quick-arrow"
                            viewBox="0 0 24 24"
                        >
                            <path d="M5 12h14"></path>
                            <path d="M14 7l5 5-5 5"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('client.projects.index') }}"
                        class="quick-access-item"
                    >
                        <div class="quick-icon green">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16v12H7l-3 3z"></path>
                                <path d="M8 8h8"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>
                                Request Revision
                            </strong>
                            <span>
                                Submit feedback on the design.
                            </span>
                        </div>
                        <svg
                            class="quick-arrow"
                            viewBox="0 0 24 24"
                        >
                            <path d="M5 12h14"></path>
                            <path d="M14 7l5 5-5 5"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('client.files.index') }}"
                        class="quick-access-item"
                    >
                        <div class="quick-icon blue">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 6h7l2 2h9v11H3z"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>
                                View Files
                            </strong>
                            <span>
                                Browse your project documents.
                            </span>
                        </div>
                        <svg
                            class="quick-arrow"
                            viewBox="0 0 24 24"
                        >
                            <path d="M5 12h14"></path>
                            <path d="M14 7l5 5-5 5"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('client.meetings.index') }}"
                        class="quick-access-item"
                    >
                        <div class="quick-icon purple">
                            <svg viewBox="0 0 24 24">
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="16"
                                    rx="2"
                                ></rect>
                                <path d="M8 3v4"></path>
                                <path d="M16 3v4"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>
                                View Meetings
                            </strong>
                            <span>
                                Check your meeting schedule.
                            </span>
                        </div>
                        <svg
                            class="quick-arrow"
                            viewBox="0 0 24 24"
                        >
                            <path d="M5 12h14"></path>
                            <path d="M14 7l5 5-5 5"></path>
                        </svg>
                    </a>
                </div>
            </section>
        @else
            <section class="no-project-state">
                <div class="no-project-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21V9l9-6 9 6v12"></path>
                        <path d="M9 21v-7h6v7"></path>
                    </svg>
                </div>
                <h2>
                    No project assigned yet
                </h2>
                <p>
                    Once your architect assigns a project,
                    it will appear here automatically.
                </p>
            </section>
        @endif
    </main>
</div>
<script>
document.addEventListener(
    'DOMContentLoaded',
    function () {
        /*
        |--------------------------------------------------------------------------
        | CSRF TOKEN
        |--------------------------------------------------------------------------
        */
        const csrfToken =
            document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');
        /*
        |--------------------------------------------------------------------------
        | PROFILE DROPDOWN
        |--------------------------------------------------------------------------
        */
        const profileMenuButton =
            document.getElementById(
                'profileMenuButton'
            );
        const profileDropdown =
            document.getElementById(
                'profileDropdown'
            );
        if (
            profileMenuButton
            && profileDropdown
        ) {
            profileMenuButton.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                    profileDropdown
                        .classList
                        .toggle('show');
                    notificationDropdown
                        ?.classList
                        .remove('show');
                }
            );
            profileDropdown.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );
        }
        /*
        |--------------------------------------------------------------------------
        | MOBILE NAVIGATION
        |--------------------------------------------------------------------------
        */
        const mobileMenuButton =
            document.getElementById(
                'mobileMenuButton'
            );
        const mobileNavigation =
            document.getElementById(
                'mobileNavigation'
            );
        if (
            mobileMenuButton
            && mobileNavigation
        ) {
            mobileMenuButton.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                    mobileNavigation
                        .classList
                        .toggle('show');
                }
            );
            mobileNavigation.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );
        }
        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        const notificationButton =
            document.getElementById(
                'notificationButton'
            );
        const notificationDropdown =
            document.getElementById(
                'notificationDropdown'
            );
        const notificationBadge =
            document.getElementById(
                'notificationBadge'
            );
        const notificationList =
            document.getElementById(
                'notificationList'
            );
        const markAllReadButton =
            document.getElementById(
                'markAllReadButton'
            );
        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */
        function escapeHtml(value) {
            const div =
                document.createElement('div');
            div.textContent =
                value ?? '';
            return div.innerHTML;
        }
        /*
        |--------------------------------------------------------------------------
        | FORMAT TIME
        |--------------------------------------------------------------------------
        */
        function formatNotificationTime(
            dateValue
        ) {
            if (!dateValue) {
                return '';
            }
            const date =
                new Date(dateValue);
            const now =
                new Date();
            const difference =
                now - date;
            const minutes =
                Math.floor(
                    difference / 60000
                );
            if (minutes < 1) {
                return 'Just now';
            }
            if (minutes < 60) {
                return `${minutes} min ago`;
            }
            const hours =
                Math.floor(
                    minutes / 60
                );
            if (hours < 24) {
                return `${hours} hr ago`;
            }
            const days =
                Math.floor(
                    hours / 24
                );
            if (days < 7) {
                return `${days} ${
                    days === 1
                        ? 'day'
                        : 'days'
                } ago`;
            }
            return date.toLocaleDateString(
                'en-PH',
                {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                }
            );
        }
        /*
        |--------------------------------------------------------------------------
        | UPDATE BADGE
        |--------------------------------------------------------------------------
        */
        function updateNotificationBadge(
            count
        ) {
            const unread =
                Number(count || 0);
            if (!notificationBadge) {
                return;
            }
            if (unread > 0) {
                notificationBadge.hidden =
                    false;
                notificationBadge.textContent =
                    unread > 99
                        ? '99+'
                        : unread;
            } else {
                notificationBadge.hidden =
                    true;
                notificationBadge.textContent =
                    '0';
            }
        }
        /*
        |--------------------------------------------------------------------------
        | RENDER NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        function renderNotifications(
            notifications
        ) {
            if (!notificationList) {
                return;
            }
            if (
                !notifications
                || notifications.length === 0
            ) {
                notificationList.innerHTML = `
                    <div class="notification-empty">
                        <div class="notification-empty-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"
                                ></path>
                                <path d="M10 20h4"></path>
                            </svg>
                        </div>
                        <strong>
                            No notifications yet
                        </strong>
                        <span>
                            New project updates will appear here.
                        </span>
                    </div>
                `;
                return;
            }
            notificationList.innerHTML =
                notifications
                    .map(
                        function (
                            notification
                        ) {
                            const data =
                                notification.data
                                || {};
                            const type =
                                escapeHtml(
                                    data.type
                                    || 'general'
                                );
                            const title =
                                escapeHtml(
                                    data.title
                                    || 'Project Update'
                                );
                            const message =
                                escapeHtml(
                                    data.message
                                    || ''
                                );
                            const notificationUrl =
                                data.url
                                || '#';
                            const isUnread =
                                !notification.read_at;
                            const time =
                                formatNotificationTime(
                                    notification.created_at
                                );
                            return `
                                <a
                                    href="${escapeHtml(notificationUrl)}"
                                    class="notification-item ${
                                        isUnread
                                            ? 'unread'
                                            : ''
                                    }"
                                    data-notification-id="${notification.id}"
                                    data-type="${type}"
                                >
                                    <span
                                        class="notification-type-icon"
                                    >
                                        ${getNotificationIcon(type)}
                                    </span>
                                    <div
                                        class="notification-content"
                                    >
                                        <div
                                            class="notification-item-top"
                                        >
                                            <strong
                                                class="notification-item-title"
                                            >
                                                ${title}
                                            </strong>
                                            ${
                                                isUnread
                                                    ? `
                                                        <span
                                                            class="notification-unread-dot"
                                                        ></span>
                                                    `
                                                    : ''
                                            }
                                        </div>
                                        ${
                                            message
                                                ? `
                                                    <p
                                                        class="notification-item-message"
                                                    >
                                                        ${message}
                                                    </p>
                                                `
                                                : ''
                                        }
                                        <span
                                            class="notification-item-time"
                                        >
                                            ${time}
                                        </span>
                                    </div>
                                </a>
                            `;
                        }
                    )
                    .join('');
            /*
            |--------------------------------------------------------------------------
            | CLICK NOTIFICATION
            |--------------------------------------------------------------------------
            */
            document
                .querySelectorAll(
                    '.notification-item'
                )
                .forEach(
                    function (item) {
                        item.addEventListener(
                            'click',
                            async function (event) {
                                const notificationId =
                                    this.dataset
                                        .notificationId;
                                const destination =
                                    this.getAttribute(
                                        'href'
                                    );
                                if (
                                    this.classList
                                        .contains('unread')
                                ) {
                                    event.preventDefault();
                                    await markNotificationAsRead(
                                        notificationId
                                    );
                                    if (
                                        destination
                                        && destination !== '#'
                                    ) {
                                        window.location.href =
                                            destination;
                                    }
                                }
                            }
                        );
                    }
                );
        }
        /*
        |--------------------------------------------------------------------------
        | ICONS
        |--------------------------------------------------------------------------
        */
        function getNotificationIcon(
            type
        ) {
            if (type === 'message') {
                return `
                    <svg viewBox="0 0 24 24">
                        <path d="M4 5h16v11H8l-4 4z"></path>
                    </svg>
                `;
            }
            if (type === 'file') {
                return `
                    <svg viewBox="0 0 24 24">
                        <path d="M3 6h7l2 2h9v11H3z"></path>
                    </svg>
                `;
            }
            if (type === 'revision') {
                return `
                    <svg viewBox="0 0 24 24">
                        <path d="M4 12a8 8 0 101.8-5"></path>
                        <path d="M4 4v6h6"></path>
                    </svg>
                `;
            }
            if (type === 'meeting') {
                return `
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>
                        <path d="M3 10h18"></path>
                    </svg>
                `;
            }
            return `
                <svg viewBox="0 0 24 24">
                    <path d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"></path>
                    <path d="M10 20h4"></path>
                </svg>
            `;
        }
        /*
        |--------------------------------------------------------------------------
        | FETCH NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        async function loadNotifications() {
            if (!notificationList) {
                return;
            }
            try {
                const response =
                    await fetch(
                        "{{ route('client.notifications.index') }}",
                        {
                            method: 'GET',
                            headers: {
                                'Accept':
                                    'application/json',
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );
                if (!response.ok) {
                    throw new Error(
                        'Unable to load notifications.'
                    );
                }
                const data =
                    await response.json();
                updateNotificationBadge(
                    data.unread_count
                );
                renderNotifications(
                    data.notifications
                );
            } catch (error) {
                console.error(
                    error
                );
                notificationList.innerHTML = `
                    <div class="notification-error">
                        <strong>
                            Couldn't load notifications
                        </strong>
                        <span>
                            Please try again.
                        </span>
                    </div>
                `;
            }
        }
        /*
        |--------------------------------------------------------------------------
        | MARK ONE AS READ
        |--------------------------------------------------------------------------
        */
        async function markNotificationAsRead(
            notificationId
        ) {
            try {
                const url =
                    "{{ route('client.notifications.read', ['id' => '__ID__']) }}"
                        .replace(
                            '__ID__',
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
                                'Content-Type':
                                    'application/json',
                                'X-CSRF-TOKEN':
                                    csrfToken,
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );
                if (!response.ok) {
                    throw new Error(
                        'Unable to mark notification as read.'
                    );
                }
                await loadNotifications();
                return true;
            } catch (error) {
                console.error(
                    error
                );
                return false;
            }
        }
        /*
        |--------------------------------------------------------------------------
        | MARK ALL AS READ
        |--------------------------------------------------------------------------
        */
        async function markAllNotificationsAsRead() {
            try {
                const response =
                    await fetch(
                        "{{ route('client.notifications.readAll') }}",
                        {
                            method: 'POST',
                            headers: {
                                'Accept':
                                    'application/json',
                                'Content-Type':
                                    'application/json',
                                'X-CSRF-TOKEN':
                                    csrfToken,
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );
                if (!response.ok) {
                    throw new Error(
                        'Unable to mark notifications as read.'
                    );
                }
                await loadNotifications();
            } catch (error) {
                console.error(
                    error
                );
            }
        }
        /*
        |--------------------------------------------------------------------------
        | NOTIFICATION BUTTON
        |--------------------------------------------------------------------------
        */
        if (
            notificationButton
            && notificationDropdown
        ) {
            notificationButton.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                    const isOpen =
                        notificationDropdown
                            .classList
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
                    if (isOpen) {
                        loadNotifications();
                    }
                }
            );
            notificationDropdown.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );
        }
        /*
        |--------------------------------------------------------------------------
        | MARK ALL BUTTON
        |--------------------------------------------------------------------------
        */
        if (markAllReadButton) {
            markAllReadButton.addEventListener(
                'click',
                function () {
                    markAllNotificationsAsRead();
                }
            );
        }
        /*
        |--------------------------------------------------------------------------
        | OUTSIDE CLICK
        |--------------------------------------------------------------------------
        */
        document.addEventListener(
            'click',
            function () {
                profileDropdown
                    ?.classList
                    .remove('show');
                notificationDropdown
                    ?.classList
                    .remove('show');
                notificationButton
                    ?.setAttribute(
                        'aria-expanded',
                        'false'
                    );
                mobileNavigation
                    ?.classList
                    .remove('show');
            }
        );
        /*
        |--------------------------------------------------------------------------
        | INITIAL NOTIFICATION LOAD
        |--------------------------------------------------------------------------
        */
        loadNotifications();
    }
);
</script>
</body>
</html>
