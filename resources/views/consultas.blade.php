@extends('layouts.app')

@section('contenido')
    <div class="py-5">
        <h1>Consultas Generales</h1>
        <p>Utilizá este formulario para consultas que no sean reservas.</p>
        <form class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label class="form-label">Asunto</label>
                <select class="form-select">
                    <option>Consulta sobre tarifas</option>
                    <option>Eventos y convenciones</option>
                    <option>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tu Mensaje</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>
            <button type="button" class="btn btn-dark">Enviar Consulta</button>
        </form>
    </div>
@endsection