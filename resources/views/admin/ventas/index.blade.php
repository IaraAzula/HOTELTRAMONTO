@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff !important; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    .table-tramonto, .table-tramonto thead, .table-tramonto tbody, 
    .table-tramonto tr, .table-tramonto td, .table-tramonto th { 
        background-color: transparent !important; 
        color: #ffffff !important;
        border-color: rgba(212, 175, 55, 0.2) !important;
    }
    .table-tramonto th { 
        color: #d4af37 !important; 
        border-bottom: 2px solid #d4af37 !important; 
        text-transform: uppercase; 
        font-size: 0.85rem; 
    }
    .table-tramonto td { 
        border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; 
        color: #cbd5e1 !important; 
    }
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }
    .form-control-tramonto { background-color: #0f172a !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; color: #ffffff !important; }
    .form-control-tramonto:focus { border-color: #d4af37 !important; box-shadow: 0 0 8px rgba(212, 175, 55, 0.3) !important; }
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.85rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }
    .modal-content-tramonto { background-color: #0b1329 !important; border: 1px solid #d4af37 !important; border-radius: 14px; color: #ffffff; }
    .modal-header-tramonto { border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; }
    .modal-footer-tramonto { border-top: 1px solid rgba(212, 175, 55, 0.1) !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-calendar-check me-2"></i>Reservas</h1>
            <p class="text-white small">Panel de administración y control de estadías del Hotel Tramonto</p>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

    <div class="card card-tramonto p-4 shadow-lg">
        
        {{-- FILTROS SUPERIORES --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <select id="filtroEstado" class="form-select form-control-tramonto">
                    <option value="todos">Todos los estados</option>
                    <option value="pendiente">Pendiente de Pago</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="checkin">Check-in / Activa</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" id="filtroDesde" class="form-control form-control-tramonto">
            </div>
            <div class="col-md-3">
                <input type="date" id="filtroHasta" class="form-control form-control-tramonto">
            </div>
            <div class="col-md-2">
                <button onclick="filtrarPorFecha()" class="btn btn-gold-outline w-100">Filtrar</button>
            </div>
        </div>

        <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 1px;">Gestión de Estadías</h5>

        @if($ventas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-tramonto align-middle m-0">
                    <thead>
                        <tr>
                            <th scope="col">Reserva</th>
                            <th scope="col">Huésped / Cliente</th>
                            <th scope="col">Fecha Entrada</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Monto Total</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                            @php
                                $estadoLower = strtolower($venta->estado);
                                if ($estadoLower == 'enviado') $estadoLower = 'confirmada';
                                if ($estadoLower == 'entregado') $estadoLower = 'checkin';
                                $nombreUsuario = $venta->usuario->nombre ?? 'Usuario ID: ' . $venta->usuario_id;
                            @endphp
                            <tr class="fila-reserva" 
                                data-estado="{{ $estadoLower }}"
                                data-entrada="{{ $venta->fecha_entrada }}">
                                <td class="fw-bold text-white">#{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $nombreUsuario }}</td>
                                <td>{{ $venta->fecha_entrada ?? '-' }}</td>
                                <td>{{ $venta->fecha_salida ?? '-' }}</td>
                                <td class="fw-semibold text-white">${{ number_format($venta->total, 2, ',', '.') }}</td>
                                <td>
                                    <select class="form-select form-select-sm form-control-tramonto w-auto d-inline-block fw-medium selector-estado-fila">
                                        <option value="pendiente" {{ $estadoLower == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="confirmada" {{ $estadoLower == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                        <option value="checkin" {{ $estadoLower == 'checkin' ? 'selected' : '' }}>Check-in / Activa</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.reservas.detalle', $venta->id) }}" class="btn btn-gold-outline btn-sm px-3 rounded-pill">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-tramonto align-middle m-0">
                    <thead>
                        <tr>
                            <th>Reserva</th>
                            <th>Huésped / Cliente</th>
                            <th>Fecha Entrada</th>
                            <th>Fecha Salida</th>
                            <th>Monto Total</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fila-reserva" data-estado="pendiente" data-entrada="2026-06-12">
                            <td class="fw-bold text-white">#1023</td>
                            <td>Juan Pérez</td>
                            <td>2026-06-12</td>
                            <td>2026-06-15</td>
                            <td class="fw-semibold text-white">$ 124.000,00</td>
                            <td>
                                <select class="form-select form-select-sm form-control-tramonto w-auto d-inline-block fw-medium selector-estado-fila">
                                    <option value="pendiente" selected>Pendiente</option>
                                    <option value="confirmada">Confirmada</option>
                                    <option value="checkin">Check-in / Activa</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-gold-outline btn-sm px-3 rounded-pill">Ver detalle</button>
                            </td>
                        </tr>
                        <tr class="fila-reserva" data-estado="confirmada" data-entrada="2026-06-20">
                            <td class="fw-bold text-white">#1024</td>
                            <td>María López</td>
                            <td>2026-06-20</td>
                            <td>2026-06-25</td>
                            <td class="fw-semibold text-white">$ 542.000,00</td>
                            <td>
                                <select class="form-select form-select-sm form-control-tramonto w-auto d-inline-block fw-medium selector-estado-fila">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="confirmada" selected>Confirmada</option>
                                    <option value="checkin">Check-in / Activa</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-gold-outline btn-sm px-3 rounded-pill">Ver detalle</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filtroEstado = document.getElementById('filtroEstado');
        const filas = document.querySelectorAll('.fila-reserva');

        function aplicarFiltros() {
            const estadoSeleccionado = filtroEstado.value;
            const desde = document.getElementById('filtroDesde').value;
            const hasta = document.getElementById('filtroHasta').value;

            filas.forEach(fila => {
                const estadoFila = fila.getAttribute('data-estado');
                const fechaEntrada = fila.getAttribute('data-entrada');

                let mostrar = true;

                if (estadoSeleccionado !== 'todos' && estadoFila !== estadoSeleccionado) {
                    mostrar = false;
                }

                if (desde && fechaEntrada && fechaEntrada < desde) mostrar = false;
                if (hasta && fechaEntrada && fechaEntrada > hasta) mostrar = false;

                fila.style.display = mostrar ? '' : 'none';
            });
        }

        filtroEstado.addEventListener('change', aplicarFiltros);

        const selectoresInternos = document.querySelectorAll('.selector-estado-fila');
        selectoresInternos.forEach(select => {
            select.addEventListener('change', function() {
                const filaPadre = this.closest('.fila-reserva');
                if(filaPadre) {
                    filaPadre.setAttribute('data-estado', this.value);
                    aplicarFiltros();
                }
            });
        });
    });

    function filtrarPorFecha() {
        const event = new Event('change');
        document.getElementById('filtroEstado').dispatchEvent(event);
    }
</script>
@endsection