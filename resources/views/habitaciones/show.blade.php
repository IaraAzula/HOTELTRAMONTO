@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; }
    .room-detail-container {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }
    .text-gold-tramonto { color: #d4af37 !important; }
    .btn-back {
        color: #d4af37;
        border-color: rgba(212,175,55,0.5);
        transition: 0.3s;
    }
    .btn-back:hover {
        background-color: #d4af37;
        color: #020617;
        border-color: #d4af37;
    }
    .carousel-custom {
        border: 1px solid rgba(212,175,55,0.4);
        border-radius: 15px;
        overflow: hidden;
    }
    .price-large { color: #d4af37; font-weight: bold; }
    .description-text { line-height: 1.8; color: #cbd5e1; text-align: justify; }
    hr.gold-line { border-top: 1px solid rgba(212,175,55,0.3); opacity: 1; }
</style>

<div class="room-detail-container py-5">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert" style="background-color: rgba(220, 53, 69, 0.12); color: #fecaca; border: 1px solid rgba(248, 113, 113, 0.35) !important;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Alerta para ver errores de validación si las fechas fallan --}}
        @if ($errors->any())
            <div class="alert alert-danger bg-danger text-white border-0 shadow-sm mb-4">
                <ul class="mb-0 px-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('catalogo') }}" class="btn btn-sm btn-back mb-4">
            <i class="bi bi-arrow-left"></i> Volver a habitaciones
        </a>

        <div class="row g-5">
            <div class="col-md-7">
                <div id="carouselHabitacion" class="carousel slide shadow-lg carousel-custom" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($habitacion->imagenes as $index => $imagen)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $imagen->url }}" class="d-block w-100" alt="{{ $habitacion->nombre }}" style="height: 500px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @if($habitacion->imagenes->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHabitacion" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselHabitacion" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    @endif
                </div>
            </div>

            <div class="col-md-5">
                <h1 class="text-gold-tramonto fw-bold display-6">{{ $habitacion->nombre }}</h1>
                <div class="d-flex align-items-baseline mb-3">
                    <h2 class="price-large mb-0">USD {{ number_format($habitacion->precio, 0) }}</h2>
                    <span class="text-white fw-medium ms-2">/ noche</span>
                </div>
                <p class="text-white-50 mb-3">Stock disponible: {{ (int) ($habitacion->stock ?? 1) }} habitaciones</p>

                <hr class="gold-line">

                <h5 class="text-gold-tramonto text-uppercase mb-3" style="letter-spacing: 1px;">Descripción</h5>
                <p class="description-text">{{ $habitacion->descripcion }}</p>

                <h5 class="text-gold-tramonto text-uppercase mt-4 mb-3" style="letter-spacing: 1px;">Servicios Incluidos</h5>
                <ul class="list-unstyled">
                    @foreach(explode("\n", $habitacion->servicios ?? '') as $servicio)
                        @if(trim($servicio))
                            <li style="color: #e2e8f0; margin-bottom: 8px;">
                                <i class="bi bi-check2-circle me-2" style="color: #d4af37;"></i>{{ trim($servicio) }}
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- FORMULARIO ACTUALIZADO Y CORREGIDO PARA EL NUEVO CONTROLADOR --}}
                <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-5 d-grid gap-3">
                    @csrf
                    
                    {{-- Envía el id de forma interna como lo espera el $request->habitacion_id --}}
                    <input type="hidden" name="habitacion_id" value="{{ $habitacion->id }}">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fecha_entrada" class="form-label text-gold-tramonto small text-uppercase">Fecha de entrada</label>
                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control bg-dark text-white border-secondary" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_salida" class="form-label text-gold-tramonto small text-uppercase">Fecha de salida</label>
                            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control bg-dark text-white border-secondary" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg w-100 btn-back mt-2">
                        <i class="bi bi-cart-plus me-2"></i> Agregar al carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection