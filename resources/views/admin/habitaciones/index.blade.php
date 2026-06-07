@extends('layouts.app')

@section('contenido')
<div class="container py-5 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-gold-tramonto mb-0">Habitaciones</h1>
        <a href="{{ route('habitaciones.create') }}" class="btn btn-gold">Nueva habitación</a>
    </div>

    <div class="table-responsive card p-3 shadow-sm" style="background: rgba(15,23,42,0.95); border: 1px solid rgba(212,175,55,0.25);">
        <table class="table table-dark table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($habitaciones as $habitacion)
                    <tr>
                        <td>{{ $habitacion->nombre }}</td>
                        <td>${{ number_format($habitacion->precio, 2, ',', '.') }}</td>
                        <td>{{ $habitacion->stock ?? 1 }}</td>
                        <td>
                            <a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="btn btn-sm btn-outline-warning me-2">Editar</a>
                            <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
