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
    }
    .btn-gold-outline { color: #d4af37; border: 1px solid #d4af37; font-size: 0.8rem; transition: 0.3s; }
    .btn-gold-outline:hover { background-color: #d4af37; color: #020617; }

    /* Calendario */
    .fc { color: #ffffff; }
    .fc-toolbar-title { color: #d4af37 !important; font-size: 1rem !important; }
    .fc-button { background-color: transparent !important; border: 1px solid #d4af37 !important; color: #d4af37 !important; font-size: 0.75rem !important; padding: 2px 8px !important; }
    .fc-button:hover { background-color: #d4af37 !important; color: #020617 !important; }
    .fc-button-active { background-color: #d4af37 !important; color: #020617 !important; }
    .fc-daygrid-day { background-color: rgba(15, 23, 42, 0.4) !important; }
    .fc-col-header-cell-cushion { color: #d4af37 !important; font-size: 0.75rem; }
    .fc-daygrid-day-number { color: #ffffff !important; font-size: 0.8rem; }
    .fc-day-today { background-color: rgba(212, 175, 55, 0.1) !important; }
    .fc-scrollgrid { border-color: rgba(212, 175, 55, 0.2) !important; }
    .fc-scrollgrid-sync-table td, .fc-scrollgrid-sync-table th { border-color: rgba(212, 175, 55, 0.1) !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-chat-right-text me-2"></i>Consultas</h1>
            <p class="text-white small">Panel interactivo para la administración de consultas y contactos reales</p>
        </div>
<span class="text-white d-flex align-items-center" style="font-size: 0.9rem;">
          <span style="display: inline-flex; align-items: center; gap: 5px; background: rgba(34, 197, 94, 0.1); padding: 5px 10px; border-radius: 20px; border: 1px solid rgba(34, 197, 94, 0.2);">
        <span class="text-white d-flex align-items-center" style="font-size: 0.9rem;">
          <span style="height: 8px; width: 8px; background-color: #28a745; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
            MODO ADMINISTRADOR
     </span>
    </span>
    </div>

    <div class="card card-tramonto p-4 shadow-lg">
        <h5 class="text-gold-tramonto text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 1px;">Consultas y Contactos</h5>

        <div class="table-responsive">
            <table class="table table-hover table-tramonto align-middle m-0">
                <thead>
                    <tr>
                        <th scope="col" style="width: 30%;">Usuario</th>
                        <th scope="col" style="width: 40%;">Consulta</th>
                        <th scope="col" style="width: 15%;">Estado</th>
                        <th scope="col" style="width: 15%;" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- 🔄 BUCLE DINÁMICO --}}
                    @forelse($consultas as $consulta)
                        <tr class="fila-consulta">
                            <td>
                                <strong class="text-gold-tramonto d-block">{{ $consulta->nombre }}</strong>
                                <span class="text-white small">{{ $consulta->email }}</span>
                            </td>
                            <td>
                                <span class="d-block fw-bold text-white small mb-1">{{ $consulta->asunto }}</span>
                                <span class="text-white small" style="display: block; max-width: 500px; word-wrap: break-word;">
                                    {{ $consulta->mensaje }}
                                </span>
                            </td>
                            <td>
                                {{-- Manejo dinámico del badge inicial por si persistís estados --}}
                                <span class="badge-estado {{ ($consulta->estado ?? 'No leído') === 'Leído' ? 'badge-leido' : 'badge-no-leido' }}">
                                    {{ $consulta->estado ?? 'No leído' }}
                                </span>
                            </td>
                            <td class="text-center shadow-element">
                                @if(($consulta->estado ?? 'No leído') !== 'Leído')
                                    <button type="button" class="btn btn-primary btn-sm px-3 rounded-pill btn-marcar-leido">
                                        Marcar leído
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        {{-- 📭 Mensaje por si no hay registros cargados todavía --}}
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="bi bi-folder-x display-6 d-block mb-2 text-gold-tramonto"></i>
                                No hay consultas registradas en este momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 📜 SCRIPT INTERACTIVO EN TIEMPO REAL --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botones = document.querySelectorAll('.btn-marcar-leido');

        botones.forEach(boton => {
            boton.addEventListener('click', function () {
                const fila = this.closest('.fila-consulta');
                
                if (fila) {
                    const badge = fila.querySelector('.badge-estado');
                    if (badge) {
                        badge.textContent = 'Leído';
                        badge.className = 'badge-leido';
                    }
                    
                    this.style.transition = 'all 0.3s ease';
                    this.style.opacity = '0';
                    setTimeout(() => {
                        this.remove(); 
                    }, 300);
                }
            });
        });
    });
</script>
@endsection