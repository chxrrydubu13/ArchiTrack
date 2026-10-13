<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BearoUsageStat extends Model
{
    protected $fillable = [
        'usage_date',
        'messages',
        'successful_replies',
        'failed_replies',
        'rate_limited',
    ];

    protected $casts = [
        'usage_date' => 'date',
    ];

    public static function addToToday(
        string $field,
        int $amount = 1
    ): void {
        if (!in_array($field, [
            'messages',
            'successful_replies',
            'failed_replies',
            'rate_limited',
        ], true)) {
            return;
        }

        $today = now('Asia/Manila')
            ->toDateString();

        $stat = self::firstOrCreate(
            [
                'usage_date' => $today,
            ],
            [
                'messages' => 0,
                'successful_replies' => 0,
                'failed_replies' => 0,
                'rate_limited' => 0,
            ]
        );

        $stat->increment(
            $field,
            $amount
        );
    }
}
