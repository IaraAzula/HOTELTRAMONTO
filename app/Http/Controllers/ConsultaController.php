<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    // Muestra la página del formulario
   public function index()
    {
    // Trae todas las consultas de la base de datos
    $consultas = \App\Models\Consulta::latest()->get(); 
    return view('admin.consultas.index', compact('consultas'));
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