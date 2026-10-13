<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionKeepAliveController extends Controller
{
    public function keepAlive(Request $request)
    {
        $request->session()->put(
            'last_activity_time',
            time()
        );

        return response()->json([
            'success' => true,
            'message' => 'Session extended.',
        ]);
    }
}
