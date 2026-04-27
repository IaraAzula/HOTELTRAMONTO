<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nombre de la Conexión de Cola por Defecto
    |--------------------------------------------------------------------------
    | Aquí se define qué motor de colas usará Laravel por defecto.
    | Las colas sirven para ejecutar tareas pesadas en segundo plano.
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Conexiones de Cola
    |--------------------------------------------------------------------------
    | Aquí configuramos todos los "motores" que Laravel soporta.
    */

    'connections' => [

        // Sync: Ejecuta las tareas al instante. No hay espera, pero tampoco "cola".
        'sync' => [
            'driver' => 'sync',
        ],

        // Database: Guarda las tareas pendientes en una tabla de tu base de datos (jobs).
        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ],

        // Beanstalkd: Un sistema externo de colas muy ligero y rápido.
        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        // SQS: El servicio de colas de Amazon (AWS). Para aplicaciones con mucho tráfico.
        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        // Redis: Usa una base de datos en memoria (ultra rápida) para las colas.
        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

        // Deferred y Background: Manejan tareas que se ejecutan después de responder al usuario.
        'deferred' => [
            'driver' => 'deferred',
        ],

        'background' => [
            'driver' => 'background',
        ],

        // Failover: Si la conexión principal falla, salta a la siguiente (ej: de Redis a DB).
        'failover' => [
            'driver' => 'failover',
            'connections' => [
                'database',
                'deferred',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Procesamiento por Lotes (Job Batching)
    |--------------------------------------------------------------------------
    | Permite enviar muchas tareas juntas y tratarlas como un solo grupo.
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tareas de Cola Fallidas
    |--------------------------------------------------------------------------
    | Si una tarea falla (ej: error de servidor), Laravel la guarda aquí 
    | para que no se pierda la información y podamos reintentarla.
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];