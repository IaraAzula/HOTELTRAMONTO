@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; }
    .table-tramonto { background-color: rgba(15, 23, 42, 0.4) !important; border: 1px solid rgba(212, 175, 55, 0.2); color: #ffffff !important; }
    .table-tramonto th { color: #d4af37 !important; border-bottom: 2px solid #d4af37 !important; text-transform: uppercase; font-size: 0.85rem; }
    .table-tramonto td { border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; color: #cbd5e1 !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-people me-2"></i>Gestión de Usuarios</h1>
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
                                    {{ $usuario->rol->nombre ?? 'Cliente' }}
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