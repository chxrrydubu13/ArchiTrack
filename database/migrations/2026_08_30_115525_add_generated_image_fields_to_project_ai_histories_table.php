<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_ai_histories', function (Blueprint $table) {

            // AI-generated concept image
            $table->string('generated_image_path')
                ->nullable()
                ->after('image_path');

            // Generation/version number: 1, 2, 3...
            $table->unsignedInteger('version_number')
                ->default(1)
                ->after('generated_image_path');

            // Previous AI generation used as basis
            $table->foreignId('parent_history_id')
                ->nullable()
                ->after('version_number')
                ->constrained('project_ai_histories')
                ->nullOnDelete();

            // Has this concept already been sent to the architect?
            $table->boolean('sent_to_architect')
                ->default(false)
                ->after('parent_history_id');
        });
    }


    public function down(): void
    {
        Schema::table('project_ai_histories', function (Blueprint $table) {

            $table->dropForeign([
                'parent_history_id'
            ]);

            $table->dropColumn([
                'generated_image_path',
                'version_number',
                'parent_history_id',
                'sent_to_architect',
            ]);
        });
    }
};