
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Preserve original architect identity.
        Schema::table('projects', function (Blueprint $table) {
            $table->string('original_architect_name')->nullable();
        });

        Schema::table('project_architects', function (Blueprint $table) {
            $table->string('architect_name')->nullable();
        });

        // Save architect names before modifying relationships.
        DB::statement("
            UPDATE projects p
            JOIN users u ON u.id = p.architect_id
            SET p.original_architect_name = u.name
        ");

        DB::statement("
            UPDATE project_architects pa
            JOIN users u ON u.id = pa.architect_id
            SET pa.architect_name = u.name
        ");

        // Remove cascade deletion on project ownership.
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['architect_id']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('architect_id')
                ->nullable()
                ->change();

            $table->foreign('architect_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        // Preserve co-architect history.
        Schema::table('project_architects', function (Blueprint $table) {
            $table->dropForeign(['architect_id']);
        });

        Schema::table('project_architects', function (Blueprint $table) {
            $table->unsignedBigInteger('architect_id')
                ->nullable()
                ->change();

            $table->foreign('architect_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        // Intentionally do not reverse preservation safeguards.
        // Restoring CASCADE could delete historical project data.
    }
};
