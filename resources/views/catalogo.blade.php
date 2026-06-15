@extends('layouts.app')

@section('contenido')
<style>
    /* Fondo general oscuro */
    body {
        background-color: #020617 !important;
    }

    .bg-rooms {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .text-gold-tramonto {
        color: #d4af37 !important;
        letter-spacing: 1px;
    }

    .text-light-muted {
        color: #cbd5e1 !important; /* Gris claro para textos secundarios */
        opacity: 0.8;
    }

    /* Configuración de las tarjetas (Cards) de habitaciones */
    .card-habitacion {
        background-color: rgba(255, 255, 255, 0.03); 
        border: 1px solid rgba(212, 175, 55, 0.3); 
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.4s ease;
        color: white;
    }
    /* Efecto al pasar el mouse sobre la tarjeta */
    .card-habitacion:hover {
        transform: translateY(-10px);
        border-color: #d4af37; 
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        background-color: rgba(255, 255, 255, 0.07);
    }

    .room-img {
        height: 280px;
        object-fit: cover; /* Ajusta la imagen sin deformarla */
        transition: transform 0.5s ease;
    }
    /* Efecto de zoom en la imagen cuando se hace hover en la tarjeta */
    .card-habitacion:hover .room-img {
        transform: scale(1.05);
    }
    
    /* Estilo del botón personalizado */
    .btn-tramonto {
        border: 1px solid #d4af37;
        color: #d4af37;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        padding: 10px 20px;
        transition: 0.3s;
        background: transparent;
        text-decoration: none;
    }

    .btn-tramonto:hover {
        background-color: #d4af37;
        color: #020617;/* El texto se vuelve oscuro al fondo del botón dorado */
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
    }

    .price-tag {
        font-size: 1.1rem;
        color: #d4af37;
    }
</style>

{{-- Cartel de Éxito Flotante del Registro --}}
@if(session('exito'))
    <div class="container mt-4">
        <div class="alert alert-success alert-dismissible fade show text-center border-0 shadow-sm" role="alert" style="background-color: rgba(25, 135, 84, 0.2); color: #2ecc71; border: 1px solid rgba(46, 204, 113, 0.4) !important;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('exito') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="bg-rooms py-5">
    <div class="container">
        {{-- Encabezado de la sección --}}
        <h1 class="display-5 fw-bold mb-2 text-center text-gold-tramonto">Nuestras Habitaciones</h1>
        <p class="text-center text-light-muted mb-5">Exclusividad y confort frente a las barrancas del Paraná</p>
     {{--
        @auth
            @if(auth()->user()->rol_id == 1)
                <div class="text-end mb-4">
                    <a href="{{ route('habitaciones.create') }}" class="btn btn-tramonto">Agregar habitación</a>
                </div>
            @endif
        @endauth
--}}
        <div class="row g-4">
            {{-- BUCLE DINÁMICO: Recorre las habitaciones cargadas en MariaDB --}}
            @forelse($habitaciones as $habitacion)
                <div class="col-md-4">
                    <div class="card card-habitacion h-100">
                        <div class="overflow-hidden">
                           <img src="{{ $habitacion->imagenes->first()->url ?? 'https://i.postimg.cc/ncjNtWvf/IMG-5740.jpg' }}" class="card-img-top room-img" alt="{{ $habitacion->nombre }}">
                        </div>
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="card-title fw-bold mb-3 text-white">{{ $habitacion->nombre }}</h4>
                                
                                <p class="text-light-muted small mb-3">{{ $habitacion->descripcion }}</p>
                                
                                <p class="price-tag fw-bold">${{ number_format($habitacion->precio, 0, ',', '.') }} <span class="small text-light-muted">/ noche</span></p>
                                <p class="text-light-muted small mb-0">Disponibilidad: {{ (int) ($habitacion->stock ?? 1) }} habitaciones</p>
                            </div>
                            <div class="mt-4">
                                {{-- Por ahora te redirige a una ruta genérica del recurso hasta armar los detalles dinámicos --}}
                              <a href="{{ route('habitaciones.show', $habitacion->id) }}" class="btn btn-tramonto">Explorar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- En caso de que se borren todas las habitaciones o no haya ninguna --}}
                <div class="col-12 text-center py-5">
                    <p class="text-light-muted fs-4">No hay habitaciones disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection