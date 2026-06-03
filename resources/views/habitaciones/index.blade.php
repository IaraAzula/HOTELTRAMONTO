<h1>Lista de Habitaciones</h1>

<a href="{{ route('habitaciones.create') }}">Crear habitación</a>

<hr>

@foreach ($habitaciones as $habitacion)
    <p>
        {{ $habitacion->nombre }} -
        {{ $habitacion->descripcion }} -
        ${{ $habitacion->precio }}

        <a href="{{ route('habitaciones.edit', $habitacion->id) }}">Editar</a>

        <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </p>
@endforeach