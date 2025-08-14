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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the exercise
            $table->text('description')->nullable(); // Detailed description of the exercise
            $table->string('image_path')->nullable(); // Path to an image file
            $table->string('video_url')->nullable(); // URL to a video demonstration
            $table->enum('type', ['cardio', 'strength', 'flexibility', 'balance', 'mobility'])->default('cardio'); // Type of exercise
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced'])->default('beginner'); // Difficulty level
            $table->foreignId('equipment_id')->nullable()->constrained('equipment')->cascadeOnDelete(); // Foreign key to the equipment, nullable if no equipment is required
            $table->foreignId('muscle_group_id')->constrained('muscle_groups')->cascadeOnDelete(); // Foreign key to the muscle group
            $table->integer('default_sets')->default(3); // Default number of sets
            $table->integer('default_reps')->default(10); // Default number of repetitions
            $table->integer('default_rest_period')->default(60); // Default rest period in seconds
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
