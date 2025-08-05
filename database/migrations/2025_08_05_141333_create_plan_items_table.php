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
        Schema::create('plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_plan_id')->constrained()->onDelete('cascade'); // Foreign key to the associated workout plan
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade'); // Foreign key to the associated exercise
            $table->integer('sets')->default(3); // Number of sets for the exercise
            $table->integer('reps')->default(10); // Number of repetitions for the exercise
            $table->decimal('weight', 8, 2)->nullable(); // Weight used for the exercise, if applicable
            $table->text('notes')->nullable(); // Additional notes for the plan item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_items');
    }
};
