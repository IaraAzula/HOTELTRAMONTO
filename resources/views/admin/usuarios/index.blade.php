@extends('layouts.app')

@section('contenido')
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

    <div class="card card-tramonto p-4 shadow-lg">
        <div class="table-responsive">
            <table class="table table-hover table-tramonto align-middle m-0">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo Electrónico</th>
                        <th scope="col" class="text-center">Rol</th>
                        <th scope="col" class="text-end">Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td class="fw-bold text-white">{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary px-3 py-2 text-uppercase" style="background-color: rgba(212, 175, 55, 0.1) !important; color: #d4af37 !important; border: 1px solid rgba(212, 175, 55, 0.3);">
                                    {{ $usuario->rol?->nombre ?? ($usuario->rol_id == 1 ? 'Admin' : ($usuario->rol_id == 2 ? 'Cliente' : 'Sin rol')) }}
                                </span>
                            </td>
                            <td class="text-end text-muted small">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'S/D' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection