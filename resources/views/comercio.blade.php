@extends('layouts.app')

@section('contenido')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Eliminamos cualquier espacio en blanco y forzamos el fondo oscuro */
    .comercializacion-wrapper {
        background-color: #050a18;
        color: white;
        min-height: 100vh;
        margin-bottom: -50px; /* Ajuste para eliminar líneas blancas con el footer */
        padding-bottom: 80px;
    }

    .titulo-dorado {
        color: #d4af37;
        font-weight: bold;
    }

    /* Estilo de los botones de pago */
    .pago-item {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: 0.3s;
    }

    .pago-item:hover {
        background-color: rgba(212, 175, 55, 0.1);
        border-color: #d4af37;
    }

    /* Iconos dorados */
    .icon-gold {
        color: #d4af37;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    /* Cards de Check-in */
    .checkin-card {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        height: 100%;
    }
</style>

<div class="comercializacion-wrapper font-tramonto">
    <div class="container py-5">
        
        <h1 class="text-center display-5 titulo-dorado mb-5">Métodos de Pago</h1>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6 col-lg-4">
                
                <div class="pago-item">
                    <i class="fa-solid fa-handshake-angle icon-gold"></i>
                    <span class="fw-bold">Mercado Pago</span>
                </div>

                <div class="pago-item">
                    <i class="fa-solid fa-building-columns icon-gold"></i>
                    <span class="fw-bold">Transferencia Bancaria</span>
                </div>

                <div class="pago-item">
                    <i class="fa-brands fa-paypal icon-gold"></i>
                    <span class="fw-bold">PayPal</span>
                </div>

                <div class="pago-item">
                    <div class="d-flex gap-3 mb-2">
                        <i class="fa-brands fa-cc-visa fs-2"></i>
                        <i class="fa-brands fa-cc-mastercard fs-2"></i>
                    </div>
                    <span class="fw-bold">Tarjeta de Crédito / Débito</span>
                </div>

            </div>
        </div>

        <h2 class="text-center titulo-dorado mb-5 mt-5">Información Post-Reserva</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="checkin-card d-flex align-items-center">
                    <i class="fa-solid fa-key icon-gold me-4 fs-1"></i>
                    <div>
                        <h4 class="titulo-dorado fs-5">Tu Check-in Digital</h4>
                        <p class="small text-white-50 mb-0">Recibirás un voucher digital. Presentá este código en recepción para un ingreso rápido.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="checkin-card d-flex align-items-center">
                    <i class="fa-solid fa-bell-concierge icon-gold me-4 fs-1"></i>
                    <div>
                        <h4 class="titulo-dorado fs-5">Entrega de Habitación</h4>
                        <p class="small text-white-50 mb-0">Preparamos tu habitación para tu llegada a partir de las <strong>14:00 hrs</strong>.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection