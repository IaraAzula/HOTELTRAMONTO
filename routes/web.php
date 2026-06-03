<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController; // <-- Agregamos esta importación para evitar futuros errores

// 1. Rutas para el CRUD del Administrador (Alta, Baja, Modificación)
Route::resource('habitaciones', HabitacionController::class, ['parameters' => ['habitaciones' => 'habitacion']]);
Route::resource('roles', RolController::class);
Route::resource('usuarios', UsuarioController::class);

// 2. Ruta para la página principal
Route::get('/', function () {
    return view('principal');
})->name('home');

// 3. Catálogo dinámico
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

// 5. Demás páginas estáticas del sitio
Route::view('/quienes-somos', 'nosotros')->name('nosotros');
Route::view('/comercializacion', 'comercio')->name('comercio');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/terminos', 'terminos')->name('terminos');
Route::view('/servicios', 'otros')->name('servicios');

// 6. Sistema de Autenticación (Login, Logout y Registro público)
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// El formulario público usa el método 'create' de UsuarioController 
Route::get('/registro', [UsuarioController::class, 'create'])->name('registro');
// Procesar el envío de datos del formulario (POST)
Route::post('/registro', [UsuarioController::class, 'store'])->name('registro.store');