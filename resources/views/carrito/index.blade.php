@extends('layouts.app') {{-- O el layout oscuro que usen --}}

@section('contenido')
<div class="container py-5 text-white" style="background-color: #0d1117; min-height: 80vh;">
    <h2 class="mb-4" style="color: #d4af37;">Resumen de tu Selección</h2>

    @if(session('reserva_temporal'))
        <div class="card bg-dark text-white border-secondary mb-3">
            <div class="card-body">
                <h4 class="card-title">{{ session('reserva_temporal')['nombre'] }}</h4>
                <p class="card-text">Precio por noche: <strong>USD {{ session('reserva_temporal')['precio'] }}</strong></p>
                
                <hr class="border-secondary">
                
                <div class="d-flex justify-content-between">
                    {{-- Acá más adelante pueden conectar el formulario final para confirmar y guardar en la tabla 'reservas' --}}
                    <a href="{{ url('/catalogo') }}" class="btn btn-secondary">Volver al catálogo</a>
                    <button class="btn btn-warning" style="background-color: #d4af37; color: black;">Confirmar Reserva</button>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info bg-dark text-white border-secondary">
            No tenés ninguna habitación seleccionada en este momento.
        </div>
        <a href="{{ url('/catalogo') }}" class="btn btn-warning" style="background-color: #d4af37; color: black;">Ver Catálogo</a>
    @endif
</div>
@endsection