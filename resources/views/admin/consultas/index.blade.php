@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; backdrop-filter: blur(5px); }
    .table-tramonto { background-color: rgba(15, 23, 42, 0.4) !important; border: 1px solid rgba(212, 175, 55, 0.2); color: #ffffff !important; }
    .table-tramonto th { color: #d4af37 !important; border-bottom: 2px solid #d4af37 !important; text-transform: uppercase; font-size: 0.85rem; }
    .table-tramonto td { border-bottom: 1px solid rgba(212, 175, 55, 0.1) !important; color: #cbd5e1 !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-chat-left-text me-2"></i>Panel de Consultas</h1>
        <span class="badge bg-outline-warning border border-warning text-warning px-3 py-2">Admin Mode</span>
    </div>

    <div class="card card-tramonto p-4 shadow-lg">
        @if($consultas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-tramonto align-middle m-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 20%;">Usuario / Email</th>
                            <th scope="col" style="width: 20%;">Asunto</th>
                            <th scope="col" style="width: 45%;">Mensaje</th>
                            <th scope="col" style="width: 15%;" class="text-end">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultas as $consulta)
                            <tr>
                                <td>
                                    <div class="fw-bold text-white">{{ $consulta->nombre ?? 'Usuario Registrado' }}</div>
                                    <small class="text-muted">{{ $consulta->email ?? 'S/D' }}</small>
                                </td>
                                <td class="fw-semibold text-gold-tramonto">{{ $consulta->asunto }}</td>
                                <td class="text-wrap">{{ $consulta->mensaje }}</td>
                                <td class="text-end small text-muted">{{ $consulta->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-chat-square-dots text-muted mb-3" style="font-size: 3rem;"></i>
                <h4 class="text-white-50">No hay consultas registradas todavía</h4>
            </div>
        @endif
    </div>
</div>
@endsection