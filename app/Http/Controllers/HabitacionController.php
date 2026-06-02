<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{

     public function catalogo()
    {
        // Trae todas las habitaciones de MariaDB que NO tengan baja lógica
        $habitaciones = Habitacion::all();

        // Te manda a la vista 'catalogo' pasándole la variable
        return view('catalogo', compact('habitaciones'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $productos = Habitacion::all();

    return view('habitaciones.index', compact('habitaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
   {
    return view('habitaciones.create');
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       Producto::create([
        'nombre' => $request->nombre,
        'tipo' => $request->tipo,
        'precio' => $request->precio,
        'disponible' => $request-> true,
    ]);

    return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
