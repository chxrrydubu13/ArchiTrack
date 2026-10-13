<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_milestones', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | COMPLETION REPORT
            |--------------------------------------------------------------------------
            |
            | Short report from the architect explaining
            | what was accomplished for this milestone.
            |
            */

            $table->text('completion_report')
                ->nullable()
                ->after('status');


            /*
            |--------------------------------------------------------------------------
            | PROOF FILE
            |--------------------------------------------------------------------------
            |
            | Stores the path of the supporting proof.
            | Example:
            | projects/10/phases/2/milestones/5/proof-file.pdf
            |
            */

            $table->string('proof_file')
                ->nullable()
                ->after('completion_report');


            /*
            |--------------------------------------------------------------------------
            | ORIGINAL PROOF FILE NAME
            |--------------------------------------------------------------------------
            |
            | This is the name shown to the architect/client.
            |
            */

            $table->string('proof_file_name')
                ->nullable()
                ->after('proof_file');


            /*
            |--------------------------------------------------------------------------
            | COMPLETED BY
            |--------------------------------------------------------------------------
            |
            | Automatically stores the logged-in architect
            | who completed the milestone.
            |
            */

            $table->foreignId('completed_by')
                ->nullable()
                ->after('proof_file_name')
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | COMPLETED DATE AND TIME
            |--------------------------------------------------------------------------
            */

            $table->timestamp('completed_at')
                ->nullable()
                ->after('completed_by');
        });
    }


    public function down(): void
    {
        Schema::table('project_milestones', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | REMOVE FOREIGN KEY
            |--------------------------------------------------------------------------
            */

            $table->dropForeign([
                'completed_by'
            ]);


            /*
            |--------------------------------------------------------------------------
            | REMOVE COLUMNS
            |--------------------------------------------------------------------------
            */

            $table->dropColumn([
                'completion_report',
                'proof_file',
                'proof_file_name',
                'completed_by',
                'completed_at',
            ]);
        });
    }
};