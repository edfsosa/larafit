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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_membership_id')->constrained('member_memberships')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->enum('method', ['credit_card', 'debit_card', 'paypal', 'bank_transfer', 'cash', 'qr_code']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
