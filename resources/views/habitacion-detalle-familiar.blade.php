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
                        <img src="https://i.postimg.cc/1zP4V2P1/IMG-5739.jpg" class="d-block w-100" alt="Foto 1" style="height: 450px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/3NywHHjZ/IMG-5745.jpg" class="d-block w-100" alt="Foto 2" style="height: 450px; object-fit: cover;"> 
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/Mp0pw5Rk/IMG-5726.jpg" class="d-block w-100" alt="Foto 2" style="height: 450px; object-fit: cover;"> 
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/7ZNJ9wK3/IMG-5731.jpg" class="d-block w-100" alt="Foto 2" style="height: 450px; object-fit: cover;"> 
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
            <h1 class="text-tramonto fw-bold">Familiar o Junior Suite</h1>
           <h3 class="text-success my-3">USD 80 – 120<small class="text-muted" style="font-size: 0.9rem;">/ noche</small></h3>
            <hr>
            <h5>Descripción</h5>
            <p class="text-muted">un espacio amplio y versátil, ideal para familias o grupos que buscan comodidad sin resignar estilo. Diseñada para brindar descanso y funcionalidad, cuenta con áreas bien distribuidas que permiten disfrutar de una estadía relajada, ya sea en compañía o con mayor independencia dentro de la misma habitación. Perfecta para quienes priorizan confort y practicidad en un ambiente acogedor.</p>
            
            <h5 class="mt-4">Servicios Incluidos</h5>
            <ul class="list-unstyled">
                <li><i class="bi bi-check2-circle text-warning"></i> Aire Acondicionado Frío/Calor</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Wi-Fi de alta velocidad</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Baño privado con ducha</li>
                <li><i class="bi bi-check2-circle text-warning"></i> TV de pantalla plana con cable</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Servicio de limpieza diario</li>
                <li><i class="bi bi-check2-circle text-warning"></i> 3 camas individuales o 1 cama matrimonial + 1 cama individual, según necesidad.</li>
                <li><i class="bi bi-check2-circle text-warning"></i> Desayuno incluido</li>
            </ul>
        </div>
    </div>
</div>
@endsection