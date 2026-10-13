<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ArchiTrack</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f3f5f7;
    font-family:Arial, Helvetica, sans-serif;
    color:#253044;
">

<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background:#f3f5f7; padding:35px 15px;">

    <tr>
        <td align="center">

            <!-- MAIN EMAIL -->
            <table width="600"
                   cellpadding="0"
                   cellspacing="0"
                   border="0"
                   style="
                        width:100%;
                        max-width:600px;
                        background:#ffffff;
                        border-radius:14px;
                        overflow:hidden;
                        border:1px solid #e5e8ec;
                   ">


                <!-- HEADER IMAGE -->
                <tr>
                    <td style="padding:0; background:#ffffff;">

                        <img
                            src="{{ $message->embed(public_path('images/header2.jpg')) }}"
                            alt="Vero Designs Architectural Services"
                            width="600"
                            style="
                                display:block;
                                width:100%;
                                max-width:600px;
                                height:auto;
                                border:0;
                                margin:0;
                            "
                        >

                    </td>
                </tr>


                <!-- ORANGE INTRO -->
                <tr>
                    <td style="
                        padding:25px 35px;
                        background:#f97316;
                    ">

                        <p style="
                            margin:0 0 7px;
                            color:#ffffff;
                            font-size:10px;
                            font-weight:bold;
                            letter-spacing:1.8px;
                        ">
                            VERO DESIGNS ARCHITECTURAL SERVICES
                        </p>

                        <h1 style="
                            margin:0;
                            color:#ffffff;
                            font-size:25px;
                            line-height:1.3;
                            font-weight:700;
                        ">
                            Welcome to ArchiTrack
                        </h1>

                    </td>
                </tr>


                <!-- EMAIL CONTENT -->
                <tr>
                    <td style="padding:35px;">

                        <h2 style="
                            margin:0 0 18px;
                            color:#172033;
                            font-size:20px;
                            line-height:1.4;
                        ">
                            Hello, {{ $architect->name }}!
                        </h2>


                        <p style="
                            margin:0 0 15px;
                            color:#606b7c;
                            font-size:14px;
                            line-height:1.7;
                        ">
                            Your architect account for
                            <strong style="color:#172033;">ArchiTrack</strong>
                            has been successfully created by the system administrator.
                        </p>


                        <p style="
                            margin:0 0 25px;
                            color:#606b7c;
                            font-size:14px;
                            line-height:1.7;
                        ">
                            ArchiTrack will help you manage architectural projects,
                            organize project files, monitor progress, handle client
                            revisions, and coordinate project activities in one
                            centralized platform.
                        </p>


                        <!-- LOGIN CREDENTIALS -->
                        <table width="100%"
                               cellpadding="0"
                               cellspacing="0"
                               border="0"
                               style="
                                    background:#fff7f0;
                                    border:1px solid #ffd5b5;
                                    border-radius:10px;
                               ">

                            <tr>
                                <td style="padding:21px 23px;">

                                    <p style="
                                        margin:0 0 16px;
                                        color:#f97316;
                                        font-size:11px;
                                        font-weight:bold;
                                        letter-spacing:1px;
                                    ">
                                        YOUR LOGIN CREDENTIALS
                                    </p>


                                    <table width="100%"
                                           cellpadding="0"
                                           cellspacing="0"
                                           border="0">

                                        <tr>
                                            <td style="
                                                padding:0 0 11px;
                                                color:#727c8b;
                                                font-size:12px;
                                                width:145px;
                                            ">
                                                Email Address
                                            </td>

                                            <td style="
                                                padding:0 0 11px;
                                                color:#172033;
                                                font-size:13px;
                                                font-weight:bold;
                                            ">
                                                {{ $architect->email }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <td style="
                                                padding:0;
                                                color:#727c8b;
                                                font-size:12px;
                                            ">
                                                Temporary Password
                                            </td>

                                            <td style="
                                                padding:0;
                                                color:#172033;
                                                font-size:13px;
                                                font-weight:bold;
                                            ">
                                                {{ $tempPassword }}
                                            </td>
                                        </tr>

                                    </table>

                                </td>
                            </tr>

                        </table>


                        <!-- SECURITY MESSAGE -->
                        <table width="100%"
                               cellpadding="0"
                               cellspacing="0"
                               border="0"
                               style="margin-top:22px;">

                            <tr>

                                <td width="4"
                                    style="
                                        width:4px;
                                        background:#f97316;
                                        border-radius:5px;
                                    ">
                                </td>

                                <td style="
                                    padding:4px 0 4px 14px;
                                ">

                                    <p style="
                                        margin:0 0 4px;
                                        color:#313b4b;
                                        font-size:12px;
                                        font-weight:bold;
                                    ">
                                        Important Security Reminder
                                    </p>

                                    <p style="
                                        margin:0;
                                        color:#737d8c;
                                        font-size:12px;
                                        line-height:1.6;
                                    ">
                                        You will be required to create a new password
                                        when you log in for the first time. Please do
                                        not share your temporary password or account
                                        credentials with anyone.
                                    </p>

                                </td>

                            </tr>

                        </table>


                        <!-- CLOSING MESSAGE -->
                        <p style="
                            margin:27px 0 0;
                            color:#606b7c;
                            font-size:14px;
                            line-height:1.7;
                        ">
                            You may now use the credentials above to access your
                            ArchiTrack account. We look forward to making project
                            coordination and collaboration more organized and efficient.
                        </p>


                        <p style="
                            margin:25px 0 0;
                            color:#606b7c;
                            font-size:13px;
                            line-height:1.7;
                        ">
                            Regards,<br>

                            <strong style="color:#172033;">
                                Vero Designs Architectural Services
                            </strong><br>

                            <span style="color:#f97316; font-weight:bold;">
                                ArchiTrack
                            </span>
                        </p>

                    </td>
                </tr>


                <!-- FOOTER -->
                <tr>
                    <td style="
                        padding:20px 35px;
                        background:#f8f9fa;
                        border-top:1px solid #e9ecef;
                        text-align:center;
                    ">

                        <p style="
                            margin:0 0 5px;
                            color:#727c8b;
                            font-size:10px;
                            font-weight:bold;
                        ">
                            VERO DESIGNS ARCHITECTURAL SERVICES
                        </p>

                        <p style="
                            margin:0;
                            color:#a0a7b1;
                            font-size:9px;
                            line-height:1.6;
                        ">
                            This is an automated account notification from ArchiTrack.
                            Please keep your login information secure.
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>

</table>

</body>
</html>