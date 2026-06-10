<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController; 
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CarritoController;

// 2. Rutas para el CRUD del Administrador (Alta, Baja, Modificación)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('habitaciones', HabitacionController::class, ['parameters' => ['habitaciones' => 'habitacion']])
        ->except('show');
    Route::resource('roles', RolController::class);
    Route::get('/admin/reservas/{reserva}', [CarritoController::class, 'detalleReserva'])->name('admin.reservas.detalle');
    Route::get('/admin/calendario', [CarritoController::class, 'calendario'])->name('admin.calendario');
    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
   
    Route::get('/admin/usuarios', [\App\Http\Controllers\CarritoController::class, 'usuariosAdmin'])->name('admin.usuarios');
    Route::get('/admin/dashboard', [\App\Http\Controllers\CarritoController::class, 'dashboardAdmin'])->name('admin.dashboard');
    // Ruta de ventas 
    Route::get('/admin/ventas', [CarritoController::class, 'ventasAdmin'])->name('admin.ventas');
    Route::get('/admin/consultas', [\App\Http\Controllers\CarritoController::class, 'consultasAdmin'])->name('admin.consultas');
    // Ruta para el panel de incidentes/consultas internas
    Route::get('/admin/consultas-internas', function () {
    return view('admin.consultas_internas');
})->name('admin.consultas.internas')->middleware('auth');
});

// 1. Ruta pública de detalle de habitación
Route::get('/habitaciones/{habitacion}', [HabitacionController::class, 'show'])->name('habitaciones.show');

// 3. Ruta para la página principal
Route::get('/', function () {
    return view('principal');
})->name('home');

// 4. Catálogo dinámico (Público)
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

// 🟢 Rutas públicas: Cualquier usuario (logueado o no) puede ver su selección y agregar habitaciones
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');

// 🔴 Rutas protegidas: Solo los usuarios logueados pueden quitar ítems, confirmar o ver el éxito
Route::middleware(['auth'])->group(function () {
    Route::delete('/carrito/quitar/{id}', [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/reserva/exito', [CarritoController::class, 'exito'])->name('reserva.exito');

    Route::post('/admin/store', [CarritoController::class, 'storeAdmin'])->name('admin.store');

  Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios');
    Route::post('/admin/usuarios/store', [UsuarioController::class, 'storeAdmin'])->name('admin.store');
    Route::delete('/admin/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    Route::get('/admin/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{id}', [UsuarioController::class, 'update'])->name('admin.usuarios.update');
});