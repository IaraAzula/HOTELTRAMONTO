@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; backdrop-filter: blur(5px); }
    
    /* Nueva regla blindada para la tabla */
    .table-tramonto { background-color: transparent !important; color: #ffffff !important; }
    .table-tramonto tr, .table-tramonto td, .table-tramonto th { 
        background-color: transparent !important; 
        color: #ffffff !important; 
    }
    .table-tramonto th { color: #d4af37 !important; border-bottom: 2px solid #d4af37 !important; text-transform: uppercase; font-size: 0.85rem; }
    .table-tramonto td { border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; }
    
    .btn-gold { background-color: #d4af37; color: #020617; font-weight: bold; border: 1px solid #d4af37; transition: 0.3s; }
    .btn-gold:hover { background-color: transparent; color: #d4af37; box-shadow: 0 0 10px rgba(212, 175, 55, 0.4); }
    
    /* SweetAlert */
    .swal2-popup-tramonto { background-color: #0f172a !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; border-radius: 15px !important; color: #ffffff !important; }
    .swal2-title-tramonto { color: #d4af37 !important; }
    .swal2-confirm-tramonto { background-color: #d4af37 !important; color: #020617 !important; font-weight: bold !important; }
</style>

<div class="container py-5">
    <h1 class="fw-bold text-gold-tramonto mb-4"><i class="bi bi-cart3 me-2"></i>Mi Carrito de Reservas</h1>

    {{-- Quitamos los carteles HTML de arriba y dejamos que JavaScript maneje las sesiones de Laravel aquí abajo --}}

    <div class="row g-4">
        {{-- Listado de habitaciones en el carrito --}}
        <div class="col-lg-8">
            @if(count($carrito) > 0)
                <div class="table-responsive card-tramonto p-3 shadow-lg">
                    <table class="table table-hover table-tramonto align-middle m-0">
                        <thead>
                            <tr>
                                <th scope="col">Habitación</th>
                                <th scope="col" class="text-center">Fechas</th>
                                <th scope="col" class="text-center">Noches</th>
                                <th scope="col" class="text-end">Subtotal</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carrito as $id => $item)
                                <tr>
                                    <td class="fw-bold text-white fs-5">{{ $item['nombre'] }}</td>
                                    <td class="text-center text-white-50 small">
                                        {{ \Carbon\Carbon::parse($item['fecha_entrada'] ?? now())->format('d/m/Y') }}<br>
                                        <span class="text-muted">a</span><br>
                                        {{ \Carbon\Carbon::parse($item['fecha_salida'] ?? now()->addDay())->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center text-white">{{ $item['noches'] ?? 1 }}</td>
                                    <td class="text-end fw-semibold text-white">${{ number_format(($item['precio'] ?? 0) * ($item['noches'] ?? 1), 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        {{-- Botón para eliminar un item --}}
                                        <form action="{{ route('carrito.quitar', $id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm border-0" title="Quitar habitación">
                                                <i class="bi bi-trash3-fill fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card card-tramonto p-5 text-center shadow-lg">
                    <i class="bi bi-calendar-x text-muted mb-3" style="font-size: 3.5rem;"></i>
                    <h3 class="fw-bold text-white-50">Tu carrito está vacío</h3>
                    <p class="text-muted">Explorá nuestro catálogo para elegir las mejores habitaciones en Empedrado.</p>
                    <div class="mt-3">
                        <a href="{{ route('catalogo') }}" class="btn btn-gold px-4 py-2">Ver Habitaciones</a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Panel lateral del Resumen / Confirmación --}}
        @if(count($carrito) > 0)
            <div class="col-lg-4">
                <div class="card card-tramonto p-4 shadow-lg sticky-top" style="top: 100px;">
                    <h4 class="fw-bold text-gold-tramonto mb-3 border-bottom pb-2" style="border-color: rgba(212, 175, 55, 0.2) !important;">Resumen del Hospedaje</h4>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Total Habitaciones:</span>
                        <span class="fw-bold text-white">{{ count($carrito) }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top border-bottom py-3 my-3" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                        <span class="fs-5 fw-bold text-white">Monto Total:</span>
                        <span class="fs-4 fw-bold text-gold-tramonto">${{ number_format(array_reduce($carrito, function ($carry, $item) { return $carry + (($item['precio'] ?? 0) * ($item['noches'] ?? 1)); }, 0), 2, ',', '.') }}</span>
                    </div>

                    {{-- Formulario para procesar y limpiar el carrito --}}
                    <form action="{{ route('carrito.confirmar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-gold w-100 py-3 text-uppercase letter-spacing fw-bold shadow">
                            <i class="bi bi-check-circle-fill me-2"></i>Confirmar Reserva
                        </button>
                    </form>

                    <a href="{{ route('catalogo') }}" class="btn btn-outline-light w-100 mt-2 py-2 small text-uppercase">
                        <i class="bi bi-arrow-left me-1"></i>Seguir viendo
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- 🚀 CDN de SweetAlert2 para los carteles flotantes en el medio --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Captura el mensaje de éxito de Laravel y lo muestra en el medio
        @if(session('exito'))
            Swal.fire({
                title: '¡Excelente!',
                text: "{{ session('exito') }}",
                icon: 'success',
                iconColor: '#d4af37',
                customClass: {
                    popup: 'swal2-popup-tramonto',
                    title: 'swal2-title-tramonto',
                    confirmButton: 'swal2-confirm-tramonto'
                },
                buttonsStyling: false
            });
        @endif

        // Captura el mensaje de error de Laravel y lo muestra en el medio
        @if(session('error'))
            Swal.fire({
                title: '¡Ups! Algo salió mal',
                text: "{{ session('error') }}",
                icon: 'error',
                iconColor: '#dc3545',
                customClass: {
                    popup: 'swal2-popup-tramonto',
                    title: 'swal2-title-tramonto',
                    confirmButton: 'swal2-confirm-tramonto'
                },
                buttonsStyling: false
            });
        @endif
    });
</script>
@endsection