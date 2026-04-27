<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de Sesión por Defecto
    |--------------------------------------------------------------------------
    | Aquí elegimos dónde se guarda la información de los usuarios conectados.
    | Al usar 'database', Laravel guarda las sesiones en una tabla de la DB.
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Duración de la Sesión
    |--------------------------------------------------------------------------
    | Define cuántos minutos puede estar un usuario inactivo antes de que 
    | se le cierre la sesión automáticamente (por defecto 120 minutos).
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    // Si se pone en 'true', la sesión se cierra apenas el usuario cierra el navegador.
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Encriptación de Sesión
    |--------------------------------------------------------------------------
    | Si se activa (true), todos los datos de la sesión se guardan cifrados
    | para mayor seguridad de los clientes del hotel.
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Ubicación de Archivos de Sesión
    |--------------------------------------------------------------------------
    | Si usáramos el driver 'file', aquí es donde se guardarían los archivos.
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Tabla de Sesiones en la Base de Datos
    |--------------------------------------------------------------------------
    | Como usás el driver 'database', aquí definimos que la tabla se llama 'sessions'.
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Lotería de Limpieza (Lottery)
    |--------------------------------------------------------------------------
    | Laravel elimina sesiones viejas automáticamente. Aquí dice que hay 
    | un 2% de probabilidades de que limpie la tabla en cada petición.
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nombre de la Cookie de Sesión
    |--------------------------------------------------------------------------
    | Es el nombre de la "galletita" que se guarda en el navegador del cliente.
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Seguridad de la Cookie
    |--------------------------------------------------------------------------
    */

    // 'path' y 'domain' definen en qué URL es válida la sesión.
    'path' => env('SESSION_PATH', '/'),
    'domain' => env('SESSION_DOMAIN'),

    // 'secure': si es true, la sesión solo funciona en páginas con HTTPS.
    'secure' => env('SESSION_SECURE_COOKIE'),

    // 'http_only': protege la cookie para que no pueda ser robada por scripts de JavaScript.
    'http_only' => env('SESSION_HTTP_ONLY', true),

    // 'same_site': previene ataques de tipo CSRF (Falsificación de Petición en Sitios Cruzados).
    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Serialización
    |--------------------------------------------------------------------------
    | Cómo se guarda el formato de los datos. 'json' es el estándar más seguro.
    */

    'serialization' => 'json',

];
