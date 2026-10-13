<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE ATTRIBUTES
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'profile_image',
        'password',
        'role',
        'status',
        'must_change_password',
    ];


    /*
    |--------------------------------------------------------------------------
    | HIDDEN ATTRIBUTES
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'password' => 'hashed',
            'must_change_password' => 'boolean',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | PROJECTS
    |--------------------------------------------------------------------------
    */

    public function projects()
    {
        return $this->hasMany(
            Project::class,
            'architect_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE DRIVE CONNECTION
    |--------------------------------------------------------------------------
    */

    public function googleDriveConnection()
    {
        return $this->hasOne(
            GoogleDriveConnection::class
        );
    }
}