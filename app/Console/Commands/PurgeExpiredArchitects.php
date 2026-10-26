<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Throwable;

class PurgeExpiredArchitects extends Command
{
    protected $signature = 'architects:purge-expired
        {--id= : Limit to one architect ID}
        {--execute : Permanently delete eligible architect accounts}
        {--immediate : Bypass the 30-day waiting period for one archived architect (requires --id and --execute)}';

    protected $description = 'Delete archived architect accounts while preserving project records and files.';

    public function handle(): int
    {
        $execute = (bool) $this->option('execute');
        $immediate = (bool) $this->option('immediate');
        $id = $this->option('id');

        if ($id !== null && (!ctype_digit((string) $id) || (int) $id < 1)) {
            $this->error('Invalid architect ID.');
            return self::FAILURE;
        }

        if ($immediate && (!$execute || $id === null)) {
            $this->error('--immediate requires both --execute and --id.');
            return self::FAILURE;
        }

        $this->info('ARCHITRACK - ARCHIVED ARCHITECT ACCOUNT DELETION');

        if (!$execute) {
            $this->warn('DRY RUN: No database records or files will be deleted.');
        }

        $query = DB::table('users')
            ->where('role', 'architect')
            ->where('status', 'archived')
            ->whereNotNull('archived_at')
            ->orderBy('id');

        if (!$immediate) {
            $query->where('archived_at', '<=', now()->subDays(30));
        }

        if ($id !== null) {
            $query->where('id', (int) $id);
        }

        $architects = $query->get();

        if ($architects->isEmpty()) {
            $this->info('No eligible archived architects found.');
            return self::SUCCESS;
        }

        $failed = false;

        foreach ($architects as $architect) {
            $ownedProjects = DB::table('projects')->where('architect_id', $architect->id)->count();
            $collaborations = DB::table('project_architects')->where('architect_id', $architect->id)->count();

            $this->newLine();
            $this->line("Architect {$architect->id}: {$architect->name}");
            $this->line("Archived at: {$architect->archived_at}");
            $this->line("Owned projects retained: {$ownedProjects}");
            $this->line("Project collaborations retained: {$collaborations}");

            if (!$execute) {
                continue;
            }

            try {
                DB::transaction(function () use ($architect, $immediate): void {
                    $locked = DB::table('users')
                        ->where('id', $architect->id)
                        ->lockForUpdate()
                        ->first();

                    if (!$locked || $locked->role !== 'architect' ||
                        $locked->status !== 'archived' || !$locked->archived_at) {
                        throw new RuntimeException('Architect is no longer archived or does not exist.');
                    }

                    if (!$immediate && $locked->archived_at > now()->subDays(30)->toDateTimeString()) {
                        throw new RuntimeException('The 30-day retention period has not expired.');
                    }

                    // Preserve identity before SET NULL foreign keys detach the account.
                    DB::table('projects')
                        ->where('architect_id', $locked->id)
                        ->update(['original_architect_name' => $locked->name]);

                    DB::table('project_architects')
                        ->where('architect_id', $locked->id)
                        ->update(['architect_name' => $locked->name]);

                    // Do not queue cleanup tasks or delete project directories.
                    // This deletion is safe only after all user FK rules and
                    // archived-project authorization have been verified.
                    $deleted = DB::table('users')
                        ->where('id', $locked->id)
                        ->where('role', 'architect')
                        ->where('status', 'archived')
                        ->delete();

                    if ($deleted !== 1) {
                        throw new RuntimeException('Account deletion was not completed.');
                    }
                }, 3);

                $this->info("ACCOUNT DELETED; PROJECT RECORDS RETAINED: {$architect->id}");
            } catch (Throwable $e) {
                $failed = true;
                $this->error("FAILED Architect {$architect->id}: {$e->getMessage()}");
            }
        }

        return $failed ? self::FAILURE : self::SUCCESS;
    }
}
