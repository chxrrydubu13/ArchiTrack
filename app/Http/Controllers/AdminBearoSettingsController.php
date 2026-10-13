<?php

namespace App\Http\Controllers;

use App\Models\BearoSetting;
use Illuminate\Http\Request;

class AdminBearoSettingsController extends Controller
{
    public function edit()
    {
        $setting = BearoSetting::current();

        return view(
            'admin.bearo-settings',
            compact('setting')
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'enabled' => [
                'nullable',
                'boolean',
            ],

            'model' => [
                'required',
                'string',
                'max:100',
            ],

            'max_output_tokens' => [
                'required',
                'integer',
                'min:80',
                'max:1000',
            ],

            'greeting_title' => [
                'required',
                'string',
                'max:120',
            ],

            'greeting_text' => [
                'required',
                'string',
                'max:220',
            ],

            'tone_instructions' => [
                'nullable',
                'string',
                'max:3000',
            ],

            'fallback_message' => [
                'required',
                'string',
                'max:500',
            ],

            'idle_reset_minutes' => [
                'required',
                'integer',
                'min:5',
                'max:120',
            ],

            'save_usage_logs' => [
                'nullable',
                'boolean',
            ],
        ]);

        $setting = BearoSetting::current();

        $setting->update([
            'enabled' =>
                $request->boolean('enabled'),

            'model' =>
                $validated['model'],

            'max_output_tokens' =>
                $validated['max_output_tokens'],

            'greeting_title' =>
                $validated['greeting_title'],

            'greeting_text' =>
                $validated['greeting_text'],

            'tone_instructions' =>
                $validated['tone_instructions'] ?? null,

            'fallback_message' =>
                $validated['fallback_message'],

            'idle_reset_minutes' =>
                $validated['idle_reset_minutes'],

            'save_usage_logs' =>
                $request->boolean('save_usage_logs'),
        ]);

        return back()->with(
            'success',
            'Bearo settings updated successfully.'
        );
    }
}
