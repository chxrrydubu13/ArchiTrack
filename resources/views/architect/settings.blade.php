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
        Settings | ArchiTrack
    </title>
    @vite([
        'resources/css/app.css',
        'resources/css/architect-dashboard.css',
        'resources/css/architect-settings.css',
                'resources/css/architect-settings-redesign.css',
'resources/js/app.js'
    ])
    <style>
        html, body {
            font-family: "Segoe UI", Arial, sans-serif !important;
        }
        button, input, textarea, select, option {
            font-family: inherit !important;
        }
        .architect-settings-page,
        .architect-settings-page button,
        .architect-settings-page input,
        .architect-settings-page select,
        .architect-settings-page textarea {
            font-size: 14px;
        }
        .settings-eyebrow,
        .settings-menu-label,
        .panel-eyebrow {
            font-size: 11px !important;
        }
        .settings-page-header > div > p,
        .settings-account-info span,
        .settings-account-info small,
        .settings-menu-item span,
        .settings-panel-header p,
        .settings-field small,
        .security-notice span,
        .preference-group-heading span,
        .preference-row span,
        .meeting-reminder-row span,
        .notification-summary span,
        .preferences-action-bar span {
            font-size: 13px !important;
            line-height: 1.5;
        }
        .settings-menu-item strong,
        .settings-field label,
        .security-notice strong,
        .preference-group-heading strong,
        .preference-row strong,
        .meeting-reminder-row strong,
        .notification-summary strong,
        .preferences-action-bar strong {
            font-size: 14px !important;
        }
        .settings-field input,
        .meeting-reminder-row select,
        .edit-settings-btn,
        .settings-save-btn,
        .settings-cancel-btn,
        .password-toggle {
            font-size: 13px !important;
        }
        .settings-panel-header h3 {
            font-size: 22px;
        }
    </style>
