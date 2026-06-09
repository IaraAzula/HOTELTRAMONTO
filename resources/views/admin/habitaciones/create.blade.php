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

    /* --- CORRECCIÓN DE TABLA --- */
    /* Anulamos el fondo de todas las partes de la tabla */
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

    /* Hover que respeta la transparencia */
    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }
    /* --------------------------- */

    /* Estilos para los buscadores y selectores */
    .form-control-tramonto { background-color: #0f172a !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; color: #ffffff !important; }
    .form-control-tramonto:focus { border-color: #d4af37 !important; box-shadow: 0 0 8px rgba(212, 175, 55, 0.3) !important; }
    
    /* Botón de acciones */
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.85rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }

    /* Modal */
    .modal-content-tramonto { background-color: #0b1329 !important; border: 1px solid #d4af37 !important; border-radius: 14px; color: #ffffff; }
    .modal-header-tramonto { border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important; }
    .modal-footer-tramonto { border-top: 1px solid rgba(212, 175, 55, 0.1) !important; }
</style>

<div class="container py-5 bg-admin-form">
    <h1 class="fw-bold mb-4 text-gold-tramonto">Crear habitación</h1>

    <form action="{{ route('habitaciones.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

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
                <label class="form-label text-gold-tramonto">Disponibilidad</label>
                <input type="number" name="disponibilidad" value="1" min="1" class="form-control bg-dark text-white border-secondary" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label text-gold-tramonto">Imágenes (una URL por línea)</label>
            <textarea name="imagenes" class="form-control bg-dark text-white border-secondary" rows="4" placeholder="https://...\nhttps://..."></textarea>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-gold">Guardar habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-light">Volver</a>
        </div>
    </form>
</div>
@endsection
