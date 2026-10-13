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

    <title>Account | ArchiTrack</title>

    @vite([
        'resources/css/app.css',
        'resources/css/client-dashboard.css',
        'resources/css/client-account.css',
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
                    href="{{ route('client.messages.index') }}"
                    class="client-nav-link"
                >
                    Messages
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


            <div class="client-account-area">

                <button
                    type="button"
                    class="notification-button"
                    aria-label="Notifications"
                >
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                        ></path>

                        <path
                            d="M13.73 21a2 2 0 0 1-3.46 0"
                        ></path>
                    </svg>
                </button>


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

        <a href="{{ route('client.messages.index') }}">
            Messages
        </a>

        <a href="{{ route('client.files.index') }}">
            Files
        </a>

        <a href="{{ route('client.meetings.index') }}">
            Meetings
        </a>

        <a
            href="{{ route('client.account.index') }}"
            class="active"
        >
            Account
        </a>
    </nav>



    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="account-main">

        <section class="account-page-heading">
            <span class="account-heading-label">Client Profile</span>
            <h1>Account Settings</h1>
            <p>Manage your personal account information and keep your ArchiTrack login secure.</p>
        </section>

        @if(session('profile_success'))
            <div class="account-alert">
                <strong>Profile updated</strong>
                <span>{{ session('profile_success') }}</span>
            </div>
        @endif

        @if(session('password_success'))
            <div class="account-alert">
                <strong>Password updated</strong>
                <span>{{ session('password_success') }}</span>
            </div>
        @endif

        @if(session('feedback_success'))
            <div class="account-alert">
                <strong>Feedback submitted</strong>
                <span>{{ session('feedback_success') }}</span>
            </div>
        @endif

        <section class="account-layout">

            <aside class="account-identity-sheet">
                <span class="account-sheet-label">Account Record</span>

                <div class="account-large-avatar">
                    @if($user->profile_image)
                        <img
                            src="{{ asset('storage/' . $user->profile_image) }}"
                            alt="{{ $user->name }}"
                        >
                    @else
                        {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
                    @endif
                </div>

                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>

                <dl class="account-record">
                    <div><dt>Access</dt><dd>Client Portal</dd></div>
                    <div><dt>Role</dt><dd>Client</dd></div>
                    <div><dt>Account ID</dt><dd>#{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</dd></div>
                </dl>

                <div class="account-record-note">
                    <span>ACCOUNT STATUS</span>
                    <strong>Active</strong>
                </div>
            </aside>

            <div class="account-forms">

                <section class="account-sheet">
                    <div class="account-sheet-head">
                        <div>
                            <span class="account-sheet-label">Profile / 01</span>
                            <h2>Account Information</h2>
                            <p>Review your account details. Select Edit Account when you want to make changes.</p>
                        </div>

                        <button type="button" class="account-edit-button" id="editAccountButton">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                            </svg>
                            <span>Edit Account</span>
                        </button>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('client.account.profile.update') }}"
                        class="account-form"
                        id="accountProfileForm"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')

                        <div class="account-photo-editor">
                            <div class="account-photo-preview" id="accountPhotoPreview">
                                @if($user->profile_image)
                                    <img
                                        src="{{ asset('storage/' . $user->profile_image) }}"
                                        alt="{{ $user->name }}"
                                    >
                                @else
                                    {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
                                @endif
                            </div>

                            <div class="account-photo-copy">
                                <span class="account-photo-label">Profile Picture</span>
                                <strong>Your client profile image</strong>
                                <p>JPG, JPEG, PNG or WEBP. Maximum file size: 2MB.</p>

                                <label for="profile_image" class="account-photo-button">
                                    Choose Photo
                                </label>

                                <input
                                    type="file"
                                    id="profile_image"
                                    name="profile_image"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    disabled
                                >

                                <span class="account-photo-filename" id="profileImageFilename">
                                    No new photo selected
                                </span>

                                @error('profile_image')
                                    <span class="account-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="account-form-grid">
                            <div class="account-field">
                                <label for="name">Full Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    maxlength="255"
                                    autocomplete="name"
                                    required
                                    readonly
                                >
                                @error('name')
                                    <span class="account-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="account-field">
                                <label for="email">Email Address</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    maxlength="255"
                                    autocomplete="email"
                                    required
                                    readonly
                                >
                                @error('email')
                                    <span class="account-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="account-form-footer">
                            <span id="accountEditStatus">
                                Account information is currently read-only.
                            </span>

                            <div class="account-edit-actions" id="accountEditActions" hidden>
                                <button
                                    type="button"
                                    class="account-secondary-button"
                                    id="cancelAccountEdit"
                                >
                                    Cancel
                                </button>

                                <button type="submit" class="account-primary-button">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

                <section class="account-sheet">
                    <div class="account-sheet-head">
                        <div>
                            <span class="account-sheet-label">Security / 02</span>
                            <h2>Change Password</h2>
                            <p>Enter your current password before setting a new password.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('client.account.password.update') }}" class="account-form">
                        @csrf
                        @method('PUT')

                        <div class="account-field">
                            <label for="current_password">Current Password</label>
                            <div class="account-password-field">
                                <input type="password" id="current_password" name="current_password" autocomplete="current-password" required>
                                <button type="button" class="password-toggle" data-password-toggle="current_password">Show</button>
                            </div>
                            @error('current_password')
                                <span class="account-field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="account-form-grid">
                            <div class="account-field">
                                <label for="password">New Password</label>
                                <div class="account-password-field">
                                    <input type="password" id="password" name="password" minlength="8" autocomplete="new-password" required>
                                    <button type="button" class="password-toggle" data-password-toggle="password">Show</button>
                                </div>
                                @error('password')
                                    <span class="account-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="account-field">
                                <label for="password_confirmation">Confirm New Password</label>
                                <div class="account-password-field">
                                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" autocomplete="new-password" required>
                                    <button type="button" class="password-toggle" data-password-toggle="password_confirmation">Show</button>
                                </div>
                            </div>
                        </div>

                        <div class="account-security-note">
                            <span>!</span>
                            <p>Use at least 8 characters. Avoid reusing a password from another account.</p>
                        </div>

                        <div class="account-form-footer">
                            <span>Your current password is required for security.</span>
                            <button type="submit" class="account-primary-button">Update Password</button>
                        </div>
                    </form>
                </section>

                <section class="account-sheet account-feedback-sheet">

                    <div class="account-sheet-head">
                        <div>
                            <span class="account-sheet-label">Feedback / 03</span>
                            <h2>Report an Issue or Suggest an Improvement</h2>
                            <p>
                                Tell us about a problem you experienced or share an idea
                                that could improve your ArchiTrack Client Portal.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('client.feedback.store') }}"
                        class="account-form account-feedback-form"
                    >
                        @csrf

                        <div class="account-field">
                            <label for="feedback_type">Feedback Type</label>

                            <select
                                id="feedback_type"
                                name="type"
                                required
                            >
                                <option value="">
                                    Select feedback type
                                </option>

                                <option
                                    value="issue"
                                    {{ old('type') === 'issue' ? 'selected' : '' }}
                                >
                                    Report an Issue
                                </option>

                                <option
                                    value="suggestion"
                                    {{ old('type') === 'suggestion' ? 'selected' : '' }}
                                >
                                    Suggest an Improvement
                                </option>
                            </select>

                            @error('type')
                                <span class="account-field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="account-field">
                            <label for="feedback_subject">Subject</label>

                            <input
                                type="text"
                                id="feedback_subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                maxlength="255"
                                placeholder="Briefly describe your concern or suggestion"
                                required
                            >

                            @error('subject')
                                <span class="account-field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="account-field">
                            <label for="feedback_message">Details</label>

                            <textarea
                                id="feedback_message"
                                name="message"
                                rows="6"
                                maxlength="5000"
                                placeholder="Describe what happened, what you expected, or what you would like to improve."
                                required
                            >{{ old('message') }}</textarea>

                            @error('message')
                                <span class="account-field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="account-security-note account-feedback-note">
                            <span>i</span>
                            <p>
                                Your submission will be recorded under your client account
                                so the ArchiTrack team can review and follow up on it.
                            </p>
                        </div>

                        <div class="account-form-footer">
                            <span>
                                New submissions are marked as Pending for review.
                            </span>

                            <button
                                type="submit"
                                class="account-primary-button"
                            >
                                Submit Feedback
                            </button>
                        </div>
                    </form>

                </section>

                <section class="account-sheet account-resource-sheet">

                    <div class="account-sheet-head">
                        <div>
                            <span class="account-sheet-label">Resources / 04</span>
                            <h2>Help & Resources</h2>
                            <p>Access helpful information for using your ArchiTrack Client Portal.</p>
                        </div>
                    </div>

                    <div class="account-resource-body">

                        <div class="account-resource-item">

                            <div class="account-resource-number">
                                01
                            </div>

                            <div class="account-resource-copy">
                                <span class="account-resource-label">
                                    Client Documentation
                                </span>

                                <h3>
                                    ArchiTrack Client User Manual
                                </h3>

                                <p>
                                    Learn how to use projects, phases, messages,
                                    files, revisions, meetings, notifications,
                                    and account settings.
                                </p>
                            </div>

                            <a
                                href="{{ route('client.account.manual.download') }}"
                                class="account-download-button"
                            >
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 3v12"></path>
                                    <path d="m7 10 5 5 5-5"></path>
                                    <path d="M5 21h14"></path>
                                </svg>

                                <span>Download PDF</span>
                            </a>

                        </div>

                    </div>

                </section>

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


    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(button.dataset.passwordToggle);
            if (!input) return;
            const visible = input.type === 'text';
            input.type = visible ? 'password' : 'text';
            button.textContent = visible ? 'Show' : 'Hide';
        });
    });



    const editAccountButton = document.getElementById('editAccountButton');
    const cancelAccountEdit = document.getElementById('cancelAccountEdit');
    const accountEditActions = document.getElementById('accountEditActions');
    const accountEditStatus = document.getElementById('accountEditStatus');
    const accountProfileForm = document.getElementById('accountProfileForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const profileImageInput = document.getElementById('profile_image');
    const profileImageFilename = document.getElementById('profileImageFilename');
    const profilePhotoPreview = document.getElementById('accountPhotoPreview');

    const originalName = nameInput ? nameInput.value : '';
    const originalEmail = emailInput ? emailInput.value : '';
    const originalPreviewHtml = profilePhotoPreview ? profilePhotoPreview.innerHTML : '';

    function setAccountEditMode(editing) {
        if (nameInput) nameInput.readOnly = !editing;
        if (emailInput) emailInput.readOnly = !editing;
        if (profileImageInput) profileImageInput.disabled = !editing;
        if (editAccountButton) editAccountButton.hidden = editing;
        if (accountEditActions) accountEditActions.hidden = !editing;

        if (accountEditStatus) {
            accountEditStatus.textContent = editing
                ? 'Editing enabled. Save your changes when finished.'
                : 'Account information is currently read-only.';
        }

        if (accountProfileForm) {
            accountProfileForm.classList.toggle('is-editing', editing);
        }
    }

    if (editAccountButton) {
        editAccountButton.addEventListener('click', function () {
            setAccountEditMode(true);
            if (nameInput) nameInput.focus();
        });
    }

    if (cancelAccountEdit) {
        cancelAccountEdit.addEventListener('click', function () {
            if (nameInput) nameInput.value = originalName;
            if (emailInput) emailInput.value = originalEmail;
            if (profileImageInput) profileImageInput.value = '';
            if (profileImageFilename) {
                profileImageFilename.textContent = 'No new photo selected';
            }
            if (profilePhotoPreview) {
                profilePhotoPreview.innerHTML = originalPreviewHtml;
            }
            setAccountEditMode(false);
        });
    }

    if (profileImageInput) {
        profileImageInput.addEventListener('change', function () {
            const file = profileImageInput.files
                ? profileImageInput.files[0]
                : null;

            if (!file) {
                if (profileImageFilename) {
                    profileImageFilename.textContent = 'No new photo selected';
                }
                return;
            }

            if (profileImageFilename) {
                profileImageFilename.textContent = file.name;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                if (!profilePhotoPreview) return;

                profilePhotoPreview.innerHTML = '';

                const image = document.createElement('img');
                image.src = event.target.result;
                image.alt = 'Profile picture preview';

                profilePhotoPreview.appendChild(image);
            };

            reader.readAsDataURL(file);
        });
    }

    @if(
        $errors->has('name')
        || $errors->has('email')
        || $errors->has('profile_image')
    )
        setAccountEditMode(true);
    @else
        setAccountEditMode(false);
    @endif


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
        }
    );

});
</script>

</body>
</html>
