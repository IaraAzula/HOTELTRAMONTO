@extends('layouts.app')

@section('contenido')
    <h1 class="mb-4">Nuestras Habitaciones</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    [Imagen Habitación Standard]
                </div>
                <div class="card-body">
                    <h5 class="card-title">Habitación Standard</h5>
                    <p class="card-text">Cama matrimonial, aire acondicionado y Wi-Fi.</p>
                    <p class="fw-bold">$45.000 / noche</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-primary">
                <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    [Imagen Suite Río]
                </div>
                <div class="card-body">
                    <h5 class="card-title">Suite Vista al Río</h5>
                    <p class="card-text">Balcón privado hacia las barrancas y minibar.</p>
                    <p class="fw-bold">$65.000 / noche</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    [Imagen Pack Aventura]
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pack Excursión</h5>
                    <p class="card-text">Incluye estadía + día de pesca guiada.</p>
                    <p class="fw-bold">$90.000 / total</p>
                </div>
            </div>
        </div>
    </div>
@endsection