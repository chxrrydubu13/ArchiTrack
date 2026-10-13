<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bearo_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('enabled')->default(true);

            $table->string('model')->default('gpt-5.6-luna');

            $table->unsignedInteger('max_output_tokens')->default(260);

            $table->string('greeting_title')
                ->default("Hi! I'm Bearo.");

            $table->string('greeting_text')
                ->default('Ask me anything about ArchiTrack.');

            $table->text('tone_instructions')->nullable();

            $table->text('fallback_message')->nullable();

            $table->unsignedInteger('idle_reset_minutes')->default(20);

            $table->boolean('save_usage_logs')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bearo_settings');
    }
};
