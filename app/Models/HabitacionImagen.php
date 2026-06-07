<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitacionImagen extends Model
{
    protected $table = 'habitacion_imagenes';
    protected $fillable = ['habitacion_id', 'url', 'principal'];

    // Relación inversa: Una imagen pertenece a una Habitación
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }
}