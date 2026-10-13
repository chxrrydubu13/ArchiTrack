<?php

namespace App\Http\Controllers;

use App\Models\BearoSetting;
use App\Models\BearoUsageStat;
use Carbon\Carbon;

class AdminBearoAnalyticsController extends Controller
{
    public function index()
    {
        $setting = BearoSetting::current();

        $totalMessages = BearoUsageStat::sum('messages');

        $successfulReplies = BearoUsageStat::sum(
            'successful_replies'
        );

        $failedReplies = BearoUsageStat::sum(
            'failed_replies'
        );

        $rateLimited = BearoUsageStat::sum(
            'rate_limited'
        );

        $successRate = $totalMessages > 0
            ? round(
                ($successfulReplies / $totalMessages)
                * 100,
                1
            )
            : 0;

        $today = now('Asia/Manila')
            ->toDateString();

        $todayStat = BearoUsageStat::where(
            'usage_date',
            $today
        )->first();

        $todayMessages = $todayStat?->messages ?? 0;

        $startDate = now('Asia/Manila')
            ->subDays(6)
            ->startOfDay();

        $weeklyRows = BearoUsageStat::whereDate(
                'usage_date',
                '>=',
                $startDate->toDateString()
            )
            ->orderBy('usage_date')
            ->get()
            ->keyBy(
                fn ($row) =>
                    $row->usage_date->format('Y-m-d')
            );

        $weeklyUsage = [];

        for ($i = 0; $i < 7; $i++) {
            $day = $startDate
                ->copy()
                ->addDays($i);

            $key = $day->format('Y-m-d');

            $row = $weeklyRows->get($key);

            $weeklyUsage[] = [
                'date' => $key,
                'label' => $day->format('D'),
                'messages' => $row?->messages ?? 0,
                'successful_replies' =>
                    $row?->successful_replies ?? 0,
                'failed_replies' =>
                    $row?->failed_replies ?? 0,
            ];
        }

        $weeklyMax = max(
            1,
            collect($weeklyUsage)
                ->max('messages')
        );

        return view(
            'admin.bearo-analytics',
            compact(
                'setting',
                'totalMessages',
                'successfulReplies',
                'failedReplies',
                'rateLimited',
                'successRate',
                'todayMessages',
                'weeklyUsage',
                'weeklyMax'
            )
        );
    }
}
