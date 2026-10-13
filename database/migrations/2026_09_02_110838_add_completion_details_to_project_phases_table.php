<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_phases', function (Blueprint $table) {

            $table->json('completion_checklist')
                ->nullable()
                ->after('completed_date');

            $table->text('completion_note')
                ->nullable()
                ->after('completion_checklist');

            $table->foreignId('completed_by')
                ->nullable()
                ->after('completion_note')
                ->constrained('users')
                ->nullOnDelete();

        });
    }


    public function down(): void
    {
        Schema::table('project_phases', function (Blueprint $table) {

            $table->dropForeign([
                'completed_by'
            ]);

            $table->dropColumn([
                'completion_checklist',
                'completion_note',
                'completed_by',
            ]);

        });
    }
};