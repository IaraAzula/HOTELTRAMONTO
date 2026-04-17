@extends('layouts.app')

@section('contenido')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container py-5">
        <h1 class="text-tramonto">Consultas Generales</h1>
        <p class="text-muted">Utilizá este formulario para consultas que no sean reservas.</p>
        
        <form id="formConsulta" class="bg-light p-4 rounded shadow-sm border-top border-warning border-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Asunto</label>
                <select class="form-select">
                    <option>Consulta sobre tarifas</option>
                    <option>Eventos y convenciones</option>
                    <option>Restaurante</option>
                    <option>Pesca guiada</option>
                    <option>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tu Mensaje</label>
                <textarea class="form-control" rows="4" id="mensaje" required></textarea>
            </div>
            
            <button type="button" class="btn btn-warning px-4 fw-bold" onclick="enviarFormulario()">
                Enviar Consulta
            </button>
        </form>
    </div>

    <div class="modal fade" id="modalExito" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="fw-bold">¡Consulta enviada!</h3>
                    <p class="text-muted">En breve el equipo de Hotel Tramonto se pondrá en contacto con vos.</p>
                    <button type="button" class="btn btn-dark px-5" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function enviarFormulario() {
            // validar si el mensaje no está vacío antes de mostrar el aviso
            const mensaje = document.getElementById('mensaje').value;
            
            if(mensaje.trim() === "") {
                alert("Por favor, escribe un mensaje.");
                return;
            }

            // 1. Creamos la instancia del modal de Bootstrap
            var myModal = new bootstrap.Modal(document.getElementById('modalExito'));
            
            // 2. Mostramos el modal
            myModal.show();

            // 3. Limpiamos el formulario
            document.getElementById("formConsulta").reset();
        }
    </script>
@endsection