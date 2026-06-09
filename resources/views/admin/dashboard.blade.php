@extends('layouts.app')

@section('contenido')
<style>
    /* Fondo oscuro global */
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    
    /* Tarjetas */
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    
    /* Métricas */
    .metric-card { 
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.8)); 
        border: 1px solid rgba(212, 175, 55, 0.15); 
        border-radius: 12px; 
        transition: 0.3s; 
    }
    .metric-card:hover { border-color: #d4af37; transform: translateY(-3px); }
    .metric-icon { font-size: 2rem; color: #d4af37; opacity: 0.8; }

    /* Tablas Premium */
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
        border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; 
    }
    .table-tramonto td { 
        padding: 1rem; 
        color: #cbd5e1 !important; 
        font-size: 0.9rem; 
    }
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }


    /* TABLAS: FORZAMOS EL COLOR OSCURO */
    .table-tramonto { 
        background-color: transparent !important; 
        color: #ffffff !important; 
        border-collapse: collapse !important;
    }
    
    /* Forzamos el fondo de cada fila */
    .table-tramonto tbody tr { 
        background-color: transparent !important; 
        border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; 
    }

    /* Forzamos el fondo de cada celda por si acaso */
    .table-tramonto td, .table-tramonto th { 
        background-color: transparent !important; 
        color: #cbd5e1 !important;
        padding: 1rem; 
    }

    /* Quitamos el fondo blanco de Bootstrap en tablas */
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.1) !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
            <p class="text-white">Panel general de control y monitoreo del Hotel Tramonto</p>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

    {{-- BLOQUE DE TARJETAS SUPERIORES --}}
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

    {{-- TABLAS --}}
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card card-tramonto p-4 h-100 shadow-lg">
                <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 1px;">Últimos Pedidos</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-tramonto align-middle m-0">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Cliente</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasVentas as $venta)
                                <tr>
                                    <td class="fw-bold text-white">#{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $venta->usuario->nombre ?? 'Cliente ID: '.$venta->usuario_id }}</td>
                                    <td class="text-end fw-semibold text-white">${{ number_format($venta->total, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-4 text-muted">No hay pedidos recientes.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-tramonto p-4 h-100 shadow-lg">
                <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 1px;">Más Vendidos</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-tramonto align-middle m-0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-white">Suite Imperial Tramonto</td>
                                <td class="text-center"><span class="badge bg-dark border border-secondary text-white px-3 py-1">14 Reservas</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-white">Habitación Familiar Vista al Río</td>
                                <td class="text-center"><span class="badge bg-dark border border-secondary text-white px-3 py-1">9 Reservas</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection