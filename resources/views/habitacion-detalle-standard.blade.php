@extends('layouts.app')

@section('contenido')
<style>
    /* Fondo oscuro coherente */
    body {
        background-color: #020617 !important;
    }

    .room-detail-container {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .text-gold-tramonto {
        color: #d4af37 !important;
    }

    /* Botón Volver Estilizado */
    .btn-back {
        color: #d4af37;
        border-color: rgba(212, 175, 55, 0.5);
        transition: 0.3s;
    }

    .btn-back:hover {
        background-color: #d4af37;
        color: #020617;
        border-color: #d4af37;
    }

    /* Carrusel con estética Premium */
    .carousel-custom {
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 15px;
        overflow: hidden;
    }

    /* Tipografía y Listas */
    .service-list li {
        margin-bottom: 10px;
        color: #e2e8f0;
    }

    .price-large {
        color: #d4af37;
        font-weight: bold;
    }

    .description-text {
        line-height: 1.8;
        color: #cbd5e1;
        text-align: justify;
    }

    hr.gold-line {
        border-top: 1px solid rgba(212, 175, 55, 0.3);
        opacity: 1;
    }
</style>

<div class="room-detail-container py-5">
    <div class="container">
        <a href="{{ url('/habitaciones') }}" class="btn btn-sm btn-back mb-4">
            <i class="bi bi-arrow-left"></i> Volver a habitaciones
        </a>

        <div class="row g-5">
            <div class="col-md-7">
                <div id="carouselHabitacion" class="carousel slide shadow-lg carousel-custom" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://i.postimg.cc/RFYcK5LL/IMG-5733.jpg" class="d-block w-100" alt="Habitación Standard Vista 1" style="height: 500px; object-fit: cover;">
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.postimg.cc/ncjNtWvf/IMG-5740.jpg" class="d-block w-100" alt="Habitación Standard Vista 2" style="height: 500px; object-fit: cover;"> 
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.postimg.cc/XJ5xzRRR/IMG-6050.jpg" class="d-block w-100" alt="Detalles" style="height: 500px; object-fit: cover;"> 
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.postimg.cc/3NH95L7N/IMG-6051.jpg" class="d-block w-100" alt="Comodidades" style="height: 500px; object-fit: cover;"> 
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
                <h1 class="text-gold-tramonto fw-bold display-6">Habitación Standard</h1>
                <div class="d-flex align-items-baseline mb-3">
                    <h2 class="price-large mb-0">USD 60 – 90</h2>
                    <span class="text-white fw-medium">/ noche</span>
                </div>
                
                <hr class="gold-line">
                
                <h5 class="text-gold-tramonto text-uppercase mb-3" style="letter-spacing: 1px;">Descripción</h5>
                <p class="description-text">
                    Nuestra habitación Standard ofrece el equilibrio perfecto entre confort y sencillez. 
                    Diseñada para quienes buscan una estadía tranquila y acogedora en Empedrado, esta opción 
                    combina la calidez de la hospitalidad correntina con todas las comodidades necesarias 
                    para un descanso reparador cerca del Paraná.
                </p>
                
                <h5 class="text-gold-tramonto text-uppercase mt-4 mb-3" style="letter-spacing: 1px;">Servicios Incluidos</h5>
                <ul class="list-unstyled service-list">
                    <li><i class="bi bi-check2-circle text-gold-tramonto me-2"></i> Cama Matrimonial Sommier</li>
                    <li><i class="bi bi-check2-circle text-gold-tramonto me-2"></i> Aire Acondicionado Frío/Calor</li>
                    <li><i class="bi bi-check2-circle text-gold-tramonto me-2"></i> Wi-Fi de alta velocidad bonificado</li>
                    <li><i class="bi bi-check2-circle text-gold-tramonto me-2"></i> Baño privado con ducha</li>
                    <li><i class="bi bi-check2-circle text-gold-tramonto me-2"></i> Servicio de limpieza diario</li>
                    <li><i class="bi bi-check2-circle text-gold-tramonto me-2"></i> Desayuno artesanal incluido</li>
                </ul>

                <div class="mt-5">
                    <a href="https://wa.me/543794000000" target="_blank" class="btn btn-lg w-100 btn-back" style="background-color: transparent;">
                        CONSULTAR DISPONIBILIDAD
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection