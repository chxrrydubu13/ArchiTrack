<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    use HasFactory;


    protected $fillable = [
        'project_phase_id',

        'milestone_name',
        'description',

        'status',
        'milestone_order',

        'target_date',
        'completed_date',

        'completion_report',

        'proof_file',
        'proof_file_name',

        'completed_by',
        'completed_at',
    ];


    protected $casts = [
        'target_date' =>
            'date',

        'completed_date' =>
            'date',

        'completed_at' =>
            'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | PROJECT PHASE
    |--------------------------------------------------------------------------
    */

    public function phase()
    {
        return $this->belongsTo(
            ProjectPhase::class,
            'project_phase_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | COMPLETED BY
    |--------------------------------------------------------------------------
    */

    public function completedBy()
    {
        return $this->belongsTo(
            User::class,
            'completed_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK IF MILESTONE HAS PROOF
    |--------------------------------------------------------------------------
    */

    public function hasProof()
    {
        return
            !empty(
                $this->proof_file
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK IF MILESTONE HAS COMPLETION REPORT
    |--------------------------------------------------------------------------
    */

    public function hasCompletionReport()
    {
        return
            !empty(
                trim(
                    (string) $this->completion_report
                )
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK IF MILESTONE IS FULLY COMPLETED
    |--------------------------------------------------------------------------
    |
    | A milestone is considered properly completed only if:
    |
    | 1. status = completed
    | 2. completion report exists
    | 3. proof file exists
    |
    */

    public function isFullyCompleted()
    {
        return
            $this->status === 'completed'
            &&
            $this->hasCompletionReport()
            &&
            $this->hasProof();
    }
}