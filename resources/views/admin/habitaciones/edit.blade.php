@extends('layouts.app')

@section('contenido')
<div class="container py-5 text-white">
    <h1 class="fw-bold mb-4 text-gold-tramonto">Editar habitación</h1>

    <form action="{{ route('habitaciones.update', $habitacion->id) }}" method="POST" class="card p-4 shadow-sm" style="background: rgba(15,23,42,0.9); border: 1px solid rgba(212,175,55,0.25);">
        @csrf
        @method('PUT')

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
                <label class="form-label text-gold-tramonto">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $habitacion->stock ?? 1) }}" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label text-gold-tramonto">URL de imagen</label>
            <input type="text" name="imagen" value="{{ old('imagen', $habitacion->imagen) }}" class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-gold">Actualizar habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-light">Volver</a>
        </div>
    </form>
</div>
@endsection
