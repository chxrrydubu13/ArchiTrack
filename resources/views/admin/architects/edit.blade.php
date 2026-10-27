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


<style>
    /* Scoped security UI; existing ARCHITRACK page layout remains unchanged. */
    .edit-security-panel { margin: 18px 0 24px; padding: 20px; border: 1px solid #d9dfe8; border-radius: 14px; background: #f8fafc; color: #253047; }
    .edit-security-panel.is-unlocked { background: #f4faf7; border-color: #b8d8c5; }
    .security-panel-header { display: flex; gap: 14px; align-items: flex-start; }
    .security-icon { flex: 0 0 42px; width: 42px; height: 42px; display: grid; place-items: center; border-radius: 12px; background: #e9edf3; color: #34445c; }
    .is-unlocked .security-icon { background: #dcefe3; color: #23623f; }
    .security-icon svg { width: 23px; height: 23px; }
    .security-panel-copy { flex: 1; min-width: 0; }
    .security-eyebrow, .security-dialog-kicker { display: block; margin-bottom: 5px; color: #6b7280; font-size: 10px; font-weight: 800; letter-spacing: .12em; }
    .security-panel-copy h4 { margin: 0 0 6px; font-size: 17px; font-weight: 750; line-height: 1.3; }
    .security-panel-copy p { margin: 0; color: #657184; font-size: 13px; line-height: 1.55; }
    .security-state { flex: 0 0 auto; border: 1px solid #cdd5df; border-radius: 999px; padding: 6px 9px; font-size: 10px; font-weight: 800; letter-spacing: .05em; color: #475569; background: #fff; }
    .is-unlocked .security-state { color: #226343; border-color: #a9d0b8; }
    .security-unlock-form { margin-top: 18px; padding-top: 16px; border-top: 1px solid #dfe4ec; }
    .security-unlock-form label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 700; }
    .security-unlock-row { display: flex; gap: 10px; align-items: stretch; }
    .security-unlock-row input { flex: 1; min-width: 0; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #fff; color: #172033; font-size: 14px; }
    .security-unlock-row input:focus-visible { outline: 2px solid #f59e0b; outline-offset: 1px; }
    .security-unlock-button { padding: 12px 18px; border: 0; border-radius: 9px; background: #dc6b21; color: #fff; font-size: 13px; font-weight: 750; cursor: pointer; white-space: nowrap; }
    .security-unlock-button:hover { background: #bd5515; }
    .security-help { margin: 10px 0 0; font-size: 12px; color: #64748b; }
    .security-field-error { margin: 9px 0 0; font-size: 12px; color: #b42318; }
    .security-timer-row { margin-top: 18px; padding-top: 14px; border-top: 1px solid #c9e2d3; display: flex; justify-content: space-between; align-items: center; gap: 12px; font-size: 13px; color: #35644a; }
    .security-timer-row strong { font-size: 19px; font-variant-numeric: tabular-nums; }
    .security-alert { padding: 12px 15px; margin: 12px 0; border-radius: 10px; font-size: 13px; }
    .security-alert-error { color: #9b2424; background: #fef2f2; border: 1px solid #fecaca; }
    .security-alert-success { color: #17623a; background: #ecfdf3; border: 1px solid #bbebcd; }
    .edit-form input[readonly], .edit-form input:disabled, .account-status-readonly { background: #f1f4f8 !important; color: #697586 !important; cursor: not-allowed; }
    .edit-form button:disabled { opacity: .5; cursor: not-allowed; }
    .security-confirm-dialog { border: 0; border-radius: 16px; padding: 0; max-width: 450px; width: calc(100% - 32px); box-shadow: 0 24px 80px rgba(0,0,0,.25); }
    .security-confirm-dialog::backdrop { background: rgba(15,23,42,.6); }
    .security-dialog-content { padding: 28px; background: #fff; color: #202b3c; }
    .security-dialog-content h3 { margin: 4px 0 12px; font-size: 21px; }
    .security-dialog-content p { margin: 0; color: #64748b; line-height: 1.6; font-size: 14px; }
    .security-dialog-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; }
    @media (max-width: 600px) { .security-panel-header { flex-wrap: wrap; } .security-state { margin-left: 56px; } .security-unlock-row { flex-direction: column; } .security-unlock-button { width: 100%; } }

    /* Password visibility and live requirements */
    .at-password-wrap { position: relative; width: 100%; }
    .at-password-wrap > input { width: 100%; box-sizing: border-box; padding-right: 48px !important; }
    .at-password-toggle { position: absolute; top: 50%; right: 9px; transform: translateY(-50%); border: 0; background: transparent; color: #475569; cursor: pointer; padding: 7px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; }
    .at-password-toggle:hover, .at-password-toggle:focus-visible { background: #e9edf3; outline-offset: 2px; }
    .at-password-toggle svg { width: 19px; height: 19px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .at-password-rules { margin-top: 11px; padding: 12px 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; }
    .at-password-rules strong { display: block; font-size: 11px; letter-spacing: .04em; margin-bottom: 8px; color: #334155; }
    .at-password-rules ul { list-style: none; margin: 0; padding: 0; display: grid; gap: 5px; }
    .at-password-rules li { font-size: 12px; color: #b91c1c; display: flex; gap: 8px; align-items: center; }
    .at-password-rules li::before { content: '✕'; font-weight: 800; width: 14px; }
    .at-password-rules li.is-met { color: #15803d; }
    .at-password-rules li.is-met::before { content: '✓'; }
</style>

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


                    @if ($errors->has('unlock'))
                        <div class="security-alert security-alert-error" role="alert">{{ $errors->first('unlock') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="security-alert security-alert-success" role="status">{{ session('success') }}</div>
                    @endif

                    <section class="edit-security-panel {{ $editUnlocked ? 'is-unlocked' : 'is-locked' }}" aria-label="Editing access">
                        <div class="security-panel-header">
                            <span class="security-icon" aria-hidden="true">
                                @if ($editUnlocked)
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 7.5-2"/></svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                @endif
                            </span>
                            <div class="security-panel-copy">
                                <span class="security-eyebrow">ACCOUNT SECURITY</span>
                                <h4>{{ $editUnlocked ? 'Editing Access Granted' : 'Account Details Locked' }}</h4>
                                <p>{{ $editUnlocked ? 'You may update this account during the authorized editing window.' : 'Account details are view-only. Verify your administrator password to make changes.' }}</p>
                            </div>
                            <span class="security-state">{{ $editUnlocked ? 'UNLOCKED' : 'READ ONLY' }}</span>
                        </div>
                        @unless ($editUnlocked)
                            <form class="security-unlock-form" method="POST" action="{{ route('admin.architects.unlock-edit', $architect->id) }}">
                                @csrf
                                <label for="unlock_admin_password">Administrator Password</label>
                                <div class="security-unlock-row">
                                    <div class="at-password-wrap">
<input id="unlock_admin_password" type="password" name="admin_password" required autocomplete="current-password" placeholder="Enter your admin password" aria-describedby="unlockHelp" />
<button type="button" class="at-password-toggle" aria-label="Show password" aria-pressed="false" title="Show password"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
                                    <button type="submit" class="security-unlock-button">Unlock Editing</button>
                                </div>
                                <p id="unlockHelp" class="security-help">Your password is verified securely. Access expires after five minutes.</p>
                                @error('admin_password') <p class="security-field-error" role="alert">{{ $message }}</p> @enderror
                            </form>
                        @else
                            <div class="security-timer-row" id="editUnlockNotice" role="status">
                                <span>Time remaining to save</span>
                                <strong id="editUnlockCountdown" aria-label="Time remaining">05:00</strong>
                            </div>
                        @endunless
                    </section>

                    <form

                        method="POST"

                        action="{{ route('admin.architects.update', $architect->id) }}"

                        class="edit-form"
                        id="editArchitectForm"

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
                                    readonly aria-readonly="true"

                                    value="{{ $architect->name }}"

                                    placeholder="Enter architect name"

                                    minlength="2"
                                    maxlength="100"
                                    autocomplete="name"

                                    

                                    title="Use letters and standard name separators. No numbers or symbols."

                                    required

                                >

                                <small>

                                    Professional identity is protected. Use the verified name change workflow to request a correction.

                                </small>

                                @if ($editUnlocked)
                                    <a href="{{ route('admin.architects.name-change', $architect->id) }}" class="security-unlock-button" style="display:inline-block;text-decoration:none;margin-top:12px">Request Verified Name Change</a>
                                @else
                                    <span class="security-unlock-button" aria-disabled="true" title="Unlock editing first" style="display:inline-block;opacity:.5;cursor:not-allowed;margin-top:12px">Request Verified Name Change</span>
                                @endif

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
                                    @unless ($editUnlocked) readonly aria-readonly="true" @endunless

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

                            {{-- OPTIONAL PASSWORD UPDATE --}}
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <div class="at-password-wrap">
<input
                                    type="password"
                                    id="password"
                                    name="password"
                                    @unless ($editUnlocked) disabled @endunless
                                    placeholder="Leave blank to keep current password"
                                    minlength="8"
                                    autocomplete="new-password"
                                >
<button type="button" class="at-password-toggle" aria-label="Show password" aria-pressed="false" title="Show password"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
                                <small>Leave blank to keep the current password.</small>
                                <div class="at-password-rules" id="architectPasswordRules" aria-live="polite">
                                    <strong>PASSWORD MUST CONTAIN:</strong>
                                    <ul>
                                        <li data-rule="lower">At least one lowercase letter</li>
                                        <li data-rule="upper">At least one uppercase letter</li>
                                        <li data-rule="number">At least one number</li>
                                        <li data-rule="special">At least one special character</li>
                                        <li data-rule="length">Minimum 8 characters</li>
                                    </ul>
                                </div>
                                @error('password')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <div class="at-password-wrap">
<input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    @unless ($editUnlocked) disabled @endunless
                                    placeholder="Re-enter new password"
                                    minlength="8"
                                    autocomplete="new-password"
                                >
<button type="button" class="at-password-toggle" aria-label="Show password" aria-pressed="false" title="Show password"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
                            </div>

                            {{-- Active and On Hold are editable after admin unlock; Archived is permanent. --}}
                            <div class="form-group form-group-full">
                                <label for="account_status">Account Status</label>
                                <select id="account_status" name="status" required @unless ($editUnlocked) disabled @endunless>
                                    <option value="active" @selected(old('status', $architect->status) === 'active')>Active</option>
                                    <option value="on_hold" @selected(old('status', $architect->status) === 'on_hold')>On Hold</option>
                                </select>
                                <small>Archived accounts cannot be restored. Use the separate Archive action for permanent archiving.</small>
                                @unless ($editUnlocked)
                                    <input type="hidden" name="status" value="{{ $architect->status }}">
                                @endunless
                                @error('status') <p class="input-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group form-group-full" id="statusRemarksGroup" style="display:none">
                                <label for="status_remarks">On Hold Reason / Remarks <span>*</span></label>
                                <textarea id="status_remarks" name="status_remarks" maxlength="1000" rows="3" @unless ($editUnlocked) disabled @endunless placeholder="Explain why the architect account is being placed on hold">{{ old('status_remarks') }}</textarea>
                                @error('status_remarks') <p class="input-error">{{ $message }}</p> @enderror
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

                                type="button"

                                id="openAdminConfirmation"
                                @unless ($editUnlocked) disabled title="Unlock editing first" @endunless

                                class="save-btn"

                            >

                                Save Changes

                            </button>

                        </div>

                        <dialog id="adminPasswordDialog" class="security-confirm-dialog" aria-labelledby="adminConfirmationTitle">
                            <div class="security-dialog-content">
                                <span class="security-dialog-kicker">FINAL CONFIRMATION</span>
                                <h3 id="adminConfirmationTitle">Review Account Changes</h3>
                                <p>Are you sure you want to save changes to <strong>{{ $architect->name }}</strong>? This action will be recorded in the audit log.</p>
                                <div class="security-dialog-actions">
                                    <button type="button" id="cancelAdminConfirmation" class="cancel-btn">Cancel</button>
                                    <button type="button" id="confirmAdminChanges" class="save-btn">Confirm &amp; Save</button>
                                </div>
                            </div>
                        </dialog>
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

    // Password visibility (does not alter field values or form submission).
    document.querySelectorAll('.at-password-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = button.parentElement.querySelector('input');
            if (!input || input.disabled) return;
            const visible = input.type === 'password';
            input.type = visible ? 'text' : 'password';
            button.setAttribute('aria-label', visible ? 'Hide password' : 'Show password');
            button.setAttribute('title', visible ? 'Hide password' : 'Show password');
            button.setAttribute('aria-pressed', String(visible));
            button.style.color = visible ? '#dc6b21' : '';
        });
    });
    const newPasswordInput = document.getElementById('password');
    const passwordRules = document.getElementById('architectPasswordRules');
    function updatePasswordRules() {
        if (!newPasswordInput || !passwordRules) return;
        const value = newPasswordInput.value;
        const checks = {
            lower: /[a-z]/.test(value),
            upper: /[A-Z]/.test(value),
            number: /[0-9]/.test(value),
            special: /[^A-Za-z0-9]/.test(value),
            length: value.length >= 8
        };
        passwordRules.querySelectorAll('[data-rule]').forEach(function (item) {
            item.classList.toggle('is-met', Boolean(checks[item.dataset.rule]));
        });
    }
    newPasswordInput?.addEventListener('input', updatePasswordRules);
    updatePasswordRules();
    const editArchitectForm = document.getElementById('editArchitectForm');
    const adminPasswordDialog = document.getElementById('adminPasswordDialog');
    const editUnlocked = @json($editUnlocked);
    const expiresAt = @json($editUnlockExpiresAt) * 1000;
    const countdown = document.getElementById('editUnlockCountdown');
    const statusSelect = document.getElementById('account_status');
    const remarksGroup = document.getElementById('statusRemarksGroup');
    const remarksField = document.getElementById('status_remarks');
    function syncStatusRemarks() {
        const onHold = statusSelect?.value === 'on_hold';
        if (remarksGroup) remarksGroup.style.display = onHold ? '' : 'none';
        if (remarksField) remarksField.required = onHold && editUnlocked;
    }
    statusSelect?.addEventListener('change', syncStatusRemarks);
    syncStatusRemarks();
    function updateCountdown() {
        if (!editUnlocked || !countdown) return;
        const seconds = Math.max(0, Math.ceil((expiresAt - Date.now()) / 1000));
        countdown.textContent = String(Math.floor(seconds / 60)).padStart(2, '0') + ':' + String(seconds % 60).padStart(2, '0');
    }
    updateCountdown();
    function ensureUnlockValid() {
        if (!editUnlocked) return false;
        if (Date.now() >= expiresAt) {
            window.location.reload();
            return false;
        }
        return true;
    }
    document.getElementById('openAdminConfirmation')?.addEventListener('click', function () {
        if (!ensureUnlockValid() || !editArchitectForm.reportValidity()) return;
        adminPasswordDialog.showModal();
    });
    document.getElementById('cancelAdminConfirmation')?.addEventListener('click', function () {
        adminPasswordDialog.close();
    });
    document.getElementById('confirmAdminChanges')?.addEventListener('click', function () {
        if (!ensureUnlockValid()) return;
        editArchitectForm.requestSubmit();
    });
    if (editUnlocked) {
        const check = setInterval(() => {
            updateCountdown();
            if (Date.now() >= expiresAt) {
                clearInterval(check);
                window.location.reload();
            }
        }, 1000);
    }

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
