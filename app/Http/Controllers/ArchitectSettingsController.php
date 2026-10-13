<?php

namespace App\Http\Controllers;

use App\Models\ArchitectSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArchitectSettingsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SETTINGS PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        $settings = ArchitectSetting::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'message_notifications' => true,
                'message_sound' => true,
                'message_preview' => true,

                'meeting_reminder_minutes' => 30,
                'meeting_notifications' => true,

                'email_notifications' => true,
                'revision_notifications' => true,
                'file_notifications' => true,
            ]
        );

        return view(
            'architect.settings',
            compact(
                'user',
                'settings'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\.\-]+$/'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],
        ]);


        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);


        return redirect()
            ->route('architect.settings.index')
            ->with(
                'profile_success',
                'Profile information updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => [
                'required'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);


        if (
            !Hash::check(
                $validated['current_password'],
                $user->password
            )
        ) {

            return back()
                ->withErrors([
                    'current_password' =>
                        'Your current password is incorrect.'
                ])
                ->withInput();
        }


        $user->update([
            'password' => Hash::make(
                $validated['password']
            )
        ]);


        return redirect()
            ->route('architect.settings.index')
            ->with(
                'password_success',
                'Password changed successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PREFERENCES
    |--------------------------------------------------------------------------
    */

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        $settings = ArchitectSetting::firstOrCreate([
            'user_id' => $user->id
        ]);


        $validated = $request->validate([
            'meeting_reminder_minutes' => [
                'required',
                'integer',
                'in:10,15,30,60,120'
            ],
        ]);


        $settings->update([
            /*
            |--------------------------------------------------------------------------
            | MESSAGES
            |--------------------------------------------------------------------------
            */

            'message_notifications' =>
                $request->boolean(
                    'message_notifications'
                ),

            'message_sound' =>
                $request->boolean(
                    'message_sound'
                ),

            'message_preview' =>
                $request->boolean(
                    'message_preview'
                ),


            /*
            |--------------------------------------------------------------------------
            | MEETINGS
            |--------------------------------------------------------------------------
            */

            'meeting_reminder_minutes' =>
                $validated[
                    'meeting_reminder_minutes'
                ],

            'meeting_notifications' =>
                $request->boolean(
                    'meeting_notifications'
                ),


            /*
            |--------------------------------------------------------------------------
            | GENERAL NOTIFICATIONS
            |--------------------------------------------------------------------------
            */

            'email_notifications' =>
                $request->boolean(
                    'email_notifications'
                ),

            'revision_notifications' =>
                $request->boolean(
                    'revision_notifications'
                ),

            'file_notifications' =>
                $request->boolean(
                    'file_notifications'
                ),
        ]);


        return redirect()
            ->route('architect.settings.index')
            ->with(
                'settings_success',
                'Preferences updated successfully.'
            );
    }
}