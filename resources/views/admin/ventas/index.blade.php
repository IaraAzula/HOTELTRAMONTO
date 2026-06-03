@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; }
    .table-tramonto { background-color: rgba(15, 23, 42, 0.4) !important; border: 1px solid rgba(212, 175, 55, 0.2); color: #ffffff !important; }
    .table-tramonto th { color: #d4af37 !important; border-bottom: 2px solid #d4af37 !important; text-transform: uppercase; font-size: 0.85rem; }
    .table-tramonto td { border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; color: #cbd5e1 !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-currency-dollar me-2"></i>Monitoreo de Ventas</h1>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

    <div class="card card-tramonto p-4 shadow-lg">
        @if($ventas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-tramonto align-middle m-0">
                    <thead>
                        <tr>
                            <th scope="col">ID Reserva</th>
                            <th scope="col">Usuario ID</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Fecha</th>
                            <th scope="col" class="text-end">Monto Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                            <tr>
                                <td class="fw-bold text-white">#{{ $venta->id }}</td>
                                <td>
                                    <span class="text-muted">ID Cliente:</span> {{ $venta->usuario_id }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success text-uppercase px-2 py-1" style="font-size: 0.75rem;">
                                        {{ $venta->estado }}
                                    </span>
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $venta->created_at ? $venta->created_at->format('d/m/Y H:i') : 'S/D' }}
                                </td>
                                <td class="text-end fw-bold text-gold-tramonto" style="font-size: 1.1rem;">
                                    ${{ number_format($venta->total, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-cart-x text-muted mb-3" style="font-size: 3rem;"></i>
                <h4 class="text-white-50">No se registran transacciones en el sistema</h4>
            </div>
        @endif
    </div>
</div>
@endsection