<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- IMPORTANTE

class Habitacion extends Model
{
    use HasFactory, SoftDeletes; // <-- Activa la baja lógica

    // Le avisamos a Laravel el nombre real de la tabla en español
    protected $table = 'habitaciones';

    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen'];
}
