@extends('layouts.app')

@section('contenido')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h1 class="text-tramonto">Contacto</h1>
                <div class="mt-4">
                    <p><strong>Titular:</strong> Juan Pérez</p>
                    <p><strong>Razón Social:</strong> Hotel Tramonto S.R.L.</p>
                    <p><strong>Domicilio Legal:</strong> Lavalle 55, Empedrado, Corrientes.</p>
                    <p><strong>Teléfono:</strong> +54 379 4000000</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-4">Envianos tu consulta</h4>
                    <form id="formContacto">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mensaje</label>
                            <textarea id="mensaje" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="button" onclick="mostrarAviso()" class="btn btn-warning fw-bold px-4">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalContacto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
                    <h3 class="mt-3 fw-bold">¡Mensaje enviado!</h3>
                    <p class="text-muted">Gracias por escribirnos. Nos comunicaremos con vos a la brevedad.</p>
                    <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarAviso() {
            // Validamos que los campos no estén vacíos
            const nombre = document.getElementById('nombre').value;
            const email = document.getElementById('email').value;
            const mensaje = document.getElementById('mensaje').value;

            if (nombre === "" || email === "" || mensaje === "") {
                alert("Por favor, completá todos los campos.");
                return;
            }

            // Mostramos el modal usando la API de Bootstrap
            var miModal = new bootstrap.Modal(document.getElementById('modalContacto'));
            miModal.show();

            // Reseteamos el formulario
            document.getElementById("formContacto").reset();
        }
    </script>
@endsection