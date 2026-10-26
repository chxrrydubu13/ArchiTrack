<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| ARCHITRACK - 30-DAY ARCHITECT DELETION
|--------------------------------------------------------------------------
|
| SAFETY MODE
|
| Checks archived architects daily at 2:00 AM.
| Permanent deletion remains disabled until final verification.
|
*/

Schedule::command('architects:check-deletion')
    ->dailyAt('02:00')
    ->withoutOverlapping();

/*
|--------------------------------------------------------------------------
| FUTURE AUTOMATIC PERMANENT DELETION
|--------------------------------------------------------------------------
|
| Enable only after all cleanup safeguards are verified.
|
| Schedule::command('architects:purge-expired --execute')
|     ->dailyAt('02:15')
|     ->withoutOverlapping();
|
*/