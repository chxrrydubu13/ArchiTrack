<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_milestones', function (Blueprint $table) {

            if (!Schema::hasColumn('project_milestones', 'completion_report')) {
                $table->text('completion_report')
                    ->nullable()
                    ->after('status');
            }

            if (!Schema::hasColumn('project_milestones', 'proof_file')) {
                $table->string('proof_file')
                    ->nullable()
                    ->after('completion_report');
            }

            if (!Schema::hasColumn('project_milestones', 'proof_file_name')) {
                $table->string('proof_file_name')
                    ->nullable()
                    ->after('proof_file');
            }

            if (!Schema::hasColumn('project_milestones', 'completed_by')) {
                $table->foreignId('completed_by')
                    ->nullable()
                    ->after('proof_file_name')
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('project_milestones', 'completed_at')) {
                $table->timestamp('completed_at')
                    ->nullable()
                    ->after('completed_by');
            }
        });
    }


    public function down(): void
    {
        Schema::table('project_milestones', function (Blueprint $table) {

            if (Schema::hasColumn('project_milestones', 'completed_by')) {
                $table->dropForeign([
                    'completed_by'
                ]);
            }

            $columns = [];

            if (Schema::hasColumn('project_milestones', 'completion_report')) {
                $columns[] = 'completion_report';
            }

            if (Schema::hasColumn('project_milestones', 'proof_file')) {
                $columns[] = 'proof_file';
            }

            if (Schema::hasColumn('project_milestones', 'proof_file_name')) {
                $columns[] = 'proof_file_name';
            }

            if (Schema::hasColumn('project_milestones', 'completed_by')) {
                $columns[] = 'completed_by';
            }

            if (Schema::hasColumn('project_milestones', 'completed_at')) {
                $columns[] = 'completed_at';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};