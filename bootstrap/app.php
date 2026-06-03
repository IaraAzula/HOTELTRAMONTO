<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Iniciamos la configuración de la aplicación definiendo la ruta base del proyecto
return Application::configure(basePath: dirname(__DIR__))
    
    // 2. Configuración de Rutas: Aquí le decimos a Laravel dónde buscar los archivos de rutas
    ->withRouting(
        web: __DIR__.'/../routes/web.php',      // Rutas para la web (Hotel Tramonto)
        commands: __DIR__.'/../routes/console.php', // Rutas para comandos de terminal
        health: '/up',                          // Una ruta automática para verificar si el sitio está online
    )
    
    // 3. Middlewares: Capas de seguridad y procesamiento
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 🚀 REGISTRAMOS EL ALIAS PARA EL MIDDLEWARE DE ADMINISTRADOR
        $middleware->alias([
            'admin' => \App\Http\Middleware\EsAdministrador::class,
        ]);

    })
    
    // 4. Manejo de Excepciones: Cómo reacciona el sistema ante errores
    ->withExceptions(function (Exceptions $exceptions): void {
    })
    
    // 5. Crea e inicia la instancia de la aplicación con toda la configuración anterior
    ->create();