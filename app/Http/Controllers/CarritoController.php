<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\DetalleReserva;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // 1. Ver el carrito
    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    // 2. Agregar una habitación al carrito
    public function agregar($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $carrito = session()->get('carrito', []);

        // Estructuramos el item
        $carrito[$id] = [
            "id" => $habitacion->id,
            "nombre" => $habitacion->nombre,
            "precio" => $habitacion->precio,
            "capacidad" => $habitacion->capacidad
        ];

        session()->put('carrito', $carrito);
        return redirect()->route('catalogo')->with('exito', 'Habitación añadida al carrito de reservas.');
    }

    // 3. Quitar un elemento del carrito
    public function quitar($id)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito.ver')->with('exito', 'Habitación removida.');
    }

    // 4. CONFIRMAR RESERVA (Guarda en BD y Vacía el carrito)
    public function confirmar()
    {
        $carrito = session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()->route('catalogo')->with('error', 'El carrito está vacío.');
        }

        // Calculamos el total
        $total = array_sum(array_column($carrito, 'precio'));

        // Creamos la cabecera de la reserva
        $reserva = Reserva::create([
            'usuario_id' => auth()->id(),
            'total' => $total,
            'estado' => 'confirmada'
        ]);

        // Creamos el detalle de cada habitación reservada
        foreach($carrito as $item) {
            DetalleReserva::create([
                'reserva_id' => $reserva->id,
                'habitacion_id' => $item['id'],
                'precio_unitario' => $item['precio']
            ]);
        }

        // Se vacía el carrito automáticamente
        session()->forget('carrito');

        return redirect()->route('home')->with('exito', '¡Reserva confirmada con éxito!');
    }

    public function ventasAdmin()
{
    // Buscamos todas las reservas con los datos del usuario que las hizo
    // Si no tenés la relación 'usuario' en el modelo, podés usar Reserva::latest()->get()
    $ventas = \App\Models\Reserva::latest()->get();
    return view('admin.ventas.index', compact('ventas'));
}
}