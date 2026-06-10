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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
            <p class="text-white">Panel general de control y monitoreo del Hotel Tramonto</p>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

    {{-- TARJETAS SUPERIORES --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="metric-card p-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-gold-tramonto text-uppercase fw-bold mb-3">Ventas Totales</h6>
                    <h3 class="fw-bold text-white m-0">${{ number_format($ventasTotales, 0, ',', '.') }}</h3>
                </div>
                <i class="bi bi-currency-dollar metric-icon"></i>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="metric-card p-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-gold-tramonto text-uppercase fw-bold mb-3">Ticket Promedio</h6>
                    <h3 class="fw-bold text-white m-0">${{ number_format($ticketPromedio, 0, ',', '.') }}</h3>
                </div>
                <i class="bi bi-graph-up-arrow metric-icon"></i>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="metric-card p-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-gold-tramonto text-uppercase fw-bold mb-3">Clientes</h6>
                    <h3 class="fw-bold text-white m-0">{{ $totalUsuarios }}</h3>
                </div>
                <i class="bi bi-people metric-icon"></i>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="metric-card p-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-gold-tramonto text-uppercase fw-bold mb-3">Pedidos Totales</h6>
                    <h3 class="fw-bold text-white m-0">{{ $totalPedidos }}</h3>
                </div>
                <i class="bi bi-cart-check metric-icon"></i>
            </div>
        </div>
    </div>

    {{-- TABLA + CALENDARIO --}}
    <div class="row g-4">
        {{-- Tabla de pedidos --}}
        <div class="col-lg-8">
            <div class="card card-tramonto p-4 shadow-lg h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-gold-tramonto text-uppercase fw-bold m-0" style="font-size: 0.9rem; letter-spacing: 1px;">Últimos Pedidos</h5>
                    <a href="{{ route('admin.ventas') }}" class="btn btn-gold-outline btn-sm px-3 rounded-pill">Ver todos</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-tramonto align-middle m-0">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Cliente</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasVentas as $venta)
                                <tr>
                                    <td class="fw-bold text-white">#{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <a href="{{ route('admin.reservas.detalle', $venta->id) }}" style="color: #d4af37; text-decoration: none;">
                                            {{ $venta->usuario->nombre ?? 'Cliente ID: '.$venta->usuario_id }}
                                        </a>
                                    </td>
                                    <td>{{ $venta->fecha_entrada ?? '-' }}</td>
                                    <td>{{ $venta->fecha_salida ?? '-' }}</td>
                                    <td class="text-end fw-semibold text-white">${{ number_format($venta->total, 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.reservas.detalle', $venta->id) }}" class="btn btn-gold-outline btn-sm px-3 rounded-pill">
                                            Ver detalle
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center py-4 text-muted">No hay pedidos recientes.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Calendario --}}
        <div class="col-lg-4">
            <div class="card card-tramonto p-4 shadow-lg h-100">
                <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 1px;">
                    <i class="bi bi-calendar3 me-2"></i>Ocupación
                </h5>
                <div id="calendarioDashboard"></div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reservas = @json($reservas);
    const eventos = [];

    reservas.forEach(reserva => {
        const nombre = reserva.usuario ? reserva.usuario.nombre : 'Cliente #' + reserva.usuario_id;
        eventos.push({
            title: nombre,
            start: reserva.fecha_entrada,
            end: reserva.fecha_salida,
            backgroundColor: '#c0392b',
            borderColor: '#e74c3c',
            textColor: '#ffffff',
            url: '/admin/reservas/' + reserva.id,
        });
    });

    const calendar = new FullCalendar.Calendar(document.getElementById('calendarioDashboard'), {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        height: 'auto',
        events: eventos,
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.url) window.location.href = info.event.url;
        }
    });

    calendar.render();
});
</script>
@endsection