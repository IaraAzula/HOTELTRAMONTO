@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <h1 class="mb-4 text-center text-tramonto">Nuestras Habitaciones</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-200 shadow-sm">
                <img src="https://i.postimg.cc/ncjNtWvf/IMG-5740.jpg" class="card-img-top" alt="Habitación Standard" style="height: 300px; object-fit: cover;">
                
                <div class="card-body text-center">
                    <h5 class="card-title text-tramonto">Habitación Standard</h5>
                    <p class="fw-bold text-success">USD 60 – 90 / noche</p>
                    <a href="{{ url('/habitacion-standard') }}" class="btn btn-outline-warning btn-sm">Ver más</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-200 shadow-sm">
                <img src="https://i.postimg.cc/kggxR2y6/IMG-5736.jpg" class="card-img-top" alt="Suite Río" style="height: 300px; object-fit: cover;">
                
                <div class="card-body text-center">
                    <h5 class="card-title text-tramonto">Suite Vista al Río</h5>
                    <p class="fw-bold text-success">USD 90 – 140/ noche</p>
                  <a href="{{ url('/habitacion-suite') }}" class="btn btn-outline-warning btn-sm">Ver más</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-200 shadow-sm">
                <img src="https://i.postimg.cc/KzSn6MQ6/IMG-5739.jpg class="card-img-top" alt="hab triple" style="height: 300px; object-fit: cover;">
                
                <div class="card-body text-center">
                    <h5 class="card-title text-tramonto">Familiar o Junior Suite</h5>
        
                    <p class="fw-bold text-success">USD 80 – 120 / total</p>
                    <a href="{{ url('/habitacion-familiar') }}" class="btn btn-outline-warning btn-sm">Ver más</a>
                </div>
            </div>
        </div>
    </div> </div> @endsection