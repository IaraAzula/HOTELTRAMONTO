@extends('layouts.app')

@section('contenido')
<style>
    body {
        background-color: #020617 !important;
    }

    /* Sección de Consultas con la nueva imagen de fondo */
    .bg-consultas-imagen {
        /* Capa oscura translúcida ajustada para la nueva foto */
        background-image: linear-gradient(rgba(2, 6, 23, 0.7), rgba(2, 6, 23, 0.85)), 
                          url('https://i.postimg.cc/vBt2xG2b/Whats-App-Image-2026-04-18-at-9-45-02-AM.jpg'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .text-gold-tramonto {
        color: #d4af37 !important;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.8);
    }

    .text-light-muted {
        color: #cbd5e1 !important; /* Gris Slate 300 para máxima legibilidad */
        text-shadow: 1px 1px 5px rgba(0,0,0,0.8);
    }

    /* Formulario Glassmorphism Mejorado */
    .form-glass {
        background-color: rgba(255, 255, 255, 0.02); 
        border: 1px solid rgba(212, 175, 55, 0.4); /* Borde un poco más nítido */
        border-radius: 20px;
        backdrop-filter: blur(12px); 
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
    }

    .form-label {
        color: #d4af37;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .form-control, .form-select {
        background-color: rgba(2, 6, 23, 0.5); /* Fondo más oscuro para los inputs */
        border: 1px solid rgba(212, 175, 55, 0.2);
        color: white !important;
    }

    .form-control::placeholder {
        color: #94a3b8 !important; 
    }

    .form-control:focus, .form-select:focus {
        background-color: rgba(2, 6, 23, 0.8);
        border-color: #d4af37;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
        color: white;
    }

    .form-select option {
        background-color: #020617;
        color: white;
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
        box-shadow: 0 0 25px rgba(212, 175, 55, 0.5);
    }

    .modal-content-dark {
        background-color: #020617;
        border: 1px solid #d4af37;
        color: white;
        border-radius: 15px;
    }
</style>

<div class="bg-consultas-imagen py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-gold-tramonto">Consultas Generales</h1>
            <p class="text-light-muted fs-5">Utilizá este formulario para consultas que no sean reservas.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <form id="formConsulta" class="form-glass p-4 p-md-5">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Asunto</label>
                        <select class="form-select">
                            <option>Consulta sobre tarifas</option>
                            <option>Eventos y convenciones</option>
                            <option>Restaurante</option>
                            <option>Pesca guiada</option>
                            <option>Otro</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tu Mensaje</label>
                        <textarea class="form-control" rows="5" id="mensaje" placeholder="Escribí tu consulta aquí..." required></textarea>
                    </div>
                    
                    <button type="button" class="btn btn-tramonto w-100 py-3 fw-bold" onclick="enviarFormulario()">
                        Enviar Consulta
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExito" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark text-center p-5">
            <div class="modal-body">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-gold-tramonto" style="font-size: 5rem;"></i>
                </div>
                <h2 class="fw-bold mb-3">¡Consulta enviada!</h2>
                <p class="text-light-muted mb-4">En breve el equipo de Hotel Tramonto se pondrá en contacto con vos.</p>
                <button type="button" class="btn btn-tramonto px-5" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function enviarFormulario() {
        const mensaje = document.getElementById('mensaje').value;
        if(mensaje.trim() === "") {
            return; 
        }
        var myModal = new bootstrap.Modal(document.getElementById('modalExito'));
        myModal.show();
        document.getElementById("formConsulta").reset();
    }
</script>
@endsection