<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_files', function (Blueprint $table) {

            $table->string('version_group')
                ->nullable()
                ->after('description');

            $table->unsignedInteger('version_number')
                ->default(1)
                ->after('version_group');

            $table->boolean('is_latest')
                ->default(true)
                ->after('version_number');
        });
    }

    public function down(): void
    {
        Schema::table('project_files', function (Blueprint $table) {

            $table->dropColumn([
                'version_group',
                'version_number',
                'is_latest',
            ]);
        });
    }
};