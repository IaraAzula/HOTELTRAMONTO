@extends('layouts.app')

@section('contenido')
<style>
    /* Estética general coherente con Tramonto */
    body {
        background-color: #020617 !important;
    }

    .servicios-section {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .text-gold-tramonto {
        color: #d4af37 !important;
    }

    .text-light-muted {
        color: #cbd5e1 !important;
    }

    /* Cards de Servicios Estilo Glassmorphism */
    .card-servicio {
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .card-servicio:hover {
        transform: translateY(-10px);
        border-color: #d4af37;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .service-img {
        height: 280px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card-servicio:hover .service-img {
        transform: scale(1.05);
    }

    /* Listas de servicios */
    .service-list li {
        color: #cbd5e1;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    /* Banner de contacto final */
    .contact-banner {
        background-color: rgba(212, 175, 55, 0.05);
        border: 1px solid #d4af37;
        border-radius: 15px;
    }

    .btn-tramonto {
        background-color: transparent;
        border: 1px solid #d4af37;
        color: #d4af37;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.4s;
        padding: 12px 30px;
    }

    .btn-tramonto:hover {
        background-color: #d4af37;
        color: #020617;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
    }
</style>

<div class="servicios-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-gold-tramonto">Otros Servicios</h1>
            <p class="lead text-light-muted">En Hotel Tramonto, ofrecemos experiencias diseñadas para tu máximo confort y disfrute.</p>
            <hr class="mx-auto" style="width: 80px; height: 3px; background-color: #d4af37; border: none; opacity: 1;">
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card card-servicio h-100 border-0">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/wM4J4F27/IMG-5907.jpg" class="card-img-top service-img" alt="Eventos">
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-gold-tramonto fw-bold">Eventos</h4>
                        <p class="card-text text-light-muted small mb-3">Salones totalmente equipados para bodas, conferencias y reuniones sociales.</p>
                        <ul class="list-unstyled service-list mt-auto">
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Catering exclusivo</li>
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Tecnología audiovisual</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-servicio h-100 border-0">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/gjX1rtxG/IMG-5746.jpg" class="card-img-top service-img" alt="Restaurant">
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-gold-tramonto fw-bold">Restaurante</h4>
                        <p class="card-text text-light-muted small mb-3">Gastronomía litoraleña e internacional con ingredientes locales seleccionados.</p>
                        <ul class="list-unstyled service-list mt-auto">
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Desayuno artesanal</li>
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Cava de vinos</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-servicio h-100 border-0">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/cHnLGhdJ/IMG-5908.jpg" class="card-img-top service-img" alt="SPA">
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-gold-tramonto fw-bold">SPA & Relax</h4>
                        <p class="card-text text-light-muted small mb-3">Circuitos de agua, sauna seco y masajes terapéuticos para renovar mente y cuerpo.</p>
                        <ul class="list-unstyled service-list mt-auto">
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Masajes de autor</li>
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Tratamientos faciales</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-servicio h-100 border-0">
                    <div class="overflow-hidden">
                        <img src="https://i.postimg.cc/kG4y3wgh/IMG-6076.jpg" class="card-img-top service-img" alt="Pesca">
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-gold-tramonto fw-bold">Pesca Guiada</h4>
                        <p class="card-text text-light-muted small mb-3">Recorridos por el río Paraná junto a expertos que conocen cada rincón.</p>
                        <ul class="list-unstyled service-list mt-auto">
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Guías expertos</li>
                            <li><i class="bi bi-star-fill text-gold-tramonto me-2"></i> Equipo completo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-banner mt-5 p-5 text-center shadow-lg">
            <h3 class="text-gold-tramonto fw-bold">¿Tenés una consulta especial?</h3>
            <p class="text-light-muted mb-4">Estamos a tu disposición para personalizar cualquier servicio según tus necesidades.</p>
            <a href="{{ route('contacto') }}" class="btn btn-tramonto fw-bold">Contactanos ahora</a>
        </div>
    </div>
</div>
@endsection