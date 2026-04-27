<?php

use Illuminate\Support\Str;
use Pdo\Mysql;

return [

    /*
    |--------------------------------------------------------------------------
    | Conexión por Defecto
    |--------------------------------------------------------------------------
    | Aquí Laravel decide a qué base de datos conectarse primero. 
    | Por defecto intenta usar 'sqlite', pero en el archivo .env 
    | solemos cambiarlo a 'mysql'.
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Conexiones Disponibles
    |--------------------------------------------------------------------------
    | Estas son las "puertas" preparadas para distintos tipos de bases de datos.
    */

    'connections' => [

        // SQLite: Guarda toda la base de datos en un solo archivo dentro del proyecto.
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        // MySQL: La que usamos en XAMPP o servidores web.
        // Aquí se configuran el HOST (127.0.0.1), el usuario (root) y la contraseña.
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        // MariaDB: Una versión de código abierto muy parecida a MySQL.
        'mariadb' => [
            'driver' => 'mariadb',
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
        ],

        // PostgreSQL: Otra base de datos muy potente que Laravel ya deja lista.
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'search_path' => 'public',
        ],

        // SQL Server: La base de datos de Microsoft.
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'laravel'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Tabla de Migraciones
    |--------------------------------------------------------------------------
    | Esta tabla ('migrations') es el diario donde Laravel anota qué tablas 
    | ya creó para no intentar crearlas dos veces y dar error.
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Redis
    |--------------------------------------------------------------------------
    | Redis es un sistema de almacenamiento en memoria ultra rápido 
    | que Laravel usa para sesiones o colas de trabajo pesadas.
    */

    'redis' => [
        'client' => env('REDIS_CLIENT', 'phpredis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
        ],
        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
        ],
    ],

];