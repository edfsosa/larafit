<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade'); // Foreign key to the member who owns the plan
            $table->foreignId('trainer_id')->nullable()->constrained()->onDelete('set null'); // Foreign key to the trainer who created the plan
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', [
                'draft',
                'active',
                'completed',
                'cancelled',
                'archived'
            ])->default('draft');
            $table->boolean('is_template')->default(false);
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->enum('repeat_pattern', [
                'daily',
                'weekly',
                'biweekly',
                'monthly',
            ])->default('weekly');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
