<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {

            $table->id();

            $table->string('project_name');

            $table->text('description')->nullable();

            $table->unsignedBigInteger('architect_id');

            $table->string('client_name')->nullable();

            $table->string('client_email')->nullable();

            $table->string('status')->default('planning');

            $table->integer('progress')->default(0);

            $table->date('start_date')->nullable();

            $table->date('target_date')->nullable();

            $table->timestamps();


            $table->foreign('architect_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};