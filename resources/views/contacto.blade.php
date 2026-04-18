@extends('layouts.app')

@section('contenido')
<style>
    body {
        background-color: #020617 !important;
    }

    .contacto-section {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 90vh;
    }

    .text-gold-tramonto {
        color: #d4af37 !important;
    }

    .text-light-muted {
        color: #cbd5e1 !important;
    }

    /* --- CORRECCIÓN DE COLOR PARA PLACEHOLDERS --- */
    .form-control::placeholder {
        color: #94a3b8 !important; /* Gris claro visible */
        opacity: 1; 
    }

    .glass-card {
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .form-label {
        color: #d4af37;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        font-weight: bold;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white !important;
        transition: 0.3s;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: #d4af37;
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.2);
    }

    .btn-tramonto {
        background-color: transparent;
        border: 1px solid #d4af37;
        color: #d4af37;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.4s;
    }

    .btn-tramonto:hover {
        background-color: #d4af37;
        color: #020617;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
    }

    .map-container {
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 12px;
        overflow: hidden;
    }

    .modal-content-dark {
        background-color: #0f172a;
        border: 1px solid #d4af37;
        color: white;
    }
</style>

<div class="contacto-section py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold text-gold-tramonto mb-4">Contacto</h1>
                <div class="mb-5 text-light-muted">
                    <p class="mb-2"><strong class="text-gold-tramonto">Titular:</strong> Juan Pérez</p>
                    <p class="mb-2"><strong class="text-gold-tramonto">Razón Social:</strong> Hotel Tramonto S.R.L.</p>
                    <p class="mb-2"><strong class="text-gold-tramonto">Domicilio Legal:</strong> Lavalle 55, Empedrado, Corrientes.</p>
                    <p class="mb-2"><strong class="text-gold-tramonto">Teléfono:</strong> +54 379 4000000</p>
                    <p class="mb-2"><strong class="text-gold-tramonto">Instagram:</strong> @tramonto.hotel</p>
                </div>

                <h4 class="mb-3 text-gold-tramonto fw-bold" style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Nuestra Ubicación</h4>
                <div class="map-container shadow-lg" style="height: 300px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.7483661142274!2d-58.808000!3d-27.915000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDU0JzU0LjAiUyA1OMKwNDgnMjguOCJX!5e0!3m2!1ses!2sar!4v1713444000000!5m2!1ses!2sar" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
                <p class="mt-3 text-light-muted small"><i class="bi bi-geo-alt-fill text-gold-tramonto me-2"></i> Lavalle 55, Empedrado, Corrientes.</p>
            </div>

            <div class="col-md-6">
                <div class="glass-card p-4 p-md-5 shadow-lg">
                    <h4 class="text-gold-tramonto fw-bold mb-4 text-center">ENVIANOS TU CONSULTA</h4>
                    <form id="formContacto">
                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" id="nombre" class="form-control" placeholder="Escribí tu nombre..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" class="form-control" placeholder="ejemplo@correo.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Teléfono de Contacto</label>
                            <input type="tel" id="telefono" class="form-control" placeholder="Escribí tu número..." required>
                            <small class="text-light-muted" style="font-size: 0.75rem; font-style: italic;">Sin espacios y guiones.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mensaje</label>
                            <textarea id="mensaje" class="form-control" rows="4" placeholder="¿En qué podemos ayudarte?" required></textarea>
                        </div>
                        <button type="button" onclick="mostrarAviso()" class="btn btn-tramonto w-100 py-3 fw-bold">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalContacto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark text-center p-5">
            <div class="modal-body">
                <i class="bi bi-check-circle-fill text-gold-tramonto" style="font-size: 4rem;"></i>
                <h3 class="mt-4 fw-bold">¡Mensaje enviado!</h3>
                <p class="text-light-muted">Gracias por escribirnos. Nos comunicaremos con vos a la brevedad.</p>
                <button type="button" class="btn btn-tramonto px-5 mt-3" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script>
function mostrarAviso() {
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('telefono').value;
    const mensaje = document.getElementById('mensaje').value;

    if (nombre.trim() === "" || email.trim() === "" || telefono.trim() === "" || mensaje.trim() === "") {
        alert("Por favor, completá todos los campos.");
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Por favor, ingresá un correo electrónico válido.");
        return;
    }

    const telRegex = /^[0-9]{7,15}$/;
    if (!telRegex.test(telefono)) {
        alert("Por favor, ingresá un número de teléfono válido (solo números, entre 7 y 15 dígitos).");
        return;
    }

    var miModal = new bootstrap.Modal(document.getElementById('modalContacto'));
    miModal.show();
    document.getElementById("formContacto").reset();
}
</script>
@endsection