<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Clase UserFactory
 * Esta clase se encarga de generar datos falsos (dummy data) para la tabla de Usuarios.
 */
class UserFactory extends Factory
{
    /**
     * Propiedad para la contraseña.
     * Guardamos la contraseña encriptada aquí para no tener que 
     * encriptarla cada vez que creamos un usuario (lo que haría todo más lento).
     */
    protected static ?string $password;

    /**
     * Definición del estado por defecto del modelo.
     * Aquí le decimos qué datos "inventar" para cada columna de la tabla.
     */
    public function definition(): array
    {
        return [
            // Genera un nombre falso (ej: "Juan Pérez")
            'name' => fake()->name(),
            
            // Genera un mail único y con formato válido
            'email' => fake()->unique()->safeEmail(),
            
            // Marca que el mail ya está verificado con la fecha y hora actual
            'email_verified_at' => now(),
            
            // Asigna la contraseña 'password' encriptada por defecto
            'password' => static::$password ??= Hash::make('password'),
            
            // Genera un código aleatorio de 10 caracteres para la sesión persistente
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Estado: Sin verificar.
     * Si llamamos a este método, el usuario se creará con el campo
     * 'email_verified_at' en null (como si no hubiera confirmado su cuenta).
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
