{{-- =========================================================
     BEARO SESSION TIMEOUT WARNING
========================================================= --}}

@auth

<div
    id="sessionTimeoutOverlay"
    class="session-timeout-overlay"
    aria-hidden="true"
>
    <div
        class="session-timeout-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="sessionTimeoutTitle"
    >

        <div class="session-bearo-side">

            <div class="session-bearo-bubble">
                <span>BEARO ALERT!</span>
            </div>

            <div class="session-bearo-frame">

                <img
                    src="{{ asset('images/bearo-inactive-1.png') }}"
                    alt="Bearo session warning"
                    class="session-bearo-image active"
                    id="sessionBearoImageOne"
                >

                <img
                    src="{{ asset('images/bearo-inactive-2.png') }}"
                    alt=""
                    class="session-bearo-image"
                    id="sessionBearoImageTwo"
                    aria-hidden="true"
                >

            </div>

        </div>


        <div class="session-timeout-content">

            <span class="session-timeout-label">
                SECURITY NOTICE
            </span>

            <h2 id="sessionTimeoutTitle">
                Hey! Are you still there?
            </h2>

            <p class="session-timeout-message">
                Bearo noticed you've been inactive for a while.
                Your ArchiTrack session will close soon to help
                keep your account secure.
            </p>


            <div class="session-countdown-box">

                <div class="session-countdown-copy">
                    <span>
                        AUTO LOGOUT IN
                    </span>

                    <strong>
                        <span id="sessionCountdown">60</span>
                        <small>SEC</small>
                    </strong>
                </div>

                <div class="session-countdown-track">
                    <span id="sessionCountdownBar"></span>
                </div>

            </div>


            <div class="session-timeout-tip">
                Click <strong>Stay Logged In</strong> if you're
                still working.
            </div>


            <div class="session-timeout-actions">

                <button
                    type="button"
                    id="stayLoggedInButton"
                    class="session-stay-button"
                >
                    Stay Logged In
                </button>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="session-logout-button"
                    >
                        Log Out
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>


