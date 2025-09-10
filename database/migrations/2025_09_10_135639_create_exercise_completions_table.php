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
        Schema::create('exercise_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_routine_id')->constrained('member_routines')->cascadeOnDelete();
            $table->foreignId('exercise_id')->constrained('exercises')->cascadeOnDelete();
            $table->boolean('completed')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            $table->unique(['member_routine_id', 'exercise_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_completions');
    }
};
