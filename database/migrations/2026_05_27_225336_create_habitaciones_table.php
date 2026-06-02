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
    Schema::create('habitaciones', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Ej: "Suite Familiar", "Premium Doble"
        $table->text('descripcion')->nullable();
        $table->decimal('precio', 10, 2); // Precio por noche
        $table->string('imagen')->nullable(); // Ruta de la foto
        $table->timestamps();
        
        // BAJA LÓGICA: Crea la columna 'deleted_at' 
        $table->softDeletes(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};