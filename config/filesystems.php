<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disco por Defecto
    |--------------------------------------------------------------------------
    | Aquí elegimos qué "disco" usará el hotel para guardar cosas. 
    | Por defecto usa el disco 'local'.
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Configuración de los Discos
    |--------------------------------------------------------------------------
    | Estos son los distintos lugares donde se pueden almacenar archivos.
    */

    'disks' => [

        // Disco Local: Para archivos privados que el usuario no puede ver desde afuera.
        // Se guardan en storage/app/private.
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        // Disco Público: ¡ESTE ES EL IMPORTANTE! 
        // Aquí se guardan las fotos de las habitaciones del hotel que sí queremos 
        // que se vean en la página web. Se guardan en storage/app/public.
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        // Disco S3: Para guardar archivos en la nube de Amazon (AWS). 
        // Se usa cuando el hotel crece mucho y tiene miles de imágenes.
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Enlaces Simbólicos (Links)
    |--------------------------------------------------------------------------
    | Como la carpeta 'storage' es privada, este comando crea un "atajo" 
    | desde la carpeta 'public' para que el navegador pueda mostrar las fotos.
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