</head>
<body>
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
{{-- =========================================================
    SIDEBAR
\========================================================= --}}
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
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="identity-info">
                    <strong>
                        {{ auth()->user()->name }}
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
{{-- =========================================================
    MAIN
\========================================================= --}}
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
            <h1>
                Settings
            </h1>
        </div>
        <div class="top-date">
            <span>
                {{ now()->format('l') }}
            </span>
            <strong>
                {{ now()->format('F d, Y') }}
            </strong>
        </div>
    </header>
    <div class="architect-settings-page">
        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <section class="settings-page-header">
            <div>
                <span class="settings-eyebrow">
                    ACCOUNT SETTINGS
                </span>
                <h2>
                    Manage Your Account
                </h2>
                <p>
                    Update your profile, password,
                    communication preferences, and notifications.
                </p>
            </div>
            <div class="settings-account-card">
                <div class="settings-account-avatar">
                    {{ strtoupper(
                        substr(
                            $user->name,
                            0,
                            1
                        )
                    ) }}
                </div>
                <div class="settings-account-info">
                    <strong>
                        {{ $user->name }}
                    </strong>
                    <span>
                        {{ $user->email }}
                    </span>
                    <small>
                        Architect Account
                    </small>
                </div>
            </div>
        </section>
        {{-- =====================================================
            SUCCESS
        ====================================================== --}}
        @if(
            session('profile_success')
            || session('password_success')
            || session('settings_success')
        )
            <div class="settings-message success">
                <div class="message-icon">
                    <svg viewBox="0 0 24 24">
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        ></circle>
                        <path d="M8 12l3 3 5-6"></path>
                    </svg>
                </div>
                <div>
                    <strong>
                        Changes saved
                    </strong>
                    <span>
                        {{ session('profile_success')
                            ?? session('password_success')
                            ?? session('settings_success')
                        }}
                    </span>
                </div>
            </div>
        @endif
        {{-- =====================================================
            ERRORS
        ====================================================== --}}
        @if($errors->any())
            <div class="settings-message error">
                <div class="message-icon">
                    <svg viewBox="0 0 24 24">
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        ></circle>
                        <path d="M12 7v6"></path>
                        <path d="M12 17h.01"></path>
                    </svg>
                </div>
                <div>
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
            </div>
        @endif
        {{-- =====================================================
            SETTINGS LAYOUT
        ====================================================== --}}
        <div class="settings-layout">
            {{-- =================================================
                LEFT MENU
            ================================================== --}}
            <aside class="settings-side-menu">
                <span class="settings-menu-label">
                    SETTINGS
                </span>
                <button
                    type="button"
                    class="settings-menu-item active"
                    data-setting-target="profilePanel"
                >
                    <span class="settings-menu-icon">
                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="8"
                                r="4"
                            ></circle>
                            <path
                                d="M5 21c0-4 3-7 7-7s7 3 7 7"
                            ></path>
                        </svg>
                    </span>
                    <div>
                        <strong>
                            Profile
                        </strong>
                        <span>
                            Personal information
                        </span>
                    </div>
                </button>
                <button
                    type="button"
                    class="settings-menu-item"
                    data-setting-target="securityPanel"
                >
                    <span class="settings-menu-icon">
                        <svg viewBox="0 0 24 24">
                            <rect
                                x="5"
                                y="10"
                                width="14"
                                height="10"
                                rx="2"
                            ></rect>
                            <path
                                d="M8 10V7a4 4 0 018 0v3"
                            ></path>
                        </svg>
                    </span>
                    <div>
                        <strong>
                            Security
                        </strong>
                        <span>
                            Change your password
                        </span>
                    </div>
                </button>
                <button
                    type="button"
                    class="settings-menu-item"
                    data-setting-target="preferencesPanel"
                >
                    <span class="settings-menu-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 5h16v11H8l-4 4z"></path>
                            <path d="M8 9h8"></path>
                        </svg>
                    </span>
                    <div>
                        <strong>
                            Preferences
                        </strong>
                        <span>
                            Messages and meetings
                        </span>
                    </div>
                </button>
                <button
                    type="button"
                    class="settings-menu-item"
                    data-setting-target="notificationsPanel"
                >
                    <span class="settings-menu-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"
                            ></path>
                            <path d="M10 20h4"></path>
                        </svg>
                    </span>
                    <div>
                        <strong>
                            Notifications
                        </strong>
                        <span>
                            Notification controls
                        </span>
                    </div>
                </button>
            </aside>
            {{-- =================================================
                RIGHT CONTENT
            ================================================== --}}
            <div class="settings-content">
                {{-- =================================================
                    PROFILE PANEL
                ================================================== --}}
                <section
                    class="settings-panel active"
                    id="profilePanel"
                >
                    <div class="settings-panel-header">
                        <div>
                            <span class="panel-eyebrow">
                                ACCOUNT
                            </span>
                            <h3>
                                Profile Information
                            </h3>
                            <p>
                                View and update your account details.
                            </p>
                        </div>
                        <button
                            type="button"
                            class="edit-settings-btn"
                            id="editProfileButton"
                        >
                            <svg viewBox="0 0 24 24">
                                <path d="M4 20h4l11-11-4-4L4 16z"></path>
                                <path d="M13 7l4 4"></path>
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                    <form
                        method="POST"
                        action="{{ route(
                            'architect.settings.profile.update'
                        ) }}"
                        id="profileForm"
                    >
                        @csrf
                        @method('PUT')
                        <div class="profile-overview">
                            <div class="large-profile-avatar">
                                {{ strtoupper(
                                    substr(
                                        $user->name,
                                        0,
                                        1
                                    )
                                ) }}
                            </div>
                            <div>
                                <strong>
                                    {{ $user->name }}
                                </strong>
                                <span>
                                    Architect
                                </span>
                            </div>
                        </div>
                        <div class="settings-form-grid">
                            <div class="settings-field">
                                <label for="profileName">
                                    Full Name
                                </label>
                                <input
                                    type="text"
                                    id="profileName"
                                    name="name"
                                    value="{{ old(
                                        'name',
                                        $user->name
                                    ) }}"
                                    disabled
                                    required
                                >
                                <small>
                                    Letters, spaces, periods,
                                    and hyphens only.
                                </small>
                            </div>
                            <div class="settings-field">
                                <label for="profileEmail">
                                    Email Address
                                </label>
                                <input
                                    type="email"
                                    id="profileEmail"
                                    name="email"
                                    value="{{ old(
                                        'email',
                                        $user->email
                                    ) }}"
                                    disabled
                                    required
                                >
                            </div>
                        </div>
                        <div
                            class="edit-action-row"
                            id="profileActions"
                        >
                            <button
                                type="button"
                                class="settings-cancel-btn"
                                id="cancelProfileButton"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="settings-save-btn"
                            >
                                Save Changes
                            </button>
                        </div>
                    </form>
                </section>
                {{-- =================================================
                    SECURITY PANEL
                ================================================== --}}
                <section
                    class="settings-panel"
                    id="securityPanel"
                >
                    <div class="settings-panel-header">
                        <div>
                            <span class="panel-eyebrow">
                                SECURITY
                            </span>
                            <h3>
                                Change Password
                            </h3>
                            <p>
                                Use a strong password to protect
                                your ArchiTrack account.
                            </p>
                        </div>
                    </div>
                    <div class="security-notice">
                        <div class="security-notice-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 3l8 4v5c0 5-3.4 8-8 9-4.6-1-8-4-8-9V7z"
                                ></path>
                                <path d="M9 12l2 2 4-5"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>
                                Password Security
                            </strong>
                            <span>
                                Your new password must contain
                                at least 8 characters.
                            </span>
                        </div>
                    </div>
                    <form
                        method="POST"
                        action="{{ route(
                            'architect.settings.password.update'
                        ) }}"
                    >
                        @csrf
                        @method('PUT')
                        <div class="settings-form-grid password-grid">
                            <div class="settings-field full-field">
                                <label>
                                    Current Password
                                </label>
                                <div class="password-input">
                                    <input
                                        type="password"
                                        name="current_password"
                                        id="currentPassword"
                                        required
                                    >
                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-password-target="currentPassword"
                                    >
                                        Show
                                    </button>
                                </div>
                            </div>
                            <div class="settings-field">
                                <label>
                                    New Password
                                </label>
                                <div class="password-input">
                                    <input
                                        type="password"
                                        name="password"
                                        id="newPassword"
                                        required
                                    >
                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-password-target="newPassword"
                                    >
                                        Show
                                    </button>
                                </div>
                            </div>
                            <div class="settings-field">
                                <label>
                                    Confirm New Password
                                </label>
                                <div class="password-input">
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="confirmPassword"
                                        required
                                    >
                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-password-target="confirmPassword"
                                    >
                                        Show
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="normal-save-row">
                            <button
                                type="submit"
                                class="settings-save-btn"
                            >
                                Update Password
                            </button>
                        </div>
                    </form>
                </section>
                {{-- =================================================
                    PREFERENCES FORM
                ================================================== --}}
                <form
                    method="POST"
                    action="{{ route(
                        'architect.settings.preferences.update'
                    ) }}"
                    id="preferencesForm"
                >
                    @csrf
                    @method('PUT')
                    {{-- =================================================
                        PREFERENCES PANEL
                    ================================================== --}}
                    <section
                        class="settings-panel"
                        id="preferencesPanel"
                    >
                        <div class="settings-panel-header">
                            <div>
                                <span class="panel-eyebrow">
                                    COMMUNICATION
                                </span>
                                <h3>
                                    Messaging & Meeting Preferences
                                </h3>
                                <p>
                                    Control how communication
                                    and reminders work.
                                </p>
                            </div>
                            <button
                                type="button"
                                class="edit-settings-btn"
                                id="editPreferencesButton"
                            >
                                <svg viewBox="0 0 24 24">
                                    <path
                                        d="M4 20h4l11-11-4-4L4 16z"
                                    ></path>
                                    <path d="M13 7l4 4"></path>
                                </svg>
                                Edit Preferences
                            </button>
                        </div>
                        {{-- MESSAGING --}}
                        <div class="preference-group">
                            <div class="preference-group-heading">
                                <div class="preference-group-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path
                                            d="M4 5h16v11H8l-4 4z"
                                        ></path>
                                    </svg>
                                </div>
                                <div>
                                    <strong>
                                        Messaging
                                    </strong>
                                    <span>
                                        Control message behavior
                                        in your project conversations.
                                    </span>
                                </div>
                            </div>
                            <div class="preference-list">
                                <label class="preference-row">
                                    <div>
                                        <strong>
                                            Message Notifications
                                        </strong>
                                        <span>
                                            Receive an alert when
                                            a client sends a new message.
                                        </span>
                                    </div>
                                    <input
                                        type="checkbox"
                                        name="message_notifications"
                                        value="1"
                                        class="preference-control"
                                        {{ $settings->message_notifications
                                            ? 'checked'
                                            : ''
                                        }}
                                        disabled
                                    >
                                    <span class="setting-toggle"></span>
                                </label>
                                <label class="preference-row">
                                    <div>
                                        <strong>
                                            Notification Sound
                                        </strong>
                                        <span>
                                            Play a short sound when
                                            a new message or important
                                            update is received.
                                        </span>
                                    </div>
                                    <input
                                        type="checkbox"
                                        name="message_sound"
                                        value="1"
                                        class="preference-control"
                                        {{ $settings->message_sound
                                            ? 'checked'
                                            : ''
                                        }}
                                        disabled
                                    >
                                    <span class="setting-toggle"></span>
                                </label>
                                <label class="preference-row">
                                    <div>
                                        <strong>
                                            Message Preview
                                        </strong>
                                        <span>
                                            Show part of the client's
                                            message inside the notification.
                                        </span>
                                    </div>
                                    <input
                                        type="checkbox"
                                        name="message_preview"
                                        value="1"
                                        class="preference-control"
                                        {{ $settings->message_preview
                                            ? 'checked'
                                            : ''
                                        }}
                                        disabled
                                    >
                                    <span class="setting-toggle"></span>
                                </label>
                            </div>
                        </div>
                        {{-- MEETING SETTINGS --}}
                        <div class="preference-group">
                            <div class="preference-group-heading">
                                <div class="preference-group-icon meeting-icon">
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
                                <div>
                                    <strong>
                                        Meeting Reminders
                                    </strong>
                                    <span>
                                        Choose how ArchiTrack should
                                        remind you about meetings.
                                    </span>
                                </div>
                            </div>
                            <div class="meeting-preference-box">
                                <label class="preference-row simple-row">
                                    <div>
                                        <strong>
                                            Meeting Notifications
                                        </strong>
                                        <span>
                                            Receive reminders before
                                            scheduled client meetings.
                                        </span>
                                    </div>
                                    <input
                                        type="checkbox"
                                        name="meeting_notifications"
                                        value="1"
                                        class="preference-control"
                                        {{ $settings->meeting_notifications
                                            ? 'checked'
                                            : ''
                                        }}
                                        disabled
                                    >
                                    <span class="setting-toggle"></span>
                                </label>
                                <div class="meeting-reminder-row">
                                    <div>
                                        <strong>
                                            Default Reminder
                                        </strong>
                                        <span>
                                            Send the reminder before
                                            the meeting starts.
                                        </span>
                                    </div>
                                    <select
                                        name="meeting_reminder_minutes"
                                        class="preference-control"
                                        disabled
                                    >
                                        <option
                                            value="10"
                                            {{ $settings->meeting_reminder_minutes == 10
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            10 minutes before
                                        </option>
                                        <option
                                            value="15"
                                            {{ $settings->meeting_reminder_minutes == 15
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            15 minutes before
                                        </option>
                                        <option
                                            value="30"
                                            {{ $settings->meeting_reminder_minutes == 30
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            30 minutes before
                                        </option>
                                        <option
                                            value="60"
                                            {{ $settings->meeting_reminder_minutes == 60
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            1 hour before
                                        </option>
                                        <option
                                            value="120"
                                            {{ $settings->meeting_reminder_minutes == 120
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            2 hours before
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- =================================================
                        NOTIFICATIONS PANEL
                    ================================================== --}}
                    <section
                        class="settings-panel"
                        id="notificationsPanel"
                    >
                        <div class="settings-panel-header">
                            <div>
                                <span class="panel-eyebrow">
                                    NOTIFICATIONS
                                </span>
                                <h3>
                                    Project Notifications
                                </h3>
                                <p>
                                    Choose which project activities
                                    should notify you.
                                </p>
                            </div>
                            <button
                                type="button"
                                class="edit-settings-btn"
                                id="editNotificationsButton"
                            >
                                <svg viewBox="0 0 24 24">
                                    <path
                                        d="M4 20h4l11-11-4-4L4 16z"
                                    ></path>
                                    <path d="M13 7l4 4"></path>
                                </svg>
                                Edit Preferences
                            </button>
                        </div>
                        <div class="notification-summary">
                            <div class="notification-summary-icon">
                                <svg viewBox="0 0 24 24">
                                    <path
                                        d="M6 16v-5a6 6 0 0112 0v5l2 2H4z"
                                    ></path>
                                    <path d="M10 20h4"></path>
                                </svg>
                            </div>
                            <div>
                                <strong>
                                    Stay updated on project activity
                                </strong>
                                <span>
                                    These controls determine which
                                    ArchiTrack activities can send alerts.
                                </span>
                            </div>
                        </div>
                        <div class="preference-list notification-list">
                            <label class="preference-row">
                                <div>
                                    <strong>
                                        Email Notifications
                                    </strong>
                                    <span>
                                        Receive important ArchiTrack
                                        updates through your email.
                                    </span>
                                </div>
                                <input
                                    type="checkbox"
                                    name="email_notifications"
                                    value="1"
                                    class="preference-control"
                                    {{ $settings->email_notifications
                                        ? 'checked'
                                        : ''
                                    }}
                                    disabled
                                >
                                <span class="setting-toggle"></span>
                            </label>
                            <label class="preference-row">
                                <div>
                                    <strong>
                                        Revision Requests
                                    </strong>
                                    <span>
                                        Notify you when a client
                                        submits a new revision request.
                                    </span>
                                </div>
                                <input
                                    type="checkbox"
                                    name="revision_notifications"
                                    value="1"
                                    class="preference-control"
                                    {{ $settings->revision_notifications
                                        ? 'checked'
                                        : ''
                                    }}
                                    disabled
                                >
                                <span class="setting-toggle"></span>
                            </label>
                            <label class="preference-row">
                                <div>
                                    <strong>
                                        File Updates
                                    </strong>
                                    <span>
                                        Receive notifications when
                                        project files are uploaded
                                        or updated.
                                    </span>
                                </div>
                                <input
                                    type="checkbox"
                                    name="file_notifications"
                                    value="1"
                                    class="preference-control"
                                    {{ $settings->file_notifications
                                        ? 'checked'
                                        : ''
                                    }}
                                    disabled
                                >
                                <span class="setting-toggle"></span>
                            </label>
                        </div>
                    </section>
                    {{-- =================================================
                        SHARED PREFERENCES ACTION BAR
                    ================================================== --}}
                    <div
                        class="preferences-action-bar"
                        id="preferencesActions"
                    >
                        <div>
                            <strong>
                                Unsaved changes
                            </strong>
                            <span>
                                Save or cancel the preference changes.
                            </span>
                        </div>
                        <div class="action-buttons">
                            <button
                                type="button"
                                class="settings-cancel-btn"
                                id="cancelPreferencesButton"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="settings-save-btn"
                            >
                                Save Preferences
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
document.addEventListener(
    'DOMContentLoaded',
    function () {
        /*
        |--------------------------------------------------------------------------
        | SETTINGS SIDE MENU
        |--------------------------------------------------------------------------
        */
        const menuItems =
            document.querySelectorAll(
                '.settings-menu-item'
            );
        const panels =
            document.querySelectorAll(
                '.settings-panel'
            );
        menuItems.forEach(
            function (menuItem) {
                menuItem.addEventListener(
                    'click',
                    function () {
                        const targetId =
                            menuItem.dataset.settingTarget;
                        menuItems.forEach(
                            function (item) {
                                item.classList.remove(
                                    'active'
                                );
                            }
                        );
                        panels.forEach(
                            function (panel) {
                                panel.classList.remove(
                                    'active'
                                );
                            }
                        );
                        menuItem.classList.add(
                            'active'
                        );
                        const targetPanel =
                            document.getElementById(
                                targetId
                            );
                        if (targetPanel) {
                            targetPanel.classList.add(
                                'active'
                            );
                        }
                    }
                );
            }
        );
        /*
        |--------------------------------------------------------------------------
        | PROFILE EDIT MODE
        |--------------------------------------------------------------------------
        */
        const profileForm =
            document.getElementById(
                'profileForm'
            );
        const editProfileButton =
            document.getElementById(
                'editProfileButton'
            );
        const cancelProfileButton =
            document.getElementById(
                'cancelProfileButton'
            );
        const profileActions =
            document.getElementById(
                'profileActions'
            );
        const profileName =
            document.getElementById(
                'profileName'
            );
        const profileEmail =
            document.getElementById(
                'profileEmail'
            );
        const originalProfileName =
            profileName
                ? profileName.value
                : '';
        const originalProfileEmail =
            profileEmail
                ? profileEmail.value
                : '';
        function enableProfileEdit()
        {
            if (!profileName || !profileEmail) {
                return;
            }
            profileName.disabled = false;
            profileEmail.disabled = false;
            profileForm.classList.add(
                'editing'
            );
            editProfileButton.classList.add(
                'hidden'
            );
            profileActions.classList.add(
                'show'
            );
            profileName.focus();
        }
        function cancelProfileEdit()
        {
            if (!profileName || !profileEmail) {
                return;
            }
            profileName.value =
                originalProfileName;
            profileEmail.value =
                originalProfileEmail;
            profileName.disabled = true;
            profileEmail.disabled = true;
            profileForm.classList.remove(
                'editing'
            );
            editProfileButton.classList.remove(
                'hidden'
            );
            profileActions.classList.remove(
                'show'
            );
        }
        if (editProfileButton) {
            editProfileButton.addEventListener(
                'click',
                enableProfileEdit
            );
        }
        if (cancelProfileButton) {
            cancelProfileButton.addEventListener(
                'click',
                cancelProfileEdit
            );
        }
        /*
        |--------------------------------------------------------------------------
        | PREFERENCES EDIT MODE
        |--------------------------------------------------------------------------
        */
        const preferencesForm =
            document.getElementById(
                'preferencesForm'
            );
        const preferenceControls =
            document.querySelectorAll(
                '.preference-control'
            );
        const editPreferencesButton =
            document.getElementById(
                'editPreferencesButton'
            );
        const editNotificationsButton =
            document.getElementById(
                'editNotificationsButton'
            );
        const cancelPreferencesButton =
            document.getElementById(
                'cancelPreferencesButton'
            );
        const preferencesActions =
            document.getElementById(
                'preferencesActions'
            );
        /*
        |--------------------------------------------------------------------------
        | SAVE ORIGINAL VALUES
        |--------------------------------------------------------------------------
        */
        const originalPreferenceValues =
            [];
        preferenceControls.forEach(
            function (control) {
                originalPreferenceValues.push({
                    element: control,
                    type: control.type,
                    checked:
                        control.type === 'checkbox'
                            ? control.checked
                            : null,
                    value:
                        control.type !== 'checkbox'
                            ? control.value
                            : null
                });
            }
        );
        function enablePreferencesEdit()
        {
            preferenceControls.forEach(
                function (control) {
                    control.disabled = false;
                }
            );
            preferencesForm.classList.add(
                'editing'
            );
            if (editPreferencesButton) {
                editPreferencesButton.classList.add(
                    'hidden'
                );
            }
            if (editNotificationsButton) {
                editNotificationsButton.classList.add(
                    'hidden'
                );
            }
            preferencesActions.classList.add(
                'show'
            );
        }
        function cancelPreferencesEdit()
        {
            originalPreferenceValues.forEach(
                function (saved) {
                    if (
                        saved.type ===
                        'checkbox'
                    ) {
                        saved.element.checked =
                            saved.checked;
                    } else {
                        saved.element.value =
                            saved.value;
                    }
                    saved.element.disabled =
                        true;
                }
            );
            preferencesForm.classList.remove(
                'editing'
            );
            if (editPreferencesButton) {
                editPreferencesButton.classList.remove(
                    'hidden'
                );
            }
            if (editNotificationsButton) {
                editNotificationsButton.classList.remove(
                    'hidden'
                );
            }
            preferencesActions.classList.remove(
                'show'
            );
        }
        if (editPreferencesButton) {
            editPreferencesButton.addEventListener(
                'click',
                enablePreferencesEdit
            );
        }
        if (editNotificationsButton) {
            editNotificationsButton.addEventListener(
                'click',
                enablePreferencesEdit
            );
        }
        if (cancelPreferencesButton) {
            cancelPreferencesButton.addEventListener(
                'click',
                cancelPreferencesEdit
            );
        }
        /*
        |--------------------------------------------------------------------------
        | PASSWORD SHOW / HIDE
        |--------------------------------------------------------------------------
        */
        const passwordButtons =
            document.querySelectorAll(
                '.password-toggle'
            );
        passwordButtons.forEach(
            function (button) {
                button.addEventListener(
                    'click',
                    function () {
                        const targetId =
                            button.dataset.passwordTarget;
                        const input =
                            document.getElementById(
                                targetId
                            );
                        if (!input) {
                            return;
                        }
                        if (
                            input.type ===
                            'password'
                        ) {
                            input.type = 'text';
                            button.textContent =
                                'Hide';
                        } else {
                            input.type =
                                'password';
                            button.textContent =
                                'Show';
                        }
                    }
                );
            }
        );
    }
);
</script>
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
