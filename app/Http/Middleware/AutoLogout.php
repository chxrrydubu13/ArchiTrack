<?php
namespace App\Http\Middleware;

use Closure;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AutoLogout
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | CHECK AUTHENTICATION
        |--------------------------------------------------------------------------
        */

        if (! Auth::check()) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | BLOCK NON-ACTIVE ACCOUNTS
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        if ($user->status !== 'active') {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Your account is no longer active. Please contact the administrator.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SESSION INACTIVITY TIMEOUT
        |--------------------------------------------------------------------------
        */

        $timeoutMinutes = (int) config(
            'session.lifetime',
            20
        );

        $timeoutSeconds = $timeoutMinutes * 60;

        $lastActivity = $request->session()->get(
            'last_activity_time'
        );

        if (
            $lastActivity &&
            (time() - $lastActivity) > $timeoutSeconds
        ) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'You were logged out because your session was inactive for '
                    . $timeoutMinutes
                    . ' minutes.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE LAST ACTIVITY
        |--------------------------------------------------------------------------
        */

        $request->session()->put(
            'last_activity_time',
            time()
        );

        return $next($request);
    }
}
