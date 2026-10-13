<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_revisions', function (Blueprint $table) {

            if (!Schema::hasColumn('project_revisions', 'project_id')) {
                $table->foreignId('project_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('projects')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('project_revisions', 'client_id')) {
                $table->foreignId('client_id')
                    ->nullable()
                    ->after('project_id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('project_revisions', 'title')) {
                $table->string('title')
                    ->nullable()
                    ->after('client_id');
            }

            if (!Schema::hasColumn('project_revisions', 'description')) {
                $table->text('description')
                    ->nullable()
                    ->after('title');
            }

            if (!Schema::hasColumn('project_revisions', 'status')) {
                $table->enum('status', [
                    'pending',
                    'in_progress',
                    'resolved'
                ])
                    ->default('pending')
                    ->after('description');
            }

            if (!Schema::hasColumn('project_revisions', 'architect_response')) {
                $table->text('architect_response')
                    ->nullable()
                    ->after('status');
            }

            if (!Schema::hasColumn('project_revisions', 'resolved_at')) {
                $table->timestamp('resolved_at')
                    ->nullable()
                    ->after('architect_response');
            }
        });
    }


    public function down(): void
    {
        Schema::table('project_revisions', function (Blueprint $table) {

            if (Schema::hasColumn('project_revisions', 'resolved_at')) {
                $table->dropColumn('resolved_at');
            }

            if (Schema::hasColumn('project_revisions', 'architect_response')) {
                $table->dropColumn('architect_response');
            }

            if (Schema::hasColumn('project_revisions', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('project_revisions', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('project_revisions', 'title')) {
                $table->dropColumn('title');
            }

            if (Schema::hasColumn('project_revisions', 'client_id')) {
                $table->dropForeign(['client_id']);
                $table->dropColumn('client_id');
            }

            if (Schema::hasColumn('project_revisions', 'project_id')) {
                $table->dropForeign(['project_id']);
                $table->dropColumn('project_id');
            }
        });
    }
};