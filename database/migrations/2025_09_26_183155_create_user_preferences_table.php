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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();
            $table->enum('language', ['es', 'en', 'fr', 'de'])->default('es');
            $table->enum('theme', ['light', 'dark', 'system'])->default('system');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('push_notifications')->default(true);
            $table->enum('unit_system', ['metric', 'imperial'])->default('metric');
            $table->boolean('show_tutorials')->default(true);
            $table->boolean('show_calories')->default(true);
            $table->boolean('show_equipment_tips')->default(true);
            $table->json('extra_preferences')->nullable(); // For future extensibility            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
