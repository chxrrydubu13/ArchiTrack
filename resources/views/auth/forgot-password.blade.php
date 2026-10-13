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

    <title>Forgot Password | ArchiTrack</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            font-family: "Segoe UI", Inter, Arial, sans-serif;
            color: #303940;
            background: #f5f1eb;
        }

        button,
        input,
        a {
            font-family: inherit;
        }

        .forgot-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 38px 24px;
            background:
                linear-gradient(
                    135deg,
                    rgba(255, 253, 249, 0.98),
                    rgba(247, 241, 234, 0.94)
                );
        }

        /* ========================================
           ARCHITECTURAL BACKGROUND
        ======================================== */

        .architectural-background {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .blueprint-grid {
            position: absolute;
            inset: 0;
            opacity: 0.22;

            background-image:
                linear-gradient(
                    rgba(70, 79, 86, 0.09) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(70, 79, 86, 0.09) 1px,
                    transparent 1px
                );

            background-size: 34px 34px;
        }

        .blueprint-grid::before {
            content: "";
            position: absolute;
            inset: 0;

            background-image:
                linear-gradient(
                    rgba(70, 79, 86, 0.08) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(70, 79, 86, 0.08) 1px,
                    transparent 1px
                );

            background-size: 170px 170px;
        }

        .architecture-line {
            position: absolute;
            border-color: rgba(249, 115, 22, 0.13);
            border-style: solid;
        }

        .architecture-line.one {
            width: 460px;
            height: 460px;
            left: -180px;
            top: -170px;
            border-width: 1px;
            transform: rotate(18deg);
        }

        .architecture-line.two {
            width: 370px;
            height: 570px;
            right: -150px;
            bottom: -230px;
            border-width: 1px;
            transform: rotate(-19deg);
        }

        .architecture-line.three {
            width: 280px;
            height: 1px;
            right: 8%;
            top: 19%;
            border-width: 1px 0 0;
        }

        .architecture-line.four {
            width: 1px;
            height: 260px;
            left: 10%;
            bottom: 10%;
            border-width: 0 0 0 1px;
        }

        .dimension-mark {
            position: absolute;
            color: rgba(73, 81, 88, 0.17);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
        }

        .dimension-mark.one {
            left: 6%;
            top: 18%;
            transform: rotate(-90deg);
        }

        .dimension-mark.two {
            right: 7%;
            bottom: 19%;
        }

        /* ========================================
           PAGE LAYOUT
        ======================================== */

        .forgot-shell {
            position: relative;
            z-index: 5;

            width: min(100%, 1000px);
            min-height: 610px;

            display: grid;
            grid-template-columns: minmax(0, 0.92fr) minmax(0, 1.08fr);

            border: 1px solid #d9d2ca;

            background: rgba(255, 253, 249, 0.96);

            box-shadow:
                0 30px 80px rgba(45, 53, 59, 0.13),
                0 4px 14px rgba(45, 53, 59, 0.05);
        }

        /* ========================================
           LEFT PANEL
        ======================================== */

        .forgot-intro {
            position: relative;
            overflow: hidden;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            padding: 42px 40px;

            background:
                linear-gradient(
                    145deg,
                    #303940,
                    #242c32
                );

            color: white;
        }

        .forgot-intro::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;

            width: 5px;
            height: 100%;

            background: #f97316;
        }

        .forgot-intro::after {
            content: "";

            position: absolute;

            width: 330px;
            height: 330px;

            right: -190px;
            bottom: -170px;

            border: 1px solid rgba(255, 255, 255, 0.08);

            transform: rotate(32deg);
        }

        .brand {
            position: relative;
            z-index: 2;

            display: inline-flex;
            align-items: center;
            gap: 12px;

            width: fit-content;

            color: white;
            text-decoration: none;
        }

        .brand-logo {
            width: 48px;
            height: 48px;

            display: grid;
            place-items: center;

            overflow: hidden;

            border: 1px solid rgba(255, 255, 255, 0.17);

            background: white;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
        }

        .brand-copy strong {
            font-size: 17px;
            line-height: 1.1;
            letter-spacing: -0.01em;
        }

        .brand-copy span {
            margin-top: 4px;

            color: rgba(255, 255, 255, 0.54);

            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .intro-content {
            position: relative;
            z-index: 2;

            max-width: 330px;
        }

        .intro-code {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 14px;

            color: #ff9a54;

            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }

        .intro-code::before {
            content: "";

            width: 26px;
            height: 2px;

            background: #f97316;
        }

        .intro-content h1 {
            margin: 0 0 16px;

            color: #ffffff;

            font-size: 36px;
            line-height: 1.08;
            letter-spacing: -0.035em;
        }

        .intro-content p {
            margin: 0;

            color: rgba(255, 255, 255, 0.66);

            font-size: 13px;
            line-height: 1.7;
        }

        .intro-footer {
            position: relative;
            z-index: 2;

            padding-top: 22px;

            border-top: 1px solid rgba(255, 255, 255, 0.09);

            color: rgba(255, 255, 255, 0.43);

            font-size: 10px;
            line-height: 1.5;
        }

        /* ========================================
           FORM PANEL
        ======================================== */

        .forgot-form-panel {
            display: flex;
            align-items: center;

            padding: 52px 55px;

            background:
                linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.98),
                    rgba(255, 253, 249, 0.98)
                );
        }

        .forgot-form-inner {
            width: 100%;
            max-width: 430px;
            margin: 0 auto;
        }

        .form-heading-label {
            display: block;

            margin-bottom: 9px;

            color: #c85e18;

            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .forgot-form-inner h2 {
            margin: 0 0 9px;

            color: #303940;

            font-size: 27px;
            line-height: 1.15;
            letter-spacing: -0.025em;
        }

        .forgot-description {
            margin: 0 0 29px;

            color: #6b747b;

            font-size: 13px;
            line-height: 1.65;
        }

        /* ========================================
           SESSION STATUS
        ======================================== */

        .session-status {
            margin-bottom: 20px;
            padding: 13px 14px;

            border: 1px solid #b8d9c5;
            border-left: 4px solid #4f8265;

            background: #f2faf5;

            color: #356149;

            font-size: 12px;
            line-height: 1.5;
        }

        /* ========================================
           FIELD
        ======================================== */

        .form-field {
            margin-bottom: 21px;
        }

        .form-field label {
            display: block;

            margin-bottom: 8px;

            color: #4d575f;

            font-size: 12px;
            font-weight: 700;
        }

        .email-field {
            position: relative;
        }

        .email-icon {
            position: absolute;
            left: 14px;
            top: 50%;

            width: 18px;
            height: 18px;

            transform: translateY(-50%);

            color: #8a939a;

            pointer-events: none;
        }

        .email-icon svg {
            width: 100%;
            height: 100%;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.7;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-field input {
            width: 100%;
            height: 48px;

            padding: 0 15px 0 43px;

            border: 1px solid #d4cec7;
            border-radius: 2px;

            outline: none;

            background: #ffffff;

            color: #303940;

            font-size: 13px;

            transition:
                border-color 0.15s ease,
                box-shadow 0.15s ease,
                background 0.15s ease;
        }

        .form-field input::placeholder {
            color: #a0a6aa;
        }

        .form-field input:focus {
            border-color: #f28a43;

            box-shadow:
                0 0 0 3px rgba(249, 115, 22, 0.08);

            background: #fffdfb;
        }

        .field-error {
            display: block;

            margin-top: 7px;

            color: #b64242;

            font-size: 11px;
            line-height: 1.45;
        }

        /* ========================================
           BUTTON
        ======================================== */

        .reset-button {
            width: 100%;
            min-height: 48px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            padding: 0 20px;

            border: 1px solid #f97316;
            border-radius: 2px;

            background: #f97316;

            color: white;

            font-size: 12px;
            font-weight: 750;

            cursor: pointer;

            transition:
                background 0.15s ease,
                border-color 0.15s ease,
                transform 0.15s ease,
                box-shadow 0.15s ease;
        }

        .reset-button:hover {
            background: #e8660d;
            border-color: #e8660d;

            box-shadow:
                0 8px 20px rgba(249, 115, 22, 0.18);
        }

        .reset-button:active {
            transform: translateY(1px);
        }

        .reset-button svg {
            width: 17px;
            height: 17px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ========================================
           BACK TO LOGIN
        ======================================== */

        .back-login {
            margin-top: 22px;

            display: flex;
            justify-content: center;
        }

        .back-login a {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: #59646c;

            font-size: 12px;
            font-weight: 650;

            text-decoration: none;
        }

        .back-login a:hover {
            color: #f97316;
        }

        .back-login svg {
            width: 15px;
            height: 15px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ========================================
           INFORMATION NOTE
        ======================================== */

        .reset-note {
            display: flex;
            gap: 10px;

            margin-top: 25px;
            padding: 13px 14px;

            border: 1px solid #e5ded6;

            background: #faf7f3;
        }

        .reset-note-icon {
            flex: 0 0 22px;

            width: 22px;
            height: 22px;

            display: grid;
            place-items: center;

            border: 1px solid #efc29f;

            color: #c85e18;

            font-size: 11px;
            font-weight: 800;
        }

        .reset-note p {
            margin: 0;

            color: #747d84;

            font-size: 10.5px;
            line-height: 1.55;
        }

        /* ========================================
           RESPONSIVE
        ======================================== */

        @media (max-width: 800px) {

            .forgot-page {
                padding: 24px 16px;
            }

            .forgot-shell {
                width: min(100%, 560px);
                min-height: auto;

                grid-template-columns: 1fr;
            }

            .forgot-intro {
                min-height: 275px;
                padding: 30px;
            }

            .intro-content {
                margin: 40px 0;
            }

            .intro-content h1 {
                font-size: 30px;
            }

            .intro-footer {
                display: none;
            }

            .forgot-form-panel {
                padding: 38px 30px 42px;
            }
        }

        @media (max-width: 480px) {

            .forgot-page {
                align-items: flex-start;
                padding: 0;
            }

            .forgot-shell {
                width: 100%;
                min-height: 100vh;

                border: 0;
                box-shadow: none;
            }

            .forgot-intro {
                min-height: 235px;
                padding: 25px 22px;
            }

            .brand-logo {
                width: 42px;
                height: 42px;
            }

            .intro-content {
                margin: 30px 0 10px;
            }

            .intro-content h1 {
                font-size: 27px;
            }

            .intro-content p {
                font-size: 12px;
            }

            .forgot-form-panel {
                align-items: flex-start;

                padding: 34px 22px 45px;
            }

            .forgot-form-inner h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="forgot-page">

    {{-- ARCHITECTURAL BACKGROUND --}}
    <div class="architectural-background">

        <div class="blueprint-grid"></div>

        <div class="architecture-line one"></div>
        <div class="architecture-line two"></div>
        <div class="architecture-line three"></div>
        <div class="architecture-line four"></div>

        <span class="dimension-mark one">
            ARCH / 04.80
        </span>

        <span class="dimension-mark two">
            07.50 M
        </span>

    </div>


    <main class="forgot-shell">

        {{-- =========================================
             LEFT SIDE
        ========================================== --}}

        <section class="forgot-intro">

            <a
                href="{{ route('home') }}"
                class="brand"
            >
                <div class="brand-logo">
                    <img
                        src="{{ asset('images/arlogo.jpg') }}"
                        alt="ArchiTrack"
                    >
                </div>

                <div class="brand-copy">
                    <strong>ArchiTrack</strong>
                    <span>Project Management</span>
                </div>
            </a>


            <div class="intro-content">

                <span class="intro-code">
                    Account Recovery
                </span>

                <h1>
                    Forgot your password?
                </h1>

                <p>
                    Enter the email address connected to your
                    ArchiTrack account. We'll send you a secure
                    link so you can create a new password.
                </p>

            </div>


            <div class="intro-footer">
                Secure architectural project management,
                communication, and collaboration in one workspace.
            </div>

        </section>


        {{-- =========================================
             FORM SIDE
        ========================================== --}}

        <section class="forgot-form-panel">

            <div class="forgot-form-inner">

                <span class="form-heading-label">
                    Password Reset
                </span>

                <h2>
                    Recover your account
                </h2>

                <p class="forgot-description">
                    Enter your registered email address below.
                    If it matches an ArchiTrack account, you'll
                    receive instructions for resetting your password.
                </p>


                {{-- SESSION STATUS --}}
                @if (session('status'))

                    <div
                        class="session-status"
                        role="status"
                    >
                        {{ session('status') }}
                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div class="form-field">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="email-field">

                            <span class="email-icon">

                                <svg viewBox="0 0 24 24">
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    ></rect>

                                    <path
                                        d="m3 7 9 6 9-6"
                                    ></path>
                                </svg>

                            </span>


                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your registered email"
                                autocomplete="email"
                                required
                                autofocus
                            >

                        </div>


                        @error('email')

                            <span
                                class="field-error"
                                role="alert"
                            >
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="reset-button"
                    >

                        <span>
                            Send Password Reset Link
                        </span>

                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14"></path>
                            <path d="m13 6 6 6-6 6"></path>
                        </svg>

                    </button>

                </form>


                {{-- BACK TO LOGIN --}}
                <div class="back-login">

                    <a href="{{ route('login') }}">

                        <svg viewBox="0 0 24 24">
                            <path d="m15 18-6-6 6-6"></path>
                        </svg>

                        <span>
                            Back to login
                        </span>

                    </a>

                </div>


                <div class="reset-note">

                    <div class="reset-note-icon">
                        i
                    </div>

                    <p>
                        For your security, the reset link is sent
                        only to the email address registered with
                        your ArchiTrack account.
                    </p>

                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>