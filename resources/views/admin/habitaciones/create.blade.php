@extends('layouts.app')

@section('contenido')
<style>
    /* Fondo oscuro para la página */
    body { background-color: #020617 !important; }

    /* Estilo igual al de reservas */
    .card-tramonto { 
        background-color: #0b0f19 !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
        padding: 2rem !important;
        color: #ffffff !important;
        
    }

    .text-gold-tramonto { color: #d4af37 !important; }

    ::placeholder {
  color: #ffffff !important;
  opacity: 0.6; /* Un poco de transparencia para que se note que es un placeholder */
}
</style>

<div class="container py-5">
    <h1 class="fw-bold mb-4 text-gold-tramonto">Crear habitación</h1>
<div class="mb-4">
    <span style="display: inline-flex; align-items: center; gap: 5px; background: rgba(34, 197, 94, 0.1); padding: 5px 10px; border-radius: 20px; border: 1px solid rgba(34, 197, 94, 0.2);">
      <span class="text-white d-flex align-items-center" style="font-size: 0.9rem;">
          <span style="height: 8px; width: 8px; background-color: #28a745; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
            MODO ADMINISTRADOR
     </span>
    </span>
</div>
   <form id="formHabitacion" action="{{ route('habitaciones.store') }}" method="POST" class="card-tramonto shadow-sm">
        @csrf
        
        <input type="text" style="display:none">

        <div class="mb-3">
            <label class="form-label text-white">Nombre</label>
            <input type="text" name="nombre" class="form-control bg-dark text-white border-secondary" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Descripción</label>
            <textarea name="descripcion" class="form-control bg-dark text-white border-secondary" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Servicios</label>
            <textarea name="servicios" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Una línea por servicio";></textarea>
        
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-white">Precio</label>
                <input type="number" step="80" name="precio" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-white">Capacidad (personas)</label>
                <input type="number" name="capacidad" value="2" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-white">Disponibilidad</label>
                <input type="number" name="Disponibilidad" value="1" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label text-white">Imágenes (una URL por línea)</label>
            <textarea name="imagenes" class="form-control bg-dark text-white border-secondary" rows="6" placeholder="https://i.postimg.cc/url1.jpg&#10;https://i.postimg.cc/url2.jpg" ></textarea>
            <small style="color: #bec1c7;">Pegá cada URL en una línea separada. Podés usar Enter libremente acá.</small>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="button" onclick="document.getElementById('formHabitacion').submit()" class="btn btn-outline-warning">Guardar habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-light">Volver</a>
        </div>
    </form>
</div>
@endsection