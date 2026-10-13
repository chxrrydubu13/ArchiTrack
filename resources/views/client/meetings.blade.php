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



    <title>Meetings | ArchiTrack</title>



    @vite([

        'resources/css/app.css',

        'resources/css/client-dashboard.css',

        'resources/css/client-meetings-page.css',

        'resources/js/app.js'

    ])



    <style>

        /*

        |--------------------------------------------------------------------------

        | NOTIFICATION ICON FIX

        |--------------------------------------------------------------------------

        */



        .notification-item-icon {

            width: 42px;

            height: 42px;

            min-width: 42px;

            flex: 0 0 42px;



            display: flex;

            align-items: center;

            justify-content: center;



            border-radius: 12px;



            background: #fff3e8;

            color: #f97316;

        }



        .notification-item-icon svg {

            width: 20px !important;

            height: 20px !important;



            display: block;



            fill: none !important;

            stroke: currentColor !important;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;

        }



        .notification-item-icon svg circle,

        .notification-item-icon svg path,

        .notification-item-icon svg rect,

        .notification-item-icon svg line,

        .notification-item-icon svg polyline {

            fill: none !important;

            stroke: currentColor !important;

        }



        .notification-item {

            width: 100%;



            display: flex;

            align-items: flex-start;

            gap: 14px;



            padding: 16px 18px;



            border: 0;

            border-bottom: 1px solid #eee7df;



            background: #ffffff;



            text-align: left;

            cursor: pointer;

        }



        .notification-item:hover {

            background: #fffaf5;

        }



        .notification-item.unread {

            background: #fff7ed;

        }



        .notification-item-copy {

            flex: 1;

            min-width: 0;



            display: flex;

            flex-direction: column;

            gap: 4px;

        }



        .notification-item-copy strong {

            font-size: 14px;

            line-height: 1.4;



            color: #25313b;

        }



        .notification-item-copy > span {

            font-size: 13px;

            line-height: 1.5;



            color: #66727c;

        }



        .notification-item-copy time {

            margin-top: 2px;



            font-size: 11px;



            color: #98a1a8;

        }



        .notification-unread-dot {

            width: 8px;

            height: 8px;

            min-width: 8px;



            margin-top: 7px;



            border-radius: 50%;



            background: #f97316;

        }

    
        /* =========================================================
           TWO-WAY MEETING APPROVAL
        ========================================================= */

        .meeting-response-banner {
            grid-column: 1 / -1;
            width: 100%;
            margin-top: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            border: 1px solid #eadfd4;
            border-left: 4px solid #f97316;
            background: #fffaf5;
            box-sizing: border-box;
        }

        .meeting-response-banner.waiting-architect {
            border-left-color: #8b959e;
            background: #f7f8f8;
        }

        .meeting-response-copy {
            flex: 1 1 auto;
            min-width: 0;
        }

        .meeting-response-copy strong {
            display: block;
            margin: 0 0 3px;
            color: #26323c;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.35;
        }

        .meeting-response-copy span {
            display: block;
            color: #66727c;
            font-size: 12px;
            line-height: 1.5;
        }

        .meeting-proposal-label {
            display: inline-flex;
            align-items: center;
            min-height: 23px;
            padding: 0 8px;
            margin-left: 7px;
            border: 1px solid #e5d8ca;
            border-radius: 2px;
            background: #fff8f1;
            color: #c45d17;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .meeting-proposal-label.client {
            border-color: #dce1e4;
            background: #f5f7f8;
            color: #67727b;
        }

        .meeting-response-actions {
            flex: 0 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .meeting-response-actions form {
            margin: 0;
        }

        .meeting-approve-button,
        .meeting-reject-button,
        .meeting-reschedule-toggle,
        .meeting-reschedule-submit {
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 13px;
            border-radius: 2px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            white-space: nowrap;
            cursor: pointer;
            transition: .18s ease;
        }

        .meeting-approve-button {
            border: 1px solid #4f8265;
            background: #4f8265;
            color: #ffffff;
        }

        .meeting-approve-button:hover {
            background: #426f56;
        }

        .meeting-reject-button {
            border: 1px solid #d7b7b2;
            background: #fff9f8;
            color: #91493f;
        }

        .meeting-reject-button:hover {
            background: #fff1ef;
        }

        .meeting-reschedule-toggle {
            list-style: none;
            border: 1px solid #e7aa7b;
            background: #fff8f2;
            color: #bf5c18;
        }

        .meeting-reschedule-toggle:hover {
            background: #fff1e6;
        }

        .meeting-reschedule-toggle::-webkit-details-marker {
            display: none;
        }

        .meeting-reschedule-details {
            position: relative;
        }

        .meeting-reschedule-panel {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            z-index: 40;
            width: min(620px, 78vw);
            padding: 15px;
            border: 1px solid #ded7cf;
            background: #ffffff;
            box-shadow: 0 14px 34px rgba(46, 42, 38, .12);
        }

        .meeting-reschedule-panel form {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .meeting-reschedule-field {
            display: grid;
            gap: 5px;
        }

        .meeting-reschedule-field.full {
            grid-column: 1 / -1;
        }

        .meeting-reschedule-field label {
            color: #46515b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .meeting-reschedule-field input,
        .meeting-reschedule-field textarea {
            width: 100%;
            min-height: 38px;
            padding: 8px 10px;
            border: 1px solid #d8d2ca;
            border-radius: 2px;
            background: #ffffff;
            color: #25313b;
            font-size: 12px;
            box-sizing: border-box;
            outline: none;
        }

        .meeting-reschedule-field textarea {
            min-height: 76px;
            resize: vertical;
        }

        .meeting-reschedule-field input:focus,
        .meeting-reschedule-field textarea:focus {
            border-color: #e49a62;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, .08);
        }

        .meeting-reschedule-submit {
            grid-column: 1 / -1;
            justify-self: start;
            border: 1px solid #f97316;
            background: #f97316;
            color: #ffffff;
        }

        .meeting-feedback {
            margin: 0 0 18px;
            padding: 13px 15px;
            border-radius: 2px;
            font-size: 13px;
        }

        .meeting-feedback.success {
            border: 1px solid #c9dbcf;
            border-left: 4px solid #4f8265;
            background: #f2f7f3;
            color: #3d654e;
        }

        .meeting-feedback.error {
            border: 1px solid #e1c8c4;
            border-left: 4px solid #a9544c;
            background: #fff6f5;
            color: #87453e;
        }

        .meeting-feedback.error ul {
            margin: 0;
            padding-left: 18px;
        }


        .meeting-note-row {
            grid-column: 1 / -1;
            width: 100%;
            margin-top: 8px;
            padding: 10px 12px;
            border-left: 3px solid #f97316;
            background: #fffaf5;
            box-sizing: border-box;
        }

        .meeting-note-row span {
            display: block;
            margin-bottom: 4px;
            color: #c45d17;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .meeting-note-row p {
            margin: 0;
            color: #59656f;
            font-size: 12px;
            line-height: 1.5;
            white-space: normal;
            word-break: break-word;
        }

        @media (max-width: 1050px) {
            .meeting-response-banner {
                align-items: flex-start;
                flex-direction: column;
            }

            .meeting-response-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .meeting-reschedule-panel {
                left: 0;
                right: auto;
                width: min(620px, 82vw);
            }
        }

        @media (max-width: 760px) {
            .meeting-response-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .meeting-response-actions form,
            .meeting-response-actions details {
                width: 100%;
            }

            .meeting-approve-button,
            .meeting-reject-button,
            .meeting-reschedule-toggle {
                width: 100%;
            }

            .meeting-reschedule-panel {
                position: static;
                width: 100%;
                margin-top: 8px;
                box-shadow: none;
            }

            .meeting-reschedule-panel form {
                grid-template-columns: 1fr;
            }

            .meeting-reschedule-field.full,
            .meeting-reschedule-submit {
                grid-column: 1;
            }
        }

    </style>

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

                    href="{{ route('client.files.index') }}"

                    class="client-nav-link"

                >

                    Files

                </a>



                <a

                    href="{{ route('client.meetings.index') }}"

                    class="client-nav-link active"

                >

                    Meetings

                </a>



            </nav>





            <div class="client-account-area">



                <div class="notification-wrapper">



                    <button

                        type="button"

                        class="notification-button"

                        id="notificationButton"

                        aria-label="Notifications"

                        aria-expanded="false"

                    >

                        <svg viewBox="0 0 24 24">

                            <path

                                d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"

                            ></path>



                            <path

                                d="M13.73 21a2 2 0 0 1-3.46 0"

                            ></path>

                        </svg>



                        <span

                            class="notification-badge"

                            id="notificationBadge"

                            style="display: none;"

                        >

                            0

                        </span>

                    </button>





                    <div

                        class="notification-dropdown"

                        id="notificationDropdown"

                    >

                        <div class="notification-dropdown-header">



                            <div>

                                <span class="notification-dropdown-label">

                                    Client Updates

                                </span>



                                <h3>

                                    Notifications

                                </h3>

                            </div>



                            <button

                                type="button"

                                class="notification-mark-all"

                                id="markAllReadButton"

                            >

                                Mark all as read

                            </button>



                        </div>



                        <div

                            class="notification-list"

                            id="notificationList"

                        >

                            <div class="notification-empty">

                                Loading notifications...

                            </div>

                        </div>

                    </div>



                </div>





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

<a href="{{ route('client.files.index') }}">

            Files

        </a>



        <a

            href="{{ route('client.meetings.index') }}"

            class="active"

        >

            Meetings

        </a>



        <a href="{{ route('client.account.index') }}">

            Account

        </a>

    </nav>





    {{-- =========================================================

         MAIN

    ========================================================== --}}



    <main class="meetings-main">



        <section class="meetings-page-heading">



            <div class="meetings-heading-copy">



                <div class="meetings-heading-line"></div>



                <div>

                    <span class="meetings-heading-label">

                        Project Schedule

                    </span>



                    <h1>

                        Meetings

                    </h1>



                    <p>

                        View upcoming, pending, scheduled, completed,

                        and cancelled meetings across all your projects.

                    </p>

                </div>



            </div>



        </section>






        @if(session('success'))
            <div class="meeting-feedback success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="meeting-feedback error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- =====================================================

             SUMMARY

        ====================================================== --}}



        <section class="meetings-summary-grid">



            <a

                href="{{ route('client.meetings.index', ['view' => 'upcoming']) }}"

                class="meeting-summary-card {{ $view === 'upcoming' ? 'active' : '' }}"

            >

                <span class="meeting-summary-label">

                    Upcoming

                </span>



                <strong>

                    {{ $pendingCount + $scheduledCount }}

                </strong>



                <small>

                    Pending and scheduled meetings

                </small>

            </a>



            <a

                href="{{ route('client.meetings.index', ['view' => 'pending']) }}"

                class="meeting-summary-card"

            >

                <span class="meeting-summary-label">

                    Pending

                </span>



                <strong>

                    {{ $pendingCount }}

                </strong>



                <small>

                    Waiting for architect confirmation

                </small>

            </a>



            <a

                href="{{ route('client.meetings.index', ['view' => 'scheduled']) }}"

                class="meeting-summary-card"

            >

                <span class="meeting-summary-label">

                    Scheduled

                </span>



                <strong>

                    {{ $scheduledCount }}

                </strong>



                <small>

                    Confirmed project meetings

                </small>

            </a>



            <a

                href="{{ route('client.meetings.index', ['view' => 'completed']) }}"

                class="meeting-summary-card"

            >

                <span class="meeting-summary-label">

                    Completed

                </span>



                <strong>

                    {{ $completedCount }}

                </strong>



                <small>

                    Finished project meetings

                </small>

            </a>



            <a

                href="{{ route('client.meetings.index', ['view' => 'cancelled']) }}"

                class="meeting-summary-card"

            >

                <span class="meeting-summary-label">

                    Cancelled

                </span>



                <strong>

                    {{ $cancelledCount }}

                </strong>



                <small>

                    Cancelled meeting requests

                </small>

            </a>



        </section>





        {{-- =====================================================

             UPCOMING STRIP

        ====================================================== --}}



        @if($upcomingMeetings->isNotEmpty())



            <section class="upcoming-meetings-strip">



                <div class="upcoming-strip-head">

                    <span class="meetings-section-label">

                        Next Meetings

                    </span>



                    <h2>

                        Coming Up

                    </h2>

                </div>



                <div class="upcoming-cards">



                    @foreach($upcomingMeetings as $meeting)



                        @php

                            $meetingDate = \Carbon\Carbon::parse(

                                $meeting->meeting_date,

                                'Asia/Manila'

                            );



                            $startTime = $meeting->start_time

                                ? \Carbon\Carbon::parse(

                                    $meeting->start_time,

                                    'Asia/Manila'

                                )->format('g:i A')

                                : 'Time TBA';


                            $proposalOwner =
                                $meeting->proposed_by;

                            if (
                                !$proposalOwner
                                &&
                                $meeting->status === 'pending'
                            ) {
                                $proposalOwner =
                                    'client';
                            }

                            $waitingForClientApproval =
                                $meeting->status === 'pending'
                                &&
                                $proposalOwner === 'architect';

                            $waitingForArchitectApproval =
                                $meeting->status === 'pending'
                                &&
                                $proposalOwner === 'client';

                        @endphp



                        <article class="upcoming-card">



                            <div class="upcoming-date-box">

                                <span>

                                    {{ strtoupper($meetingDate->format('M')) }}

                                </span>



                                <strong>

                                    {{ $meetingDate->format('d') }}

                                </strong>

                            </div>



                            <div class="upcoming-info">



                                <span class="upcoming-project">

                                    {{ $meeting->project->project_name ?? 'Project' }}

                                </span>



                                <h3>

                                    {{ $meeting->title }}

                                </h3>



                                <p>

                                    {{ $startTime }}

                                    ·

                                    {{ $meeting->meeting_type === 'online'

                                        ? 'Online'

                                        : 'In Person'

                                    }}

                                </p>



                            </div>



                            <span class="meeting-status status-{{ $meeting->status }}">

                                {{ ucfirst($meeting->status) }}

                            </span>

                                @if($waitingForClientApproval)
                                    <span class="meeting-proposal-label">
                                        Your Approval Needed
                                    </span>
                                @elseif($waitingForArchitectApproval)
                                    <span class="meeting-proposal-label client">
                                        Waiting for Architect
                                    </span>
                                @endif



                        </article>



                    @endforeach



                </div>



            </section>



        @endif





        {{-- =====================================================

             CENTRALIZED MEETING LIST

        ====================================================== --}}



        <section class="meetings-library">



            <div class="meetings-library-head">



                <div>

                    <span class="meetings-section-label">

                        Centralized Schedule

                    </span>



                    <h2>

                        All Project Meetings

                    </h2>

                </div>



                <span class="meetings-result-count">

                    {{ $allMeetings->count() }}

                    {{ $allMeetings->count() === 1 ? 'meeting' : 'meetings' }}

                </span>



            </div>





            <div class="meetings-quick-tabs">



                <a

                    href="{{ route('client.meetings.index', ['view' => 'upcoming']) }}"

                    class="{{ $view === 'upcoming' ? 'active' : '' }}"

                >

                    Upcoming

                </a>



                <a

                    href="{{ route('client.meetings.index', ['view' => 'pending']) }}"

                    class="{{ $view === 'pending' ? 'active' : '' }}"

                >

                    Pending

                </a>



                <a

                    href="{{ route('client.meetings.index', ['view' => 'scheduled']) }}"

                    class="{{ $view === 'scheduled' ? 'active' : '' }}"

                >

                    Scheduled

                </a>



                <a

                    href="{{ route('client.meetings.index', ['view' => 'completed']) }}"

                    class="{{ $view === 'completed' ? 'active' : '' }}"

                >

                    Completed

                </a>



                <a

                    href="{{ route('client.meetings.index', ['view' => 'cancelled']) }}"

                    class="{{ $view === 'cancelled' ? 'active' : '' }}"

                >

                    Cancelled

                </a>



            </div>





            <form

                method="GET"

                action="{{ route('client.meetings.index') }}"

                class="meetings-filter-bar"

            >



                <input

                    type="hidden"

                    name="view"

                    value="{{ $view }}"

                >



                <div class="meetings-search-field">



                    <svg viewBox="0 0 24 24">

                        <circle

                            cx="11"

                            cy="11"

                            r="8"

                        ></circle>



                        <path d="m21 21-4.35-4.35"></path>

                    </svg>



                    <input

                        type="search"

                        name="search"

                        value="{{ $search }}"

                        placeholder="Search meeting, project, architect..."

                    >



                </div>





                <select name="project">

                    <option value="">

                        All Projects

                    </option>



                    @foreach($projects as $project)



                        <option

                            value="{{ $project->id }}"

                            {{ (string) $projectId === (string) $project->id ? 'selected' : '' }}

                        >

                            {{ $project->project_name }}

                        </option>



                    @endforeach

                </select>





                <select name="type">

                    <option value="">

                        All Types

                    </option>



                    <option

                        value="online"

                        {{ $type === 'online' ? 'selected' : '' }}

                    >

                        Online

                    </option>



                    <option

                        value="in_person"

                        {{ $type === 'in_person' ? 'selected' : '' }}

                    >

                        In Person

                    </option>

                </select>





                <select name="status">

                    <option value="">

                        All Status

                    </option>



                    <option

                        value="pending"

                        {{ $status === 'pending' ? 'selected' : '' }}

                    >

                        Pending

                    </option>



                    <option

                        value="scheduled"

                        {{ $status === 'scheduled' ? 'selected' : '' }}

                    >

                        Scheduled

                    </option>



                    <option

                        value="completed"

                        {{ $status === 'completed' ? 'selected' : '' }}

                    >

                        Completed

                    </option>



                    <option

                        value="cancelled"

                        {{ $status === 'cancelled' ? 'selected' : '' }}

                    >

                        Cancelled

                    </option>

                </select>





                <select name="sort">

                    <option

                        value="soonest"

                        {{ $sort === 'soonest' ? 'selected' : '' }}

                    >

                        Soonest First

                    </option>



                    <option

                        value="latest"

                        {{ $sort === 'latest' ? 'selected' : '' }}

                    >

                        Recently Added

                    </option>



                    <option

                        value="oldest"

                        {{ $sort === 'oldest' ? 'selected' : '' }}

                    >

                        Oldest Added

                    </option>



                    <option

                        value="project"

                        {{ $sort === 'project' ? 'selected' : '' }}

                    >

                        Project

                    </option>

                </select>





                <button type="submit">

                    Apply

                </button>



                @if(

                    $search

                    || $projectId

                    || $type

                    || $status

                    || $sort !== 'soonest'

                    || $view !== 'upcoming'

                )

                    <a

                        href="{{ route('client.meetings.index') }}"

                        class="meetings-clear-filter"

                    >

                        Clear

                    </a>

                @endif



            </form>





            <div class="meetings-list">



                @forelse($allMeetings as $meeting)



                    @php



                        $meetingDate = $meeting->meeting_date

                            ? \Carbon\Carbon::parse(

                                $meeting->meeting_date,

                                'Asia/Manila'

                            )

                            : null;



                        $startTime = $meeting->start_time

                            ? \Carbon\Carbon::parse(

                                $meeting->start_time,

                                'Asia/Manila'

                            )->format('g:i A')

                            : '—';



                        $endTime = $meeting->end_time

                            ? \Carbon\Carbon::parse(

                                $meeting->end_time,

                                'Asia/Manila'

                            )->format('g:i A')

                            : null;



                        $projectName =

                            $meeting->project->project_name

                            ?? 'Project';



                        $architectName =

                            $meeting->architect->name

                            ?? 'Architect';



                    
                        /*
                         * Legacy Pending meetings created before proposed_by
                         * existed are treated as Client requests.
                         */
                        $proposalOwner = $meeting->proposed_by;

                        if (
                            !$proposalOwner
                            &&
                            $meeting->status === 'pending'
                        ) {
                            $proposalOwner = 'client';
                        }

                        $waitingForClientApproval =
                            $meeting->status === 'pending'
                            &&
                            $proposalOwner === 'architect';

                        $waitingForArchitectApproval =
                            $meeting->status === 'pending'
                            &&
                            $proposalOwner === 'client';

                    @endphp





                    <article

                        class="meeting-row"

                        id="meeting-{{ $meeting->id }}"

                    >



                        <div class="meeting-date-card">



                            @if($meetingDate)



                                <span>

                                    {{ strtoupper(

                                        $meetingDate->format('M')

                                    ) }}

                                </span>



                                <strong>

                                    {{ $meetingDate->format('d') }}

                                </strong>



                                <small>

                                    {{ $meetingDate->format('Y') }}

                                </small>



                            @else



                                <span>

                                    DATE

                                </span>



                                <strong>

                                    —

                                </strong>



                            @endif



                        </div>





                        <div class="meeting-primary">



                            <div class="meeting-title-row">



                                <strong>

                                    {{ $meeting->title }}

                                </strong>



                                <span class="meeting-status status-{{ $meeting->status }}">

                                    {{ ucfirst($meeting->status) }}

                                </span>



                            </div>



                            <span class="meeting-project-name">

                                {{ $projectName }}

                            </span>



                            @if($meeting->agenda)

                                <p>

                                    {{ \Illuminate\Support\Str::limit(

                                        $meeting->agenda,

                                        110

                                    ) }}

                                </p>

                            @endif



                        </div>





                        <div class="meeting-detail">

                            <span>Time</span>



                            <strong>

                                {{ $startTime }}



                                @if($endTime)

                                    – {{ $endTime }}

                                @endif

                            </strong>

                        </div>





                        <div class="meeting-detail">

                            <span>Type</span>



                            <strong>

                                {{ $meeting->meeting_type === 'online'

                                    ? 'Online'

                                    : 'In Person'

                                }}

                            </strong>

                        </div>





                        <div class="meeting-detail">

                            <span>Architect</span>



                            <strong>

                                {{ $architectName }}

                            </strong>

                        </div>





                        <div class="meeting-detail">

                            <span>

                                {{ $meeting->meeting_type === 'online'

                                    ? 'Meeting Link'

                                    : 'Location'

                                }}

                            </span>



                            @if(

                                $meeting->meeting_type === 'online'

                                &&

                                $meeting->meeting_link

                            )



                                <a

                                    href="{{ $meeting->meeting_link }}"

                                    target="_blank"

                                    rel="noopener noreferrer"

                                    class="meeting-inline-link"

                                >

                                    Join Meeting

                                </a>



                            @elseif(

                                $meeting->meeting_type === 'in_person'

                                &&

                                $meeting->location

                            )



                                <strong title="{{ $meeting->location }}">

                                    {{ \Illuminate\Support\Str::limit(

                                        $meeting->location,

                                        28

                                    ) }}

                                </strong>



                            @else



                                <strong>

                                    —

                                </strong>



                            @endif



                        </div>





                        @if($meeting->notes)

                            <div class="meeting-note-row">
                                <span>Meeting Note</span>

                                <p>
                                    {{ $meeting->notes }}
                                </p>
                            </div>

                        @endif


                        <div class="meeting-actions">

                            <a
                                href="{{ route(
                                    'client.projects.index',
                                    [
                                        'project' => $meeting->project_id,
                                        'section' => 'meetings'
                                    ]
                                ) }}#meeting-{{ $meeting->id }}"
                                class="meeting-workspace-button"
                            >
                                Open Project
                            </a>

                        </div>


                        @if($waitingForClientApproval)

                            <div class="meeting-response-banner">

                                <div class="meeting-response-copy">

                                    <strong>
                                        Meeting request from your architect
                                    </strong>

                                    <span>
                                        Review the proposed schedule, then approve,
                                        reject, or suggest a different date and time.
                                    </span>

                                </div>


                                <div class="meeting-response-actions">

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'client.projects.meetings.approve',
                                            [
                                                'id' => $meeting->project_id,
                                                'meeting' => $meeting->id
                                            ]
                                        ) }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="meeting-approve-button"
                                        >
                                            Approve Meeting
                                        </button>
                                    </form>


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'client.projects.meetings.reject',
                                            [
                                                'id' => $meeting->project_id,
                                                'meeting' => $meeting->id
                                            ]
                                        ) }}"
                                        onsubmit="return confirm('Reject this meeting request?');"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="meeting-reject-button"
                                        >
                                            Reject
                                        </button>
                                    </form>


                                    <details class="meeting-reschedule-details">

                                        <summary class="meeting-reschedule-toggle">
                                            Propose New Schedule
                                        </summary>


                                        <div class="meeting-reschedule-panel">

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'client.projects.meetings.reschedule',
                                                    [
                                                        'id' => $meeting->project_id,
                                                        'meeting' => $meeting->id
                                                    ]
                                                ) }}"
                                            >
                                                @csrf
                                                @method('PUT')

                                                <div class="meeting-reschedule-field">
                                                    <label>New Date</label>

                                                    <input
                                                        type="date"
                                                        name="meeting_date"
                                                        min="{{ now('Asia/Manila')->format('Y-m-d') }}"
                                                        value="{{ $meetingDate ? $meetingDate->format('Y-m-d') : '' }}"
                                                        required
                                                    >
                                                </div>


                                                <div class="meeting-reschedule-field">
                                                    <label>Start Time</label>

                                                    <input
                                                        type="time"
                                                        name="start_time"
                                                        value="{{ $meeting->start_time ? \Carbon\Carbon::parse($meeting->start_time)->format('H:i') : '' }}"
                                                        required
                                                    >
                                                </div>


                                                <div class="meeting-reschedule-field">
                                                    <label>
                                                        End Time
                                                        <span>(optional)</span>
                                                    </label>

                                                    <input
                                                        type="time"
                                                        name="end_time"
                                                        value="{{ $meeting->end_time ? \Carbon\Carbon::parse($meeting->end_time)->format('H:i') : '' }}"
                                                    >
                                                </div>


                                                <div class="meeting-reschedule-field full">
                                                    <label>
                                                        Note to Architect
                                                        <span>(optional)</span>
                                                    </label>

                                                    <textarea
                                                        name="notes"
                                                        placeholder="Add a short note about your preferred schedule."
                                                    >{{ old('notes') }}</textarea>
                                                </div>


                                                <button
                                                    type="submit"
                                                    class="meeting-reschedule-submit"
                                                >
                                                    Send New Schedule Proposal
                                                </button>

                                            </form>

                                        </div>

                                    </details>

                                </div>

                            </div>


                        @elseif($waitingForArchitectApproval)

                            <div class="meeting-response-banner waiting-architect">

                                <div class="meeting-response-copy">

                                    <strong>
                                        Waiting for architect approval
                                    </strong>

                                    <span>
                                        You proposed this meeting schedule.
                                        It will be confirmed once your architect approves it.
                                    </span>

                                </div>

                            </div>

                        @endif



                    </article>



                @empty



                    <div class="meetings-empty">



                        <div class="meetings-empty-icon">

                            <svg viewBox="0 0 24 24">

                                <rect

                                    x="3"

                                    y="5"

                                    width="18"

                                    height="16"

                                    rx="2"

                                ></rect>



                                <path d="M16 3v4"></path>

                                <path d="M8 3v4"></path>

                                <path d="M3 10h18"></path>

                            </svg>

                        </div>



                        <h3>

                            No meetings found

                        </h3>



                        <p>

                            Meeting requests and confirmed schedules

                            from your projects will appear here.

                        </p>



                    </div>



                @endforelse



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



    const notificationButton =

        document.getElementById('notificationButton');



    const notificationDropdown =

        document.getElementById('notificationDropdown');



    const notificationBadge =

        document.getElementById('notificationBadge');



    const notificationList =

        document.getElementById('notificationList');



    const markAllReadButton =

        document.getElementById('markAllReadButton');



    const csrfToken =

        document

            .querySelector('meta[name="csrf-token"]')

            ?.getAttribute('content');





    /*

    |--------------------------------------------------------------------------

    | PROFILE MENU

    |--------------------------------------------------------------------------

    */



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



                notificationDropdown

                    ?.classList

                    .remove('show');



                notificationButton

                    ?.setAttribute(

                        'aria-expanded',

                        'false'

                    );

            }

        );

    }





    /*

    |--------------------------------------------------------------------------

    | MOBILE MENU

    |--------------------------------------------------------------------------

    */



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



                notificationDropdown

                    ?.classList

                    .remove('show');



                notificationButton

                    ?.setAttribute(

                        'aria-expanded',

                        'false'

                    );

            }

        );

    }





    /*

    |--------------------------------------------------------------------------

    | NOTIFICATION HELPERS

    |--------------------------------------------------------------------------

    */



    function escapeHtml(value) {



        const div =

            document.createElement('div');



        div.textContent =

            value ?? '';



        return div.innerHTML;

    }





    function formatNotificationTime(dateValue) {



        if (!dateValue) {

            return '';

        }



        const date =

            new Date(dateValue);



        if (Number.isNaN(date.getTime())) {

            return '';

        }



        return date.toLocaleString(

            'en-PH',

            {

                month: 'short',

                day: 'numeric',

                year: 'numeric',

                hour: 'numeric',

                minute: '2-digit'

            }

        );

    }





    function updateNotificationBadge(count) {



        if (!notificationBadge) {

            return;

        }



        const unreadCount =

            Number(count) || 0;



        notificationBadge.textContent =

            unreadCount > 99

                ? '99+'

                : unreadCount;



        notificationBadge.style.display =

            unreadCount > 0

                ? 'flex'

                : 'none';

    }





    /*

    |--------------------------------------------------------------------------

    | NOTIFICATION ICONS

    |--------------------------------------------------------------------------

    */



    function getNotificationIcon(type) {



        if (type === 'message') {

            return `

                <svg viewBox="0 0 24 24">

                    <path

                        d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"

                    ></path>

                </svg>

            `;

        }





        if (type === 'file') {

            return `

                <svg viewBox="0 0 24 24">

                    <path

                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"

                    ></path>



                    <path

                        d="M14 2v6h6"

                    ></path>

                </svg>

            `;

        }





        if (type === 'revision') {

            return `

                <svg viewBox="0 0 24 24">

                    <path

                        d="M3 12a9 9 0 1 0 3-6.7L3 8"

                    ></path>



                    <path

                        d="M3 3v5h5"

                    ></path>

                </svg>

            `;

        }





        if (type === 'meeting') {

            return `

                <svg viewBox="0 0 24 24">

                    <rect

                        x="3"

                        y="5"

                        width="18"

                        height="16"

                        rx="2"

                    ></rect>



                    <path d="M16 3v4"></path>

                    <path d="M8 3v4"></path>

                    <path d="M3 11h18"></path>

                </svg>

            `;

        }





        if (type === 'milestone') {

            return `

                <svg viewBox="0 0 24 24">

                    <circle

                        cx="12"

                        cy="12"

                        r="9"

                    ></circle>



                    <path

                        d="m8 12 2.5 2.5L16 9"

                    ></path>

                </svg>

            `;

        }





        if (type === 'project') {

            return `

                <svg viewBox="0 0 24 24">

                    <rect

                        x="3"

                        y="3"

                        width="18"

                        height="18"

                        rx="2"

                    ></rect>



                    <path d="M8 12h8"></path>

                    <path d="M12 8v8"></path>

                </svg>

            `;

        }





        return `

            <svg viewBox="0 0 24 24">

                <circle

                    cx="12"

                    cy="12"

                    r="9"

                ></circle>



                <path

                    d="M12 8v4"

                ></path>



                <path

                    d="M12 16h.01"

                ></path>

            </svg>

        `;

    }





    /*

    |--------------------------------------------------------------------------

    | RENDER NOTIFICATIONS

    |--------------------------------------------------------------------------

    */



    function renderNotifications(notifications) {



        if (!notificationList) {

            return;

        }



        if (

            !Array.isArray(notifications)

            ||

            notifications.length === 0

        ) {

            notificationList.innerHTML = `

                <div class="notification-empty">



                    <strong>

                        No notifications yet

                    </strong>



                    <span>

                        Project updates from your architect will appear here.

                    </span>



                </div>

            `;



            return;

        }





        notificationList.innerHTML =

            notifications

                .map(function (notification) {



                    const data =

                        notification.data || {};



                    const isUnread =

                        !notification.read_at;





                    const title =

                        escapeHtml(

                            data.title

                            ||

                            'Project Update'

                        );





                    const message =

                        escapeHtml(

                            data.message

                            ||

                            ''

                        );





                    const type =

                        escapeHtml(

                            data.type

                            ||

                            'general'

                        );





                    const url =

                        data.url

                            ? escapeHtml(data.url)

                            : '';





                    const time =

                        escapeHtml(

                            formatNotificationTime(

                                notification.created_at

                            )

                        );





                    return `

                        <button

                            type="button"

                            class="notification-item ${isUnread ? 'unread' : ''}"

                            data-notification-id="${escapeHtml(notification.id)}"

                            data-notification-url="${url}"

                        >



                            <span

                                class="notification-item-icon ${type}"

                            >

                                ${getNotificationIcon(data.type)}

                            </span>





                            <span class="notification-item-copy">



                                <strong>

                                    ${title}

                                </strong>



                                <span>

                                    ${message}

                                </span>



                                <time>

                                    ${time}

                                </time>



                            </span>





                            ${

                                isUnread

                                    ? '<span class="notification-unread-dot"></span>'

                                    : ''

                            }



                        </button>

                    `;

                })

                .join('');

    }





    /*

    |--------------------------------------------------------------------------

    | LOAD NOTIFICATIONS

    |--------------------------------------------------------------------------

    */



    async function loadNotifications() {



        if (!notificationList) {

            return;

        }



        try {



            const response =

                await fetch(

                    @json(route('client.notifications.index')),

                    {

                        headers: {

                            'Accept':

                                'application/json'

                        }

                    }

                );





            const data =

                await response.json();





            if (!response.ok) {

                throw new Error(

                    'Unable to load notifications.'

                );

            }





            renderNotifications(

                data.notifications || []

            );





            updateNotificationBadge(

                data.unread_count || 0

            );



        } catch (error) {



            console.error(error);



            notificationList.innerHTML = `

                <div class="notification-empty">

                    Unable to load notifications.

                </div>

            `;

        }

    }





    /*

    |--------------------------------------------------------------------------

    | MARK ONE AS READ

    |--------------------------------------------------------------------------

    */



    async function markNotificationAsRead(

        notificationId

    ) {



        const url =

            @json(

                route(

                    'client.notifications.read',

                    ['id' => '__NOTIFICATION__']

                )

            )

            .replace(

                '__NOTIFICATION__',

                notificationId

            );





        const response =

            await fetch(

                url,

                {

                    method: 'POST',



                    headers: {



                        'Accept':

                            'application/json',



                        'X-CSRF-TOKEN':

                            csrfToken

                    }

                }

            );





        if (!response.ok) {

            throw new Error(

                'Unable to mark notification as read.'

            );

        }





        return response.json();

    }





    /*

    |--------------------------------------------------------------------------

    | NOTIFICATION BUTTON

    |--------------------------------------------------------------------------

    */



    notificationButton?.addEventListener(

        'click',

        function (event) {



            event.stopPropagation();





            const isOpen =

                notificationDropdown

                    ?.classList

                    .toggle('show');





            notificationButton.setAttribute(

                'aria-expanded',

                isOpen

                    ? 'true'

                    : 'false'

            );





            profileDropdown

                ?.classList

                .remove('show');





            mobileNavigation

                ?.classList

                .remove('show');

        }

    );





    /*

    |--------------------------------------------------------------------------

    | NOTIFICATION ITEM CLICK

    |--------------------------------------------------------------------------

    */



    notificationList?.addEventListener(

        'click',

        async function (event) {



            const item =

                event.target.closest(

                    '.notification-item'

                );





            if (!item) {

                return;

            }





            const notificationId =

                item.dataset.notificationId;





            const notificationUrl =

                item.dataset.notificationUrl;





            if (

                notificationId

                &&

                item.classList.contains('unread')

            ) {



                try {



                    await markNotificationAsRead(

                        notificationId

                    );





                    item.classList.remove(

                        'unread'

                    );





                    item

                        .querySelector(

                            '.notification-unread-dot'

                        )

                        ?.remove();





                    const currentCount =

                        Number(

                            notificationBadge

                                ?.textContent

                        ) || 0;





                    updateNotificationBadge(

                        Math.max(

                            currentCount - 1,

                            0

                        )

                    );



                } catch (error) {



                    console.error(error);

                }

            }





            if (notificationUrl) {



                window.location.href =

                    notificationUrl;

            }

        }

    );





    /*

    |--------------------------------------------------------------------------

    | MARK ALL AS READ

    |--------------------------------------------------------------------------

    */



    markAllReadButton?.addEventListener(

        'click',

        async function (event) {



            event.stopPropagation();





            markAllReadButton.disabled =

                true;





            try {



                const response =

                    await fetch(

                        @json(

                            route(

                                'client.notifications.readAll'

                            )

                        ),

                        {

                            method: 'POST',



                            headers: {



                                'Accept':

                                    'application/json',



                                'X-CSRF-TOKEN':

                                    csrfToken

                            }

                        }

                    );





                if (!response.ok) {

                    throw new Error(

                        'Unable to mark all notifications as read.'

                    );

                }





                notificationList

                    ?.querySelectorAll(

                        '.notification-item.unread'

                    )

                    .forEach(

                        function (item) {



                            item.classList.remove(

                                'unread'

                            );





                            item

                                .querySelector(

                                    '.notification-unread-dot'

                                )

                                ?.remove();

                        }

                    );





                updateNotificationBadge(0);



            } catch (error) {



                console.error(error);



            } finally {



                markAllReadButton.disabled =

                    false;

            }

        }

    );





    /*

    |--------------------------------------------------------------------------

    | CLOSE DROPDOWNS

    |--------------------------------------------------------------------------

    */



    document.addEventListener(

        'click',

        function (event) {





            if (

                profileDropdown

                &&

                profileMenuButton

                &&

                !profileDropdown.contains(

                    event.target

                )

                &&

                !profileMenuButton.contains(

                    event.target

                )

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

                !mobileNavigation.contains(

                    event.target

                )

                &&

                !mobileMenuButton.contains(

                    event.target

                )

            ) {

                mobileNavigation.classList.remove(

                    'show'

                );

            }





            if (

                notificationDropdown

                &&

                notificationButton

                &&

                !notificationDropdown.contains(

                    event.target

                )

                &&

                !notificationButton.contains(

                    event.target

                )

            ) {



                notificationDropdown

                    .classList

                    .remove('show');





                notificationButton

                    .setAttribute(

                        'aria-expanded',

                        'false'

                    );

            }

        }

    );





    /*

    |--------------------------------------------------------------------------

    | INITIAL LOAD

    |--------------------------------------------------------------------------

    */



    loadNotifications();



});

</script>



</body>

</html>