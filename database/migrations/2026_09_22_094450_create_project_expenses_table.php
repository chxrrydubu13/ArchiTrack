<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('recorded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('category', 100);

            $table->string('description', 255);

            $table->decimal('amount', 15, 2);

            $table->date('expense_date');

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->index([
                'project_id',
                'expense_date',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_expenses');
    }
};