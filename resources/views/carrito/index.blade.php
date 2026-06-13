
@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <h2 class="mb-4" style="color: #C7B25D;">Mi Carrito de Reservas</h2>

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="card bg-dark border-secondary shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="mi-tabla-oscura" style="width: 100%; background-color: #0d1117 !important;">
    <thead>
        <tr style="background-color: #0d1117 !important; color: #C7B25D !important;">
            <th style="background-color: #0d1117 !important; padding: 15px;">HABITACIÓN</th>
            <th style="background-color: #0d1117 !important; padding: 15px;">FECHAS</th>
            <th style="background-color: #0d1117 !important; padding: 15px;">NOCHES</th>
            <th style="background-color: #0d1117 !important; padding: 15px;">SUBTOTAL</th>
            <th style="background-color: #0d1117 !important; padding: 15px;">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
    @foreach(session('carrito') as $id => $item)
    <tr style="background-color: #0d1117 !important; border-bottom: 1px solid #333 !important;">
        <td style="background-color: #0d1117 !important; color: white !important; padding: 15px;">{{ $item['nombre'] }}</td>
        <td style="background-color: #0d1117 !important; color: white !important; padding: 15px;">{{ $item['fecha_entrada'] }} a {{ $item['fecha_salida'] }}</td>
        <td style="background-color: #0d1117 !important; color: white !important; padding: 15px;">{{ $item['noches'] }}</td>
        <td style="background-color: #0d1117 !important; color: white !important; padding: 15px;">USD {{ number_format($item['precio'] * $item['noches'], 2) }}</td>
        <td style="background-color: #0d1117 !important; padding: 15px;">
            <form action="{{ route('carrito.quitar', $id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
                </div>
            </div>
            
            <div class="card-footer bg-dark border-secondary p-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('catalogo') }}" class="btn btn-outline-secondary">← Seguir Viendo</a>
                
                <form action="{{ route('carrito.confirmar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning fw-bold" style="background-color: #C7B25D; border: none;">
                        CONFIRMAR RESERVA
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="alert bg-dark text-white border-secondary">
            No tienes ninguna habitación seleccionada en este momento.
        </div>
        <a href="{{ route('catalogo') }}" class="btn btn-warning" style="background-color: #C7B25D; color: black;">Ver Catálogo</a>
    @endif
</div>
@endsection