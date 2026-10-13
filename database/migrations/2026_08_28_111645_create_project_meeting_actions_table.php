<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_meeting_actions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->onDelete('cascade');

            $table->foreignId('meeting_id')
                ->nullable()
                ->constrained('project_meetings')
                ->onDelete('set null');

            $table->string('title');

            $table->string('type')
                ->default('task');

            $table->date('due_date')
                ->nullable();

            $table->string('priority')
                ->default('normal');

            $table->string('status')
                ->default('todo');

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_meeting_actions');
    }
};