<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sistema de Envío por Defecto
    |--------------------------------------------------------------------------
    | Aquí elegimos qué método usaremos para mandar mails. 
    | Por defecto está en 'log', lo que significa que el mail no se manda de verdad,
    | sino que se escribe en el archivo de texto storage/logs/laravel.log (ideal para pruebas).
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Configuraciones de los "Mailers"
    |--------------------------------------------------------------------------
    | Aquí definimos las diferentes formas de enviar correos.
    */

    'mailers' => [

        // SMTP: Es el más común (el que usa Gmail o Outlook). 
        // Se necesita host, puerto, usuario y contraseña.
        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        // SES, Postmark, Resend: Son servicios profesionales en la nube 
        // para mandar miles de mails sin caer en SPAM.
        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        // Log: En lugar de mandar el mail, lo escribe en una carpeta local.
        // Es muy seguro para nosotros mientras estamos programando.
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        // Array: Guarda los mails en una lista temporal solo para hacer tests.
        'array' => [
            'transport' => 'array',
        ],

        // Failover: Si el sistema principal (SMTP) falla, intenta mandarlo por el 'log'.
        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Dirección del Remitente Global
    |--------------------------------------------------------------------------
    | Aquí configuramos qué mail y qué nombre verá el cliente cuando 
    | reciba un mensaje del hotel (Ej: "Hotel Tramonto <reservas@tramonto.com>").
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'reservas@hoteltramonto.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Hotel Tramonto')),
    ],

];