<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            // Restaurar carrito guardado en BD
            $carritoGuardado = Carrito::where('usuario_id', Auth::id())->first();
            if ($carritoGuardado && !empty($carritoGuardado->items)) {
                session()->put('carrito', $carritoGuardado->items);
            }

            if (Auth::user()->rol_id == 1 || (Auth::user()->rol && Auth::user()->rol->nombre === 'Admin')) {
                return redirect()->route('admin.dashboard')->with('exito', '¡Bienvenido al panel de administrador!');
            }

            return redirect()->route('catalogo')->with('exito', '¡Bienvenido de nuevo!');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Guardar carrito en BD antes de cerrar sesión
        $carrito = session()->get('carrito', []);
        if (!empty($carrito)) {
            Carrito::updateOrCreate(
                ['usuario_id' => Auth::id()],
                ['items' => $carrito]
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('catalogo')->with('exito', 'Sesión cerrada correctamente.');
    }
}