<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_meetings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('architect_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('agenda')
                ->nullable();

            $table->enum('meeting_type', [
                'online',
                'in_person'
            ])->default('online');

            $table->date('meeting_date');

            $table->time('start_time');

            $table->time('end_time')
                ->nullable();

            $table->string('meeting_link')
                ->nullable();

            $table->string('location')
                ->nullable();

            $table->enum('status', [
                'scheduled',
                'completed',
                'cancelled'
            ])->default('scheduled');

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('project_meetings');
    }
};