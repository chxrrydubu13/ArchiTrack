<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchitectSetting extends Model
{
    protected $fillable = [
        'user_id',

        'message_notifications',
        'message_sound',
        'message_preview',

        'meeting_reminder_minutes',
        'meeting_notifications',

        'email_notifications',
        'revision_notifications',
        'file_notifications',
    ];


    protected $casts = [
        'message_notifications' => 'boolean',
        'message_sound' => 'boolean',
        'message_preview' => 'boolean',

        'meeting_notifications' => 'boolean',

        'email_notifications' => 'boolean',
        'revision_notifications' => 'boolean',
        'file_notifications' => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}