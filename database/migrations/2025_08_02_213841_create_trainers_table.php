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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->unique();
            $table->string('name');
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('photo_path')->nullable();
            $table->text('bio')->nullable();
            $table->enum('specialty', [
                'strength_training',
                'cardio',
                'yoga',
                'pilates',
                'nutrition',
                'crossfit',
            ])->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
