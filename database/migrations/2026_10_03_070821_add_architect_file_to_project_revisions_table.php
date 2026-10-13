<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_revisions', function (Blueprint $table) {
            $table->string('architect_file_path')->nullable()->after('architect_response');
            $table->string('architect_file_name')->nullable()->after('architect_file_path');
            $table->string('architect_file_type', 50)->nullable()->after('architect_file_name');
            $table->unsignedBigInteger('architect_file_size')->nullable()->after('architect_file_type');
        });
    }

    public function down(): void
    {
        Schema::table('project_revisions', function (Blueprint $table) {
            $table->dropColumn([
                'architect_file_path',
                'architect_file_name',
                'architect_file_type',
                'architect_file_size',
            ]);
        });
    }
};
