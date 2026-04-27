<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Canal de Logs por Defecto
    |--------------------------------------------------------------------------
    | Aquí se define qué canal se usa para escribir los mensajes de error.
    | El valor 'stack' significa que puede usar varios canales al mismo tiempo.
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Canal de Depreciaciones
    |--------------------------------------------------------------------------
    | Esto controla dónde se guardan los avisos sobre funciones viejas de PHP
    | que van a dejar de funcionar pronto. Ayuda a mantener el código al día.
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Canales de Log
    |--------------------------------------------------------------------------
    | Aquí configuramos los distintos lugares donde el Hotel Tramonto 
    | puede anotar lo que pasa. Usamos la librería Monolog.
    */

    'channels' => [

        // Stack: Agrupa varios canales (por defecto usa el canal 'single').
        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', (string) env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        // Single: Guarda todo en un ÚNICO archivo de texto.
        // Ruta: storage/logs/laravel.log
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        // Daily: Crea un archivo por día (ej: laravel-2026-04-28.log).
        // Borra los archivos que tengan más de 14 días para no llenar el disco.
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        // Slack: Si hay un error crítico, manda un mensaje a un canal de Slack.
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', env('APP_NAME', 'Laravel')),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        // Papertrail: Envía los errores a un servicio externo en la nube.
        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        // Null: Un "agujero negro". Lo que se manda acá no se guarda en ningún lado.
        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        // Emergency: Canal de emergencia por si el archivo principal falla.
        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

];