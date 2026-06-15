@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff !important; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    .table-tramonto, .table-tramonto thead, .table-tramonto tbody, 
    .table-tramonto tr, .table-tramonto td, .table-tramonto th { 
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
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }
    .form-control-tramonto { background-color: #0f172a !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; color: #ffffff !important; }
    .form-control-tramonto:focus { border-color: #d4af37 !important; box-shadow: 0 0 8px rgba(212, 175, 55, 0.3) !important; }
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.85rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }
    .modal-content-tramonto { background-color: #0b1329 !important; border: 1px solid #d4af37 !important; border-radius: 14px; color: #ffffff; }
    .modal-header-tramonto { border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; }
    .modal-footer-tramonto { border-top: 1px solid rgba(212, 175, 55, 0.1) !important; }
</style>

<div class="container py-5 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-gold-tramonto mb-0">Habitaciones</h1>
        <a href="{{ route('habitaciones.create') }}" class="btn btn-sm btn-outline-warning me-2">Nueva habitación</a>
    </div>

    <div class="table-responsive card p-3 shadow-sm" style="background: rgba(15,23,42,0.95); border: 1px solid rgba(212,175,55,0.25);">
        <table class="table table-dark table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($habitaciones as $habitacion)
                    <tr>
                        <td>{{ $habitacion->nombre }}</td>
                        <td>${{ number_format($habitacion->precio, 2, ',', '.') }}</td>
                        <td>{{ $habitacion->stock ?? 1 }}</td>
                        <td>
                            <a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="btn btn-sm btn-outline-warning me-2">Editar</a>
                            <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
