@extends('layouts.app')

@section('contenido')
<style>
    .bg-admin-form {
        background-color: #04080f;
        color: #f5f5f5;
        min-height: 100vh;
    }
    .bg-admin-form .card {
        background-color: rgba(20, 28, 45, 0.96);
        border: 1px solid rgba(212, 175, 55, 0.25);
    }
    .bg-admin-form .form-label,
    .bg-admin-form .form-text,
    .bg-admin-form .text-gold-tramonto,
    .bg-admin-form .card-title {
        color: #f5f5f5 !important;
    }
    .bg-admin-form .form-control {
        background-color: rgba(255, 255, 255, 0.06) !important;
        border: 1px solid rgba(212, 175, 55, 0.25) !important;
        color: #ffffff !important;
    }
    .bg-admin-form .form-control::placeholder {
        color: rgba(255, 255, 255, 0.55) !important;
    }
    .bg-admin-form .btn-gold {
        background-color: #d4af37;
        color: #020617;
        border: 1px solid #d4af37;
    }
</style>

<div class="container py-5 bg-admin-form">
    <h1 class="fw-bold mb-4 text-gold-tramonto">Crear habitación</h1>

    <form id="formHabitacion" action="{{ route('habitaciones.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <input type="text" style="display:none">

        <div class="mb-3">
            <label class="form-label text-gold-tramonto">Nombre</label>
            <input type="text" name="nombre" class="form-control bg-dark text-white border-secondary" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-gold-tramonto">Descripción</label>
            <textarea name="descripcion" class="form-control bg-dark text-white border-secondary" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-gold-tramonto">Servicios</label>
            <textarea name="servicios" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Una línea por servicio"></textarea>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-gold-tramonto">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-gold-tramonto">Capacidad (personas)</label>
                <input type="number" name="capacidad" value="2" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-gold-tramonto">Disponibilidad</label>
                <input type="number" name="Disponibilidad" value="1" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label text-gold-tramonto">Imágenes (una URL por línea)</label>
            <textarea name="imagenes" class="form-control bg-dark text-white border-secondary" rows="6" placeholder="https://i.postimg.cc/url1.jpg&#10;https://i.postimg.cc/url2.jpg"></textarea>
            <small style="color: #94a3b8;">Pegá cada URL en una línea separada. Podés usar Enter libremente acá.</small>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="button" onclick="document.getElementById('formHabitacion').submit()" class="btn btn-gold">Guardar habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-light">Volver</a>
        </div>
    </form>
</div>
@endsection