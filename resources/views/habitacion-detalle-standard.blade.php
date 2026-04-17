@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <a href="{{ url('/habitaciones') }}" class="btn btn-sm btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Volver a habitaciones
    </a>

    <div class="row">
        <div class="col-md-7">
            <div id="carouselHabitacion" class="carousel slide shadow-sm rounded overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://i.postimg.cc/RFYcK5LL/IMG-5733.jpg" class="d-block w-100" alt="Foto 1" style="height: 450px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/ncjNtWvf/IMG-5740.jpg" class="d-block w-100" alt="Foto 2" style="height: 450px; object-fit: cover;"> 
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/XJ5xzRRR/IMG-6050.jpg" class="d-block w-100" alt="Foto 2" style="height: 450px; object-fit: cover;"> 
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/3NH95L7N/IMG-6051.jpg" class="d-block w-100" alt="Foto 2" style="height: 450px; object-fit: cover;"> 
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHabitacion" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselHabitacion" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <div class="col-md-5">
            <h1 class="text-tramonto fw-bold">Habitación Standard</h1>
            <h3 class="text-success my-3">USD 60 – 90 <small class="text-muted" style="font-size: 0.9rem;">/ noche</small></h3>
            <hr>
            <h5>Descripción</h5>
            <p class="text-muted">Nuestra habitación Standard ofrece el equilibrio perfecto entre confort y sencillez. Ideal para parejas que buscan una estadía tranquila en Empedrado.</p>
            
            <h5 class="mt-4">Servicios Incluidos</h5>
            <ul class="list-unstyled">
                <li><i class="bi bi-check2-circle text-warning"></i> Cama Matrimonial Sommier</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Aire Acondicionado Frío/Calor</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Wi-Fi de alta velocidad</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Baño privado con ducha</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Servicio de limpieza diario</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Desayuno incluido</li>
            </ul>
        </div>
    </div>
</div>
@endsection