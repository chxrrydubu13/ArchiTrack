<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="UTF-8">



    <title>

        ArchiTrack Architect Report

    </title>



    <style>



        @page {

            margin: 24px;

        }



        * {

            box-sizing: border-box;

        }



        body {

            margin: 0;

            color: #2f2a26;

            font-family: DejaVu Sans, sans-serif;

            font-size: 9px;

            line-height: 1.4;

        }



        .report-header {

            width: 100%;

            margin-bottom: 18px;

            border-bottom: 3px solid #f47a1f;

        }



        .report-header td {

            padding-bottom: 12px;

            vertical-align: bottom;

        }



        .brand-label {

            color: #f47a1f;

            font-size: 8px;

            font-weight: bold;

            letter-spacing: 1px;

        }



        h1 {

            margin: 4px 0 0;

            color: #25211e;

            font-size: 22px;

            line-height: 1.15;

        }



        .architect-name {

            margin-top: 5px;

            color: #6f675f;

            font-size: 10px;

        }



        .generated-info {

            text-align: right;

            color: #756d65;

        }



        .generated-info strong {

            display: block;

            margin-bottom: 3px;

            color: #332e2a;

            font-size: 10px;

        }



        .filter-box {

            margin-bottom: 14px;

            padding: 9px 11px;

            border: 1px solid #ddd5cc;

            background: #f8f4ee;

        }



        .filter-box strong {

            color: #403a35;

        }



        .summary-table {

            width: 100%;

            margin-bottom: 16px;

            border-collapse: collapse;

            table-layout: fixed;

        }



        .summary-table td {

            width: 25%;

            padding: 10px 11px;

            border: 1px solid #ded6cd;

            vertical-align: top;

        }



        .summary-label {

            display: block;

            color: #777067;

            font-size: 7px;

            font-weight: bold;

            text-transform: uppercase;

        }



        .summary-value {

            display: block;

            margin-top: 4px;

            color: #25211e;

            font-size: 18px;

            font-weight: bold;

        }



        .section-title {

            margin: 18px 0 7px;

            color: #2d2824;

            font-size: 12px;

            font-weight: bold;

        }



        .section-kicker {

            color: #f47a1f;

            font-size: 7px;

            font-weight: bold;

            text-transform: uppercase;

        }



        .project-table,

        .phase-table,

        .financial-table {

            width: 100%;

            border-collapse: collapse;

        }



        .project-table th,

        .project-table td,

        .phase-table th,

        .phase-table td,

        .financial-table th,

        .financial-table td {

            padding: 6px 7px;

            border: 1px solid #e0d9d1;

            vertical-align: top;

        }



        .project-table th,

        .phase-table th,

        .financial-table th {

            background: #f4efe8;

            color: #615951;

            font-size: 7px;

            text-align: left;

            text-transform: uppercase;

        }



        .project-name {

            color: #292521;

            font-weight: bold;

        }



        .muted {

            color: #817970;

            font-size: 8px;

        }



        .status {

            font-weight: bold;

        }



        .progress-bar {

            width: 75px;

            height: 4px;

            margin-top: 3px;

            background: #e3ddd5;

        }



        .progress-fill {

            height: 4px;

            background: #f47a1f;

        }



        .two-column {

            width: 100%;

            margin-top: 15px;

            border-collapse: collapse;

        }



        .two-column > tbody > tr > td {

            width: 50%;

            vertical-align: top;

        }



        .two-column > tbody > tr > td:first-child {

            padding-right: 6px;

        }



        .two-column > tbody > tr > td:last-child {

            padding-left: 6px;

        }



        .activity-grid {

            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;

        }



        .activity-grid td {

            width: 50%;

            padding: 11px;

            border: 1px solid #e0d9d1;

        }



        .activity-grid span {

            display: block;

            color: #777067;

            font-size: 7px;

            font-weight: bold;

        }



        .activity-grid strong {

            display: block;

            margin-top: 4px;

            font-size: 16px;

        }



        .financial-table td {

            width: 33.33%;

            padding: 12px;

        }



        .financial-table span {

            display: block;

            color: #777067;

            font-size: 7px;

            font-weight: bold;

        }



        .financial-table strong {

            display: block;

            margin-top: 4px;

            color: #292521;

            font-size: 14px;

        }



        .negative {

            color: #a84038 !important;

        }



        .footer {

            margin-top: 18px;

            padding-top: 8px;

            border-top: 1px solid #ddd6cd;

            color: #8a8179;

            font-size: 7px;

            text-align: center;

        }



    </style>




    <style>
        /* =========================================================
           ARCHITRACK PDF REPORT — REFINED PRINT DESIGN
        ========================================================= */

        @page {
            margin: 26px 28px 30px;
        }

        body {
            color: #303438;
            background: #ffffff;
            font-family: DejaVu Sans, sans-serif;
            font-size: 8.5px;
            line-height: 1.45;
        }

        .report-header {
            margin-bottom: 16px;
            border-bottom: 2px solid #f47a1f;
        }

        .report-header td {
            padding-bottom: 13px;
        }

        .brand-label {
            color: #c95d14;
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 1.1px;
        }

        h1 {
            margin: 4px 0 0;
            color: #252a2e;
            font-size: 21px;
            font-weight: bold;
            line-height: 1.1;
        }

        .architect-name {
            margin-top: 5px;
            color: #747a7e;
            font-size: 8.5px;
        }

        .generated-info {
            color: #787d81;
            font-size: 8px;
            text-align: right;
        }

        .generated-info strong {
            margin-bottom: 4px;
            color: #373d41;
            font-size: 9px;
        }

        .filter-box {
            margin-bottom: 13px;
            padding: 8px 10px;
            border: 1px solid #ded8d1;
            border-left: 3px solid #f47a1f;
            background: #faf7f3;
            color: #676d71;
            font-size: 8px;
        }

        .filter-box strong {
            color: #373d41;
        }

        .summary-table {
            margin-bottom: 15px;
        }

        .summary-table td {
            padding: 10px 11px;
            border: 1px solid #ded8d1;
            background: #fffdfa;
        }

        .summary-label {
            color: #777d80;
            font-size: 6.5px;
            letter-spacing: .35px;
        }

        .summary-value {
            margin-top: 5px;
            color: #282e32;
            font-size: 17px;
        }

        .section-kicker {
            margin-top: 3px;
            color: #c95d14;
            font-size: 6.5px;
            letter-spacing: .45px;
        }

        .section-title {
            margin: 3px 0 7px;
            color: #2c3236;
            font-size: 11px;
        }

        .project-table,
        .phase-table,
        .financial-table {
            border-collapse: collapse;
        }

        .project-table th,
        .phase-table th,
        .financial-table th {
            padding: 6px 6px;
            border: 1px solid #d8d2cb;
            background: #efeae4;
            color: #62686c;
            font-size: 6.5px;
            font-weight: bold;
            letter-spacing: .25px;
            text-transform: uppercase;
        }

        .project-table td,
        .phase-table td,
        .financial-table td {
            padding: 6px 6px;
            border: 1px solid #e3ddd6;
            color: #444b50;
            font-size: 7.5px;
        }

        .project-table tbody tr:nth-child(even) td,
        .phase-table tbody tr:nth-child(even) td {
            background: #fbf9f6;
        }

        .project-name {
            color: #2c3236;
            font-weight: bold;
        }

        .muted {
            color: #858b8e;
            font-size: 7px;
        }

        .status {
            color: #4d555a;
            font-weight: bold;
        }

        .progress-bar {
            width: 70px;
            height: 4px;
            margin-top: 4px;
            background: #e6e0da;
        }

        .progress-fill {
            height: 4px;
            background: #f47a1f;
        }

        .two-column {
            margin-top: 13px;
        }

        .two-column > tbody > tr > td:first-child {
            padding-right: 7px;
        }

        .two-column > tbody > tr > td:last-child {
            padding-left: 7px;
        }

        .activity-grid td {
            padding: 10px;
            border: 1px solid #e0dad3;
            background: #fffdfa;
        }

        .activity-grid span,
        .financial-table span {
            color: #7c8285;
            font-size: 6.5px;
            letter-spacing: .25px;
        }

        .activity-grid strong {
            margin-top: 4px;
            color: #2d3337;
            font-size: 15px;
        }

        .financial-table {
            margin-bottom: 4px;
        }

        .financial-table td {
            padding: 11px;
            background: #fffdfa;
        }

        .financial-table strong {
            margin-top: 5px;
            color: #2d3337;
            font-size: 13px;
        }

        .negative {
            color: #a44f45 !important;
        }

        .footer {
            margin-top: 17px;
            padding-top: 8px;
            border-top: 1px solid #ddd7d0;
            color: #8b9093;
            font-size: 6.5px;
            text-align: center;
        }
    </style>

