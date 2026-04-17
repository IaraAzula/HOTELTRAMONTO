@extends('layouts.app')

@section('contenido')
<style>
    body, .main-wrapper {
        background-color: #020617 !important;
        margin: 0; padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .carousel-item { height: 100vh; }
    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
        filter: brightness(50%); 
    }
    .hero-content {
        position: absolute;
        z-index: 10;
        width: 100%;
    }
    .text-gold-tramonto {
        color: #d4af37 !important;
        text-shadow: 0 4px 15px rgba(0,0,0,0.9);
    }
</style>

<div class="main-wrapper">
    <div class="hero-section text-center text-white">
        
        <div id="carouselTramonto" class="carousel slide carousel-fade position-absolute w-100 h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="https://i.postimg.cc/wTmK8BN0/IMG-5744.jpg" class="d-block w-100" alt="Foto 1">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="https://i.postimg.cc/m2Hxfr9V/IMG-5742.jpg" class="d-block w-100" alt="Foto 2">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="https://i.postimg.cc/RVHr50t1/IMG-5709.jpg" class="d-block w-100" alt="Foto 3">
                </div>
            </div>
        </div>

        <div class="container hero-content">
            <h1 class="display-1 fw-bold text-gold-tramonto">Hotel Tramonto</h1>
            <p class="lead fs-3 mt-4">Bienvenidos a la Perla del Paraná.</p>
            <div class="mt-5">
                <a href="{{ route('catalogo') }}" class="btn btn-warning btn-lg px-5 fw-bold">Ver Habitaciones</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializa el carrusel manualmente por si Bootstrap no lo detecta
        var myCarousel = document.querySelector('#carouselTramonto');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 4000, // Cambia cada 4 segundos
            ride: 'carousel',
            pause: false // Que no se detenga si el mouse está encima
        });
    });
</script>
@endsection