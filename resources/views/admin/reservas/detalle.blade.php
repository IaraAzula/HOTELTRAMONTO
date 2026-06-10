@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; }
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    .table-tramonto th { 
        color: #d4af37 !important; 
        border-bottom: 2px solid #d4af37 !important; 
        text-transform: uppercase; 
        font-size: 0.8rem; 
    }
    .table > :not(caption) > * > * {
        background-color: transparent !important;
        color: #ffffff !important;
    }
    .table-tramonto tr { border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; }
    .table-tramonto tbody tr td:first-child { color: #d4af37 !important; }
    .table-hover tbody tr:hover > * {
        background-color: rgba(212, 175, 55, 0.08) !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-5">
    <a href="{{ route('admin.ventas') }}" class="btn btn-sm mb-4" style="color: #d4af37; border: 1px solid rgba(212,175,55,0.5);">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <h2 class="fw-bold text-gold-tramonto mb-1">Reserva #{{ str_pad($reserva->id, 4, '0', STR_PAD_LEFT) }}</h2>
    <p style="color: #94a3b8;">{{ $reserva->created_at->format('d/m/Y H:i') }}</p>

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="card-tramonto p-4">
                <h6 class="text-gold-tramonto text-uppercase mb-3">Cliente</h6>
                <p class="text-white mb-1"><strong>{{ $reserva->usuario->nombre }} {{ $reserva->usuario->apellido }}</strong></p>
                <p style="color: #94a3b8;">{{ $reserva->usuario->email }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-tramonto p-4">
                <h6 class="text-gold-tramonto text-uppercase mb-3">Estado</h6>
                <span class="badge bg-success px-3 py-2">{{ ucfirst($reserva->estado) }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-tramonto p-4">
                <h6 class="text-gold-tramonto text-uppercase mb-3">Total</h6>
                <h4 class="text-white fw-bold">${{ number_format($reserva->total, 2, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="card-tramonto p-4 mt-4">
        <h5 class="text-gold-tramonto text-uppercase mb-3">Habitaciones Reservadas</h5>
        <table class="table table-hover table-tramonto align-middle">
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Fecha Entrada</th>
                    <th>Fecha Salida</th>
                    <th>Noches</th>
                    <th class="text-end">Precio por noche</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reserva->detalles as $detalle)
                <tr>
                    <td style="color: #d4af37 !important;">{{ $detalle->habitacion->nombre ?? 'N/A' }}</td>
                    <td>{{ $detalle->fecha_entrada ?? '-' }}</td>
                    <td>{{ $detalle->fecha_salida ?? '-' }}</td>
                    <td>
                        @if($detalle->fecha_entrada && $detalle->fecha_salida)
                            {{ \Carbon\Carbon::parse($detalle->fecha_entrada)->diffInDays($detalle->fecha_salida) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection