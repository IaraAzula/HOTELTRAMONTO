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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            // Relación con la tabla usuarios (quién hace la reserva)
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            // Monto total a abonar por la reserva
            $table->decimal('total', 10, 2);
            // Estado para el control de auditoría
            $table->string('estado')->default('confirmada'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};