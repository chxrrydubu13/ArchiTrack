<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | PHILIPPINE TIME
        |--------------------------------------------------------------------------
        */

        $phTime = Carbon::now('Asia/Manila');

        if ($phTime->hour < 12) {

            $greeting = 'Good morning';

        } elseif ($phTime->hour < 18) {

            $greeting = 'Good afternoon';

        } else {

            $greeting = 'Good evening';

        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT PROJECTS
        |--------------------------------------------------------------------------
        */

        $projects = Project::where(
                'client_id',
                $user->id
            )
            ->with([
                'architect',

                'meetings' => function ($query) {

                    $query
                        ->orderBy('meeting_date')
                        ->orderBy('start_time');

                }
            ])
            ->orderByDesc('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CURRENT PROJECT
        |--------------------------------------------------------------------------
        */

        $currentProject = $projects
            ->whereNotIn(
                'status',
                [
                    'completed',
                    'cancelled'
                ]
            )
            ->first();


        if (!$currentProject) {

            $currentProject =
                $projects->first();

        }


        /*
        |--------------------------------------------------------------------------
        | CURRENT PROJECT IMAGE
        |--------------------------------------------------------------------------
        |
        | Priority:
        |
        | 1. Architect uploaded project image
        | 2. Existing public image path
        | 3. Existing storage image path
        | 4. Default architectural image
        |
        */

        $projectImageUrl =
            asset('images/lineart2.png');

        $hasCustomProjectImage =
            false;


        if (
            $currentProject &&
            !empty($currentProject->project_image)
        ) {

            $projectImage =
                trim(
                    $currentProject->project_image
                );


            /*
            |--------------------------------------------------------------------------
            | EXTERNAL URL
            |--------------------------------------------------------------------------
            */

            if (
                str_starts_with(
                    $projectImage,
                    'http://'
                )
                ||
                str_starts_with(
                    $projectImage,
                    'https://'
                )
            ) {

                $projectImageUrl =
                    $projectImage;

                $hasCustomProjectImage =
                    true;

            } else {

                /*
                |--------------------------------------------------------------------------
                | CLEAN SAVED PATH
                |--------------------------------------------------------------------------
                */

                $cleanPath =
                    ltrim(
                        $projectImage,
                        '/'
                    );


                /*
                |--------------------------------------------------------------------------
                | PATH ALREADY STARTS WITH storage/
                |--------------------------------------------------------------------------
                */

                if (
                    str_starts_with(
                        $cleanPath,
                        'storage/'
                    )
                ) {

                    $relativeStoragePath =
                        substr(
                            $cleanPath,
                            strlen('storage/')
                        );


                    if (
                        File::exists(
                            storage_path(
                                'app/public/' .
                                $relativeStoragePath
                            )
                        )
                    ) {

                        $projectImageUrl =
                            asset(
                                $cleanPath
                            );

                        $hasCustomProjectImage =
                            true;

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | NORMAL STORAGE PATH
                |--------------------------------------------------------------------------
                */

                elseif (
                    File::exists(
                        storage_path(
                            'app/public/' .
                            $cleanPath
                        )
                    )
                ) {

                    $projectImageUrl =
                        asset(
                            'storage/' .
                            $cleanPath
                        );

                    $hasCustomProjectImage =
                        true;

                }


                /*
                |--------------------------------------------------------------------------
                | PUBLIC DIRECTORY PATH
                |--------------------------------------------------------------------------
                */

                elseif (
                    File::exists(
                        public_path(
                            $cleanPath
                        )
                    )
                ) {

                    $projectImageUrl =
                        asset(
                            $cleanPath
                        );

                    $hasCustomProjectImage =
                        true;

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | NEXT MEETING
        |--------------------------------------------------------------------------
        */

        $nextMeeting = null;


        if ($currentProject) {

            $today =
                $phTime
                    ->copy()
                    ->startOfDay();


            $nextMeeting =
                $currentProject
                    ->meetings
                    ->filter(
                        function ($meeting) use ($today) {

                            if (
                                !$meeting->meeting_date
                            ) {

                                return false;

                            }


                            $meetingDate =
                                Carbon::parse(
                                    $meeting->meeting_date,
                                    'Asia/Manila'
                                )
                                ->startOfDay();


                            return $meetingDate
                                ->greaterThanOrEqualTo(
                                    $today
                                );

                        }
                    )
                    ->sortBy(
                        function ($meeting) {

                            return
                                $meeting->meeting_date
                                . ' '
                                . (
                                    $meeting->start_time
                                    ?? '00:00:00'
                                );

                        }
                    )
                    ->first();

        }


        /*
        |--------------------------------------------------------------------------
        | PROJECT DAYS LEFT
        |--------------------------------------------------------------------------
        */

        $daysLeft = null;


        if (
            $currentProject
            &&
            $currentProject->target_date
        ) {

            $targetDate =
                Carbon::parse(
                    $currentProject->target_date,
                    'Asia/Manila'
                )
                ->startOfDay();


            $today =
                $phTime
                    ->copy()
                    ->startOfDay();


            /*
            |--------------------------------------------------------------------------
            | FORCE WHOLE CALENDAR DAYS
            |--------------------------------------------------------------------------
            */

            $daysLeft =
                (int) round(
                    $today->diffInDays(
                        $targetDate,
                        false
                    )
                );

        }


        /*
        |--------------------------------------------------------------------------
        | MEETING DAYS LEFT
        |--------------------------------------------------------------------------
        */

        $meetingDaysLeft = null;


        if ($nextMeeting) {

            $meetingDate =
                Carbon::parse(
                    $nextMeeting->meeting_date,
                    'Asia/Manila'
                )
                ->startOfDay();


            $today =
                $phTime
                    ->copy()
                    ->startOfDay();


            /*
            |--------------------------------------------------------------------------
            | WHOLE CALENDAR DAYS ONLY
            |--------------------------------------------------------------------------
            |
            | Example:
            |
            | Aug 30 -> Aug 31 = 1
            | Aug 30 -> Sep 1  = 2
            |
            | Never 1.333333...
            |
            */

            $meetingDaysLeft =
                (int) round(
                    $today->diffInDays(
                        $meetingDate,
                        false
                    )
                );

        }


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'client.dashboard',
            compact(
                'user',
                'projects',
                'currentProject',
                'nextMeeting',
                'daysLeft',
                'meetingDaysLeft',
                'phTime',
                'greeting',
                'projectImageUrl',
                'hasCustomProjectImage'
            )
        );

    }
}