</head>





<body>





<table class="report-header">



    <tr>



        <td>



            <div class="brand-label">

                ARCHITRACK

            </div>



            <h1>

                Architect Project Report

            </h1>



            <div class="architect-name">

                Prepared for {{ $user->name }}

            </div>



        </td>





        <td class="generated-info">



            <strong>

                Generated Report

            </strong>



            {{ $generatedAt->format('F j, Y') }}

            <br>



            {{ $generatedAt->format('h:i A') }} PH



        </td>



    </tr>



</table>





<div class="filter-box">



    <strong>

        Report filters:

    </strong>



    Status:

    {{ $selectedStatus

        ? ucwords(

            str_replace(

                '_',

                ' ',

                $selectedStatus

            )

        )

        : 'All Statuses'

    }}



    &nbsp;&nbsp; | &nbsp;&nbsp;



    Current Phase:

    {{ $selectedPhase ?: 'All Phases' }}



    &nbsp;&nbsp; | &nbsp;&nbsp;



    Showing:

    {{ $projects->count() }}

    {{ $projects->count() === 1

        ? 'project'

        : 'projects'

    }}



</div>





<table class="summary-table">



    <tr>



        <td>

            <span class="summary-label">

                Total Projects

            </span>



            <span class="summary-value">

                {{ $totalProjects }}

            </span>

        </td>





        <td>

            <span class="summary-label">

                Planning

            </span>



            <span class="summary-value">

                {{ $planningProjects }}

            </span>

        </td>





        <td>

            <span class="summary-label">

                Ongoing

            </span>



            <span class="summary-value">

                {{ $ongoingProjects }}

            </span>

        </td>





        <td>

            <span class="summary-label">

                Completed

            </span>



            <span class="summary-value">

                {{ $completedProjects }}

            </span>

        </td>



    </tr>



