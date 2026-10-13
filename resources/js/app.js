import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


/*
|--------------------------------------------------------------------------
| ARCHITECT AUTOMATIC PRESENCE
|--------------------------------------------------------------------------
|
| Runs only on architect pages.
|
| online = architect is actively using the page
| idle   = no activity for 5 minutes
| away   = tab is hidden
|
| Heartbeat updates last_seen_at every 30 seconds.
|
*/

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ARCHITECT PAGES ONLY
        |--------------------------------------------------------------------------
        */

        if (
            !window.location.pathname.startsWith(
                '/architect'
            )
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | CSRF TOKEN
        |--------------------------------------------------------------------------
        */

        const csrfMeta =
            document.querySelector(
                'meta[name="csrf-token"]'
            );


        if (!csrfMeta) {

            console.warn(
                'Architect presence: CSRF token not found.'
            );

            return;
        }


        const csrfToken =
            csrfMeta.getAttribute(
                'content'
            );


        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        const HEARTBEAT_INTERVAL =
            30000;


        const IDLE_TIME =
            5 * 60 * 1000;


        let lastActivityTime =
            Date.now();


        let currentPresence =
            'online';


        /*
        |--------------------------------------------------------------------------
        | SEND PRESENCE TO SERVER
        |--------------------------------------------------------------------------
        */

        async function sendPresence(
            status
        ) {

            try {

                const response =
                    await fetch(
                        '/architect/presence/heartbeat',
                        {
                            method:
                                'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'

                            },

                            body:
                                JSON.stringify(
                                    {
                                        presence_status:
                                            status
                                    }
                                )

                        }
                    );


                if (!response.ok) {

                    console.warn(
                        'Architect presence heartbeat failed.',
                        response.status
                    );

                    return;

                }


                const data =
                    await response.json();


                currentPresence =
                    data.presence_status
                    ?? status;


                console.log(
                    'Architect presence:',
                    currentPresence
                );


            } catch (error) {

                console.warn(
                    'Architect presence heartbeat error:',
                    error
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SET STATUS
        |--------------------------------------------------------------------------
        */

        function setPresence(
            status
        ) {

            if (
                ![
                    'online',
                    'idle',
                    'away'
                ].includes(status)
            ) {
                return;
            }


            currentPresence =
                status;


            sendPresence(
                status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | USER ACTIVITY
        |--------------------------------------------------------------------------
        */

        function registerActivity() {

            lastActivityTime =
                Date.now();


            /*
            |--------------------------------------------------------------------------
            | DO NOT MARK ONLINE WHILE TAB IS HIDDEN
            |--------------------------------------------------------------------------
            */

            if (
                document.hidden
            ) {
                return;
            }


            if (
                currentPresence
                !==
                'online'
            ) {

                setPresence(
                    'online'
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | ACTIVITY EVENTS
        |--------------------------------------------------------------------------
        */

        const activityEvents = [

            'mousemove',
            'mousedown',
            'keydown',
            'touchstart',
            'scroll',
            'click'

        ];


        activityEvents
            .forEach(
                function (eventName) {

                    document.addEventListener(
                        eventName,
                        registerActivity,
                        {
                            passive:
                                true
                        }
                    );

                }
            );


        /*
        |--------------------------------------------------------------------------
        | TAB VISIBILITY
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'visibilitychange',
            function () {

                if (
                    document.hidden
                ) {

                    setPresence(
                        'away'
                    );

                } else {

                    lastActivityTime =
                        Date.now();


                    setPresence(
                        'online'
                    );

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | IDLE CHECK
        |--------------------------------------------------------------------------
        */

        setInterval(
            function () {

                if (
                    document.hidden
                ) {
                    return;
                }


                const inactiveTime =
                    Date.now()
                    -
                    lastActivityTime;


                if (
                    inactiveTime
                    >=
                    IDLE_TIME
                ) {

                    if (
                        currentPresence
                        !==
                        'idle'
                    ) {

                        setPresence(
                            'idle'
                        );

                    }

                }

            },
            15000
        );


        /*
        |--------------------------------------------------------------------------
        | HEARTBEAT
        |--------------------------------------------------------------------------
        */

        setInterval(
            function () {

                if (
                    document.hidden
                ) {

                    sendPresence(
                        'away'
                    );

                    return;

                }


                const inactiveTime =
                    Date.now()
                    -
                    lastActivityTime;


                if (
                    inactiveTime
                    >=
                    IDLE_TIME
                ) {

                    sendPresence(
                        'idle'
                    );

                } else {

                    sendPresence(
                        'online'
                    );

                }

            },
            HEARTBEAT_INTERVAL
        );


        /*
        |--------------------------------------------------------------------------
        | FIRST HEARTBEAT
        |--------------------------------------------------------------------------
        */

        setPresence(
            document.hidden
                ? 'away'
                : 'online'
        );

    }
);