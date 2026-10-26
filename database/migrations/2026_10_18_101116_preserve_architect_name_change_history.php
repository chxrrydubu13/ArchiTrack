
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('architect_name_changes', function (Blueprint $table) {
            $table->unsignedBigInteger('archived_architect_id')
                ->nullable()
                ->after('architect_id');

            $table->unsignedBigInteger('archived_admin_id')
                ->nullable()
                ->after('admin_id');
        });

        DB::table('architect_name_changes')
            ->orderBy('id')
            ->chunkById(100, function ($records) {
                foreach ($records as $record) {
                    DB::table('architect_name_changes')
                        ->where('id', $record->id)
                        ->update([
                            'archived_architect_id' => $record->architect_id,
                            'archived_admin_id' => $record->admin_id,
                        ]);
                }
            });

        Schema::table('architect_name_changes', function (Blueprint $table) {
            $table->dropForeign(['architect_id']);
            $table->dropForeign(['admin_id']);
        });

        Schema::table('architect_name_changes', function (Blueprint $table) {
            $table->unsignedBigInteger('architect_id')
                ->nullable()
                ->change();

            $table->unsignedBigInteger('admin_id')
                ->nullable()
                ->change();
        });

        Schema::table('architect_name_changes', function (Blueprint $table) {
            $table->foreign('architect_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('admin_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        // Intentionally irreversible.
        // Restoring RESTRICT foreign keys after users have been
        // deleted could invalidate preserved historical records.
        throw new RuntimeException(
            'This migration cannot be safely rolled back automatically.'
        );
    }
};
