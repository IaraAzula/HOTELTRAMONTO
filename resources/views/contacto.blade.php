@extends('layouts.app')

@section('contenido')
    <div class="row py-5">
        <div class="col-md-6">
            <h1>Contacto</h1>
            <p><strong>Titular:</strong> Juan Pérez</p>
            <p><strong>Razón Social:</strong> Hotel Tramonto S.R.L.</p>
            <p><strong>Domicilio Legal:</strong> Calle Ficticia 123, Empedrado, Corrientes.</p>
            <p><strong>Teléfono:</strong> +54 379 4000000</p>
        </div>
        <div class="col-md-6">
            <h4>Envianos tu consulta</h4>
            <form>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mensaje</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-primary">Enviar Mensaje</button>
            </form>
        </div>
    </div>
@endsection