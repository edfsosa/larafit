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
        Schema::create('plan_day_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_day_id')->constrained('plan_days')->cascadeOnDelete();
            $table->foreignId('routine_id')->constrained('routines')->cascadeOnDelete();
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->unique(['plan_day_id', 'routine_id', 'order'], 'day_routine_order_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_day_routines');
    }
};
