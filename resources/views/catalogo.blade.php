@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <h1 class="mb-4 text-center text-tramonto">Nuestras Habitaciones</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-200 shadow-sm">
                <img src="https://i.postimg.cc/RFYcK5LL/IMG-5733.jpg" class="card-img-top" alt="Habitación Standard" style="height: 300px; object-fit: cover;">
                
                <div class="card-body text-center">
                    <h5 class="card-title text-tramonto">Habitación Standard</h5>
                    <p class="card-text">Cama matrimonial, aire acondicionado y Wi-Fi.</p>
                    <p class="fw-bold text-success">$45.000 / noche</p>
                    <a href="#" class="btn btn-outline-warning btn-sm">Ver más</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-200 shadow-sm border-warning">
                <img src="https://i.postimg.cc/tg1wFyhd/IMG-5738.jpg" class="card-img-top" alt="Suite Río" style="height: 300px; object-fit: cover;">
                
                <div class="card-body text-center">
                    <h5 class="card-title text-tramonto">Suite Vista al Río</h5>
                    <p class="card-text">Balcón privado hacia las barrancas y minibar.</p>
                    <p class="fw-bold text-success">$65.000 / noche</p>
                    <a href="#" class="btn btn-outline-warning btn-sm">Ver más</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-200 shadow-sm">
                <img src="https://i.postimg.cc/KzSn6MQ6/IMG-5739.jpg class="card-img-top" alt="hab triple" style="height: 300px; object-fit: cover;">
                
                <div class="card-body text-center">
                    <h5 class="card-title text-tramonto">Familiar o Junior Suite</h5>
                    <p class="card-text">Amplia y cómoda, ideal para familias o grupos.</p>
                    <p class="fw-bold text-success">$40.000 / total</p>
                    <a href="#" class="btn btn-outline-warning btn-sm">Ver más</a>
                </div>
            </div>
        </div>
    </div> </div> @endsection