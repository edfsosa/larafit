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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the equipment
            $table->text('description')->nullable(); // Detailed description of the equipment
            $table->string('image_path')->nullable(); // Path to an image file
            $table->string('video_url')->nullable(); // URL to a video demonstration
            $table->string('serial_number')->nullable(); // Serial number of the equipment
            $table->string('brand')->nullable(); // Brand of the equipment
            $table->string('model')->nullable(); // Model of the equipment
            $table->enum('type', ['cardio', 'strength', 'flexibility', 'balance', 'mobility'])->default('strength'); // Type of equipment
            $table->enum('status', ['available', 'maintenance', 'out_of_order'])->default('available'); // Status of the equipment
            $table->date('purchased_at')->nullable(); // Date when the equipment was purchased
            $table->date('last_service_at')->nullable(); // Date of the last service
            $table->date('next_service_due')->nullable(); // Date when the next service is due
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
