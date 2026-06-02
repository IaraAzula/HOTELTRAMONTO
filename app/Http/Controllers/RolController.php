<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Muestra el listado de roles
     */
    public function index()
    {
        $roles = Rol::all(); // SoftDelete filtra deleted_at automáticamente
        return view('roles.index', compact('roles'));
    }

    public function create() {}

    /**
     * Guarda un nuevo rol validado
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:roles',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Rol::create($request->only(['nombre', 'descripcion'])); // usa $fillable del Model
        return redirect()->route('roles.index')->with('exito', 'Rol creado.');
    }

    public function show(Rol $rol) {}
    public function edit(Rol $rol) {}
    public function update(Request $request, Rol $rol) {}

    /**
     * Borrado lógico del rol
     */
    public function destroy(Rol $rol)
    {
        $rol->delete(); // SoftDelete: setea deleted_at, no borra la fila
        return redirect()->route('roles.index')->with('exito', 'Rol eliminado.');
    }
}