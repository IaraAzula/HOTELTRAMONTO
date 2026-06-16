<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Nombre de la tabla en la base de datos
    protected $table = 'usuarios';

    // Columnas permitidas para asignación masiva
    protected $fillable = [
        'nombre', 
        'apellido',
        'email', 
        'password', 
        'rol_id'
    ];

    // Datos ocultos que nunca se exponen en transformaciones JSON
    protected $hidden = [
        'password', 
        'remember_token'
    ];

    // Hasheo automático de contraseñas al guardar
    protected $casts = [
        'password' => 'hashed',
    ];

   

    /**
     * Relación: un Usuario pertenece a un Rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function reservas() {
    return $this->hasMany(Reserva::class);
}

}