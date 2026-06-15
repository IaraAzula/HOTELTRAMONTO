@extends('layouts.app')

@section('contenido')

<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    .metric-card { 
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.8)); 
        border: 1px solid rgba(212, 175, 55, 0.15); 
        border-radius: 12px; 
        transition: 0.3s; 
    }
    .metric-card:hover { border-color: #d4af37; transform: translateY(-3px); }
    .metric-icon { font-size: 2rem; color: #d4af37; opacity: 0.8; }
    .table-tramonto { 
        background-color: transparent !important; 
        color: #ffffff !important; 
        border-collapse: collapse !important;
    }
    .table-tramonto th { 
        color: #d4af37 !important; 
        border-bottom: 2px solid #d4af37 !important; 
        text-transform: uppercase; 
        font-size: 0.8rem; 
        padding: 1rem;
    }
    .table-tramonto tbody tr { 
        background-color: transparent !important; 
        border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; 
    }
    .table-tramonto td, .table-tramonto th { 
        background-color: transparent !important; 
        color: #cbd5e1 !important;
        padding: 1rem; 
    }
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.1) !important;
    }
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.8rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }

    /* Calendario */
    .fc { color: #ffffff; }
    .fc-toolbar-title { color: #d4af37 !important; font-size: 1rem !important; }
    .fc-button { background-color: transparent !important; border: 1px solid #d4af37 !important; color: #d4af37 !important; font-size: 0.75rem !important; padding: 2px 8px !important; }
    .fc-button:hover { background-color: #d4af37 !important; color: #020617 !important; }
    .fc-button-active { background-color: #d4af37 !important; color: #020617 !important; }
    .fc-daygrid-day { background-color: rgba(15, 23, 42, 0.4) !important; }
    .fc-col-header-cell-cushion { color: #d4af37 !important; font-size: 0.75rem; }
    .fc-daygrid-day-number { color: #ffffff !important; font-size: 0.8rem; }
    .fc-day-today { background-color: rgba(212, 175, 55, 0.1) !important; }
    .fc-scrollgrid { border-color: rgba(212, 175, 55, 0.2) !important; }
    .fc-scrollgrid-sync-table td, .fc-scrollgrid-sync-table th { border-color: rgba(212, 175, 55, 0.1) !important; }
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
    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover" style="background-color: #1e293b !important; border: 1px solid #334155 !important;">
            <thead>
                <tr style="background-color: #0f172a !important; color: #C7B25D !important;">
                    <th class="p-3">Habitación</th>
                    <th class="p-3">Fecha Entrada</th>
                    <th class="p-3">Fecha Salida</th>
                    <th class="p-3">Noches</th>
                    <th class="p-3 text-center">Personas</th>
                    <th class="p-3 text-end">Precio por noche</th>
                </tr>
            </thead>
            <tbody style="background-color: #1e293b !important;">
                @foreach($reserva->detalles as $detalle)
                <tr style="background-color: #1e293b !important; color: #ffffff !important;">
                    <td class="p-3" style="color: #d4af37 !important; font-weight: bold;">{{ $detalle->habitacion->nombre ?? 'N/A' }}</td>
                    <td class="p-3">{{ $detalle->fecha_entrada ?? '-' }}</td>
                    <td class="p-3">{{ $detalle->fecha_salida ?? '-' }}</td>
                    <td class="p-3">
                        @if($detalle->fecha_entrada && $detalle->fecha_salida)
                            {{ \Carbon\Carbon::parse($detalle->fecha_entrada)->diffInDays($detalle->fecha_salida) }}
                        @else - @endif
                    </td>
                    <td class="p-3 text-center">
                        <i class="bi bi-people me-1" style="color: #d4af37;"></i>{{ $detalle->personas ?? '-' }}
                    </td>
                    <td class="p-3 text-end">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection