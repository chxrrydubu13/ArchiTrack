<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAIHistory extends Model
{
    use HasFactory;


    protected $table = 'project_ai_histories';


    protected $fillable = [
        'project_id',
        'client_id',
        'type',
        'prompt',
        'result_text',
        'image_path',

        // AI image generation
        'generated_image_path',
        'version_number',
        'parent_history_id',
        'sent_to_architect',
    ];


    protected $casts = [
        'version_number' => 'integer',
        'sent_to_architect' => 'boolean',
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


    /*
    |--------------------------------------------------------------------------
    | PREVIOUS AI VERSION
    |--------------------------------------------------------------------------
    */

    public function parentHistory()
    {
        return $this->belongsTo(
            ProjectAIHistory::class,
            'parent_history_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | NEXT AI VERSIONS
    |--------------------------------------------------------------------------
    */

    public function childHistories()
    {
        return $this->hasMany(
            ProjectAIHistory::class,
            'parent_history_id'
        );
    }
}