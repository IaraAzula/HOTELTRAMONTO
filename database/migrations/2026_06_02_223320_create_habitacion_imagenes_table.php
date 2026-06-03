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
       Schema::create('habitacion_imagenes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade');
        $table->string('url');
        $table->boolean('principal')->default(false);
        $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacion_imagenes');
    }
};