<style>
    .session-timeout-overlay {
        position: fixed;
        inset: 0;
        z-index: 99999;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 24px;

        background:
            linear-gradient(
                rgba(20, 24, 28, .62),
                rgba(20, 24, 28, .62)
            );

        backdrop-filter: blur(6px);
    }

    .session-timeout-overlay.show {
        display: flex;
    }


    .session-timeout-card {
        position: relative;

        width: min(640px, 100%);
        min-height: 300px;

        display: grid;

        grid-template-columns:
            minmax(210px, .78fr)
            minmax(0, 1.22fr);

        overflow: hidden;

        background: #ffffff;

        border: 1px solid rgba(31, 39, 47, .08);
        border-top: 4px solid #f97316;

        box-shadow:
            0 34px 90px
            rgba(16, 22, 28, .30);

        font-family:
            "Segoe UI",
            Arial,
            sans-serif;

        animation:
            sessionModalIn
            .24s
            ease-out;
    }


    .session-bearo-side {
        position: relative;

        min-height: 300px;

        display: flex;
        align-items: flex-end;
        justify-content: center;

        overflow: hidden;

        padding:
            18px
            14px
            0;

        background:
            radial-gradient(
                circle at 50% 25%,
                rgba(255,255,255,.98),
                rgba(245,246,248,.92) 62%,
                rgba(237,239,242,.96)
            );
    }


    .session-bearo-side::before {
        content: "";

        position: absolute;
        inset: 0;

        background-image:
            linear-gradient(
                rgba(249,115,22,.055) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                rgba(249,115,22,.055) 1px,
                transparent 1px
            );

        background-size:
            26px
            26px;

        pointer-events: none;
    }


    .session-bearo-bubble {
        position: absolute;

        top: 22px;
        left: 22px;

        z-index: 3;

        padding:
            7px
            10px;

        color: #ffffff;
        background: #f97316;

        font-size: 9px;
        font-weight: 800;
        letter-spacing: .10em;

        box-shadow:
            0 8px 20px
            rgba(249,115,22,.20);
    }


    .session-bearo-frame {
        position: relative;

        width: 100%;
        height: 250px;

        display: flex;
        align-items: flex-end;
        justify-content: center;
    }


    .session-bearo-image {
        position: absolute;

        bottom: -4px;
        left: 50%;

        width: 100%;
        max-width: 220px;
        height: auto;

        transform:
            translateX(-50%)
            scale(.98);

        opacity: 0;

        transition:
            opacity
            .22s
            ease,
            transform
            .22s
            ease;

        filter:
            drop-shadow(
                0 14px 20px
                rgba(42,49,56,.12)
            );

        user-select: none;
        pointer-events: none;
    }


    .session-bearo-image.active {
        opacity: 1;

        transform:
            translateX(-50%)
            scale(1);

        animation:
            bearoPanic
            .75s
            ease-in-out
            infinite alternate;
    }


    .session-timeout-content {
        min-width: 0;

        display: flex;
        flex-direction: column;
        justify-content: center;

        padding:
            26px
            28px
            24px;
    }


    .session-timeout-label {
        display: block;

        margin-bottom: 9px;

        color: #f97316;

        font-size: 10px;
        font-weight: 800;
        letter-spacing: .12em;
    }


    .session-timeout-card h2 {
        margin:
            0
            0
            10px;

        color: #27303a;

        font-size: 24px;
        font-weight: 680;
        line-height: 1.12;
        letter-spacing: -.025em;
    }


    .session-timeout-message {
        margin: 0;

        color: #737c85;

        font-size: 13px;
        line-height: 1.6;
    }


    .session-countdown-box {
        margin-top: 16px;

        padding:
            11px
            13px
            10px;

        background: #f8f6f2;

        border-left: 3px solid #f97316;
    }


    .session-countdown-copy {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;
    }


    .session-countdown-copy > span {
        color: #858d95;

        font-size: 9px;
        font-weight: 800;
        letter-spacing: .10em;
    }


    .session-countdown-copy > strong {
        display: flex;
        align-items: baseline;

        gap: 4px;

        color: #252d35;

        font-size: 24px;
        line-height: 1;
    }


    .session-countdown-copy small {
        color: #f97316;

        font-size: 9px;
        font-weight: 800;
    }


    .session-countdown-track {
        height: 4px;

        margin-top: 11px;

        overflow: hidden;

        background: #e8e4df;
    }


    .session-countdown-track span {
        display: block;

        width: 100%;
        height: 100%;

        background: #f97316;

        transform-origin: left center;

        transition:
            width
            1s
            linear;
    }


    .session-timeout-tip {
        margin-top: 10px;

        color: #9299a0;

        font-size: 10px;
        line-height: 1.45;
    }


    .session-timeout-tip strong {
        color: #49525b;
    }


    .session-timeout-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;

        gap: 9px;

        margin-top: 15px;
    }


    .session-timeout-actions form {
        margin: 0;
    }


    .session-stay-button,
    .session-logout-button {
        min-height: 40px;

        padding:
            0
            17px;

        border: 0;

        font-family:
            "Segoe UI",
            Arial,
            sans-serif;

        font-size: 12px;
        font-weight: 650;

        cursor: pointer;

        transition:
            transform
            .16s
            ease,
            background
            .16s
            ease;
    }


    .session-stay-button {
        color: #ffffff;
        background: #f97316;
    }


    .session-stay-button:hover {
        background: #ea580c;

        transform:
            translateY(-1px);
    }


    .session-stay-button:disabled {
        opacity: .55;
        cursor: wait;
        transform: none;
    }


    .session-logout-button {
        color: #47515b;
        background: #ebe7e1;
    }


    .session-logout-button:hover {
        background: #dfdad3;

        transform:
            translateY(-1px);
    }


    @keyframes sessionModalIn {
        from {
            opacity: 0;

            transform:
                translateY(12px)
                scale(.985);
        }

        to {
            opacity: 1;

            transform:
                translateY(0)
                scale(1);
        }
    }


    @keyframes bearoPanic {
        from {
            transform:
                translateX(-50%)
                rotate(-1.2deg)
                scale(1);
        }

        to {
            transform:
                translateX(-50%)
                rotate(1.2deg)
                scale(1.012);
        }
    }


    @media (max-width: 720px) {

        .session-timeout-card {
            width: min(480px, 100%);

            grid-template-columns: 1fr;
        }


        .session-bearo-side {
            min-height: 165px;

            padding-top: 8px;
        }


        .session-bearo-frame {
            height: 150px;
        }


        .session-bearo-image {
            max-width: 155px;
        }


        .session-bearo-bubble {
            top: 14px;
            left: 14px;
        }


        .session-timeout-content {
            padding:
                24px
                22px
                22px;
        }


        .session-timeout-card h2 {
            font-size: 23px;
        }
    }


    @media (max-width: 470px) {

        .session-timeout-overlay {
            padding: 12px;
        }


        .session-timeout-actions {
            flex-direction: column;
            align-items: stretch;
        }


        .session-timeout-actions form,
        .session-stay-button,
        .session-logout-button {
            width: 100%;
        }
    }


    /* Compact layout refinement */
    .session-timeout-content {
        gap: 0;
    }

    .session-timeout-message {
        max-width: 360px;
    }

    .session-countdown-box {
        max-width: 320px;
    }

    .session-timeout-actions {
        flex-wrap: wrap;
    }

    .session-bearo-bubble {
        top: 16px;
        left: 16px;
    }

    @media (max-width: 720px) {
        .session-timeout-card {
            width: min(430px, 100%);
        }

        .session-timeout-content {
            padding:
                20px
                18px
                18px;
        }

        .session-countdown-box {
            max-width: none;
        }
    }



