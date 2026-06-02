<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Muestra el listado de usuarios con su relación (Evita consultas N+1)
     */
    public function index()
    {
        // with('rol') carga la relación de manera eficiente
        $usuarios = Usuario::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario de creación/registro de usuario
     */
    public function create()
    {
        $roles = Rol::all(); // Necesario para el select de roles en el formulario
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Valida y registra un nuevo usuario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed', // busca el campo password_confirmation
            'rol_id' => 'required|exists:roles,id', // valida que el rol exista en la tabla roles
        ]);

        // Gracias al cast 'hashed' que pusimos en el Modelo Usuario,
        // Laravel va a encriptar la password automáticamente acá.
        Usuario::create($request->only(['nombre', 'email', 'password', 'rol_id']));
        
        return redirect()->route('usuarios.index')->with('exito', 'Usuario registrado.');
    }

    public function show(Usuario $usuario) {}
    public function edit(Usuario $usuario) {}
    public function update(Request $request, Usuario $usuario) {}

    /**
     * Baja lógica del usuario
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete(); // borrado lógico (setea deleted_at)
        return redirect()->route('usuarios.index')->with('exito', 'Usuario dado de baja.');
    }
}