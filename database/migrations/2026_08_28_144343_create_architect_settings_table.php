<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('architect_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->onDelete('cascade');

            // Presence
            $table->string('default_status')
                ->default('online');

            // Messages
            $table->boolean('message_notifications')
                ->default(true);

            $table->boolean('message_sound')
                ->default(true);

            $table->boolean('message_preview')
                ->default(true);

            // Meetings
            $table->integer('meeting_reminder_minutes')
                ->default(30);

            $table->boolean('meeting_notifications')
                ->default(true);

            // General notifications
            $table->boolean('email_notifications')
                ->default(true);

            $table->boolean('revision_notifications')
                ->default(true);

            $table->boolean('file_notifications')
                ->default(true);

            // Appearance
            $table->string('appearance')
                ->default('light');

            $table->string('density')
                ->default('comfortable');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('architect_settings');
    }
};