/* =========================================================
   POLISHED BEARO ALERT — tighter + better visual balance
========================================================= */

.session-timeout-card {
    width: min(620px, 100%);
    min-height: 320px;

    grid-template-columns:
        235px
        minmax(0, 1fr);

    border-radius: 0;
}

.session-bearo-side {
    min-height: 320px;

    align-items: center;
    justify-content: center;

    padding:
        54px
        10px
        14px;

    background:
        linear-gradient(
            180deg,
            #fffaf6 0%,
            #f8f5f1 100%
        );
}

/* remove busy grid */
.session-bearo-side::before {
    display: none;
}

.session-bearo-bubble {
    top: 18px;
    left: 18px;

    padding:
        7px
        11px;

    border-radius: 0;

    font-size: 9px;
    letter-spacing: .08em;
}

.session-bearo-frame {
    width: 100%;
    height: 245px;

    align-items: center;
    justify-content: center;
}

.session-bearo-image {
    top: 50%;
    bottom: auto;
    left: 50%;

    width: 230px;
    max-width: 230px;
    max-height: 245px;

    object-fit: contain;
    object-position: center;

    transform:
        translate(-50%, -50%)
        scale(.98);

    filter:
        drop-shadow(
            0 12px 16px
            rgba(40, 47, 54, .12)
        );
}

.session-bearo-image.active {
    transform:
        translate(-50%, -50%)
        scale(1);

    animation:
        bearoPanicPolished
        .85s
        ease-in-out
        infinite alternate;
}

.session-timeout-content {
    justify-content: center;

    padding:
        28px
        30px
        26px;
}

.session-timeout-label {
    margin-bottom: 7px;

    font-size: 9px;
}

.session-timeout-card h2 {
    margin-bottom: 9px;

    font-size: 25px;
    line-height: 1.15;
}

.session-timeout-message {
    max-width: 330px;

    font-size: 12px;
    line-height: 1.55;
}

.session-countdown-box {
    width: 100%;
    max-width: none;

    margin-top: 16px;

    padding:
        12px
        14px
        11px;

    border-left-width: 3px;
}

.session-countdown-copy > span {
    font-size: 8px;
}

.session-countdown-copy > strong {
    font-size: 25px;
}

.session-countdown-track {
    margin-top: 9px;
}

.session-timeout-tip {
    margin-top: 9px;

    font-size: 9px;
}

.session-timeout-actions {
    margin-top: 16px;

    gap: 8px;
}

.session-stay-button,
.session-logout-button {
    min-height: 38px;

    padding:
        0
        16px;

    font-size: 11px;
}

/* Better mascot motion: same position, only tiny tilt/scale */
@keyframes bearoPanicPolished {
    from {
        transform:
            translate(-50%, -50%)
            rotate(-.7deg)
            scale(1);
    }

    to {
        transform:
            translate(-50%, -50%)
            rotate(.7deg)
            scale(1.015);
    }
}

@media (max-width: 720px) {

    .session-timeout-card {
        width: min(430px, 100%);

        grid-template-columns: 1fr;
    }

    .session-bearo-side {
        min-height: 170px;

        padding:
            42px
            10px
            6px;
    }

    .session-bearo-frame {
        height: 145px;
    }

    .session-bearo-image {
        width: 155px;
        max-width: 155px;
        max-height: 155px;
    }

    .session-timeout-content {
        padding:
            20px
            20px
            20px;
    }

    .session-timeout-card h2 {
        font-size: 22px;
    }

    .session-timeout-message {
        max-width: none;
    }
}

</style>


