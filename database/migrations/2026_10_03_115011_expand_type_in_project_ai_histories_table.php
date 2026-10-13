<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Expand AI history type values
        |--------------------------------------------------------------------------
        |
        | Existing values:
        | - suggestion
        | - image
        |
        | New image-generation workflow also uses:
        | - image_generation
        | - image_edit
        |
        */

        DB::statement("
            ALTER TABLE project_ai_histories
            MODIFY COLUMN type ENUM(
                'suggestion',
                'image',
                'image_generation',
                'image_edit'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Protect rollback from invalid enum values
        |--------------------------------------------------------------------------
        |
        | Convert newer values back to the old 'image' value first.
        |
        */

        DB::table('project_ai_histories')
            ->whereIn('type', [
                'image_generation',
                'image_edit',
            ])
            ->update([
                'type' => 'image',
            ]);

        DB::statement("
            ALTER TABLE project_ai_histories
            MODIFY COLUMN type ENUM(
                'suggestion',
                'image'
            ) NOT NULL
        ");
    }
};
