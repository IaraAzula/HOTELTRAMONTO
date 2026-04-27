<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Método UP: Se ejecuta al correr 'php artisan migrate'.
     * Sirve para CREAR las tablas en la base de datos.
     */
    public function up(): void
    {
        // 1. Creación de la tabla 'users' (Usuarios)
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crea una clave primaria autoincremental
            $table->string('name'); // Columna para el nombre completo
            $table->string('email')->unique(); // Columna para el correo, no se puede repetir
            $table->timestamp('email_verified_at')->nullable(); // Fecha de verificación (puede ser nula)
            $table->string('password'); // Columna para la contraseña encriptada
            $table->rememberToken(); // Columna especial para la sesión de "recordarme"
            $table->timestamps(); // Crea automáticamente 'created_at' y 'updated_at'
        });

        // 2. Creación de la tabla para recuperación de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // El mail es la clave primaria aquí
            $table->string('token'); // Código temporal para resetear la clave
            $table->timestamp('created_at')->nullable(); // Cuándo se pidió el cambio
        });

        // 3. Creación de la tabla 'sessions'
        // Aquí se guarda quién está conectado si usamos el driver de base de datos.
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID único de la sesión
            $table->foreignId('user_id')->nullable()->index(); // ID del usuario conectado (relación)
            $table->string('ip_address', 45)->nullable(); // IP desde donde se conecta
            $table->text('user_agent')->nullable(); // Navegador y dispositivo usado
            $table->longText('payload'); // Datos de la sesión (encriptados)
            $table->integer('last_activity')->index(); // Última vez que el usuario hizo algo
        });
    }

    /**
     * Método DOWN: Se ejecuta al correr 'php artisan migrate:rollback'.
     * Sirve para BORRAR las tablas si nos equivocamos o queremos resetear.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};