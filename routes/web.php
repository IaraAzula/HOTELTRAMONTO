<?php

use Illuminate\Support\Facades\Route;

// Cambiamos esto para que la raíz sea tu página principal
Route::get('/', function () {
    return view('principal');
})->name ('home');

Route::get('/habitacion-standard', function () {
    return view('habitacion-detalle-standard'); 
});
Route::get('/habitacion-suite', function () {
    return view('habitacion-detalle-suite'); 
});

Route::get('/habitacion-familiar', function () {
    return view('habitacion-detalle-familiar'); 
});
// ruta que hace funcionar el botón de "Volver"
Route::get('/habitaciones', function () {
    return view('catalogo'); 
});

Route::view('/quienes-somos', 'nosotros')->name('nosotros');
Route::view('/comercializacion', 'comercio')->name('comercio');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/terminos', 'terminos')->name('terminos');
Route::view('/catalogo', 'catalogo')->name('catalogo');
Route::view('/consultas', 'consultas')->name('consultas');
Route::view('/servicios', 'otros')->name('servicios');
