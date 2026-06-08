@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .card-tramonto { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 12px; backdrop-filter: blur(5px); }
    .form-control-tramonto { background-color: rgba(2, 6, 23, 0.8) !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; color: #ffffff !important; }
    .form-control-tramonto:focus { border-color: #d4af37 !important; box-shadow: 0 0 8px rgba(212, 175, 55, 0.3) !important; }
    .btn-tramonto { background-color: #d4af37; color: #020617; font-weight: bold; border: 1px solid #d4af37; transition: 0.3s; width: 100%; }
    .btn-tramonto:hover { background-color: transparent; color: #d4af37; box-shadow: 0 0 10px rgba(212, 175, 55, 0.4); }
</style>

<div class="container py-5" translate="no"> {{-- Evitamos traducciones raras del navegador --}}
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            {{-- Cartel flotante de éxito específico para consultas --}}
            @if(session('exito_consulta'))
                <div class="alert alert-success alert-dismissible fade show text-center border-0 mb-4 shadow-sm" role="alert" style="background-color: rgba(25, 135, 84, 0.2); color: #2ecc71; border: 1px solid rgba(46, 204, 113, 0.4) !important;">
                    <i class="bi bi-envelope-check-fill me-2"></i>
                    {{ session('exito_consulta') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card card-tramonto p-4 shadow-lg">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-gold-tramonto">Dejanos tu Consulta</h2>
                    <p class="fw-bold fs-5 text-white">Respondemos todas tus dudas para hacer tu estadía inolvidable</p>
                </div>

                <form action="{{ route('consultas.store') }}" method="POST">
                    @csrf

                    {{-- 💡 Información del usuario logueado --}}
                    @if(Auth::check())
                    <div class="p-3 mb-4 rounded" style="background-color: rgba(199, 178, 93, 0.1); border: 1px dashed rgba(199, 178, 93, 0.4);">
                        <p class="m-0 small text-muted">Enviando consulta como:</p>
                        <p class="m-0 fw-bold" style="color: #C7B25D;">
                            {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} 
                            <span class="fw-normal text-white-50">({{ Auth::user()->email }})</span>
                        </p>
                    </div>
                    @endif

                    {{-- Asunto --}}
                    <div class="mb-3">
                        <label for="asunto" class="form-label small fw-bold text-gold-tramonto">Asunto</label>
                        <input type="text" name="asunto" id="asunto" class="form-control form-control-tramonto @error('asunto') is-invalid @enderror" value="{{ old('asunto') }}">
                        @error('asunto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mensaje --}}
                    <div class="mb-4">
                        <label for="mensaje" class="form-label small fw-bold text-gold-tramonto">Mensaje o Comentario</label>
                        <textarea name="mensaje" id="mensaje" rows="4" class="form-control form-control-tramonto @error('mensaje') is-invalid @enderror">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-tramonto py-2">
                        <i class="bi bi-send-fill me-2"></i>Enviar Mensaje
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection