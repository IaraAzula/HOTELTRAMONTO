<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\HabitacionImagen;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function catalogo()
    {
        $habitaciones = Habitacion::all();
        return view('catalogo', compact('habitaciones'));
    }

    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('habitaciones.index', compact('habitaciones'));
    }

    public function create()
    {
        return view('habitaciones.create');
    }

    public function store(Request $request)
{
    $habitacion = Habitacion::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'servicios' => $request->servicios,
        'precio' => $request->precio,
        'imagen' => null,
    ]);

    if ($request->imagenes) {
        $urls = array_filter(explode("\n", trim($request->imagenes)));
        foreach ($urls as $index => $url) {
            HabitacionImagen::create([
                'habitacion_id' => $habitacion->id,
                 'url' => trim($url, " \t\n\r\0\x0B\""),
                'principal' => $index === 0,
            ]);
        }
    }

    return redirect()->route('habitaciones.index');
}

    public function edit(Habitacion $habitacion)
    {
        return view('habitaciones.edit', compact('habitacion'));
    }

    public function show(Habitacion $habitacion)
    {
    $habitacion->load('imagenes');
    return view('habitaciones.show', compact('habitacion'));
    }
    public function update(Request $request, Habitacion $habitacion)
    {
        $habitacion->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $request->imagen,
        ]);

        return redirect()->route('habitaciones.index');
    }

    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();
        return redirect()->route('habitaciones.index');
    }
}
