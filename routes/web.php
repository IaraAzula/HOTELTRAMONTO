<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;

// 1. Esto crea automáticamente todas las rutas para el CRUD del Administrador (Alta, Baja, Modificación)
Route::resource('habitaciones', HabitacionController::class);

// 2. Ruta para la página principal
Route::get('/', function () {
    return view('principal');
})->name('home');

// 3. catálogo ahora es dinámico y llama al controlador
Route::get('/catalogo', [HabitacionController::class, 'catalogo'])->name('catalogo');

// 4. Rutas estáticas de las habitaciones viejas 
Route::get('/habitacion-standard', function () {
    return view('habitacion-detalle-standard'); 
});
Route::get('/habitacion-suite', function () {
    return view('habitacion-detalle-suite'); 
});
Route::get('/habitacion-familiar', function () {
    return view('habitacion-detalle-familiar'); 
});

// Rutas completas para la gestión de Roles y Usuarios (CRUD)
Route::resource('roles', RolController::class);
Route::resource('usuarios', UsuarioController::class);

// 5. Demás páginas estáticas del sitio
Route::view('/quienes-somos', 'nosotros')->name('nosotros');
Route::view('/comercializacion', 'comercio')->name('comercio');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/terminos', 'terminos')->name('terminos');
Route::view('/servicios', 'otros')->name('servicios');

Route::get('/registro', [UsuarioController::class, 'create'])->name('registro');

// Ruta provisoria para el Login 
Route::get('/login', function () {
    return view('login');
})->name('login');