<script>
document.addEventListener(
    'DOMContentLoaded',
    function () {

        const timeoutMinutes =
            Number(
                @json(
                    (int) config(
                        'session.lifetime',
                        20
                    )
                )
            );


        const timeoutMs =
            timeoutMinutes
            * 60
            * 1000;


        const warningMs =
            60
            * 1000;


        const keepAliveUrl =
            @json(
                route(
                    'session.keep-alive'
                )
            );


        const csrfToken =
            document
                .querySelector(
                    'meta[name="csrf-token"]'
                )
                ?.getAttribute(
                    'content'
                )
            ||
            @json(csrf_token());


        const overlay =
            document.getElementById(
                'sessionTimeoutOverlay'
            );


        const countdownElement =
            document.getElementById(
                'sessionCountdown'
            );


        const countdownBar =
            document.getElementById(
                'sessionCountdownBar'
            );


        const stayButton =
            document.getElementById(
                'stayLoggedInButton'
            );


        const bearoImageOne =
            document.getElementById(
                'sessionBearoImageOne'
            );


        const bearoImageTwo =
            document.getElementById(
                'sessionBearoImageTwo'
            );


        if (
            !overlay
            ||
            !countdownElement
            ||
            !stayButton
        ) {
            return;
        }


        let lastActivity =
            Date.now();


        let lastServerPing =
            0;


        let warningOpen =
            false;


        let countdownTimer =
            null;


        let bearoSwapTimer =
            null;


        function showBearoImage(
            showSecond
        ) {

            if (
                !bearoImageOne
                ||
                !bearoImageTwo
            ) {
                return;
            }


            bearoImageOne.classList.toggle(
                'active',
                !showSecond
            );


            bearoImageTwo.classList.toggle(
                'active',
                showSecond
            );
        }


        function startBearoAnimation() {

            let showSecond =
                false;


            showBearoImage(
                showSecond
            );


            bearoSwapTimer =
                setInterval(
                    function () {

                        showSecond =
                            !showSecond;


                        showBearoImage(
                            showSecond
                        );

                    },
                    1450
                );
        }


        function stopBearoAnimation() {

            if (bearoSwapTimer) {

                clearInterval(
                    bearoSwapTimer
                );


                bearoSwapTimer =
                    null;
            }


            showBearoImage(
                false
            );
        }


        function hideWarning() {

            warningOpen =
                false;


            overlay.classList.remove(
                'show'
            );


            overlay.setAttribute(
                'aria-hidden',
                'true'
            );


            if (countdownTimer) {

                clearInterval(
                    countdownTimer
                );


                countdownTimer =
                    null;
            }


            stopBearoAnimation();
        }


        function goToLogin() {

            window.location.href =
                @json(route('login'));
        }


        async function pingServer(
            force = false
        ) {

            const now =
                Date.now();


            if (
                !force
                &&
                now - lastServerPing
                <
                60000
            ) {
                return true;
            }


            try {

                const response =
                    await fetch(
                        keepAliveUrl,
                        {
                            method:
                                'POST',

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (
                    response.redirected
                    ||
                    response.status === 401
                    ||
                    response.status === 419
                ) {

                    goToLogin();

                    return false;
                }


                if (!response.ok) {

                    return false;
                }


                lastServerPing =
                    now;


                return true;

            } catch (error) {

                console.error(
                    'Session keep-alive failed.',
                    error
                );


                return false;
            }
        }


        function recordActivity() {

            if (warningOpen) {
                return;
            }


            lastActivity =
                Date.now();


            pingServer();
        }


        function startCountdown() {

            warningOpen =
                true;


            overlay.classList.add(
                'show'
            );


            overlay.setAttribute(
                'aria-hidden',
                'false'
            );


            startBearoAnimation();


            let secondsLeft =
                60;


            countdownElement.textContent =
                secondsLeft;


            if (countdownBar) {
                countdownBar.style.width =
                    '100%';
            }


            countdownTimer =
                setInterval(
                    function () {

                        secondsLeft--;


                        countdownElement.textContent =
                            Math.max(
                                secondsLeft,
                                0
                            );


                        if (countdownBar) {

                            const percent =
                                Math.max(
                                    0,
                                    (
                                        secondsLeft
                                        /
                                        60
                                    )
                                    *
                                    100
                                );


                            countdownBar.style.width =
                                percent
                                +
                                '%';
                        }


                        if (
                            secondsLeft <= 0
                        ) {

                            clearInterval(
                                countdownTimer
                            );


                            countdownTimer =
                                null;


                            goToLogin();
                        }

                    },
                    1000
                );
        }


        function checkIdleTime() {

            if (warningOpen) {
                return;
            }


            const idleFor =
                Date.now()
                -
                lastActivity;


            if (
                idleFor
                >=
                (
                    timeoutMs
                    -
                    warningMs
                )
            ) {

                startCountdown();
            }
        }


        stayButton.addEventListener(
            'click',
            async function () {

                stayButton.disabled =
                    true;


                const keptAlive =
                    await pingServer(
                        true
                    );


                if (keptAlive) {

                    lastActivity =
                        Date.now();


                    hideWarning();
                }


                stayButton.disabled =
                    false;
            }
        );


        [
            'click',
            'keydown',
            'mousemove',
            'scroll',
            'touchstart'
        ].forEach(
            function (eventName) {

                document.addEventListener(
                    eventName,
                    recordActivity,
                    {
                        passive: true
                    }
                );
            }
        );


        setInterval(
            checkIdleTime,
            5000
        );


        pingServer(
            true
        );

    }
);
</script>

@endauth
