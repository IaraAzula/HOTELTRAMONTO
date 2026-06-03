<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitacionImagen extends Model
{
    protected $table = 'habitacion_imagenes';
    protected $fillable = ['habitacion_id', 'url', 'principal'];
}
