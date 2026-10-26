<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('architect_name_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('architect_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('admin_id')->constrained('users')->restrictOnDelete();
            $table->string('old_name', 100);
            $table->string('new_name', 100);
            $table->string('reason', 40);
            $table->text('explanation');
            $table->string('proof_disk', 30);
            $table->string('proof_path', 500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('architect_name_changes');
    }
};
