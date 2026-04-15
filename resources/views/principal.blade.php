@extends('layouts.app')

@section('contenido')
    <div class="hero-section text-center text-white">
        <div class="container">
            <h1 class="display-3 fw-bold text-warning">Hotel Tramonto</h1>
            
            <p class="lead fs-4 mt-3">
                Bienvenidos a la Perla del Paraná en Empedrado, Corrientes. <br>
                Disfrutá de la mejor vista y el máximo confort.
            </p>

            <div class="mt-4">
                <a href="{{ route('catalogo') }}" class="btn btn-warning btn-lg px-5 shadow">
                    Ver Habitaciones
                </a>
            </div>
        </div>
    </div>
@endsection