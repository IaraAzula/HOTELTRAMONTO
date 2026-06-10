<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    // El nombre de la tabla en tu base de datos
    protected $table = 'reservas';

    // 🚀 AHORA SÍ: Adentro de la clase para permitir la asignación masiva
    protected $fillable = [
        'usuario_id',
        'total',
        'estado',
        'fecha_entrada',
        'fecha_salida'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleReserva::class, 'reserva_id');
    }
        public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}