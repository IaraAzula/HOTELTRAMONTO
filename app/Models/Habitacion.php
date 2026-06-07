<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitacion extends Model
{
    use SoftDeletes; // Tu baja lógica obligatoria

    protected $table = 'habitaciones';

    protected $fillable = [
        'nombre',
        'descripcion',
        'servicios',
        'precio',
        'stock',
        'capacidad',
        'imagen',
    ];

    public function imagenes()
    {
        return $this->hasMany(HabitacionImagen::class, 'habitacion_id');
    }
}