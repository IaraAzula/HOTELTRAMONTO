<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Método UP: Crea las tablas de caché en la base de datos.
     * Se ejecuta al correr 'php artisan migrate'.
     */
    public function up(): void
    {
        // 1. Tabla 'cache': Aquí se guarda la información temporal.
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // El "nombre" del dato guardado (único).
            $table->mediumText('value');      // El contenido del dato (puede ser mucho texto).
            $table->bigInteger('expiration')->index(); // Cuándo debe borrarse automáticamente.
        });

        // 2. Tabla 'cache_locks': Sirve para evitar que dos procesos 
        // escriban el mismo dato al mismo tiempo y rompan algo.
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary(); // Nombre del "candado".
            $table->string('owner');          // Quién puso el candado (qué parte del código).
            $table->bigInteger('expiration')->index(); // Cuándo se libera el candado si algo falla.
        });
    }

    /**
     * Método DOWN: Borra estas tablas si se hace un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};