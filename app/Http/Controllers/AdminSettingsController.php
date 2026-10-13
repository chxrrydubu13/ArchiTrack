<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.settings.settings', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with(
            'success',
            'Your profile information has been updated successfully.'
        );
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);


        $user = auth()->user();


        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {

            return back()
                ->withErrors([
                    'current_password' =>
                        'The current password is incorrect.'
                ]);
        }


        $user->password = Hash::make(
            $request->new_password
        );

        $user->save();


        return back()->with(
            'success',
            'Your password has been changed successfully.'
        );
    }
}