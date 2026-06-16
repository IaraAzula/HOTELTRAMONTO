@extends('layouts.app')

@section('contenido')

<style>
    /* Estilos globales para mantener la coherencia */
    body { background-color: #020617 !important; color: #ffffff; }
    
    .card-tramonto { 
        background-color: #1e293b !important; 
        border: 1px solid #334155 !important; 
        color: white; 
    }

    /* Estilo del botón dorado corporativo */
    .btn-gold { 
        background-color: #d4af37 !important; 
        color: #020617 !important; 
        font-weight: bold; 
        text-transform: uppercase;
        border: none !important;
        transition: 0.3s;
    }
    .btn-gold:hover { 
        background-color: #c5a032 !important;
        transform: translateY(-2px);
    }
</style>
<div class="container py-5">
    <h2 class="text-gold-tramonto fw-bold mb-4">Mis Reservas</h2>
    
    <div class="card card-tramonto p-4">
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr style="color: #C7B25D;">
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                    <tr>
                        <td>#{{ $reserva->codigo }}</td>
                        <td>{{ $reserva->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-success">Confirmada</span>
                        </td>
                        <td>${{ number_format($reserva->total, 2) }}</td>
                        <td>
                            <a href="{{ route('reservas.detalles', $reserva->id) }}" class="btn btn-sm btn-gold">Ver Detalle</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection