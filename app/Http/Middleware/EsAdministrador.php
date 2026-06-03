<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdministrador
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Chequeamos si el usuario inició sesión
        // 2. Chequeamos si su rol_id es igual al del Admin (asumiendo que Admin es 1)
        if (auth()->check() && auth()->user()->rol_id == 1) {
            return $next($request); // Lo dejamos pasar
        }

        // Si no es admin, lo rebotamos al home con un mensaje de error
        return redirect()->route('home')->with('error', 'Acceso denegado. Solo el administrador puede ingresar a esta sección.');
    }
}