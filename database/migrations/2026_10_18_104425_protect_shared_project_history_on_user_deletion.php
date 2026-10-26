
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_files', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);
        });

        Schema::table('project_files', function (Blueprint $table) {
            $table->unsignedBigInteger('uploaded_by')->nullable()->change();

            $table->foreign('uploaded_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        Schema::table('project_messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
        });

        Schema::table('project_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('sender_id')->nullable()->change();
            $table->unsignedBigInteger('receiver_id')->nullable()->change();

            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        Schema::table('project_meetings', function (Blueprint $table) {
            $table->dropForeign(['architect_id']);
        });

        Schema::table('project_meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('architect_id')->nullable()->change();

            $table->foreign('architect_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Automatic rollback is disabled because restoring CASCADE could destroy preserved history.'
        );
    }
};
