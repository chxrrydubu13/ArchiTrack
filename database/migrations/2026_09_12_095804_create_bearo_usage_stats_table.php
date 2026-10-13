<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bearo_usage_stats', function (Blueprint $table) {
            $table->id();

            $table->date('usage_date')->unique();

            $table->unsignedInteger('messages')->default(0);
            $table->unsignedInteger('successful_replies')->default(0);
            $table->unsignedInteger('failed_replies')->default(0);
            $table->unsignedInteger('rate_limited')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bearo_usage_stats');
    }
};
