@extends('layouts.app')

@section('contenido')

<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    .metric-card { 
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.8)); 
        border: 1px solid rgba(212, 175, 55, 0.15); 
        border-radius: 12px; 
        transition: 0.3s; 
    }
    .metric-card:hover { border-color: #d4af37; transform: translateY(-3px); }
    .metric-icon { font-size: 2rem; color: #d4af37; opacity: 0.8; }
    .table-tramonto { 
        background-color: transparent !important; 
        color: #ffffff !important; 
        border-collapse: collapse !important;
    }
    .table-tramonto th { 
        color: #d4af37 !important; 
        border-bottom: 2px solid #d4af37 !important; 
        text-transform: uppercase; 
        font-size: 0.8rem; 
        padding: 1rem;
    }
    .table-tramonto tbody tr { 
        background-color: transparent !important; 
        border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; 
    }
    .table-tramonto td, .table-tramonto th { 
        background-color: transparent !important; 
        color: #cbd5e1 !important;
        padding: 1rem; 
    }
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.1) !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-5 text-white">
    <h1 class="fw-bold mb-4 text-gold-tramonto">Editar habitación</h1>

    <form id="formEditar" action="{{ route('habitaciones.update', $habitacion->id) }}" method="POST" class="card p-4 shadow-sm" style="background: rgba(15,23,42,0.9); border: 1px solid rgba(212,175,55,0.25);">
        @csrf
        @method('PUT')
        <input type="text" style="display:none">

        <div class="mb-3">
            <label class="form-label text-gold-tramonto">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $habitacion->nombre) }}" class="form-control bg-dark text-white border-secondary" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-gold-tramonto">Descripción</label>
            <textarea name="descripcion" class="form-control bg-dark text-white border-secondary" rows="4" required>{{ old('descripcion', $habitacion->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-gold-tramonto">Servicios</label>
            <textarea name="servicios" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Una línea por servicio">{{ old('servicios', $habitacion->servicios) }}</textarea>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-gold-tramonto">Precio</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $habitacion->precio) }}" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-gold-tramonto">Capacidad (personas)</label>
                <input type="number" name="capacidad" value="{{ old('capacidad', $habitacion->capacidad ?? 2) }}" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-white">Disponibilidad</label>
                <input type="number" name="disponibilidad" value="{{ old('disponibilidad', $habitacion->disponibilidad ?? 1) }}" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label text-gold-tramonto">Imágenes (una URL por línea)</label>
            <textarea name="imagenes" class="form-control bg-dark text-white border-secondary" rows="6">{{ old('imagenes', $habitacion->imagenes->pluck('url')->join("\n")) }}</textarea>
            <small style="color: #94a3b8;">Podés agregar, quitar o cambiar URLs. Una por línea.</small>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="button" onclick="document.getElementById('formEditar').submit()" class="btn btn-outline-light">Actualizar habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-light">Volver</a>
        </div>
    </form>
</div>
@endsection
