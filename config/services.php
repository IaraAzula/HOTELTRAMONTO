<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Servicios de Terceros
    |--------------------------------------------------------------------------
    | Este archivo sirve para guardar las credenciales (llaves, tokens, IDs) 
    | de servicios externos como Amazon, Slack o gestores de correos.
    */

    // Postmark: Un servicio profesional para enviar correos electrónicos.
    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    // Resend: Otra plataforma moderna para envío de mails comerciales.
    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    // SES (Amazon Simple Email Service): El servicio de correos de Amazon AWS.
    // Aquí se guardan la llave de acceso, la clave secreta y la región (ej: us-east-1).
    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // Slack: Configuración para que el sistema de Hotel Tramonto pueda enviar
    // notificaciones automáticas a un chat de Slack.
    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'), // Token del bot
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'), // Canal por defecto
        ],
    ],

];