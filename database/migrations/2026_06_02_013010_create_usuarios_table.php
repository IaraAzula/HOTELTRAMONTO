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
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido');
        $table->string('email')->unique(); // El email no se puede repetir
        $table->string('password'); // Contraseña encriptada
        
        // RELACIÓN: Creamos la columna 'rol_id' que se conecta con la tabla roles
        // Si borramos un rol, se restringe para cuidar la integridad referencial
        $table->foreignId('rol_id')
              ->constrained('roles') // FK hacia tabla roles
              ->onDelete('restrict'); // impide borrar un rol con usuarios
              
        $table->rememberToken(); // token para "Recordarme"
        $table->softDeletes(); // borrado lógico
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
