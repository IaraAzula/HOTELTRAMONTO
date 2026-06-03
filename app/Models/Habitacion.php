<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'habitaciones';

    protected $fillable = ['nombre', 'descripcion', 'servicios', 'precio', 'imagen'];

    public function imagenes()
    {
        return $this->hasMany(HabitacionImagen::class);
    }

    public function imagenPrincipal()
    {
        return $this->hasOne(HabitacionImagen::class)->where('principal', true);
    }
}