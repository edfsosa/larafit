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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('notifiable'); // puede ser Member, Trainer, User, etc.
            $table->string('title')->nullable(); // Título del mensaje
            $table->text('body'); // Contenido de la notificación
            $table->enum('type', ['routine_reminder', 'membership_expiry', 'custom', 'system'])->default('custom');
            $table->timestamp('scheduled_at')->nullable(); // Para notificaciones programadas
            $table->timestamp('sent_at')->nullable();      // Marca cuándo fue enviada
            $table->boolean('is_read')->default(false);    // Para saber si el usuario ya la vio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
