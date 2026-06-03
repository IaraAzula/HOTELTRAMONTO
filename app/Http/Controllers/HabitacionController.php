<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    // 1. LISTAR (Para que el Admin vea la tabla con botones de editar/borrar)
    public function index()
    {
        // Trae solo las que no están borradas lógicamente
        $habitaciones = Habitacion::all(); 
        return view('habitaciones.index', compact('habitaciones'));
    }

    // 2. FORMULARIO DE ALTA
    public function create()
    {
        return view('habitaciones.create');
    }

    // 3. GUARDAR EN BD (Alta)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
        ]);

        Habitacion::create($request->all());

        return redirect()->route('habitaciones.index')->with('exito', 'Habitación creada correctamente.');
    }

    // 4. FORMULARIO DE EDICIÓN (Modificación)
    public function edit($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('habitaciones.edit', compact('habitacion'));
    }

    // 5. ACTUALIZAR EN BD
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
        ]);

        $habitacion = Habitacion::findOrFail($id);
        $habitacion->update($request->all());

        return redirect()->route('habitaciones.index')->with('exito', 'Habitación actualizada correctamente.');
    }

    // 6. BAJA LÓGICA (Borrado sutil)
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        
        // Al tener SoftDeletes, esto solo va a llenar la columna 'deleted_at'
        $habitacion->delete(); 

        return redirect()->route('habitaciones.index')->with('exito', 'Habitación dada de baja correctamente.');
    }

    // 7. CATÁLOGO PÚBLICO (Para que lo vean todos los clientes del hotel)
    public function catalogo()
    {
        // Trae las habitaciones disponibles (las que no tienen baja lógica)
        $habitaciones = Habitacion::all(); 
        
        // Retorna la vista pública donde mostrás las tarjetas de las habitaciones
        return view('catalogo', compact('habitaciones'));
    }
}