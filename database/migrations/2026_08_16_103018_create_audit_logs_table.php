<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {

            $table->id();

            // user who performed the action
            $table->unsignedBigInteger('user_id')->nullable();

            // readable user name
            $table->string('user_name')->nullable();

            // login, logout, upload, revision, meeting, etc.
            $table->string('action');

            // optional extra details
            $table->text('details')->nullable();

            // project affected by the action
            $table->unsignedBigInteger('project_id')->nullable();

            // project name for easy display
            $table->string('project_name')->nullable();

            // IP address
            $table->string('ip_address')->nullable();

            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();


            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->nullOnDelete();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};