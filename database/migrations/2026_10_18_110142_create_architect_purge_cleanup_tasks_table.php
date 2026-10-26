<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('architect_purge_cleanup_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('architect_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('disk', 30);
            $table->string('directory', 500);
            $table->string('status', 20)->default('pending');
            $table->unsignedInteger('attempts')->default(0);
            $table->text('last_error')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'id']);
            $table->index('architect_id');
            $table->unique(
                ['architect_id', 'project_id', 'disk', 'directory'],
                'architect_cleanup_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('architect_purge_cleanup_tasks');
    }
};
