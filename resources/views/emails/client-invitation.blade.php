<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Welcome to ArchiTrack</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f3f1ee;
    font-family:Arial, Helvetica, sans-serif;
    color:#30383d;
">

<table
    width="100%"
    cellpadding="0"
    cellspacing="0"
    border="0"
    style="
        width:100%;
        background:#f3f1ee;
        padding:35px 15px;
    "
>
    <tr>
        <td align="center">

            <table
                width="600"
                cellpadding="0"
                cellspacing="0"
                border="0"
                style="
                    width:100%;
                    max-width:600px;
                    background:#ffffff;
                    border:1px solid #e1ddd8;
                "
            >

                {{-- =============================================
                     HEADER IMAGE
                ============================================== --}}

                <tr>
                    <td style="
                        padding:0;
                        margin:0;
                    ">

                        <img
                            src="{{ $message->embed(public_path('images/header1.jpg')) }}"
                            alt="ArchiTrack"
                            width="600"
                            style="
                                width:100%;
                                max-width:600px;
                                height:auto;
                                display:block;
                                border:0;
                            "
                        >

                    </td>
                </tr>


                {{-- =============================================
                     INTRODUCTION
                ============================================== --}}

                <tr>
                    <td style="
                        padding:38px 40px 20px;
                    ">

                        <p style="
                            margin:0 0 8px;
                            font-size:11px;
                            font-weight:bold;
                            letter-spacing:1.4px;
                            text-transform:uppercase;
                            color:#c86420;
                        ">
                            Client Project Access
                        </p>

                        <h1 style="
                            margin:0;
                            font-size:27px;
                            line-height:1.25;
                            font-weight:700;
                            color:#2f393f;
                        ">
                            Your project is now on ArchiTrack.
                        </h1>

                        <p style="
                            margin:22px 0 0;
                            font-size:15px;
                            line-height:1.75;
                            color:#606b71;
                        ">
                            Hi {{ $client->name }},
                        </p>

                        <p style="
                            margin:12px 0 0;
                            font-size:15px;
                            line-height:1.75;
                            color:#606b71;
                        ">
                            You have been given access to ArchiTrack
                            so you can stay connected with your architect
                            and follow your project in one organized workspace.
                        </p>

                        <p style="
                            margin:12px 0 0;
                            font-size:15px;
                            line-height:1.75;
                            color:#606b71;
                        ">
                            Through your Client Portal, you can follow
                            project progress, review files and updates,
                            communicate with your architect, submit revision
                            requests, and coordinate project meetings.
                        </p>

                    </td>
                </tr>


                {{-- =============================================
                     PROJECT INFORMATION
                ============================================== --}}

                <tr>
                    <td style="
                        padding:5px 40px 25px;
                    ">

                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                            style="
                                background:#faf8f5;
                                border:1px solid #e3ddd7;
                                border-left:3px solid #c86420;
                            "
                        >
                            <tr>
                                <td style="
                                    padding:18px 20px;
                                ">

                                    <p style="
                                        margin:0 0 6px;
                                        font-size:9px;
                                        font-weight:bold;
                                        letter-spacing:1.2px;
                                        text-transform:uppercase;
                                        color:#a36a45;
                                    ">
                                        Your Project
                                    </p>

                                    <p style="
                                        margin:0;
                                        font-size:18px;
                                        line-height:1.4;
                                        font-weight:bold;
                                        color:#344047;
                                    ">
                                        {{ $project->project_name }}
                                    </p>

                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>


                {{-- =============================================
                     LOGIN DETAILS
                ============================================== --}}

                <tr>
                    <td style="
                        padding:0 40px 25px;
                    ">

                        <h2 style="
                            margin:0 0 8px;
                            font-size:17px;
                            color:#344047;
                        ">
                            Your login details
                        </h2>

                        <p style="
                            margin:0 0 18px;
                            font-size:13px;
                            line-height:1.65;
                            color:#747e84;
                        ">
                            Use the credentials below to access your
                            ArchiTrack Client Portal for the first time.
                        </p>


                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                            style="
                                border:1px solid #e0dcd7;
                                background:#ffffff;
                            "
                        >

                            <tr>

                                <td style="
                                    width:135px;
                                    padding:14px 16px;
                                    border-bottom:1px solid #e6e2de;
                                    background:#faf9f7;
                                    font-size:10px;
                                    font-weight:bold;
                                    letter-spacing:.6px;
                                    text-transform:uppercase;
                                    color:#858e94;
                                ">
                                    Email
                                </td>

                                <td style="
                                    padding:14px 16px;
                                    border-bottom:1px solid #e6e2de;
                                    font-size:13px;
                                    color:#3e4a51;
                                ">
                                    {{ $client->email }}
                                </td>

                            </tr>


                            <tr>

                                <td style="
                                    width:135px;
                                    padding:14px 16px;
                                    background:#faf9f7;
                                    font-size:10px;
                                    font-weight:bold;
                                    letter-spacing:.6px;
                                    text-transform:uppercase;
                                    color:#858e94;
                                ">
                                    Temporary Password
                                </td>

                                <td style="
                                    padding:14px 16px;
                                    font-size:14px;
                                    font-weight:bold;
                                    letter-spacing:.4px;
                                    color:#c15d1d;
                                ">
                                    {{ $temporaryPassword }}
                                </td>

                            </tr>

                        </table>

                    </td>
                </tr>


                {{-- =============================================
                     LOGIN BUTTON
                ============================================== --}}

                <tr>
                    <td
                        align="center"
                        style="
                            padding:4px 40px 30px;
                        "
                    >

                        <a
                            href="{{ route('login') }}"
                            style="
                                display:inline-block;
                                padding:14px 28px;
                                background:#c86420;
                                border:1px solid #b7591b;
                                color:#ffffff;
                                text-decoration:none;
                                font-size:12px;
                                font-weight:bold;
                                letter-spacing:.5px;
                                text-transform:uppercase;
                            "
                        >
                            Open Client Portal
                        </a>

                    </td>
                </tr>


                {{-- =============================================
                     SECURITY NOTE
                ============================================== --}}

                <tr>
                    <td style="
                        padding:0 40px 32px;
                    ">

                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                            style="
                                background:#faf8f5;
                                border:1px solid #e3ddd7;
                            "
                        >
                            <tr>

                                <td style="
                                    width:38px;
                                    padding:15px 0 15px 15px;
                                    vertical-align:top;
                                ">

                                    <div style="
                                        width:24px;
                                        height:24px;
                                        line-height:24px;
                                        text-align:center;
                                        border:1px solid #d8b69e;
                                        color:#c86420;
                                        font-size:11px;
                                        font-weight:bold;
                                    ">
                                        !
                                    </div>

                                </td>


                                <td style="
                                    padding:15px;
                                ">

                                    <p style="
                                        margin:0 0 4px;
                                        font-size:11px;
                                        font-weight:bold;
                                        color:#555f65;
                                    ">
                                        First-time login
                                    </p>

                                    <p style="
                                        margin:0;
                                        font-size:11px;
                                        line-height:1.6;
                                        color:#7a8489;
                                    ">
                                        For your security, ArchiTrack will
                                        ask you to create a new password
                                        after signing in with the temporary
                                        password above.
                                    </p>

                                </td>

                            </tr>
                        </table>

                    </td>
                </tr>


                {{-- =============================================
                     CLOSING MESSAGE
                ============================================== --}}

                <tr>
                    <td style="
                        padding:27px 40px;
                        border-top:1px solid #e2ddd8;
                    ">

                        <p style="
                            margin:0;
                            font-size:13px;
                            line-height:1.7;
                            color:#69747a;
                        ">
                            ArchiTrack keeps your project communication,
                            documents, decisions, and progress organized
                            throughout your collaboration with your architect.
                        </p>

                        <p style="
                            margin:18px 0 0;
                            font-size:13px;
                            font-weight:bold;
                            color:#3d484e;
                        ">
                            Vero Designs Architectural Services
                        </p>

                        <p style="
                            margin:3px 0 0;
                            font-size:10px;
                            color:#9a9fa2;
                        ">
                            Powered by ArchiTrack
                        </p>

                    </td>
                </tr>

            </table>


            {{-- =============================================
                 EMAIL FOOTER
            ============================================== --}}

            <table
                width="600"
                cellpadding="0"
                cellspacing="0"
                border="0"
                style="
                    width:100%;
                    max-width:600px;
                "
            >

                <tr>

                    <td
                        align="center"
                        style="
                            padding:18px 20px 0;
                            font-size:10px;
                            line-height:1.6;
                            color:#999999;
                        "
                    >
                        This email was sent because an ArchiTrack
                        Client Portal account was created for you.
                    </td>

                </tr>

            </table>

        </td>
    </tr>
</table>

</body>

</html>