</table>





<div class="section-kicker">

    PROJECT REPORT

</div>



<div class="section-title">

    Project Progress

</div>





<table class="project-table">



    <thead>



        <tr>

            <th style="width: 20%;">Project</th>

            <th style="width: 9%;">Assignment</th>

            <th style="width: 9%;">Status</th>

            <th style="width: 12%;">Current Phase</th>

            <th style="width: 12%;">Progress</th>

            <th style="width: 8%;">Files</th>

            <th style="width: 10%;">Revisions</th>

            <th style="width: 10%;">Meetings</th>

            <th style="width: 10%;">Messages</th>

        </tr>



    </thead>





    <tbody>



        @forelse($projects as $project)



            @php



                $currentPhase =

                    $project

                        ->phases

                        ->sortBy('phase_order')

                        ->first(

                            function ($phase) {



                                return

                                    strtolower(

                                        (string) $phase->status

                                    )

                                    !==

                                    'completed';

                            }

                        );





                if (!$currentPhase) {



                    $currentPhase =

                        $project

                            ->phases

                            ->sortBy('phase_order')

                            ->last();

                }





                $isLead =

                    (int) $project->architect_id

                    ===

                    (int) $user->id;





                $progress =

                    min(

                        max(

                            (int) ($project->progress ?? 0),

                            0

                        ),

                        100

                    );



            @endphp





            <tr>



                <td>



                    <span class="project-name">

                        {{ $project->project_name }}

                    </span>



                    <br>



                    <span class="muted">

                        {{ $project->client_name }}

                    </span>



                </td>





                <td>

                    {{ $isLead

                        ? 'Lead'

                        : 'Collaborator'

                    }}

                </td>





                <td class="status">



                    {{ ucwords(

                        str_replace(

                            '_',

                            ' ',

                            $project->status

                        )

                    ) }}



                </td>





                <td>

                    {{ $currentPhase?->phase_name

                        ?? 'Not started'

                    }}

                </td>





                <td>



                    {{ $progress }}%



                    <div class="progress-bar">



                        <div

                            class="progress-fill"

                            style="width: {{ $progress }}%;"

                        ></div>



                    </div>



                </td>





                <td>

                    {{ $project->files_count }}

                </td>



                <td>

                    {{ $project->revisions_count }}

                </td>



                <td>

                    {{ $project->meetings_count }}

                </td>



                <td>

                    {{ $project->messages_count }}

                </td>



            </tr>





        @empty



            <tr>



                <td colspan="9">

                    No projects match the selected report filters.

                </td>



            </tr>



        @endforelse



    </tbody>



