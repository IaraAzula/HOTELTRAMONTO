@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; }
    .ticket-box { background-color: rgba(2, 6, 23, 0.4); border-left: 4px solid #d4af37; border-radius: 4px; transition: 0.3s; }
    .ticket-box:hover { background-color: rgba(199, 178, 93, 0.05); }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-headset me-2"></i>Consultas Internas</h1>
            <p class="text-muted small">Canal de comunicación directa e incidencias de huéspedes alojados</p>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Soporte Huéspedes</span>
    </div>

    <div class="card card-tramonto p-4 shadow-lg">
        <h5 class="text-gold-tramonto text-uppercase fw-bold mb-4" style="font-size: 0.9rem; letter-spacing: 1px;">Bandeja de Tickets Internos</h5>

        <div class="ticket-box p-3 mb-3 shadow-sm position-relative">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="badge bg-warning text-dark mb-2" style="font-size: 0.65rem;">Habitación 104 (Suite)</span>
                    <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Inconveniente con el control del Jacuzzi</h5>
                    <p class="text-muted small mb-2">Reportado por: <strong>Matias Mendoza</strong> — mendozaamaab@gmail.com</p>
                    <p class="text-light small m-0 bg-dark p-2 rounded" style="background-color: rgba(0,0,0,0.2) !important;">
                        "Buenas tardes, el panel digital del jacuzzi de la suite no responde al intentar regular la temperatura. ¿Podrían mandar a mantenimiento?"
                    </p>
                </div>
                <div class="text-end">
                    <span class="text-muted small d-block mb-2">Hace 10 min</span>
                    <button class="btn btn-outline-warning btn-sm px-3 rounded-pill btn-resolver" style="font-size: 0.75rem;">
                        <i class="bi bi-check2-circle me-1"></i>Resolver
                    </button>
                </div>
            </div>
        </div>

        <div class="ticket-box p-3 mb-3 shadow-sm position-relative" style="border-left-color: #64748b;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="badge bg-secondary text-white mb-2" style="font-size: 0.65rem;">Cochera Privada</span>
                    <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem; text-decoration: line-through; opacity: 0.6;">Solicitud de Late Check-out y resguardo de coche</h5>
                    <p class="text-muted small mb-2">Reportado por: <strong>Lara Azula</strong> — soyunaprueba@gmail.com</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill" style="font-size: 0.7rem;">
                        <i class="bi bi-check-all me-1"></i>Resuelto
                    </span >
                    <span class="text-muted small d-block mt-2">Ayer</span>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botones = document.querySelectorAll('.btn-resolver');
        botones.forEach(boton => {
            boton.addEventListener('click', function () {
                const contenedorAccion = this.parentElement;
                // Simulación visual de resolución
                contenedorAccion.innerHTML = `
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill" style="font-size: 0.7rem;">
                        <i class="bi bi-check-all me-1"></i>Resuelto
                    </span>
                    <span class="text-muted small d-block mt-2">Justo ahora</span>
                `;
            });
        });
    });
</script>
@endsection