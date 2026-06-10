@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; }
    
   
    .table-tramonto { background-color: transparent !important; color: #ffffff !important; }
    .table-tramonto th, 
    .table-tramonto td, 
    .table-tramonto tr { background-color: transparent !important; }

    .table-tramonto th { color: #d4af37 !important; border-bottom: 2px solid rgba(212, 175, 55, 0.4) !important; text-transform: uppercase; font-size: 0.85rem; }
    .table-tramonto td { border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; color: #cbd5e1 !important; }

    /* Estilos para los badges de estado */
    .badge-no-leido { background-color: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; }
    .badge-leido { background-color: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.4); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-chat-right-text me-2"></i>Consultas</h1>
            <p class="text-white small">Panel interactivo para la administración de consultas y contactos reales</p>
        </div>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
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