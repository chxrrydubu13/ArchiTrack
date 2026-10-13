<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | NOT LOGGED IN
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | CURRENT USER
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | FORCE PASSWORD CHANGE
        |--------------------------------------------------------------------------
        */

        if (
            $user->must_change_password
            &&
            !$request->routeIs('password.change')
            &&
            !$request->routeIs('password.change.update')
            &&
            !$request->routeIs('logout')
        ) {
            return redirect()
                ->route('password.change');
        }


        /*
        |--------------------------------------------------------------------------
        | CONTINUE REQUEST
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}