<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRevision extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'client_id',
        'title',
        'description',

        // Client reference attachment
        'attachment_path',
        'attachment_name',
        'attachment_type',
        'attachment_size',

        // AI-assisted revision
        'revision_category',
        'ai_structured_feedback',
        'used_ai',

        // Revision status
        'status',
        'architect_response',
        'resolved_at',

        // Architect revised file
        'architect_file_path',
        'architect_file_name',
        'architect_file_type',
        'architect_file_size',
    ];

    protected $casts = [
        'used_ai' => 'boolean',
        'resolved_at' => 'datetime',
        'attachment_size' => 'integer',
        'architect_file_size' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | PROJECT
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CLIENT
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(
            User::class,
            'client_id'
        );
    }
}
