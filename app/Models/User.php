<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Fillable: Define qué campos se pueden llenar de forma masiva (ej: desde un formulario)
#[Fillable(['name', 'email', 'password'])]

// Hidden: Estos campos NO se enviarán cuando el modelo se convierta a JSON (por seguridad)
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    /** Uso de Traits: 
     * HasFactory: Permite crear usuarios de prueba automáticamente.
     * Notifiable: Permite que este usuario reciba notificaciones (ej: emails). 
     */
    use HasFactory, Notifiable;

    /**
     * Casts (Conversiones):
     * Este método transforma los datos de la base de datos a formatos específicos de PHP.
     */
    protected function casts(): array
    {
        return [
            // Convierte la fecha de verificación de texto a un objeto de tiempo (datetime)
            'email_verified_at' => 'datetime',
            
            // Indica que la contraseña debe guardarse siempre encriptada (hash)
            'password' => 'hashed',
        ];
    }
}