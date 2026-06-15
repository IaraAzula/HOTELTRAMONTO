@extends('layouts.app')

@section('contenido')
<style>
    /* Estilos globales para mantener la coherencia */
    body { background-color: #020617 !important; color: #ffffff; }
    
    .card-tramonto { 
        background-color: #1e293b !important; 
        border: 1px solid #334155 !important; 
        color: white; 
    }

    /* Estilo del botón dorado corporativo */
    .btn-gold { 
        background-color: #d4af37 !important; 
        color: #020617 !important; 
        font-weight: bold; 
        text-transform: uppercase;
        border: none !important;
        transition: 0.3s;
    }
    .btn-gold:hover { 
        background-color: #c5a032 !important;
        transform: translateY(-2px);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-tramonto shadow-lg">
                
                <div class="card-header bg-dark text-center border-0 py-3">
                    <h3 class="mb-0 fw-bold" style="color: #d4af37;">Resumen de tu Reserva</h3>
                </div>
                
                <div class="card-body">
                    <p><strong>Número de Reserva:</strong> {{ $reserva->id }}</p>
                    <p><strong>Total a pagar:</strong> ${{ number_format($reserva->total, 2) }}</p>
                    
                    <hr style="border-color: #475569;">
                    
                    <p style="color: #cbd5e1;">Haz clic en el botón para continuar y completar tus datos de pago.</p>

                    <a href="{{ route('reservas.datos_pago', $reserva->id) }}" 
                       class="btn btn-gold w-100 py-3 shadow">
                        <i class="bi bi-credit-card me-2"></i> Continuar a Pago
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection