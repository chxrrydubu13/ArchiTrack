<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'recorded_by',
        'category',
        'description',
        'amount',
        'expense_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class
        );
    }

    public function recordedBy()
    {
        return $this->belongsTo(
            User::class,
            'recorded_by'
        );
    }
}