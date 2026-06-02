<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- OBLIGATORIO PARA EL BORRADO LÓGICO

class Rol extends Model
{
    use HasFactory, SoftDeletes;

    // Sobreescribe la pluralización en inglés ('rols')
    protected $table = 'roles'; 

    // Columnas permitidas para asignación masiva
    protected $fillable = [
        'nombre', 
        'descripcion',
    ];

    /**
     * Relación: un Rol tiene muchos Usuarios.
     * Se usa en el código como: $rol->usuarios
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}