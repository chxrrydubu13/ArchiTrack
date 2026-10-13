<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_feedback', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('type', [
                'issue',
                'suggestion'
            ]);

            $table->string('subject', 255);

            $table->text('message');

            $table->enum('status', [
                'pending',
                'in_review',
                'resolved'
            ])->default('pending');

            $table->timestamps();

            $table->index([
                'client_id',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_feedback');
    }
};