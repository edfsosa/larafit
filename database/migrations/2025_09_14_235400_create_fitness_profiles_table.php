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
        Schema::create('fitness_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unique()->constrained()->cascadeOnDelete();
            $table->decimal('height', 5, 2)->nullable(); // in centimeters
            $table->decimal('weight', 5, 2)->nullable(); // in kilograms
            $table->enum('workout_location', ['gym', 'home', 'outdoors'])->default('gym');
            $table->json('body_focus_areas')->nullable(); // e.g., ['upper body', 'core']
            $table->enum('experience_level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->integer('weekly_workout_frequency')->default(3);
            $table->json('available_equipment')->nullable(); // e.g., ['dumbbells', 'resistance bands']
            $table->enum('intensity_preference', ['low', 'medium', 'high'])->default('medium');
            $table->enum('workout_duration', ['15-30 minutes', '30-45 minutes', '45-60 minutes', '60+ minutes'])->default('30-45 minutes');
            $table->enum('preferred_workout_time', ['morning', 'afternoon', 'evening'])->default('morning');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_profiles');
    }
};
