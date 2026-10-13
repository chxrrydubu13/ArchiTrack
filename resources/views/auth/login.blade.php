<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | ArchiTrack</title>

    @vite([
        'resources/css/app.css',
        'resources/css/login.css',
        'resources/js/app.js'
    ])
</head>

<body>

<div class="login-page">

    <div class="login-container">

        <!-- LEFT SIDE -->
        <div class="login-left">

            <div class="brand-area">
                <img src="{{ asset('images/arlogo.jpg') }}" alt="Vero Designs Logo">
            </div>

            <div class="left-text">

                <span class="small-title">
                    ARCHITRACK
                </span>

                <h1>
                    Architectural<br>
                    Project <span>Management</span><br>
                    Simplified.
                </h1>

                <div class="orange-line"></div>

                <p>
                    Manage projects, files, revisions, meetings,
                    and client collaboration in one centralized workspace.
                </p>

            </div>

            <img
                src="{{ asset('images/lineart1.png') }}"
                class="login-lineart"
                alt=""
            >

            <div class="left-dots"></div>

            <div class="left-footer">
                © {{ date('Y') }} Vero Designs Architectural Services<br>
                All rights reserved.
            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="login-right">

            <div class="login-form">

                <span class="welcome-text">
                    WELCOME BACK
                </span>

                <h2>
                    Log in to <span>ArchiTrack</span>
                </h2>

                <p class="login-description">
                    Enter your account credentials to continue.
                </p>


                @if (session('status'))
                    <div class="success-message">
                        {{ session('status') }}
                    </div>
                @endif


                @if ($errors->any())
                    <div class="error-message">

                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </div>
                @endif


                <form method="POST" action="{{ route('login') }}">

                    @csrf


                    <!-- EMAIL -->
                    <div class="input-group">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="input-box">

                            <span class="input-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="M3 7l9 6 9-6"/>
                                </svg>
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                maxlength="255"
                                autocomplete="username"
                                required
                                autofocus
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->
                    <div class="input-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-box">

                            <span class="input-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="5" y="10" width="14" height="10" rx="2"/>
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                                </svg>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="eye-btn"
                                onclick="togglePassword()"
                            >

                                <svg viewBox="0 0 24 24">
                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                            </button>

                        </div>

                    </div>


                    <!-- OPTIONS -->
                    <div class="login-options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                            >

                            <span>
                                Remember me
                            </span>

                        </label>


                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif

                    </div>


                    <!-- LOGIN BUTTON -->
                    <button type="submit" class="login-btn">
                        Log In
                    </button>


                    <!-- NOTE -->
                    <div class="account-note">

                        <div class="note-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>

                        <div>
                            <strong>
                                Public account registration is not available.
                            </strong>

                            <p>
                                Accounts are provided by authorized administrators
                                or project invitations.
                            </p>
                        </div>

                    </div>

                </form>


                <div class="back-home">

                    <a href="{{ route('home') }}">
                        Back to Home
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    function togglePassword()
    {
        let password = document.getElementById('password');

        if (password.type === 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
    }
</script>

</body>

</html>