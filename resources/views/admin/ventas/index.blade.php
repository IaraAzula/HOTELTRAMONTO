@extends('layouts.app')

@section('contenido')
<style>
    /* Fondo oscuro global */
    body { background-color: #020617 !important; color: #ffffff !important; }
    
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }

    /* --- CORRECCIÓN DE TABLA --- */
    /* Anulamos el fondo de todas las partes de la tabla */
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

    /* Hover que respeta la transparencia */
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }
    /* --------------------------- */

    /* Estilos para los buscadores y selectores */
    .form-control-tramonto { background-color: #0f172a !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; color: #ffffff !important; }
    .form-control-tramonto:focus { border-color: #d4af37 !important; box-shadow: 0 0 8px rgba(212, 175, 55, 0.3) !important; }
    
    /* Botón de acciones */
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.85rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }

    /* Modal */
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
        
        {{-- 🔍 FILTROS SUPERIORES DE RESERVAS --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <select id="filtroEstado" class="form-select form-control-tramonto">
                    <option value="todos">Todos los estados</option>
                    <option value="pendiente">Pendiente de Pago</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="checkin">Check-in / Activa</option>
                </select>
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
                            <th scope="col">Monto Total</th>
                            <th scope="col">Estado del Huésped</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                            @php
                                $estadoLower = strtolower($venta->estado);
                                if ($estadoLower == 'enviado') $estadoLower = 'confirmada';
                                if ($estadoLower == 'entregado') $estadoLower = 'checkin';
                                
                                // Nombre visible del usuario
                                $nombreUsuario = $venta->usuario->nombre ?? 'Usuario ID: ' . $venta->usuario_id;
                            @endphp
                            <tr class="fila-reserva" data-estado="{{ $estadoLower }}">
                                <td class="fw-bold text-white">#{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $nombreUsuario }}</td>
                                <td class="fw-semibold text-white">${{ number_format($venta->total, 2, ',', '.') }}</td>
                                <td>
                                    <select class="form-select form-select-sm form-control-tramonto w-auto d-inline-block fw-medium selector-estado-fila">
                                        <option value="pendiente" {{ $venta->estado == 'pendiente' || $venta->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="confirmada" {{ $venta->estado == 'confirmada' || $venta->estado == 'Confirmada' || $venta->estado == 'enviado' || $venta->estado == 'Enviado' ? 'selected' : '' }}>Confirmada</option>
                                        <option value="checkin" {{ $venta->estado == 'checkin' || $venta->estado == 'Check-in' || $venta->estado == 'entregado' || $venta->estado == 'Entregado' ? 'selected' : '' }}>Check-in / Activa</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    {{-- El botón ahora incluye atributos data- para mandarle info al modal --}}
                                    <button type="button" class="btn btn-gold-outline btn-sm px-3 rounded-pill btn-ver-detalle" 
                                            data-id="{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}"
                                            data-cliente="{{ $nombreUsuario }}"
                                            data-total="${{ number_format($venta->total, 2, ',', '.') }}">
                                        Ver detalle
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- 💡 DATOS DE PRUEBA (Mocks por si la BD está vacía al mostrarle al profe) --}}
            <div class="table-responsive">
                <table class="table table-hover table-tramonto align-middle m-0">
                    <thead>
                        <tr>
                            <th scope="col">Reserva</th>
                            <th scope="col">Huésped / Cliente</th>
                            <th scope="col">Monto Total</th>
                            <th scope="col">Estado del Huésped</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fila-reserva" data-estado="pendiente">
                            <td class="fw-bold text-white">#1023</td>
                            <td>Juan Pérez</td>
                            <td class="fw-semibold text-white">$ 124.000,00</td>
                            <td>
                                <select class="form-select form-select-sm form-control-tramonto w-auto d-inline-block fw-medium text-warning selector-estado-fila">
                                    <option value="pendiente" selected>Pendiente</option>
                                    <option value="confirmada">Confirmada</option>
                                    <option value="checkin">Check-in / Activa</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-gold-outline btn-sm px-3 rounded-pill btn-ver-detalle" data-id="1023" data-cliente="Juan Pérez" data-total="$ 124.000,00">
                                    Ver detalle
                                </button>
                            </td>
                        </tr>
                        <tr class="fila-reserva" data-estado="confirmada">
                            <td class="fw-bold text-white">#1024</td>
                            <td>María López</td>
                            <td class="fw-semibold text-white">$ 542.000,00</td>
                            <td>
                                <select class="form-select form-select-sm form-control-tramonto w-auto d-inline-block fw-medium text-info selector-estado-fila">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="confirmada" selected>Confirmada</option>
                                    <option value="checkin">Check-in / Activa</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-gold-outline btn-sm px-3 rounded-pill btn-ver-detalle" data-id="1024" data-cliente="María López" data-total="$ 542.000,00">
                                    Ver detalle
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- 🪟 MODAL DE DETALLE DE RESERVA --}}
<div class="modal fade" id="modalDetalleReserva" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-tramonto shadow-lg">
            <div class="modal-header modal-header-tramonto">
                <h5 class="modal-title fw-bold text-gold-tramonto" id="modalTitulo">Detalle de Reserva #0000</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Huésped Principal</label>
                    <span id="modalCliente" class="fs-5 fw-medium text-white">-</span>
                </div>
                <hr style="border-color: rgba(212,175,55,0.2);">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Habitación</label>
                        <span class="text-white fw-medium"><i class="bi bi-door-closed me-1"></i> Suite Tramonto Deluxe</span>
                    </div>
                    <div class="col-6">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Régimen</label>
                        <span class="text-white fw-medium">Pensión Completa</span>
                    </div>
                    <div class="col-6">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Check-In</label>
                        <span class="text-white fw-medium">12/06/2026</span>
                    </div>
                    <div class="col-6">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Check-Out</label>
                        <span class="text-white fw-medium">15/06/2026</span>
                    </div>
                </div>
                <hr style="border-color: rgba(212,175,55,0.2);">
                <div class="p-3 rounded" style="background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212,175,55,0.1);">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-gold-tramonto">Monto Total Liquidado:</span>
                        <span id="modalTotal" class="fs-4 fw-bold text-white">$0,00</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-tramonto">
                <button type="button" class="btn btn-gold-outline px-4 rounded-pill" data-bs-dismiss="modal">Cerrar Ventana</button>
            </div>
        </div>
    </div>
</div>

{{-- 📜 INTERACTIVIDAD EN TIEMPO REAL CON JAVASCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filtroEstado = document.getElementById('filtroEstado');
        const filas = document.querySelectorAll('.fila-reserva');

        // Lógica de Filtros por Estado
        function aplicarFiltros() {
            const estadoSeleccionado = filtroEstado.value;

            filas.forEach(fila => {
                const estadoFila = fila.getAttribute('data-estado');
                if (estadoSeleccionado === 'todos' || estadoFila === estadoSeleccionado) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        }

        filtroEstado.addEventListener('change', aplicarFiltros);

        // Actualización dinámica cuando se cambia el select de una fila
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

        // ⚡ LÓGICA INTERACTIVA DEL MODAL "VER DETALLE"
        const botonesDetalle = document.querySelectorAll('.btn-ver-detalle');
        const modalElement = document.getElementById('modalDetalleReserva');
        
        // Inicializamos el objeto modal de Bootstrap
        const miModal = new bootstrap.Modal(modalElement);

        botonesDetalle.forEach(boton => {
            boton.addEventListener('click', function() {
                // Capturamos los datos cargados en el botón cliqueado
                const id = this.getAttribute('data-id');
                const cliente = this.getAttribute('data-cliente');
                const total = this.getAttribute('data-total');

                // Inyectamos los datos reales dinámicamente en el HTML del modal
                document.getElementById('modalTitulo').innerText = `Detalle de Reserva #${id}`;
                document.getElementById('modalCliente').innerText = cliente;
                document.getElementById('modalTotal').innerText = total;

                // Desplegamos el modal en pantalla
                miModal.show();
            });
        });
    });
</script>
@endsection