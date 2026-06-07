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
<<<<<<< HEAD
        'imagen'
=======
        'stock',
        'capacidad',
        'imagen', // Por si guardás la URL o ruta de la foto
>>>>>>> 5eea1545943633cafc56e6b8c05044962d339168
    ];

    public function imagenes()
    {
        return $this->hasMany(HabitacionImagen::class, 'habitacion_id');
    }
}