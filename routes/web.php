<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController; 
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CarritoController; 
 use App\Http\Controllers\ReservaController; 

// 1. Rutas para el CRUD del Administrador (Alta, Baja, Modificación)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('habitaciones', HabitacionController::class, ['parameters' => ['habitaciones' => 'habitacion']]);
    Route::resource('roles', RolController::class);
   Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    
    // Ruta de ventas que ya tenías
    Route::get('/admin/ventas', [CarritoController::class, 'ventasAdmin'])->name('admin.ventas');
});

// 2. Ruta para la página principal
Route::get('/', function () {
    return view('principal');
})->name('home');

// 3. Catálogo dinámico (Público)
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
Route::post('/registro', [UsuarioController::class, 'store'])->name('registro.store');

// 7. Rutas para la sección de Consultas
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index')->middleware('auth');
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store')->middleware('auth');

// 8. RUTAS DEL CARRITO DE RESERVAS

// 🟢 Rutas públicas: Cualquier usuario puede armar su carrito antes de registrarse o loguearse
Route::get('/carrito', [App\Http\Controllers\ReservaController::class, 'verCarrito'])->name('carrito.ver');
Route::post('/carrito/agregar', [App\Http\Controllers\ReservaController::class, 'agregar'])->name('carrito.agregar');

// 🔴 Rutas protegidas: Solo usuarios logueados pueden quitar items o confirmar la compra/reserva
Route::middleware(['auth'])->group(function () {
    Route::delete('/carrito/quitar/{id}', [App\Http\Controllers\CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::post('/carrito/confirmar', [App\Http\Controllers\CarritoController::class, 'confirmar'])->name('carrito.confirmar');
});