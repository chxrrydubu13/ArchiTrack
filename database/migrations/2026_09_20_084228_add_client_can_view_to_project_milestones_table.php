<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
    |--------------------------------------------------------------------------
    | RUN MIGRATION
    |--------------------------------------------------------------------------
    */

    public function up(): void
    {
        Schema::table(
            'project_milestones',
            function (Blueprint $table) {

                $table
                    ->boolean('client_can_view')
                    ->default(true)
                    ->after('proof_file');
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REVERSE MIGRATION
    |--------------------------------------------------------------------------
    */

    public function down(): void
    {
        Schema::table(
            'project_milestones',
            function (Blueprint $table) {

                $table->dropColumn(
                    'client_can_view'
                );
            }
        );
    }
};