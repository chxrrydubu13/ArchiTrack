<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'project_revisions',
            function (Blueprint $table) {

                /*
                |--------------------------------------------------------------------------
                | REFERENCE ATTACHMENT
                |--------------------------------------------------------------------------
                */

                $table->string('attachment_path')
                    ->nullable()
                    ->after('description');

                $table->string('attachment_name')
                    ->nullable()
                    ->after('attachment_path');

                $table->string('attachment_type')
                    ->nullable()
                    ->after('attachment_name');

                $table->unsignedBigInteger('attachment_size')
                    ->nullable()
                    ->after('attachment_type');


                /*
                |--------------------------------------------------------------------------
                | AI STRUCTURED REVISION
                |--------------------------------------------------------------------------
                */

                $table->string('revision_category')
                    ->nullable()
                    ->after('attachment_size');

                $table->longText('ai_structured_feedback')
                    ->nullable()
                    ->after('revision_category');

                $table->boolean('used_ai')
                    ->default(false)
                    ->after('ai_structured_feedback');

            }
        );
    }


    public function down(): void
    {
        Schema::table(
            'project_revisions',
            function (Blueprint $table) {

                $table->dropColumn([
                    'attachment_path',
                    'attachment_name',
                    'attachment_type',
                    'attachment_size',
                    'revision_category',
                    'ai_structured_feedback',
                    'used_ai',
                ]);

            }
        );
    }
};