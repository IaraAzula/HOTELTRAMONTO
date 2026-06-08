<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    // Muestra la página correspondiente según el rol
    public function index()
{
    // 1. Validamos que el usuario esté logueado
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $usuarioLogueado = auth()->user();

    // 👑 2. Si el rol_id es 1 (Administrador), ve el listado de consultas
    if ($usuarioLogueado->rol_id == 1) {
        $consultas = \App\Models\Consulta::latest()->get(); 
        return view('admin.consultas.index', compact('consultas'));
    }

    // 👤 3. Si es cualquier otro rol (Cliente/rol_id: 2), ve el formulario suelto
    return view('consultas');
}

    public function store(Request $request)
    {
        // 1. Validamos únicamente lo que el usuario escribe ahora
        $request->validate([
            'asunto' => 'required|string|max:150',
            'mensaje' => 'required|string|min:10',
        ], [
            'asunto.required' => 'El asunto no puede quedar vacío.',
            'mensaje.required' => 'Escribí el contenido de tu consulta.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
        ]);

        // 2. Tomamos el usuario autenticado
        $usuarioLogueado = auth()->user();

        // 3. Guardamos en la base de datos combinando los datos de la sesión y el formulario
        Consulta::create([
            'nombre' => $usuarioLogueado->nombre . ' ' . $usuarioLogueado->apellido, // Registra su nombre completo
            'email'  => $usuarioLogueado->email,                                    // Registra su mail oficial
            'asunto' => $request->asunto,
            'mensaje' => $request->mensaje,
        ]);

        return back()->with('exito_consulta', '¡Tu consulta fue enviada con éxito! Nos comunicaremos con vos a tu correo registrado.');
    }
}