<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- OBLIGATORIO PARA EL BORRADO LÓGICO
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable para el login
use Illuminate\Notifications\Notifiable; // <-- AGREGADO SEGÚN EL PDF

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Nombre de la tabla en castellano
    protected $table = 'usuarios';

    // Columnas permitidas para asignación masiva
    protected $fillable = [
        'nombre', 
        'email', 
        'password', 
        'rol_id'
    ];

    // Datos ocultos que nunca se exponen al transformar a JSON (por ejemplo, en APIs)
    protected $hidden = [
        'password', 
        'remember_token'
    ];

    /**
     * Catea y hashea automáticamente la contraseña al asignar
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: un Usuario pertenece a un Rol.
     * Se usa en el código como: $usuario->role
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}