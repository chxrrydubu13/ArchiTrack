
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /*
        |--------------------------------------------------------------------------
        | REGISTER CUSTOM MIDDLEWARE
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'force.password' => \App\Http\Middleware\ForcePasswordChange::class,
            'architect' => \App\Http\Middleware\ArchitectMiddleware::class,
            'client' => \App\Http\Middleware\ClientMiddleware::class,
            'auto.logout' => \App\Http\Middleware\AutoLogout::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCOUNT STATUS ON AUTHENTICATED WEB REQUESTS
        |--------------------------------------------------------------------------
        */

        $middleware->web(append: [
            \App\Http\Middleware\AutoLogout::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
