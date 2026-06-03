@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; }
    .form-container {
        background-color: rgba(255,255,255,0.03);
        border: 1px solid rgba(212,175,55,0.3);
        border-radius: 12px;
        padding: 2rem;
        color: #ffffff;
    }
    .text-gold { color: #d4af37; }
    .form-label, label { color: #cbd5e1; }
    .form-control {
        background-color: rgba(255,255,255,0.05);
        border: 1px solid rgba(212,175,55,0.3);
        color: #ffffff;
    }
    .form-control:focus {
        background-color: rgba(255,255,255,0.08);
        border-color: #d4af37;
        color: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.2);
    }
    .form-control::placeholder { color: #64748b; }
    .btn-gold {
        border: 1px solid #d4af37;
        color: #d4af37;
        background: transparent;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.85rem;
        transition: 0.3s;
    }
    .btn-gold:hover {
        background-color: #d4af37;
        color: #020617;
    }
    .btn-cancelar {
        color: #cbd5e1;
        border-color: rgba(255,255,255,0.2);
        background: transparent;
    }
    .btn-cancelar:hover {
        background-color: rgba(255,255,255,0.05);
        color: #ffffff;
    }
</style>

<div style="background-color: #020617; min-height: 100vh;" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="form-container">
                    <h2 class="text-gold fw-bold mb-4">Crear Habitación</h2>

                    <form action="{{ route('habitaciones.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        </div>

                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Servicios incluidos (uno por línea)</label>
                            <textarea name="servicios" class="form-control" rows="5" placeholder="WiFi de alta velocidad&#10;Aire acondicionado&#10;Desayuno incluido">{{ old('servicios') }}</textarea>
                            <small style="color: #94a3b8;">Ingresá cada servicio en una línea separada.</small>
                        </div>

                        <div class="mb-3">
                            <label>Precio</label>
                            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}">
                        </div>

                        <div class="mb-3">
                            <label>Imágenes (una URL por línea)</label>
                            <textarea name="imagenes" class="form-control" rows="5" placeholder="https://i.postimg.cc/...&#10;https://i.postimg.cc/..."></textarea>
                            <small style="color: #94a3b8;">La primera imagen será la principal.</small>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-gold px-4">Guardar</button>
                            <a href="{{ route('habitaciones.index') }}" class="btn btn-cancelar px-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection