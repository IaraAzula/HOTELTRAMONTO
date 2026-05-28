<h1>Lista de Habitaciones</h1>

<a href="{{ route('habitaciones.create') }}">
    Crear habitacion
</a>

<hr>

@foreach ($habitaciones as $habitacion)

    <p>
        {{ $habitacion->nombre }} -
        {{ $habitacion->tipo }} -
        ${{ $habitacion->precio }}
    </p>

@endforeach