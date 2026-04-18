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

    /* CAMBIO: Color para que el subtítulo sea legible */
    .text-light-muted {
        color: #cbd5e1 !important; /* Un gris azulado claro muy elegante */
        opacity: 0.8;
    }

    /* Cards Profesionales */
    .card-habitacion {
        background-color: rgba(255, 255, 255, 0.03); 
        border: 1px solid rgba(212, 175, 55, 0.3); 
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.4s ease;
        color: white;
    }

    .card-habitacion:hover {
        transform: translateY(-10px);
        border-color: #d4af37; 
        /* Corregido: Sombra dorada en lugar de roja */
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        background-color: rgba(255, 255, 255, 0.07);
    }

    .room-img {
        height: 280px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card-habitacion:hover .room-img {
        transform: scale(1.05);
    }

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
        color: #020617;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
    }

    .price-tag {
        font-size: 1.1rem;
        color: #d4af37;
    }
</style>

<div class="bg-rooms py-5">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2 text-center text-gold-tramonto">Nuestras Habitaciones</h1>
        <p class="text-center text-light-muted mb-5">Exclusividad y confort frente a las barrancas del Paraná</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-habitacion h-100">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/ncjNtWvf/IMG-5740.jpg" class="card-img-top room-img" alt="Habitación Standard">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title fw-bold mb-3">Habitación Standard</h4>
                            <p class="price-tag fw-bold">USD 60 – 90 <span class="small text-light-muted">/ noche</span></p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ url('/habitacion-standard') }}" class="btn btn-tramonto">Explorar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-habitacion h-100">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/kggxR2y6/IMG-5736.jpg" class="card-img-top room-img" alt="Suite Río">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title fw-bold mb-3 text-white">Suite Vista al Río</h4>
                            <p class="price-tag fw-bold">USD 90 – 140 <span class="small text-light-muted">/ noche</span></p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ url('/habitacion-suite') }}" class="btn btn-tramonto">Explorar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-habitacion h-100">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/KzSn6MQ6/IMG-5739.jpg" class="card-img-top room-img" alt="Habitación Familiar">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title fw-bold mb-3 text-white">Familiar Junior Suite</h4>
                            <p class="price-tag fw-bold">USD 80 – 120 <span class="small text-light-muted">/ noche</span></p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ url('/habitacion-familiar') }}" class="btn btn-tramonto">Explorar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection