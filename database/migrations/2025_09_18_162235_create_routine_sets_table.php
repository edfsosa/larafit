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
        Schema::create('routine_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routine_exercise_id')->constrained()->cascadeOnDelete();
            $table->integer('sets');
            $table->integer('reps');
            $table->integer('weight')->nullable();
            $table->integer('duration')->nullable(); // in seconds
            $table->integer('distance')->nullable(); // in meters
            $table->integer('rest_time')->nullable(); // in seconds
            $table->timestamps();
            $table->unique(['routine_exercise_id', 'sets']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine_sets');
    }
};
