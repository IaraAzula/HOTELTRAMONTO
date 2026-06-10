@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <div class="card bg-dark text-white shadow-lg border-secondary" style="max-width: 600px; margin: auto;">
        <div class="card-header border-secondary">
            <h4 class="text-gold-tramonto">Editar Usuario: {{ $usuario->nombre }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control bg-dark text-white" value="{{ $usuario->nombre }}">
                </div>
                <div class="mb-3">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control bg-dark text-white" value="{{ $usuario->apellido }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control bg-dark text-white" value="{{ $usuario->email }}">
                </div>
                
                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection