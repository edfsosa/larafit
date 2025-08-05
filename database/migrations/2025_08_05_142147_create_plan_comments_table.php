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
        Schema::create('plan_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_plan_id')->constrained()->onDelete('cascade'); // Foreign key to the associated workout plan
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Foreign key to the user who made the comment
            $table->text('comment'); // The comment text
            $table->boolean('completed')->default(false); // Whether the comment is marked as completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_comments');
    }
};
