<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AuditLog;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATE USER
        |--------------------------------------------------------------------------
        */

        $request->authenticate();


        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | GET AUTHENTICATED USER
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG - LOGIN
        |--------------------------------------------------------------------------
        */

        if ($user) {

            AuditLog::create([
                'user_id' => $user->id,

                'user_name' => $user->name,

                'action' => 'User Login',

                'details' =>
                    ucfirst($user->role)
                    . ' logged in to ArchiTrack.',
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect()
                ->route('admin.dashboard');

        }


        /*
        |--------------------------------------------------------------------------
        | ARCHITECT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'architect') {

            if ($user->must_change_password) {

                return redirect()
                    ->route('password.change');

            }


            return redirect()
                ->route('architect.dashboard');

        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'client') {

            if ($user->must_change_password) {

                return redirect()
                    ->route('password.change');

            }


            return redirect()
                ->route('client.dashboard');

        }


        /*
        |--------------------------------------------------------------------------
        | UNKNOWN ROLE
        |--------------------------------------------------------------------------
        */

        AuditLog::create([
            'user_id' => $user->id,

            'user_name' => $user->name,

            'action' => 'Invalid Role Logout',

            'details' =>
                'User was logged out because the account has an invalid system role.',
        ]);


        Auth::guard('web')->logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect()
            ->route('home')
            ->withErrors([
                'email' => 'Your account does not have a valid system role.'
            ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | GET USER BEFORE LOGOUT
        |--------------------------------------------------------------------------
        */

        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG - LOGOUT
        |--------------------------------------------------------------------------
        */

        if ($user) {

            AuditLog::create([
                'user_id' => $user->id,

                'user_name' => $user->name,

                'action' => 'User Logout',

                'details' =>
                    ucfirst($user->role)
                    . ' logged out of ArchiTrack.',
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->logout();


        /*
        |--------------------------------------------------------------------------
        | INVALIDATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();


        /*
        |--------------------------------------------------------------------------
        | REGENERATE CSRF TOKEN
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();


        return redirect('/');
    }
}