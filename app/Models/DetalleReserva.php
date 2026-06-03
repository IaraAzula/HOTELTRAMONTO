<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'detalle_reservas';

    protected $fillable = [
        'reserva_id', 
        'habitacion_id', 
        'precio_unitario'
    ];
}