<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_architects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('architect_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('role', 100)
                ->default('Co-Architect');

            $table->string('discipline', 150)
                ->nullable();

            $table->timestamps();

            $table->unique([
                'project_id',
                'architect_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_architects');
    }
};