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
    // Trae los usuarios de la base de datos
    $usuarios = \App\Models\Usuario::all(); 
    
    return view('admin.usuarios.index', compact('usuarios'));
}

    /**
     * Muestra el formulario de creación/registro de usuario
     */
    public function create()
    {
    $roles = Rol::all(); 
    return view('registro', compact('roles')); 
    }

    /**
     * Valida y registra un nuevo usuario
     */
    /**
     * Valida y registra un nuevo usuario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed', 
            'rol_id' => 'required|exists:roles,id', 
        ]);

        // Guardamos limpio usando el 'only'. El modelo se encarga de encriptar solo.
        Usuario::create($request->only(['nombre', 'apellido', 'email', 'password', 'rol_id']));
        
        return redirect()->route('catalogo')->with('exito', '¡Cuenta creada con éxito! Ya podés iniciar sesión.');
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