<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BearoSetting extends Model
{
    protected $fillable = [
        'enabled',
        'model',
        'max_output_tokens',
        'greeting_title',
        'greeting_text',
        'tone_instructions',
        'fallback_message',
        'idle_reset_minutes',
        'save_usage_logs',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'save_usage_logs' => 'boolean',
    ];

    public static function current(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'enabled' => true,
                'model' => 'gpt-5.6-luna',
                'max_output_tokens' => 260,
                'greeting_title' => "Hi! I'm Bearo.",
                'greeting_text' => 'Ask me anything about ArchiTrack.',
                'tone_instructions' =>
                    'Warm, cheerful, helpful, natural, concise, and conversational. Follow the visitor language and use English or Taglish when appropriate.',
                'fallback_message' =>
                    "Sorry, I'm having trouble connecting right now. Please try again in a moment.",
                'idle_reset_minutes' => 20,
                'save_usage_logs' => true,
            ]
        );
    }
}
