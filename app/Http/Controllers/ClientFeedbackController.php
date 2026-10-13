<?php

namespace App\Http\Controllers;

use App\Models\ClientFeedback;
use Illuminate\Http\Request;

class ClientFeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                'in:issue,suggestion',
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);

        ClientFeedback::create([
            'client_id' => auth()->id(),
            'type' => $validated['type'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return back()->with(
            'feedback_success',
            'Your feedback has been submitted successfully.'
        );
    }
}