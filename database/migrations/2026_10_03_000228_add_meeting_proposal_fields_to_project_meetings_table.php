<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'project_meetings',
            function (Blueprint $table) {

                $table->string(
                    'proposed_by',
                    20
                )
                    ->nullable()
                    ->after('client_id');

                $table->unsignedBigInteger(
                    'proposed_by_user_id'
                )
                    ->nullable()
                    ->after('proposed_by');
            }
        );
    }


    public function down(): void
    {
        Schema::table(
            'project_meetings',
            function (Blueprint $table) {

                $table->dropColumn([
                    'proposed_by',
                    'proposed_by_user_id',
                ]);
            }
        );
    }
};