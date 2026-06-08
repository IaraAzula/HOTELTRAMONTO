@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; backdrop-filter: blur(5px); }
    .btn-gold { background-color: #d4af37; color: #020617; font-weight: bold; border: 1px solid #d4af37; transition: 0.3s; }
    .btn-gold:hover { background-color: transparent; color: #d4af37; box-shadow: 0 0 10px rgba(212, 175, 55, 0.4); }
</style>

<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-tramonto p-5 shadow-lg">
                <div class="mb-4">
                    <i class="bi bi-check-circle text-success" style="font-size: 5rem;"></i>
                </div>
                
                <h1 class="fw-bold text-gold-tramonto mb-3">¡Reserva Confirmada!</h1>
                <p class="mb-0 text-white-50">Gracias por elegir Hotel Tramonto. Tu estadía ha sido registrada con éxito.</p>
                
                <div class="p-3 bg-dark rounded border border-secondary mb-4 text-start">
                    <p class="mb-2 text-white-50"><strong>Código de Reserva:</strong> <span class="text-gold-tramonto fw-bold">#{{ $datosReserva['codigo'] }}</span></p>
                    <p class="mb-0 text-white-50"><strong>Monto Total de la Operación:</strong> <span class="text-white fw-bold">${{ number_format($datosReserva['total'], 2, ',', '.') }}</span></p>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('catalogo') }}" class="btn btn-gold py-2">
                        <i class="bi bi-house-door me-2"></i>Volver al Catálogo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection