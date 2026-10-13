<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\Request;

class ArchitectReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REPORTS PAGE
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );

        return view(
            'architect.reports.index',
            $data
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD PDF
    |--------------------------------------------------------------------------
    */

    public function pdf(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );

        $data['generatedAt'] =
            now('Asia/Manila');

        $data['selectedStatus'] =
            $request->get('status');

        $data['selectedPhase'] =
            $request->get('phase');


        $fileName =
            'ArchiTrack_Report_'
            . now('Asia/Manila')
                ->format('Y-m-d_H-i-s')
            . '.pdf';


        return Pdf::loadView(
            'architect.reports.pdf',
            $data
        )
            ->setPaper(
                'a4',
                'landscape'
            )
            ->download(
                $fileName
            );
    }



    /*
    |--------------------------------------------------------------------------
    | SAVE REPORT TO GOOGLE DRIVE
    |--------------------------------------------------------------------------
    */

    public function saveToGoogleDrive(Request $request)
    {
        $user =
            auth()
                ->user()
                ->load(
                    'googleDriveConnection'
                );

        $connection =
            $user->googleDriveConnection;

        if (!$connection) {
            return redirect()
                ->route('architect.reports.index')
                ->with(
                    'error',
                    'Connect your Google Drive account first.'
                );
        }

        try {
            $client =
                new GoogleClient();

            $client->setClientId(
                config(
                    'services.google_drive.client_id'
                )
            );

            $client->setClientSecret(
                config(
                    'services.google_drive.client_secret'
                )
            );

            $client->setRedirectUri(
                config(
                    'services.google_drive.redirect_uri'
                )
            );

            $client->setScopes([
                'https://www.googleapis.com/auth/drive.file',
                'https://www.googleapis.com/auth/userinfo.email',
            ]);

            $client->setAccessType(
                'offline'
            );

            /*
            |--------------------------------------------------------------------------
            | ACCESS TOKEN
            |--------------------------------------------------------------------------
            */

            $client->setAccessToken([
                'access_token' =>
                    $connection->access_token,

                'refresh_token' =>
                    $connection->refresh_token,

                'expires_in' =>
                    3600,

                'created' =>
                    $connection->token_expires_at
                        ? $connection
                            ->token_expires_at
                            ->copy()
                            ->subHour()
                            ->timestamp
                        : now()
                            ->subHours(2)
                            ->timestamp,
            ]);


            if (
                $connection->token_expires_at
                &&
                now()->greaterThanOrEqualTo(
                    $connection->token_expires_at
                )
            ) {
                if (!$connection->refresh_token) {
                    return redirect()
                        ->route('architect.reports.index')
                        ->with(
                            'error',
                            'Your Google Drive connection expired. Please disconnect and connect Google Drive again.'
                        );
                }

                $newToken =
                    $client
                        ->fetchAccessTokenWithRefreshToken(
                            $connection->refresh_token
                        );

                if (
                    isset($newToken['error'])
                    ||
                    empty($newToken['access_token'])
                ) {
                    return redirect()
                        ->route('architect.reports.index')
                        ->with(
                            'error',
                            'Google Drive access expired. Please reconnect your Google Drive account.'
                        );
                }

                $connection->access_token =
                    $newToken['access_token'];

                if (!empty($newToken['refresh_token'])) {
                    $connection->refresh_token =
                        $newToken['refresh_token'];
                }

                $connection->token_expires_at =
                    now()->addSeconds(
                        max(
                            0,
                            (int) (
                                $newToken['expires_in']
                                ?? 3600
                            ) - 60
                        )
                    );

                $connection->save();

                $client->setAccessToken(
                    $newToken
                );
            }


            $drive =
                new GoogleDrive(
                    $client
                );


            /*
            |--------------------------------------------------------------------------
            | FIND OR CREATE ARCHITRACK REPORTS FOLDER
            |--------------------------------------------------------------------------
            */

            $folderName =
                'ArchiTrack Reports';

            $folderList =
                $drive
                    ->files
                    ->listFiles([
                        'q' =>
                            "name = '"
                            . addslashes($folderName)
                            . "' and mimeType = 'application/vnd.google-apps.folder' and trashed = false",

                        'spaces' =>
                            'drive',

                        'fields' =>
                            'files(id,name)',

                        'pageSize' =>
                            10,
                    ]);


            $folderId =
                null;


            foreach (
                $folderList->getFiles()
                as $folder
            ) {
                if (
                    $folder->getName()
                    ===
                    $folderName
                ) {
                    $folderId =
                        $folder->getId();

                    break;
                }
            }


            if (!$folderId) {
                $folderMetadata =
                    new DriveFile([
                        'name' =>
                            $folderName,

                        'mimeType' =>
                            'application/vnd.google-apps.folder',
                    ]);

                $folder =
                    $drive
                        ->files
                        ->create(
                            $folderMetadata,
                            [
                                'fields' =>
                                    'id',
                            ]
                        );

                $folderId =
                    $folder->getId();
            }


            /*
            |--------------------------------------------------------------------------
            | GENERATE PDF
            |--------------------------------------------------------------------------
            */

            $data =
                $this->buildReportData(
                    $request
                );

            $data['generatedAt'] =
                now('Asia/Manila');

            $data['selectedStatus'] =
                $request->get('status');

            $data['selectedPhase'] =
                $request->get('phase');


            $pdfOutput =
                Pdf::loadView(
                    'architect.reports.pdf',
                    $data
                )
                    ->setPaper(
                        'a4',
                        'landscape'
                    )
                    ->output();


            $fileName =
                'ArchiTrack Report - '
                . now('Asia/Manila')
                    ->format('Y-m-d h-i A')
                . '.pdf';


            /*
            |--------------------------------------------------------------------------
            | UPLOAD PDF
            |--------------------------------------------------------------------------
            */

            $fileMetadata =
                new DriveFile([
                    'name' =>
                        $fileName,

                    'parents' =>
                        [
                            $folderId,
                        ],
                ]);


            $uploadedFile =
                $drive
                    ->files
                    ->create(
                        $fileMetadata,
                        [
                            'data' =>
                                $pdfOutput,

                            'mimeType' =>
                                'application/pdf',

                            'uploadType' =>
                                'multipart',

                            'fields' =>
                                'id,name,webViewLink',
                        ]
                    );


            return redirect()
                ->route(
                    'architect.reports.index',
                    array_filter([
                        'status' =>
                            $request->get('status'),

                        'phase' =>
                            $request->get('phase'),
                    ])
                )
                ->with(
                    'success',
                    'Report saved to Google Drive successfully as "'
                    . $uploadedFile->getName()
                    . '".'
                );

        } catch (\Throwable $exception) {
            report(
                $exception
            );

            return redirect()
                ->route(
                    'architect.reports.index',
                    array_filter([
                        'status' =>
                            $request->get('status'),

                        'phase' =>
                            $request->get('phase'),
                    ])
                )
                ->with(
                    'error',
                    'The report could not be saved to Google Drive. Please check the Google Drive API connection and try again.'
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | BUILD REPORT DATA
    |--------------------------------------------------------------------------
    |
    | Used by both the browser Reports page and the downloadable PDF.
    |
    */

    private function buildReportData(
        Request $request
    ): array {
        $user =
            auth()
                ->user()
                ->load(
                    'googleDriveConnection'
                );

        $status =
            $request->get('status');

        $phase =
            $request->get('phase');


        /*
        |--------------------------------------------------------------------------
        | PROJECTS ACCESSIBLE TO LOGGED IN ARCHITECT
        |--------------------------------------------------------------------------
        */

        $accessibleProjectsQuery =
            Project::where(
                function ($query) use ($user) {

                    $query
                        ->where(
                            'architect_id',
                            $user->id
                        )
                        ->orWhereHas(
                            'projectArchitects',
                            function ($teamQuery) use ($user) {

                                $teamQuery->where(
                                    'architect_id',
                                    $user->id
                                );
                            }
                        );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | FILTERED PROJECT LIST
        |--------------------------------------------------------------------------
        */

        $projectsQuery =
            clone $accessibleProjectsQuery;


        $projectsQuery
            ->with([
                'architect',
                'client',
                'projectArchitects.architect',
                'phases.milestones',
                'expenses.recordedBy',
            ])
            ->withCount([
                'files',
                'revisions',
                'meetings',
                'messages',
            ]);


        if ($status) {

            $projectsQuery->where(
                'status',
                $status
            );
        }


        if ($phase) {

            $projectsQuery->whereHas(
                'phases',
                function ($query) use ($phase) {

                    $query
                        ->where(
                            'phase_name',
                            $phase
                        )
                        ->where(
                            'status',
                            '!=',
                            'completed'
                        );
                }
            );
        }


        $projects =
            $projectsQuery
                ->latest('updated_at')
                ->get();


        /*
        |--------------------------------------------------------------------------
        | ALL ACCESSIBLE PROJECTS
        |--------------------------------------------------------------------------
        |
        | Overall summary remains based on all accessible projects.
        |
        */

        $allProjects =
            (clone $accessibleProjectsQuery)
                ->with([
                    'phases',
                    'expenses',
                ])
                ->get();


        /*
        |--------------------------------------------------------------------------
        | STATUS SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalProjects =
            $allProjects->count();


        $planningProjects =
            $allProjects
                ->where(
                    'status',
                    'planning'
                )
                ->count();


        $ongoingProjects =
            $allProjects
                ->where(
                    'status',
                    'ongoing'
                )
                ->count();


        $onHoldProjects =
            $allProjects
                ->where(
                    'status',
                    'on_hold'
                )
                ->count();


        $completedProjects =
            $allProjects
                ->where(
                    'status',
                    'completed'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENT SUMMARY
        |--------------------------------------------------------------------------
        */

        $leadProjects =
            $allProjects
                ->where(
                    'architect_id',
                    $user->id
                )
                ->count();


        $collaboratorProjects =
            $allProjects
                ->filter(
                    function ($project) use ($user) {

                        return
                            (int) $project->architect_id
                            !==
                            (int) $user->id;
                    }
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | STANDARD PHASES
        |--------------------------------------------------------------------------
        */

        $phaseNames = [
            'Consultation',
            'Agreement',
            'Planning',
            'Design',
            'Approval',
            'Development',
            'Permits',
            'Construction',
            'Inspection',
            'Turnover',
        ];


        /*
        |--------------------------------------------------------------------------
        | CURRENT PHASE SUMMARY
        |--------------------------------------------------------------------------
        */

        $phaseSummary =
            collect($phaseNames)
                ->map(
                    function ($phaseName) use ($allProjects) {

                        $count =
                            $allProjects
                                ->filter(
                                    function ($project) use ($phaseName) {

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


                                        return
                                            $currentPhase
                                            &&
                                            $currentPhase->phase_name
                                            ===
                                            $phaseName;
                                    }
                                )
                                ->count();


                        return [
                            'phase' =>
                                $phaseName,

                            'count' =>
                                $count,
                        ];
                    }
                );


        /*
        |--------------------------------------------------------------------------
        | FINANCIAL SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalBudget =
            $allProjects
                ->sum(
                    function ($project) {

                        return
                            (float) (
                                $project->budget
                                ?? 0
                            );
                    }
                );


        $totalExpenses =
            $allProjects
                ->sum(
                    function ($project) {

                        return
                            (float) $project
                                ->expenses
                                ->sum('amount');
                    }
                );


        $totalRemaining =
            $totalBudget
            -
            $totalExpenses;


        $projectsWithBudget =
            $allProjects
                ->filter(
                    function ($project) {

                        return
                            $project->budget
                            !==
                            null;
                    }
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | FILTERED ACTIVITY SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalFiles =
            $projects
                ->sum(
                    'files_count'
                );


        $totalRevisions =
            $projects
                ->sum(
                    'revisions_count'
                );


        $totalMeetings =
            $projects
                ->sum(
                    'meetings_count'
                );


        $totalMessages =
            $projects
                ->sum(
                    'messages_count'
                );


        return [
            'user' =>
                $user,

            'googleDriveConnection' =>
                $user->googleDriveConnection,

            'projects' =>
                $projects,

            'phaseNames' =>
                $phaseNames,

            'phaseSummary' =>
                $phaseSummary,

            'totalProjects' =>
                $totalProjects,

            'planningProjects' =>
                $planningProjects,

            'ongoingProjects' =>
                $ongoingProjects,

            'onHoldProjects' =>
                $onHoldProjects,

            'completedProjects' =>
                $completedProjects,

            'leadProjects' =>
                $leadProjects,

            'collaboratorProjects' =>
                $collaboratorProjects,

            'totalBudget' =>
                $totalBudget,

            'totalExpenses' =>
                $totalExpenses,

            'totalRemaining' =>
                $totalRemaining,

            'projectsWithBudget' =>
                $projectsWithBudget,

            'totalFiles' =>
                $totalFiles,

            'totalRevisions' =>
                $totalRevisions,

            'totalMeetings' =>
                $totalMeetings,

            'totalMessages' =>
                $totalMessages,
        ];
    }
}
