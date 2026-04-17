@extends('layouts.app')

@section('contenido')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .comercializacion-wrapper {
        /* Cambio a la nueva foto manteniendo el oscurecimiento para legibilidad */
        background: linear-gradient(rgba(5, 10, 24, 0.85), rgba(5, 10, 24, 0.85)), 
                    url('https://i.postimg.cc/MH8dRzPk/IMG-5708.jpg'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        
        color: white;
        min-height: 100vh;
        margin-bottom: -50px;
        padding-bottom: 80px;
    }

    .titulo-dorado {
        color: #d4af37;
        font-weight: bold;
    }

    .pago-item {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 12px;
        padding: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
        backdrop-filter: blur(5px);
    }

    .pago-item:hover {
        background-color: rgba(212, 175, 55, 0.1);
        border-color: #d4af37;
        transform: translateY(-5px);
    }

    .icon-gold {
        color: #d4af37;
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .checkin-card {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        height: 100%;
        backdrop-filter: blur(5px);
    }
</style>

<div class="comercializacion-wrapper font-tramonto">
    <div class="container py-5">
        
        <h1 class="text-center display-5 titulo-dorado mb-5">Métodos de Pago</h1>

        <div class="row justify-content-center g-4 mb-5">
            <div class="col-12 col-md-8 col-lg-7"> 
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="pago-item text-center shadow-sm">
                            <i class="fa-solid fa-handshake-angle icon-gold"></i>
                            <span class="fw-bold fs-5 text-white">Mercado Pago</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="pago-item text-center shadow-sm">
                            <i class="fa-solid fa-building-columns icon-gold"></i>
                            <span class="fw-bold fs-5 text-white">Transferencia</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="pago-item text-center shadow-sm">
                            <i class="fa-brands fa-paypal icon-gold"></i>
                            <span class="fw-bold fs-5 text-white">PayPal</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="pago-item text-center shadow-sm">
                            <div class="d-flex gap-3 mb-2 justify-content-center icon-gold">
                                <i class="fa-brands fa-cc-visa"></i>
                                <i class="fa-brands fa-cc-mastercard"></i>
                            </div>
                            <span class="fw-bold fs-5 text-white">Tarjetas Crédito/Débito</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center titulo-dorado mb-5 mt-5 pt-4">Información Post-Reserva</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="checkin-card d-flex align-items-center">
                    <i class="fa-solid fa-key icon-gold me-4 fs-1 mb-0"></i>
                    <div>
                        <h4 class="titulo-dorado fs-5">Tu Check-in Digital</h4>
                        <p class="small text-white-50 mb-0">Recibirás un voucher digital. Presentá este código en recepción para un ingreso rápido.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="checkin-card d-flex align-items-center">
                    <i class="fa-solid fa-bell-concierge icon-gold me-4 fs-1 mb-0"></i>
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