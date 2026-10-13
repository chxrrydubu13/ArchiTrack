<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class ClientAccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW CLIENT ACCOUNT
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        return view('client.account', compact('user'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE CLIENT PROFILE
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'regex:/^[\pL\s\.\'-]+$/u',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email,' . $user->id,
        ],

        'profile_image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'name.regex' =>
            'Name must not contain numbers or invalid characters.',

        'email.unique' =>
            'This email address is already being used.',

        'profile_image.image' =>
            'The selected profile picture must be an image.',

        'profile_image.mimes' =>
            'Profile picture must be JPG, JPEG, PNG, or WEBP.',

        'profile_image.max' =>
            'Profile picture must not exceed 2MB.',
    ]);

    $profileImage = $user->profile_image;

    if ($request->hasFile('profile_image')) {

        if (
            $user->profile_image &&
            Storage::disk('public')->exists($user->profile_image)
        ) {
            Storage::disk('public')->delete(
                $user->profile_image
            );
        }

        $profileImage = $request
            ->file('profile_image')
            ->store(
                'profile-images',
                'public'
            );
    }

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'profile_image' => $profileImage,
    ]);

    return back()->with(
        'profile_success',
        'Account information updated successfully.'
    );
}


    /*
    |--------------------------------------------------------------------------
    | UPDATE CLIENT PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ], [
            'current_password.current_password' =>
                'Your current password is incorrect.',

            'password.confirmed' =>
                'The new password confirmation does not match.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with(
            'password_success',
            'Password changed successfully.'
        );
    }

    /*
|--------------------------------------------------------------------------
| DOWNLOAD CLIENT USER MANUAL
|--------------------------------------------------------------------------
*/

public function downloadManual()
{
    $filePath = storage_path(
        'app/manuals/ArchiTrack_Client_User_Manual.pdf'
    );

    if (!file_exists($filePath)) {
        abort(404, 'Client User Manual not found.');
    }

    return response()->download(
        $filePath,
        'ArchiTrack_Client_User_Manual.pdf',
        [
            'Content-Type' => 'application/pdf',
        ]
    );
}
}