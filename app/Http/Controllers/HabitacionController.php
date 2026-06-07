<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\HabitacionImagen;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    // 1. Muestra el catálogo dinámico para los clientes
    public function catalogo()
    {
        $habitaciones = Habitacion::all();
        return view('catalogo', compact('habitaciones'));
    }

    // 2. Muestra la tabla del CRUD en el panel del Administrador
    public function index()
    {
        $habitaciones = Habitacion::all();
        // Corregido: Apunta a admin.habitaciones.index para mantener tu diseño oscuro
        return view('habitaciones.index', compact('habitaciones'));
    }

    // 3. Formulario de creación de habitaciones
    public function create()
    {
        return view('habitaciones.create');
    }

    // 4. Guarda la habitación y procesa las múltiples imágenes de Iara
    public function store(Request $request)
    {
        // Limpiamos los campos duplicados que traía el archivo
        $habitacion = Habitacion::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'servicios'   => $request->servicios,
            'precio'      => $request->precio,
            'imagen'      => null, // Se controla mediante la tabla intermedia
        ]);

        // Lógica de Iara: Separa las URLs ingresadas por saltos de línea
        if ($request->imagenes) {
            $urls = array_filter(explode("\n", trim($request->imagenes)));
            foreach ($urls as $index => $url) {
                HabitacionImagen::create([
                    'habitacion_id' => $habitacion->id,
                    'url'           => trim($url, " \t\n\r\0\x0B\""),
                    'principal'     => $index === 0, // La primera URL será la principal
                ]);
            }
        }

        return redirect()->route('habitaciones.index');
    }

    // 5. Formulario de edición
    public function edit(Habitacion $habitacion)
    {
        return view('admin.habitaciones.edit', compact('habitacion'));
    }

    // 6. Detalle dinámico de una habitación
    public function show(Habitacion $habitacion)
    {
        $habitacion->load('imagenes');
        return view('habitaciones.show', compact('habitacion'));
    }

    // 7. Procesa la actualización
    public function update(Request $request, Habitacion $habitacion)
    {
        $habitacion->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'imagen'      => $request->imagen,
        ]);

        return redirect()->route('habitaciones.index');
    }

    // 8. Baja lógica (Soft Deletes)
    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();
        return redirect()->route('habitaciones.index');
    }
}