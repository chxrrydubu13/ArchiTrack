<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMeetingAction extends Model
{
    protected $fillable = [
        'project_id',
        'meeting_id',
        'title',
        'type',
        'due_date',
        'priority',
        'status',
        'notes',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function meeting()
    {
        return $this->belongsTo(
            ProjectMeeting::class,
            'meeting_id'
        );
    }
}