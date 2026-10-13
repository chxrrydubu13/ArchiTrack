<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPhase extends Model
{
    use HasFactory;


    protected $fillable = [
        'project_id',

        'phase_name',
        'description',

        'status',
        'phase_order',

        'start_date',
        'target_date',
        'completed_date',

        'completion_checklist',
        'completion_note',
        'completed_by',
    ];


    protected $casts = [
        'start_date' =>
            'date',

        'target_date' =>
            'date',

        'completed_date' =>
            'date',

        'completion_checklist' =>
            'array',
    ];


    /*
    |--------------------------------------------------------------------------
    | PROJECT
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(
            Project::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MILESTONES
    |--------------------------------------------------------------------------
    */

    public function milestones()
    {
        return $this->hasMany(
            ProjectMilestone::class
        )
            ->orderBy(
                'milestone_order'
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
    | FIXED WEIGHT
    |--------------------------------------------------------------------------
    |
    | 1. Consultation  - 5%
    | 2. Agreement     - 5%
    | 3. Planning      - 10%
    | 4. Design        - 15%
    | 5. Approval      - 10%
    | 6. Development   - 10%
    | 7. Permits       - 10%
    | 8. Construction  - 20%
    | 9. Inspection    - 10%
    | 10. Turnover     - 5%
    |
    | TOTAL = 100%
    |
    */

    public function getWeightAttribute()
    {
        $weights = [
            1 => 5,
            2 => 5,
            3 => 10,
            4 => 15,
            5 => 10,
            6 => 10,
            7 => 10,
            8 => 20,
            9 => 10,
            10 => 5,
        ];


        return
            $weights[
                $this->phase_order
            ]
            ?? 0;
    }
}