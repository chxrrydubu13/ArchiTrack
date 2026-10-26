<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Support\ArchitectSidebarCounts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ARCHITECT SIDEBAR NOTIFICATION COUNTS
        |--------------------------------------------------------------------------
        |
        | Share pending revision and meeting request counts
        | across all Architect Blade views.
        |
        | Revisions:
        | - Pending revision requests
        |
        | Meetings:
        | - Pending meeting requests proposed by clients
        | - Includes legacy pending requests with NULL proposed_by
        |
        | Counts are limited to projects accessible by the
        | currently authenticated architect.
        |
        */

        View::composer('architect.*', function ($view) {
            $view->with(
                ArchitectSidebarCounts::get()
            );
        });
    }
}
