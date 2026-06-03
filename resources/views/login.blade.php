@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; }
    .bg-login { min-height: 80vh; display: flex; align-items: center; color: #ffffff; }
    .card-login { background-color: rgba(255, 255, 255, 0.03); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 12px; padding: 40px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); }
    .text-gold-tramonto { color: #d4af37 !important; letter-spacing: 1px; }
    .form-control-tramonto { background-color: rgba(255, 255, 255, 0.05) !important; border: 1px solid rgba(212, 175, 55, 0.4) !important; color: #ffffff !important; padding: 12px; }
    .form-control-tramonto:focus { border-color: #d4af37 !important; box-shadow: 0 0 10px rgba(212, 175, 55, 0.3) !important; }
    .btn-tramonto-submit { background-color: #d4af37; color: #020617; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; padding: 12px; width: 100%; border: 1px solid #d4af37; transition: 0.3s; }
    .btn-tramonto-submit:hover { background-color: transparent; color: #d4af37; box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); }
    .text-link-gold { color: #d4af37; text-decoration: none; }
    .text-link-gold:hover { text-decoration: underline; }
</style>

<div class="bg-login py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-login">
                    <h2 class="text-center fw-bold text-gold-tramonto mb-3">Iniciar Sesión</h2>
                    <p class="text-center text-muted small mb-4">Ingresá a tu cuenta exclusiva de Hotel Tramonto</p>

                    <form action="{{ route('login.store') }}" method="POST">
    
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-white-50">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control form-control-tramonto @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-white-50">Contraseña</label>
                            <input type="password" name="password" class="form-control form-control-tramonto" required>
                        </div>

                        <button type="submit" class="btn btn-tramonto-submit mb-3">Ingresar</button>

                        <p class="text-center small text-muted mb-0">
                            ¿No tenés cuenta todavía? <a href="{{ route('registro') }}" class="text-link-gold">Registrate acá</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection