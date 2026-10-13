<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /*
    |--------------------------------------------------------------------------
    | ADD PENDING MEETING STATUS
    |--------------------------------------------------------------------------
    */

    public function up(): void
    {
        DB::statement("
            ALTER TABLE project_meetings
            MODIFY COLUMN status
            ENUM(
                'pending',
                'scheduled',
                'completed',
                'cancelled'
            )
            NOT NULL
            DEFAULT 'scheduled'
        ");
    }


    /*
    |--------------------------------------------------------------------------
    | REMOVE PENDING MEETING STATUS
    |--------------------------------------------------------------------------
    */

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | CONVERT EXISTING PENDING REQUESTS FIRST
        |--------------------------------------------------------------------------
        |
        | This prevents rollback errors if pending meeting requests
        | already exist.
        */

        DB::table('project_meetings')
            ->where('status', 'pending')
            ->update([
                'status' => 'scheduled',
            ]);


        DB::statement("
            ALTER TABLE project_meetings
            MODIFY COLUMN status
            ENUM(
                'scheduled',
                'completed',
                'cancelled'
            )
            NOT NULL
            DEFAULT 'scheduled'
        ");
    }
};