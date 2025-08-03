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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')
                ->constrained('members')
                ->onDelete('cascade');
            $table->foreignId('membership_type_id')
                ->constrained('membership_types');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->unique(['member_id', 'start_date', 'end_date'], 'memberships_unique_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
