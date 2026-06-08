<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\DetalleReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CarritoController extends Controller
{
    // 1. Ver el carrito
    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    // 2. Agregar una habitación al carrito
    public function agregar(Request $request) 
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id', // Validamos que llegue el id
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida'  => 'required|date|after:fecha_entrada',
        ]);

        $id = $request->habitacion_id; // Recuperamos el id desde el formulario

        $habitacion = Habitacion::findOrFail($id);
        $fechaEntrada = Carbon::parse($request->fecha_entrada);
        $fechaSalida = Carbon::parse($request->fecha_salida);
        $noches = $fechaEntrada->diffInDays($fechaSalida);

        $hayConflicto = false;

        if (Schema::hasColumn('detalle_reservas', 'fecha_entrada') && Schema::hasColumn('detalle_reservas', 'fecha_salida')) {
            $hayConflicto = Reserva::whereHas('detalles', function ($query) use ($id, $fechaEntrada, $fechaSalida) {
                $query->where('habitacion_id', $id)
                    ->where('fecha_entrada', '<', $fechaSalida->toDateString())
                    ->where('fecha_salida', '>', $fechaEntrada->toDateString());
            })->exists();
        }

        if ($hayConflicto) {
            return back()->with('error', 'La habitación no está disponible en esas fechas.');
        }

        $carrito = session()->get('carrito', []);

        $carrito[$id] = [
            'id' => $habitacion->id,
            'nombre' => $habitacion->nombre,
            'precio' => $habitacion->precio,
            'capacidad' => $habitacion->capacidad,
            'fecha_entrada' => $fechaEntrada->toDateString(),
            'fecha_salida' => $fechaSalida->toDateString(),
            'noches' => $noches,
        ];

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.ver')->with('exito', 'Habitación añadida al carrito con fechas seleccionadas.');
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
    // 4. CONFIRMAR RESERVA (Guarda en BD, prepara la pantalla de éxito y vacía el carrito)
    public function confirmar()
    {
        $carrito = session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()->route('catalogo')->with('error', 'El carrito está vacío.');
        }

        $total = 0;
        $tieneFechasReserva = Schema::hasColumn('reservas', 'fecha_entrada') && Schema::hasColumn('reservas', 'fecha_salida');
        $tieneFechasDetalle = Schema::hasColumn('detalle_reservas', 'fecha_entrada') && Schema::hasColumn('detalle_reservas', 'fecha_salida');

        foreach ($carrito as $item) {
            $noches = Carbon::parse($item['fecha_entrada'])->diffInDays(Carbon::parse($item['fecha_salida']));
            $total += $item['precio'] * $noches;
        }

        $reservaData = [
            'usuario_id' => auth()->id(),
            'total' => $total,
            'estado' => 'confirmada',
        ];

        if ($tieneFechasReserva) {
            $reservaData['fecha_entrada'] = Carbon::parse(reset($carrito)['fecha_entrada'])->toDateString();
            $reservaData['fecha_salida'] = Carbon::parse(end($carrito)['fecha_salida'])->toDateString();
        }

        $reserva = Reserva::create($reservaData);

        foreach ($carrito as $item) {
            $detalleData = [
                'reserva_id' => $reserva->id,
                'habitacion_id' => $item['id'],
                'precio_unitario' => $item['precio'],
            ];

            if ($tieneFechasDetalle) {
                $detalleData['fecha_entrada'] = $item['fecha_entrada'];
                $detalleData['fecha_salida'] = $item['fecha_salida'];
            }

            DetalleReserva::create($detalleData);
        }

        // 🚀 PASO CLAVE: Guardamos una copia del carrito y el ID de la reserva en la sesión flash 
        // antes de destruirlo, para poder mostrar los datos en la tarjeta de éxito.
        session()->flash('ultima_reserva', [
            'codigo' => str_pad($reserva->id, 6, '0', STR_PAD_LEFT),
            'total' => $total,
            'items' => $carrito
        ]);

        // Se vacía el carrito automáticamente
        session()->forget('carrito');

        // Redirigimos a la nueva ruta de éxito de la reserva
        return redirect()->route('reserva.exito');
    }

    // 🚀 NUEVA FUNCIÓN: Renderiza la tarjeta de éxito con los datos reales
    public function exito()
    {
        $datosReserva = session('ultima_reserva');

        // Si intentan entrar a /reserva/exito escribiendo la URL a mano sin reservar nada, los saca
        if (!$datosReserva) {
            return redirect()->route('catalogo');
        }

        return view('carrito.exito', compact('datosReserva'));
    }

    public function ventasAdmin()
{
    // Buscamos todas las reservas con los datos del usuario que las hizo
    // Si no tenés la relación 'usuario' en el modelo, podés usar Reserva::latest()->get()
    $ventas = \App\Models\Reserva::latest()->get();
    return view('admin.ventas.index', compact('ventas'));
}
}