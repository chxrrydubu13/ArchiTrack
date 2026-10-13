<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectArchitect extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'architect_id',
        'role',
        'discipline',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function architect()
    {
        return $this->belongsTo(
            User::class,
            'architect_id'
        );
    }
}