<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_milestones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_phase_id')
                ->constrained('project_phases')
                ->cascadeOnDelete();

            $table->string('milestone_name');

            $table->text('description')->nullable();

            $table->enum('status', [
                'pending',
                'in_progress',
                'completed'
            ])->default('pending');

            $table->unsignedInteger('milestone_order')->default(1);

            $table->date('target_date')->nullable();
            $table->date('completed_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_milestones');
    }
};