@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; }
    .table-tramonto { background-color: rgba(15, 23, 42, 0.4) !important; border: 1px solid rgba(212, 175, 55, 0.2); color: #ffffff !important; }
    .table-tramonto th { color: #d4af37 !important; border-bottom: 2px solid #d4af37 !important; text-transform: uppercase; font-size: 0.85rem; }
    .table-tramonto td { border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; color: #cbd5e1 !important; }

    /* Estilos para los botones y badges */
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.85rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }
    
    .badge-rol-tramonto { background-color: rgba(212, 175, 55, 0.1); color: #d4af37; border: 1px solid rgba(212, 175, 55, 0.3); padding: 4px 12px; font-size: 0.75rem; border-radius: 6px; text-transform: uppercase; }

    /* Estilos para el Modal */
    .modal-content-tramonto { background-color: #0b1329 !important; border: 1px solid #d4af37 !important; border-radius: 14px; color: #ffffff; }
    .modal-header-tramonto { border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; }
    .modal-footer-tramonto { border-top: 1px solid rgba(212, 175, 55, 0.1) !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-people me-2"></i>Usuarios</h1>
            <p class="text-muted small">Prototipo visual interactivo para la administración de e-commerce</p>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

    <div class="card card-tramonto p-4 shadow-lg">
        {{-- Sacamos el cuadro de búsqueda para evitar conflictos de filtrado en JS --}}
        
        <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 1px;">Gestión de Usuarios</h5>

        <div class="table-responsive">
            <table class="table table-hover table-tramonto align-middle m-0">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($usuarios) && $usuarios->count() > 0)
                        {{-- Bucle real si existen datos en la BD --}}
                        @foreach($usuarios as $user)
                            <tr class="fila-usuario">
                                <td class="fw-semibold text-white">{{ $user->name ?? $user->nombre }}</td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td>
                                    <span class="badge-rol-tramonto">Cliente</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-gold-outline btn-sm px-3 rounded-pill btn-detalle-usuario"
                                            data-nombre="{{ $user->name ?? $user->nombre }}"
                                            data-email="{{ $user->email }}"
                                            data-rol="Cliente"
                                            data-fecha="{{ $user->created_at ? $user->created_at->format('d/m/Y') : '10/05/2026' }}">
                                        Ver detalle
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        {{-- Mocks de prueba idénticos a tu captura para la presentación --}}
                        <tr class="fila-usuario">
                            <td class="fw-semibold text-white">Juan Pérez</td>
                            <td class="text-muted">juan@email.com</td>
                            <td>
                                <span class="badge-rol-tramonto">Cliente</span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-gold-outline btn-sm px-3 rounded-pill btn-detalle-usuario"
                                        data-nombre="Juan Pérez"
                                        data-email="juan@email.com"
                                        data-rol="Cliente"
                                        data-fecha="14/04/2026">
                                    Ver detalle
                                </button>
                            </td>
                        </tr>
                        <tr class="fila-usuario">
                            <td class="fw-semibold text-white">María López</td>
                            <td class="text-muted">maria@email.com</td>
                            <td>
                                <span class="badge-rol-tramonto">Cliente</span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-gold-outline btn-sm px-3 rounded-pill btn-detalle-usuario"
                                        data-nombre="María López"
                                        data-email="maria@email.com"
                                        data-rol="Cliente"
                                        data-fecha="22/04/2026">
                                    Ver detalle
                                </button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
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
</script>
@endsection