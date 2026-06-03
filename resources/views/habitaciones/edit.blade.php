<h1>Editar Habitación</h1>

<form action="{{ route('habitaciones.update', $habitacion->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nombre" value="{{ $habitacion->nombre }}" placeholder="Nombre">
    <br><br>

    <textarea name="descripcion" placeholder="Descripción">{{ $habitacion->descripcion }}</textarea>
    <br><br>

    <input type="number" step="0.01" name="precio" value="{{ $habitacion->precio }}" placeholder="Precio">
    <br><br>

    <input type="text" name="imagen" value="{{ $habitacion->imagen }}" placeholder="URL de imagen">
    <br><br>

    <button type="submit">Actualizar</button>
</form>
