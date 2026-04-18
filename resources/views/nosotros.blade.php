@extends('layouts.app')

@section('contenido')
<style>

    body {
        background-color: #020617 !important;
    }
    /* Tipografía Segoe UI para toda la sección */
    .font-tramonto {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Fondo Azul Oscuro para toda la página */
    .bg-main-tramonto {
        background-color: #020617; 
        color: #ffffff;
    }

    /* Color Dorado/Amarillo para resaltar */
    .text-gold-tramonto {
        color: #d4af37 !important;
    }

    /* Cards adaptadas al estilo de habitaciones pero integradas al fondo oscuro */
    .card-habitacion-style {
        background-color: rgba(255, 255, 255, 0.05); /* Fondo sutilmente claro */
        border: 1px solid #d4af37; /* Borde dorado */
        border-radius: 8px;
        color: #ffffff;
        transition: transform 0.3s ease;
    }

    .card-habitacion-style:hover {
        transform: translateY(-5px);
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* --- ESTA ES LA SECCIÓN QUE IMPORTA --- */
    .hero-section {
        background: linear-gradient(rgba(2, 6, 23, 0.7), rgba(2, 6, 23, 0.9)), 
                    url('https://i.postimg.cc/QxNXYtpr/Whats-App-Image-2026-04-18-at-8-36-53-AM.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat; /* Asegura que no se repita */
        padding: 100px 0;
    }
    /* -------------------------------------- */

    .border-gold {
        border-color: #d4af37 !important;
    }
</style>

<div class="container-fluid p-0 font-tramonto bg-main-tramonto min-vh-100">
    
    <div class="hero-section text-center shadow-lg">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4 text-gold-tramonto">Nuestra Historia</h1> 
            <p class="lead mx-auto" style="max-width: 900px; font-size: 1.25rem; color: #e2e8f0; line-height: 1.8;">
                Hotel Tramonto nació de un sueño familiar bajo los cielos dorados de Corrientes. 
                Hace más de dos décadas abrimos nuestras puertas frente a las majestuosas barrancas del Paraná, 
                convirtiéndonos en un refugio de paz y hospitalidad correntina que celebra la belleza de nuestra tierra.
            </p>
        </div>
    </div>

    <div class="py-5" style="background-color: #0f172a;">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 text-gold-tramonto">Nuestros Objetivos</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-habitacion-style h-100 shadow-sm text-center p-4">
                        <div class="fs-1 mb-2">✨</div>
                        <h4 class="fw-bold text-gold-tramonto">Excelencia</h4>
                        <p class="opacity-75">Brindar un servicio personalizado que anticipe cada deseo de nuestros huéspedes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-habitacion-style h-100 shadow-sm text-center p-4">
                        <div class="fs-1 mb-2">🌿</div>
                        <h4 class="fw-bold text-gold-tramonto">Conexión</h4>
                        <p class="opacity-75">Fomentar el reencuentro con la naturaleza en las barrancas del río Paraná.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-habitacion-style h-100 shadow-sm text-center p-4">
                        <div class="fs-1 mb-2">🏛️</div>
                        <h4 class="fw-bold text-gold-tramonto">Cultura</h4>
                        <p class="opacity-75">Preservar la identidad litoraleña en cada detalle de nuestra atención.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-5 text-gold-tramonto">Nuestro Staff</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="rounded-circle mx-auto mb-3 border border-2 border-gold" style="width: 150px; height: 150px; overflow: hidden; background: #1e293b;">
                        <img src="https://i.postimg.cc/CLWL81kR/IMG-6064.jpg" class="img-fluid" alt="Ricardo">
                    </div>
                    <h5 class="fw-bold">Ricardo Valenzuela</h5>
                    <p class="text-gold-tramonto fw-bold">Gerente General</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="rounded-circle mx-auto mb-3 border border-2 border-gold" style="width: 150px; height: 150px; overflow: hidden; background: #1e293b;">
                        <img src="https://i.postimg.cc/rmPLLn9d/IMG-6065.jpg" class="img-fluid" alt="Elena">
                    </div>
                    <h5 class="fw-bold">Bautista Solari</h5>
                    <p class="text-gold-tramonto fw-bold">Chef Principal</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="rounded-circle mx-auto mb-3 border border-2 border-gold" style="width: 150px; height: 150px; overflow: hidden; background: #1e293b;">
                        <img src="https://i.postimg.cc/cJ5ssLx3/IMG-6066.jpg" class="img-fluid" alt="Bautista">
                    </div>
                    <h5 class="fw-bold">Elena Ríos</h5>
                    <p class="text-gold-tramonto fw-bold">Guía de Expediciones</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

































































