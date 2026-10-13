<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'uploaded_by',
        'file_name',
        'original_name',
        'file_path',
        'file_type',
        'file_size',
        'category',
        'description',
        'version_group',
        'version_number',
        'is_latest',
        'is_archived',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'version_number' => 'integer',
        'is_latest' => 'boolean',
        'is_archived' => 'boolean',
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
    | UPLOADED BY
    |--------------------------------------------------------------------------
    */

    public function uploader()
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FILE VERSIONS
    |--------------------------------------------------------------------------
    */

    public function versions()
    {
        return self::where(
            'project_id',
            $this->project_id
        )
            ->where(
                'version_group',
                $this->version_group
            )
            ->orderByDesc(
                'version_number'
            )
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK IF LATEST VERSION
    |--------------------------------------------------------------------------
    */

    public function isLatestVersion()
    {
        return $this->is_latest === true;
    }
}