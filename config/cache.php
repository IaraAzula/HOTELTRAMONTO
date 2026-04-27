<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Almacén de Caché por Defecto
    |--------------------------------------------------------------------------
    | Aquí elegimos qué sistema usará el Hotel Tramonto para guardar datos 
    | temporales. Actualmente está configurado para usar la 'database'.
    */

    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Depósitos de Caché (Stores)
    |--------------------------------------------------------------------------
    | Aquí definimos todas las opciones de "estantes" donde podemos guardar 
    | información para que la web cargue más rápido.
    */

    'stores' => [

        // Opción Array: El caché solo dura lo que dura una petición. Al recargar se borra.
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        // Opción Database: Crea una tabla 'cache' en tu DB para guardar los datos.
        // Es la que estás usando actualmente por defecto.
        'database' => [
            'driver' => 'database',
            'connection' => env('DB_CACHE_CONNECTION'),
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
            'lock_table' => env('DB_CACHE_LOCK_TABLE'),
        ],

        // Opción File: Guarda el caché en carpetas dentro de storage/framework/cache.
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        // Opción Redis: Un sistema ultra rápido para proyectos muy grandes (producción).
        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
            'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
        ],

        // Las opciones de abajo (Memcached, DynamoDB, Octane) son otros sistemas 
        // de almacenamiento que Laravel ya deja preparados por si el proyecto crece.
        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Prefijo de la Llave de Caché
    |--------------------------------------------------------------------------
    | Esto le pone un "nombre" a tus datos (ej: hotel-tramonto-cache-) 
    | para que no se mezclen con otros proyectos en el mismo servidor.
    */

    'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),

];