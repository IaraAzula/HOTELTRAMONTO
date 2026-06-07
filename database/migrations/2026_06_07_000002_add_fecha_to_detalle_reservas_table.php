<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detalle_reservas', function (Blueprint $table) {
            $table->date('fecha_entrada')->nullable()->after('habitacion_id');
            $table->date('fecha_salida')->nullable()->after('fecha_entrada');
        });
    }

    public function down(): void
    {
        Schema::table('detalle_reservas', function (Blueprint $table) {
            $table->dropColumn(['fecha_entrada', 'fecha_salida']);
        });
    }
};
