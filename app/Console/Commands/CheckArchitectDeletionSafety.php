<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckArchitectDeletionSafety extends Command
{
    protected $signature = 'architects:check-deletion
        {--id= : Inspect one architect ID}';

    protected $description =
        'Read-only safety check before permanent architect deletion.';

    public function handle(): int
    {
        $this->info('ARCHITRACK - 30-DAY DELETION SAFETY CHECK');
        $this->warn('READ-ONLY: No records or files will be deleted.');
        $this->newLine();

        if (
            !Schema::hasTable('users') ||
            !Schema::hasColumn('users', 'archived_at')
        ) {
            $this->error('Required users table or archived_at column is missing.');
            return self::FAILURE;
        }

        $query = DB::table('users')
            ->where('role', 'architect')
            ->where('status', 'archived')
            ->whereNotNull('archived_at');

        if ($this->option('id')) {
            $query->where('id', $this->option('id'));
        }

        $architects = $query->get();

        if ($architects->isEmpty()) {
            $this->warn('No matching archived architects found.');
            return self::SUCCESS;
        }

        foreach ($architects as $architect) {
            $due = Carbon::parse($architect->archived_at)
                ->addDays(30);

            $this->newLine();
            $this->info("Architect ID: {$architect->id}");
            $this->line("Name: {$architect->name}");
            $this->line("Archived: {$architect->archived_at}");
            $this->line("Deletion due: {$due->format('Y-m-d H:i:s')}");
            $this->line(
                'Status: ' .
                ($due->lte(now()) ? 'DUE' : 'NOT YET DUE')
            );

            $ownedProjects = collect();

            if (
                Schema::hasTable('projects') &&
                Schema::hasColumn('projects', 'architect_id')
            ) {
                $ownedProjects = DB::table('projects')
                    ->where('architect_id', $architect->id)
                    ->pluck('id');
            }

            $this->line(
                'Owned projects: ' . $ownedProjects->count()
            );

            if (Schema::hasTable('architect_name_changes')) {
                $history = DB::table('architect_name_changes')
                    ->where('architect_id', $architect->id)
                    ->count();

                $this->line(
                    'Protected name-change records: ' . $history
                );

                if ($history > 0) {
                    $this->warn(
                        'BLOCKER: Name-change history has a RESTRICT foreign key.'
                    );
                }
            }

            $relationships = [
                ['project_architects', 'architect_id', 'project_id'],
                ['project_meetings', 'architect_id', 'project_id'],
                ['project_messages', 'sender_id', 'project_id'],
                ['project_messages', 'receiver_id', 'project_id'],
                ['project_files', 'uploaded_by', 'project_id'],
            ];

            foreach ($relationships as [$table, $userColumn, $projectColumn]) {
                if (
                    !Schema::hasTable($table) ||
                    !Schema::hasColumn($table, $userColumn) ||
                    !Schema::hasColumn($table, $projectColumn)
                ) {
                    continue;
                }

                $count = DB::table($table)
                    ->where($userColumn, $architect->id)
                    ->whereNotIn($projectColumn, $ownedProjects->all())
                    ->count();

                if ($count > 0) {
                    $this->warn(
                        "SHARED DATA: {$table}.{$userColumn} "
                        . "references {$count} record(s) "
                        . "outside this architect's owned projects."
                    );
                }
            }

            if (Schema::hasTable('project_files')) {
                $count = DB::table('project_files')
                    ->whereIn('project_id', $ownedProjects->all())
                    ->count();

                $this->line(
                    "Project file database records: {$count}"
                );
            }

            $this->warn(
                'Deletion is not enabled by this command.'
            );
        }

        $this->newLine();
        $this->info('Safety check completed.');

        return self::SUCCESS;
    }
}
