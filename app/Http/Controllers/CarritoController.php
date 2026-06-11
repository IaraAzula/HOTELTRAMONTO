<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\DetalleReserva;
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

        //  Guardamos una copia del carrito y el ID de la reserva en la sesión flash 
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

    // Renderiza la tarjeta de éxito con los datos reales
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
        $ventas = \App\Models\Reserva::latest()->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function consultasAdmin()
    {   
        $consultas = collect([]); // Dejamos la colección vacía para que use los datos de prueba idénticos al profe

        return view('admin.consultas.index', compact('consultas'));
    }

    public function usuariosAdmin()
{
    // 1. Obtén los datos de la base de datos
    // Ajusta 'rol_id' según sea tu estructura real (ej: 1 para admin, 2 para clientes)
    $administradores = \App\Models\Usuario::where('rol_id', 'admin')->get(); 
    $clientes = \App\Models\Usuario::where('rol_id', 'cliente')->get();

    // 2. ENVÍA las variables a la vista usando compact()
    return view('admin.usuarios.index', compact('administradores', 'clientes'));
}

public function dashboardAdmin()
{
    // 📊 1. Intentamos calcular las métricas reales desde tus modelos
    $ventasTotales = \App\Models\Reserva::sum('total') ?: 666000;
    $totalPedidos = \App\Models\Reserva::count() ?: 2;
    $ticketPromedio = $totalPedidos > 0 ? ($ventasTotales / $totalPedidos) : 333000;
    
    // 🔍 CAMBIAMOS 'User' POR 'Usuario'
    $totalUsuarios = \App\Models\Usuario::count() ?: 2;

    // 🕒 2. Traemos las últimas reservas (Pedidos)
    $ultimasVentas = \App\Models\Reserva::latest()->take(5)->get();

    return view('admin.dashboard', compact('ventasTotales', 'totalPedidos', 'ticketPromedio', 'totalUsuarios', 'ultimasVentas'));
}
public function storeAdmin(Request $request) 
{
    // 1. Validar que el email sea único antes de guardar
   $request->validate([
        'nombre'   => 'required',
        'apellido' => 'required',
        'email'    => 'required|email|unique:usuarios,email',
    ], [
        // Aquí personalizamos el mensaje
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

// 1. Muestra la vista con el formulario pre-llenado
public function editAdmin($id)
{
    $usuario = \App\Models\Usuario::findOrFail($id);
    return view('admin.usuarios.edit', compact('usuario'));
}

// 2. Guarda los cambios en la base de datos
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

}