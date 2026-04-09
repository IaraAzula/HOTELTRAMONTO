<?php

use Illuminate\Support\Facades\Route;

// Cambiamos esto para que la raíz sea tu página principal
Route::get('/', function () {
    return view('principal');
})->name ('home');

Route::view('/quienes-somos', 'nosotros')->name('nosotros');
Route::view('/comercializacion', 'comercio')->name('comercio');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/terminos', 'terminos')->name('terminos');
Route::view('/catalogo', 'catalogo')->name('catalogo');
Route::view('/consultas', 'consultas')->name('consultas');