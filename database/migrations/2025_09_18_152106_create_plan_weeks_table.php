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
        Schema::create('plan_weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_phase_id')->constrained()->cascadeOnDelete();
            $table->integer('number');
            $table->timestamps();
            $table->unique(['plan_phase_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_weeks');
    }
};
