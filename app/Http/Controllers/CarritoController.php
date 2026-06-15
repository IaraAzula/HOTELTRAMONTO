<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\DetalleReserva;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Models\Usuario;

class CarritoController extends Controller
{
    // 1. Ver el carrito
    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    // 2. Agregar una habitación al carrito
    public function agregar(Request $request) 
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida'  => 'required|date|after:fecha_entrada',
            'personas'      => 'required|integer|min:1',
        ], [
            'fecha_salida.after' => 'La fecha de salida debe ser posterior a la fecha de entrada.',
            'fecha_entrada.after_or_equal' => 'La fecha de entrada no puede ser anterior al día de hoy.',
            'personas.required' => 'La cantidad de personas es obligatoria.',
            'personas.min' => 'Debe haber al menos 1 persona.',
        ]);

        $id = $request->habitacion_id;

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
            'id'            => $habitacion->id,
            'nombre'        => $habitacion->nombre,
            'precio'        => $habitacion->precio,
            'capacidad'     => $habitacion->capacidad,
            'fecha_entrada' => $fechaEntrada->toDateString(),
            'fecha_salida'  => $fechaSalida->toDateString(),
            'noches'        => $noches,
            'personas'      => (int) $request->personas,
        ];

        session()->put('carrito', $carrito);

        // Guardar en BD
        Carrito::updateOrCreate(
            ['usuario_id' => auth()->id()],
            ['items' => $carrito]
        );

        return redirect()->route('carrito.ver')->with('exito', 'Habitación añadida al carrito con fechas seleccionadas.');
    }

    // 3. Quitar un elemento del carrito
    public function quitar($id)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);

            // Actualizar en BD
            Carrito::updateOrCreate(
                ['usuario_id' => auth()->id()],
                ['items' => $carrito]
            );
        }
        return redirect()->route('carrito.ver')->with('exito', 'Habitación removida.');
    }

    // 4. CONFIRMAR RESERVA
    public function confirmar()
{
    $carrito = session()->get('carrito', []);

    if(empty($carrito)) {
        return redirect()->route('catalogo')->with('error', 'El carrito está vacío.');
    }

    $total = 0;
    // Calculamos el total
    foreach ($carrito as $item) {
        $noches = Carbon::parse($item['fecha_entrada'])->diffInDays(Carbon::parse($item['fecha_salida']));
        $total += $item['precio'] * $noches;
    }

    // Preparamos los datos de la reserva
    $reservaData = [
        'usuario_id' => auth()->id(),
        'total'      => $total,
        'estado'     => 'pendiente_pago', // Cambiamos a pendiente para el flujo de pago
        'fecha_entrada' => Carbon::parse(reset($carrito)['fecha_entrada'])->toDateString(),
        'fecha_salida'  => Carbon::parse(end($carrito)['fecha_salida'])->toDateString(),
    ];

    // Creamos la reserva
    $reserva = Reserva::create($reservaData);

    // Creamos los detalles
    foreach ($carrito as $item) {
        DetalleReserva::create([
            'reserva_id'      => $reserva->id,
            'habitacion_id'   => $item['id'],
            'precio_unitario' => $item['precio'],
            'personas'        => $item['personas'] ?? 1,
            'fecha_entrada'   => $item['fecha_entrada'],
            'fecha_salida'    => $item['fecha_salida'],
        ]);
    }

    // IMPORTANTE: No borramos el carrito ni hacemos flash todavía.
    // Redirigimos al pago pasando el ID de la reserva.
    return redirect()->route('reservas.pago', $reserva->id);
}

    // Renderiza la tarjeta de éxito
    public function exito()
    {
        $datosReserva = session('ultima_reserva');

        if (!$datosReserva) {
            return redirect()->route('catalogo');
        }
     
        return view('carrito.exito', compact('datosReserva'));
    }

    public function ventasAdmin()
    {
        $ventas = \App\Models\Reserva::latest()->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function consultasAdmin()
    {   
        $consultas = collect([]);
        return view('admin.consultas.index', compact('consultas'));
    }

    public function usuariosAdmin()
    {
        $administradores = \App\Models\Usuario::where('rol_id', 'admin')->get(); 
        $clientes = \App\Models\Usuario::where('rol_id', 'cliente')->get();
        return view('admin.usuarios.index', compact('administradores', 'clientes'));
    }

    public function dashboardAdmin()
    {
        $ventasTotales  = \App\Models\Reserva::sum('total') ?: 666000;
        $totalPedidos   = \App\Models\Reserva::count() ?: 2;
        $ticketPromedio = $totalPedidos > 0 ? ($ventasTotales / $totalPedidos) : 333000;
        $reservas       = \App\Models\Reserva::with('usuario')->get();
        $totalUsuarios  = \App\Models\Usuario::count() ?: 2;
        $ultimasVentas  = \App\Models\Reserva::with('usuario')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'reservas', 
            'ventasTotales', 
            'totalPedidos', 
            'ticketPromedio', 
            'totalUsuarios', 
            'ultimasVentas'
        ));
    }

    public function storeAdmin(Request $request) 
    {
        $request->validate([
            'nombre'   => 'required',
            'apellido' => 'required',
            'email'    => 'required|email|unique:usuarios,email',
        ], [
            'email.unique' => 'El correo electrónico ingresado ya se encuentra registrado.',
        ]);

        $rolAdmin = \App\Models\Rol::where('nombre', 'Admin')->first();

        \App\Models\Usuario::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'rol_id'   => $rolAdmin ? $rolAdmin->id : 1,
            'password' => bcrypt('password123') 
        ]);

        return redirect()->route('admin.usuarios')->with('success', 'Administrador creado correctamente');
    }

    public function editAdmin($id)
    {
        $usuario = \App\Models\Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $usuario = \App\Models\Usuario::findOrFail($id);
        
        $usuario->update([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
        ]);

        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado correctamente');
    }

    public function detalleReserva($id)
    {
        $reserva = \App\Models\Reserva::with('detalles.habitacion', 'usuario')->findOrFail($id);
        return view('admin.reservas.detalle', compact('reserva'));
    }

    public function procesarPago($id)
{
    $reserva = \App\Models\Reserva::findOrFail($id);
    
    // Aquí actualizamos el estado de la reserva
    $reserva->update(['estado' => 'confirmada']);

    // Limpiamos los datos de la sesión
    session()->forget('carrito');
    \App\Models\Carrito::where('usuario_id', auth()->id())->delete();

    // Guardamos el mensaje de éxito para la siguiente vista
    session()->flash('ultima_reserva', [
        'codigo' => str_pad($reserva->id, 6, '0', STR_PAD_LEFT),
        'total'  => $reserva->total,
    ]);

    return redirect()->route('reserva.exito');
}
}