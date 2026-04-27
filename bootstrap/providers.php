<?php

/**
 * Registro de Service Providers (Proveedores de Servicios)
 * Este archivo devuelve un arreglo con todas las clases de proveedores 
 * que Laravel debe cargar al iniciar.
 */

use App\Providers\AppServiceProvider;

return [
    /**
     * AppServiceProvider: Es el proveedor principal de tu aplicación.
     * Aquí es donde podés configurar cosas globales, como el uso de 
     * Bootstrap para la paginación o reglas personalizadas para la base de datos.
     */
    AppServiceProvider::class,
];