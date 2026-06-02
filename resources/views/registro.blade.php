@extends('layouts.app')

@section('contenido')
<style>
    body {
        background-color: #020617 !important;
    }

    .bg-register {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 85vh;
        display: flex;
        align-items: center;
    }

    .card-register {
        background-color: rgba(255, 255, 255, 0.03); 
        border: 1px solid rgba(212, 175, 55, 0.3); 
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .text-gold-tramonto {
        color: #d4af37 !important;
        letter-spacing: 1px;
    }

    /* Estilo de los inputs */
    .form-control-tramonto {
        background-color: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(212, 175, 55, 0.4) !important;
        color: #ffffff !important;
        border-radius: 6px;
        padding: 12px;
    }

    .form-control-tramonto:focus {
        border-color: #d4af37 !important;
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.3) !important;
    }

    /* Botón Dorado */
    .btn-tramonto-submit {
        background-color: #d4af37;
        color: #020617;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 12px;
        border: 1px solid #d4af37;
        transition: 0.3s;
        width: 100%;
    }

    .btn-tramonto-submit:hover {
        background-color: transparent;
        color: #d4af37;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
    }

    .text-link-gold {
        color: #d4af37;
        text-decoration: none;
    }

    .text-link-gold:hover {
        text-decoration: underline;
    }
</style>

<div class="bg-register py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card-register">
                    
                    <h2 class="text-center fw-bold text-gold-tramonto mb-3">Crear Cuenta</h2>
                    <p class="text-center text-muted small mb-4">Registrate para gestionar tus reservas en Hotel Tramonto</p>

                        <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf {{-- Token obligatorio de Laravel para evitar ataques de seguridad --}}

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Nombre</label>
                                <input type="text" name="nombre" class="form-control form-control-tramonto @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Apellido</label>
                                <input type="text" name="apellido" class="form-control form-control-tramonto @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}">
                                @error('apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-white-50">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control form-control-tramonto @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-white-50">Contraseña</label>
                            <input type="password" name="password" class="form-control form-control-tramonto @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-white-50">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-tramonto">
                        </div>

                        <button type="submit" class="btn btn-tramonto-submit mb-3">Registrarse</button>

                        <p class="text-center small text-muted mb-0">
                            ¿Ya tenés una cuenta? <a href="{{ route('login') }}" class="text-link-gold">Iniciá sesión acá</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection