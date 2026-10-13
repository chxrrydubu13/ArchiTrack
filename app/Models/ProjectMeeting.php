<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMeeting extends Model
{
    use HasFactory;


    protected $fillable = [
        'project_id',
        'architect_id',
        'client_id',

        'proposed_by',
        'proposed_by_user_id',

        'title',
        'agenda',
        'meeting_type',
        'meeting_date',
        'start_time',
        'end_time',
        'meeting_link',
        'location',
        'status',
        'notes',
    ];


    protected $casts = [
        'meeting_date' => 'date',
    ];


    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id'
        );
    }


    public function architect()
    {
        return $this->belongsTo(
            User::class,
            'architect_id'
        );
    }


    public function client()
    {
        return $this->belongsTo(
            User::class,
            'client_id'
        );
    }


    public function proposedByUser()
    {
        return $this->belongsTo(
            User::class,
            'proposed_by_user_id'
        );
    }


    public function actions()
    {
        return $this->hasMany(
            ProjectMeetingAction::class,
            'meeting_id'
        );
    }
}