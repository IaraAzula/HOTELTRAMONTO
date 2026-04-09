@extends('layouts.app')

@section('contenido')
    <div class="py-5">
        <h1>Quiénes Somos</h1>
        <p class="lead">Hotel Tramonto nació hace más de 20 años como un emprendimiento familiar en las barrancas de Empedrado.</p>
        
        <h3 class="mt-4">Nuestros Objetivos</h3>
        <p>Brindar una experiencia de descanso única, conectando a nuestros huéspedes con la naturaleza y la cultura correntina.</p>

        <h3 class="mt-4">Nuestro Staff</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h5>Juan Pérez</h5>
                    <p class="text-muted">Gerente General</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h5>María Itatí</h5>
                    <p class="text-muted">Chef Principal</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h5>Pedro Ríos</h5>
                    <p class="text-muted">Guía de Pesca</p>
                </div>
            </div>
        </div>
    </div>
@endsection