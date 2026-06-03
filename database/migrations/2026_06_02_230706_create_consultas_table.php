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
    Schema::create('consultas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('email');
        $table->string('asunto', 150);
        $table->text('mensaje');
        $table->timestamps(); // Guarda la fecha y hora de la consulta (created_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