</table>





<table class="two-column">



    <tr>



        <td>



            <div class="section-kicker">

                PHASE DISTRIBUTION

            </div>



            <div class="section-title">

                Current Project Phases

            </div>





            <table class="phase-table">



                <thead>

                    <tr>

                        <th>Phase</th>

                        <th style="width: 25%;">Projects</th>

                    </tr>

                </thead>



                <tbody>



                    @foreach($phaseSummary as $phaseData)



                        <tr>



                            <td>

                                {{ $phaseData['phase'] }}

                            </td>



                            <td>

                                {{ $phaseData['count'] }}

                            </td>



                        </tr>



                    @endforeach



                </tbody>



            </table>



        </td>





        <td>



            <div class="section-kicker">

                ACTIVITY SUMMARY

            </div>



            <div class="section-title">

                Filtered Project Activity

            </div>





            <table class="activity-grid">



                <tr>



                    <td>

                        <span>FILES</span>

                        <strong>{{ $totalFiles }}</strong>

                    </td>



                    <td>

                        <span>REVISIONS</span>

                        <strong>{{ $totalRevisions }}</strong>

                    </td>



                </tr>





                <tr>



                    <td>

                        <span>MEETINGS</span>

                        <strong>{{ $totalMeetings }}</strong>

                    </td>



                    <td>

                        <span>MESSAGES</span>

                        <strong>{{ $totalMessages }}</strong>

                    </td>



                </tr>



            </table>



        </td>



    </tr>



</table>





<div class="section-kicker">

    PROJECT FINANCIALS

</div>



<div class="section-title">

    Financial Summary

</div>





<table class="financial-table">



    <tr>



        <td>



            <span>

                TOTAL BUDGET

            </span>



            <strong>

                PHP {{ number_format(

                    $totalBudget,

                    2

                ) }}

            </strong>



        </td>





        <td>



            <span>

                TOTAL EXPENSES

            </span>



            <strong>

                PHP {{ number_format(

                    $totalExpenses,

                    2

                ) }}

            </strong>



        </td>





        <td>



            <span>

                REMAINING

            </span>



            <strong

                class="{{ $totalRemaining < 0

                    ? 'negative'

                    : ''

                }}"

            >

                PHP {{ number_format(

                    $totalRemaining,

                    2

                ) }}

            </strong>



        </td>



    </tr>



</table>





<div class="footer">



    ArchiTrack Project Management System

    &nbsp; | &nbsp;

    {{ $leadProjects }} Lead Project(s)

    &nbsp; | &nbsp;

    {{ $collaboratorProjects }} Collaborator Project(s)



</div>





</body>

</html>
