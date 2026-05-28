<h1>Crear Habitación</h1>

<form action="{{ route('habitaciones.store') }}" method="POST">

    @csrf

    <input type="text" name="numero" placeholder="Número">

    <br><br>

    <input type="text" name="tipo" placeholder="Tipo">

    <br><br>

    <input type="number" step="0.01" name="precio" placeholder="Precio">

    <br><br>

    <button type="submit">
        Guardar
    </button>

</form>