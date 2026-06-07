<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class ReservaController extends Controller
{
    // 1. Guarda la habitación y las fechas en la sesión
    public function agregar(Request $request)
    {
        // Validamos que entren las fechas básicas (pueden agregar check-out después)
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
        ]);

        $habitacion = Habitacion::find($request->habitacion_id);

        // Armamos el array con los datos del "carrito"
        $carrito = [
            'id' => $habitacion->id,
            'nombre' => $habitacion->nombre,
            'precio' => $habitacion->precio,
            'imagen' => $habitacion->imagen, // Si usan fotos guardadas
        ];

        // Guardamos el array en la sesión de Laravel bajo la clave 'reserva_temporal'
        session(['reserva_temporal' => $carrito]);

        // Redirigimos al usuario a la pantalla del resumen del carrito
        return redirect()->route('carrito.ver')->with('success', 'Habitación seleccionada con éxito.');
    }

    // 2. Muestra la pantalla del carrito con los datos de la sesión
    public function verCarrito()
    {
        // Recuperamos lo que haya en la sesión
        $reserva = session('reserva_temporal');

        return view('carrito.index', compact('reserva'));
    }
}