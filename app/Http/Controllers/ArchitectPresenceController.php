<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchitectPresenceController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'presence_status' => [
                'required',
                'in:online,idle,away',
            ],
        ]);

        $user = auth()->user();

        $user->presence_status =
            $request->presence_status;

        $user->last_seen_at =
            now();

        $user->save();

        return back();
    }


    public function heartbeat(Request $request)
    {
        $request->validate([
            'presence_status' => [
                'nullable',
                'in:online,idle,away',
            ],
        ]);

        $user = auth()->user();

        $user->last_seen_at =
            now();


        if (
            $request->filled(
                'presence_status'
            )
        ) {

            $user->presence_status =
                $request->presence_status;

        } else {

            $user->presence_status =
                'online';

        }


        $user->save();


        return response()->json([
            'success' => true,

            'presence_status' =>
                $user->presence_status,

            'last_seen_at' =>
                $user->last_seen_at,
        ]);
    }
}