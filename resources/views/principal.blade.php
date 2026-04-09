@extends('layouts.app')

@section('contenido')
    <div class="p-5 mb-4 bg-light rounded-3 border">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-primary">Hotel Tramonto</h1>
            <p class="col-md-8 fs-4">Bienvenidos a la Perla del Paraná en Empedrado, Corrientes. Disfrutá de la mejor vista y el máximo confort.</p>
            <a href="{{ route('catalogo') }}" class="btn btn-primary btn-lg">Ver Habitaciones</a>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <div class="p-3 border rounded">
                <h3>Ubicación</h3>
                <p>Frente a las majestuosas barrancas.</p>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Servicios</h3>
            <p>Wi-Fi, Aire Acondicionado y Desayuno.</p>
        </div>
        <div class="col-md-4">
            <h3>Contacto</h3>
            <p>Atención personalizada 24hs.</p>
        </div>
    </div>
@endsection