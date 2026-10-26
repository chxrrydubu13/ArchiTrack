<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AuditArchitectDeletion extends Command
{
    protected $signature = 'architects:audit-deletion';

    protected $description =
        'Read-only audit of archived architects and database deletion dependencies.';

    public function handle(): int
    {
        $this->info('ARCHITRACK — ARCHITECT DELETION AUDIT');
        $this->line('No records will be deleted.');
        $this->newLine();

        if (!Schema::hasTable('users')) {
            $this->error('Users table not found.');

            return self::FAILURE;
        }

        if (!Schema::hasColumn('users', 'archived_at')) {
            $this->error(
                'Missing users.archived_at column. Run the archive migration first.'
            );

            return self::FAILURE;
        }

        $architects = DB::table('users')
            ->where('role', 'architect')
            ->where('status', 'archived')
            ->select('id', 'name', 'email', 'archived_at')
            ->orderBy('id')
            ->get();

        $this->info('1. ARCHIVED ARCHITECTS');

        if ($architects->isEmpty()) {
            $this->warn('No archived architects found.');
        } else {
            $rows = [];

            foreach ($architects as $architect) {
                $archiveDate = $architect->archived_at
                    ? \Carbon\Carbon::parse($architect->archived_at)
                    : null;

                $deleteDate = $archiveDate
                    ? $archiveDate->copy()->addDays(30)
                    : null;

                $rows[] = [
                    $architect->id,
                    $architect->name,
                    $archiveDate?->format('Y-m-d H:i') ?? 'Missing',
                    $deleteDate?->format('Y-m-d H:i') ?? 'Unknown',
                    $deleteDate
                        ? ($deleteDate->isPast() ? 'DUE' : 'WAITING')
                        : 'REVIEW',
                ];
            }

            $this->table(
                ['ID', 'Name', 'Archived At', 'Deletion Due', 'Status'],
                $rows
            );
        }

        $this->newLine();
        $this->info('2. PROJECT OWNERSHIP');

        if (
            Schema::hasTable('projects') &&
            Schema::hasColumn('projects', 'architect_id')
        ) {
            $projectRows = [];

            foreach ($architects as $architect) {
                $count = DB::table('projects')
                    ->where('architect_id', $architect->id)
                    ->count();

                $projectRows[] = [
                    $architect->id,
                    $architect->name,
                    $count,
                ];
            }

            if (count($projectRows)) {
                $this->table(
                    ['Architect ID', 'Architect', 'Owned Projects'],
                    $projectRows
                );
            } else {
                $this->line('No archived architects to inspect.');
            }
        } else {
            $this->warn('projects.architect_id not found.');
        }

        $this->newLine();
        $this->info('3. PROFESSIONAL NAME CHANGE HISTORY');

        if (Schema::hasTable('architect_name_changes')) {
            $historyRows = [];

            foreach ($architects as $architect) {
                $count = DB::table('architect_name_changes')
                    ->where('architect_id', $architect->id)
                    ->count();

                $historyRows[] = [
                    $architect->id,
                    $count,
                ];
            }

            if (count($historyRows)) {
                $this->table(
                    ['Architect ID', 'Name Change Records'],
                    $historyRows
                );
            }
        } else {
            $this->warn('Name change history table not found.');
        }

        $this->newLine();
        $this->info('4. FOREIGN KEY DEPENDENCIES');

        $driver = DB::getDriverName();

        try {
            if ($driver === 'mysql') {
                $dependencies = DB::select("
                    SELECT
                        TABLE_NAME AS child_table,
                        COLUMN_NAME AS child_column,
                        REFERENCED_TABLE_NAME AS parent_table,
                        REFERENCED_COLUMN_NAME AS parent_column,
                        CONSTRAINT_NAME AS constraint_name
                    FROM information_schema.KEY_COLUMN_USAGE
                    WHERE TABLE_SCHEMA = DATABASE()
                      AND REFERENCED_TABLE_NAME IS NOT NULL
                    ORDER BY parent_table, child_table
                ");

                $deleteRules = DB::select("
                    SELECT
                        TABLE_NAME AS child_table,
                        CONSTRAINT_NAME AS constraint_name,
                        DELETE_RULE AS delete_rule
                    FROM information_schema.REFERENTIAL_CONSTRAINTS
                    WHERE CONSTRAINT_SCHEMA = DATABASE()
                ");

                $rules = [];

                foreach ($deleteRules as $rule) {
                    $rules[
                        $rule->child_table . ':' . $rule->constraint_name
                    ] = $rule->delete_rule;
                }

                $rows = [];

                foreach ($dependencies as $dependency) {
                    $rows[] = [
                        $dependency->parent_table,
                        $dependency->child_table,
                        $dependency->child_column,
                        $rules[
                            $dependency->child_table
                            . ':'
                            . $dependency->constraint_name
                        ] ?? 'UNKNOWN',
                    ];
                }

                $this->table(
                    ['Parent Table', 'Child Table', 'Foreign Key', 'On Delete'],
                    $rows
                );
            } elseif ($driver === 'sqlite') {
                $tables = DB::select("
                    SELECT name
                    FROM sqlite_master
                    WHERE type = 'table'
                      AND name NOT LIKE 'sqlite_%'
                ");

                $rows = [];

                foreach ($tables as $table) {
                    $tableName = $table->name;

                    $foreignKeys = DB::select(
                        'PRAGMA foreign_key_list("' .
                        str_replace('"', '""', $tableName) .
                        '")'
                    );

                    foreach ($foreignKeys as $foreignKey) {
                        $rows[] = [
                            $foreignKey->table,
                            $tableName,
                            $foreignKey->from,
                            $foreignKey->on_delete,
                        ];
                    }
                }

                $this->table(
                    ['Parent Table', 'Child Table', 'Foreign Key', 'On Delete'],
                    $rows
                );
            } else {
                $this->warn(
                    'Automatic foreign-key inspection is not implemented for: '
                    . $driver
                );
            }
        } catch (QueryException $exception) {
            $this->error(
                'Foreign-key inspection failed: '
                . $exception->getMessage()
            );

            return self::FAILURE;
        }

        $this->newLine();

        $this->warn(
            'AUDIT COMPLETE — No database records were modified.'
        );

        $this->line(
            'Review CASCADE, RESTRICT, NO ACTION, and SET NULL relationships before implementing deletion.'
        );

        return self::SUCCESS;
    }
}
