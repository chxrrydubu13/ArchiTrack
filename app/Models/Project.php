<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'description',
        'project_image',
        'architect_id',
        'client_id',
        'client_name',
        'client_email',
        'status',
        'progress',
        'budget',
        'start_date',
        'target_date',
    ];


    protected $casts = [
        'budget' => 'decimal:2',
    ];


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


    public function projectArchitects()
    {
        return $this->hasMany(
            ProjectArchitect::class,
            'project_id'
        );
    }


    public function collaborators()
    {
        return $this->belongsToMany(
            User::class,
            'project_architects',
            'project_id',
            'architect_id'
        )
            ->withPivot(
                'role',
                'discipline'
            )
            ->withTimestamps();
    }


    public function files()
    {
        return $this->hasMany(
            ProjectFile::class
        );
    }


    public function messages()
    {
        return $this->hasMany(
            ProjectMessage::class
        );
    }


    public function revisions()
    {
        return $this->hasMany(
            ProjectRevision::class,
            'project_id'
        );
    }


    public function meetings()
    {
        return $this->hasMany(
            ProjectMeeting::class,
            'project_id'
        );
    }


    public function aiHistories()
    {
        return $this->hasMany(
            ProjectAIHistory::class,
            'project_id'
        );
    }


    public function meetingActions()
    {
        return $this->hasMany(
            ProjectMeetingAction::class
        );
    }


    public function phases()
    {
        return $this->hasMany(
            ProjectPhase::class
        )
            ->orderBy(
                'phase_order'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PROJECT EXPENSES
    |--------------------------------------------------------------------------
    */

    public function expenses()
    {
        return $this->hasMany(
            ProjectExpense::class
        )
            ->orderByDesc(
                'expense_date'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FINANCIAL TOTALS
    |--------------------------------------------------------------------------
    */

    public function getTotalExpensesAttribute()
    {
        return (float) $this
            ->expenses()
            ->sum('amount');
    }


    public function getRemainingBudgetAttribute()
    {
        if ($this->budget === null) {
            return null;
        }

        return (float) $this->budget
            - $this->total_expenses;
    }
}