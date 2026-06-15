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
    Schema::table('detalle_reservas', function (Blueprint $table) {
        $table->unsignedInteger('personas')->default(1)->after('precio_unitario');
    });
}

public function down(): void
{
    Schema::table('detalle_reservas', function (Blueprint $table) {
        $table->dropColumn('personas');
    });
}
};
