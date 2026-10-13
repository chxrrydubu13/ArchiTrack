<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Change Password | ArchiTrack</title>

    @vite([
        'resources/css/app.css',
        'resources/css/change-password.css',
        'resources/js/app.js'
    ])
</head>

<body>

<div class="password-page">

    <div class="password-card">

        <!-- LOGO -->
        <div class="password-logo">
            <img
                src="{{ asset('images/arlogo.jpg') }}"
                alt="ArchiTrack Logo"
            >
        </div>


        <!-- HEADER -->
        <div class="password-header">

            <span>ACCOUNT SECURITY</span>

            <h1>Change Your Password</h1>

            <p>
                For your account security, please create a new password
                before continuing to ArchiTrack.
            </p>

        </div>


        <!-- ERRORS -->
        @if ($errors->any())

            <div class="form-error">

                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

            </div>

        @endif


        <!-- CHANGE PASSWORD FORM -->
        <form
            action="{{ route('password.change.update') }}"
            method="POST"
        >

            @csrf


            <!-- NEW PASSWORD -->
            <div class="form-group">

                <label for="password">
                    New Password
                </label>

                <div class="password-input">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your new password"
                        minlength="8"
                        maxlength="100"
                        autocomplete="new-password"
                        required
                    >

                    <button
                        type="button"
                        onclick="showPassword('password', this)"
                    >
                        Show
                    </button>

                </div>

            </div>


            <!-- CONFIRM PASSWORD -->
            <div class="form-group">

                <label for="password_confirmation">
                    Confirm New Password
                </label>

                <div class="password-input">

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Re-enter your new password"
                        minlength="8"
                        maxlength="100"
                        autocomplete="new-password"
                        required
                    >

                    <button
                        type="button"
                        onclick="showPassword('password_confirmation', this)"
                    >
                        Show
                    </button>

                </div>

            </div>


            <!-- PASSWORD NOTE -->
            <div class="password-note">
                Your password must contain at least 8 characters.
                For security, avoid using an easy-to-guess password.
            </div>


            <!-- SAVE BUTTON -->
            <button
                type="submit"
                class="password-submit"
            >
                Save New Password
            </button>

        </form>


        <!-- LOGOUT FORM -->
        <form
            method="POST"
            action="{{ route('logout') }}"
            style="margin-top: 12px;"
        >

            @csrf

            <button
                type="submit"
                class="logout-link-btn"
            >
                Log Out
            </button>

        </form>

    </div>

</div>


<script>

    function showPassword(inputId, button)
    {
        let passwordInput = document.getElementById(inputId);

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';
            button.innerText = 'Hide';

        } else {

            passwordInput.type = 'password';
            button.innerText = 'Show';

        }
    }

</script>

</body>

</html>