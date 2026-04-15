@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-tramonto">Otros Servicios</h1>
        <p class="lead text-muted">En Hotel Tramonto, ofrecemos experiencias diseñadas para tu máximo confort y disfrute.</p>
        <hr class="mx-auto" style="width: 100px; height: 3px; background-color: #C7B25D; border: none;">
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500" class="card-img-top" alt="Eventos" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h4 class="card-title text-tramonto">Eventos</h4>
                    <p class="card-text">Contamos con salones totalmente equipados para bodas, conferencias y reuniones sociales con vistas panorámicas a las barrancas.</p>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="bi bi-check2 text-warning"></i> Catering exclusivo</li>
                        <li><i class="bi bi-check2 text-warning"></i> Tecnología audiovisual</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1550966842-28c258688c7e?w=500" class="card-img-top" alt="Restaurant" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h4 class="card-title text-tramonto">Restaurante</h4>
                    <p class="card-text">Disfrutá de una propuesta gastronómica que combina ingredientes locales de Corrientes con cocina internacional de autor.</p>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="bi bi-check2 text-warning"></i> Desayuno buffet incluido</li>
                        <li><i class="bi bi-check2 text-warning"></i> Cava de vinos seleccionados</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1544161515-4508f5ad4c14?w=500" class="card-img-top" alt="SPA" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h4 class="card-title text-tramonto">SPA & Relax</h4>
                    <p class="card-text">Un refugio de paz. Ofrecemos circuitos de aguas, sauna seco y masajes terapéuticos para renovar cuerpo y mente.</p>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="bi bi-check2 text-warning"></i> Piscina climatizada</li>
                        <li><i class="bi bi-check2 text-warning"></i> Tratamientos faciales</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 p-5 bg-light rounded text-center shadow-sm">
        <h3 class="text-tramonto">¿Tenés una consulta especial?</h3>
        <p>Estamos a tu disposición para personalizar cualquier servicio según tus necesidades.</p>
        <a href="{{ route('contacto') }}" class="btn btn-warning fw-bold px-4">Contactanos ahora</a>
    </div>
</div>
@endsection