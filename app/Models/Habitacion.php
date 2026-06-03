<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Habitacion extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = 'habitaciones';

    
    protected $dates = ['deleted_at']; 

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'capacidad',
        'imagen', // Por si guardás la URL o ruta de la foto
    ];
}