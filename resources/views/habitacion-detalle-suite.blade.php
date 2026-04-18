@extends('layouts.app')

@section('contenido')
<style>
    /* Estética oscura coherente con Tramonto */
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

    /* Botón Volver */
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

    /* Carrusel Premium */
    .carousel-custom {
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 15px;
        overflow: hidden;
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

    .service-list li {
        margin-bottom: 10px;
        color: #e2e8f0;
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
                            <img src="https://i.postimg.cc/kggxR2y6/IMG-5736.jpg" class="d-block w-100" alt="Vista Suite 1" style="height: 500px; object-fit: cover;">
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.postimg.cc/90B7r2w5/IMG-5738.jpg" class="d-block w-100" alt="Vista Suite 2" style="height: 500px; object-fit: cover;"> 
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.postimg.cc/K8WgKJjF/IMG-5737.jpg" class="d-block w-100" alt="Balcón Suite" style="height: 500px; object-fit: cover;"> 
                        </div>
                        <div class="carousel-item">
                            <img src="https://i.postimg.cc/Y0t4cPnV/IMG-5727.jpg" class="d-block w-100" alt="Detalle Suite" style="height: 500px; object-fit: cover;"> 
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
                <h1 class="text-gold-tramonto fw-bold display-6">Suite Vista al Río</h1>
                <div class="d-flex align-items-baseline mb-3">
                    <h2 class="price-large mb-0">USD 90 – 140</h2>
                    <span class="text-muted ms-2">/ noche</span>
                </div>
                
                <hr class="gold-line">
                
                <h5 class="text-gold-tramonto text-uppercase mb-3" style="letter-spacing: 1px;">Descripción</h5>
                <p class="description-text">
                    Una habitación diseñada exclusivamente para disfrutar del paisaje y la tranquilidad absoluta. 
                    Cuenta con un balcón privado con vista panorámica al río Paraná, ideal para relajarse al aire libre. 
                    Equipada con minibar y detalles de categoría, es la opción perfecta para quienes buscan 
                    un confort superior y una experiencia inolvidable junto al río.
                </p>
                
                <h5 class="text-gold-tramonto text-uppercase mt-4 mb-3" style="letter-spacing: 1px;">Servicios Exclusivos</h5>
                <ul class="list-unstyled service-list">
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Cama King Size para un descanso de lujo</li>
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Balcón privado con vista frontal al río</li>
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Minibar totalmente equipado</li>
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Aire Acondicionado Frío/Calor</li>
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Wi-Fi de alta velocidad bonificado</li>
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> TV de pantalla plana con cable</li>
                    <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Desayuno artesanal incluido</li>
                </ul>

                <div class="mt-5">
                    <a href="https://wa.me/543794000000" target="_blank" class="btn btn-lg w-100 btn-back" style="background-color: transparent;">
                        RESERVAR SUITE
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection