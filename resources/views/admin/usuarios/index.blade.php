@extends('layouts.app')

@section('contenido')
{{-- MENSAJE FLOTANTE EN EL MEDIO --}}
@if($errors->any())
    <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; width: 400px;">
        <div class="alert alert-danger shadow-lg border-0" style="background-color: #7f1d1d; color: #fecaca; border: 1px solid #991b1b;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white float-end" onclick="this.parentElement.parentElement.style.display='none'"></button>
        </div>
    </div>
@endif
<style>
    /* Fondo oscuro global */
    body { background-color: #020617 !important; color: #ffffff !important; }
    
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }

    /* Forzamos transparencia en TODOS los elementos de la tabla */
    .table-tramonto, .table-tramonto thead, .table-tramonto tbody, 
    .table-tramonto tr, .table-tramonto td, .table-tramonto th,
    .table-tramonto > :not(caption) > * > * { 
        background-color: transparent !important; 
        color: #ffffff !important;
        border-color: rgba(212, 175, 55, 0.2) !important;
    }

    .table-tramonto th { 
        color: #d4af37 !important; 
        border-bottom: 2px solid #d4af37 !important; 
        text-transform: uppercase; 
        font-size: 0.85rem; 
    }
    
    .table-tramonto td { 
        border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; 
        color: #cbd5e1 !important; 
    }

    /* Hover que respeta la transparencia */
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }

    /* Estilos adicionales */
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.85rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }
    
    .badge-rol-tramonto { background-color: rgba(212, 175, 55, 0.1); color: #d4af37; border: 1px solid rgba(212, 175, 55, 0.3); padding: 4px 12px; font-size: 0.75rem; border-radius: 6px; text-transform: uppercase; }

    .modal-content-tramonto { background-color: #0b1329 !important; border: 1px solid #d4af37 !important; border-radius: 14px; color: #ffffff; }
    .modal-header-tramonto { border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; }
    .modal-footer-tramonto { border-top: 1px solid rgba(212, 175, 55, 0.1) !important; }

    /*  aviso diseño dorado */
    .alert-gold {
        background-color: rgba(212, 175, 55, 0.2);
        border: 1px solid #d4af37;
        color: #d4af37;
    }
</style>

<div class="container py-5">
    @if(session('success'))
    <div class="position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 9999; width: 90%; max-width: 500px;">
        <div class="alert alert-success alert-dismissible fade show shadow-lg border-0" role="alert" style="background: #1e293b; color: #d4af37; border-left: 5px solid #d4af37;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-people me-2"></i>Usuarios</h1>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

   <div class="container py-5">
    <div class="row g-4">
       {{-- COLUMNA IZQUIERDA: CLIENTES (8 de 12 espacios) --}}
        <div class="col-lg-8">
            <div class="card card-tramonto p-4 shadow-lg h-100">
                <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3">Clientes registrados</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-tramonto align-middle m-0">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $usuario)
                            <tr>
                                <td>{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td><span class="badge-rol-tramonto">Cliente</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{-- COLUMNA DERECHA: ADMINISTRADORES (4 de 12 espacios) --}}
        <div class="col-lg-4">
            <div class="card card-tramonto p-4 shadow-lg h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-gold-tramonto text-uppercase fw-bold m-0">Administradores</h5>
                    <button class="btn btn-gold-outline btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuevoAdmin">+ Nuevo</button>
                </div>
                <div class="d-flex flex-column gap-3">
                    @forelse($administradores as $admin)
                    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-2">
                        <div>
                            <div class="fw-bold text-white">{{ $admin->nombre }} {{ $admin->apellido }}</div>
                            <small class="text-white">{{ $admin->email }}</small>
                        </div>
                            <form action="{{ route('admin.usuarios.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar a este usuario?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                    </div>
                    @empty
                        <p class="text-secondary text-center">No hay administradores.</p>
                    @endforelse
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- 🪟 MODAL DE DETALLE DE USUARIO --}}
<div class="modal fade" id="modalDetalleUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-tramonto shadow-lg">
            <div class="modal-header modal-header-tramonto">
                <h5 class="modal-title fw-bold text-gold-tramonto"><i class="bi bi-person-badge me-2"></i>Ficha del Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 text-center py-2">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px; background-color: rgba(212,175,55,0.1); border: 1px solid #d4af37;">
                        <i class="bi bi-person fs-3 text-gold-tramonto"></i>
                    </div>
                    <h4 id="modalNombreUser" class="fw-bold text-white mb-0">-</h4>
                    <span id="modalRolUser" class="badge-rol-tramonto mt-2 d-inline-block">Cliente</span>
                </div>
                
                <hr style="border-color: rgba(212,175,55,0.2);">
                
                <div class="row g-3">
                    <div class="col-12">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Correo Electrónico</label>
                        <span id="modalEmailUser" class="text-white fw-medium">-</span>
                    </div>
                    <div class="col-6">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Teléfono de Contacto</label>
                        <span class="text-white fw-medium">+54 379 4112233</span>
                    </div>
                    <div class="col-6">
                        <label class="text-gold-tramonto small text-uppercase fw-semibold d-block">Alta en Sistema</label>
                        <span id="modalFechaUser" class="text-white fw-medium">-</span>
                    </div>
                </div>
                
                <hr style="border-color: rgba(212,175,55,0.2);">
                
                <div class="p-3 rounded" style="background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212,175,55,0.1);">
                    <div class="text-white fw-medium"><i class="bi bi-info-circle me-1 text-gold-tramonto"></i> Cuenta activa y vinculada al módulo de e-commerce del hotel.</div>
                </div>
            </div>
            <div class="modal-footer modal-footer-tramonto">
                <button type="button" class="btn btn-gold-outline px-4 rounded-pill" data-bs-dismiss="modal">Cerrar Perfil</button>
            </div>
        </div>
    </div>
</div>

{{-- 📜 JAVASCRIPT PARA CONTROLAR EL MODAL --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botonesDetalle = document.querySelectorAll('.btn-detalle-usuario');
        const modalElement = document.getElementById('modalDetalleUsuario');
        
        // Instancia del modal de Bootstrap
        const modalUsuario = new bootstrap.Modal(modalElement);

        botonesDetalle.forEach(boton => {
            boton.addEventListener('click', function() {
                // Captura de datos vía atributos data-
                const nombre = this.getAttribute('data-nombre');
                const email = this.getAttribute('data-email');
                const rol = this.getAttribute('data-rol');
                const fecha = this.getAttribute('data-fecha');

                // Inyección dinámica de textos
                document.getElementById('modalNombreUser').innerText = nombre;
                document.getElementById('modalEmailUser').innerText = email;
                document.getElementById('modalRolUser').innerText = rol;
                document.getElementById('modalFechaUser').innerText = fecha;

                // Lanzar la ventana emergente
                modalUsuario.show();
            });
        });
    });
    {{-- 🪟 MODAL: CREAR NUEVO ADMINISTRADOR --}}
<div class="modal fade" id="modalNuevoAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-tramonto">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="modal-header modal-header-tramonto">
                    <h5 class="modal-title text-gold-tramonto">Nuevo Administrador</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                 @if($errors->any())
                        <div class="alert alert-danger p-2 mb-3">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="text-gold-tramonto">Nombre</label>
                        <input type="text" name="nombre" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="text-gold-tramonto">Email</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                </div>
                <div class="modal-footer modal-footer-tramonto">
                    <button type="submit" class="btn btn-gold-outline">Guardar Administrador</button>
                </div>
            </form>
        </div>
    </div>
</div>
</script>
<div class="modal fade" id="modalNuevoAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-tramonto">
            {{-- Asegúrate de que esta ruta exista en tu archivo routes/web.php --}}
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="modal-header modal-header-tramonto">
                    <h5 class="modal-title text-gold-tramonto">Crear Nuevo Administrador</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="text-gold-tramonto">Nombre completo</label>
                        <input type="text" name="nombre" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="text-gold-tramonto">Apellido</label>
                        <input type="text" name="apellido" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="text-gold-tramonto">Correo electrónico</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                </div>
                <div class="modal-footer modal-footer-tramonto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-gold-outline">Guardar Administrador</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection