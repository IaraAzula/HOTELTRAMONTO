<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra la vista de Login
    public function mostrarLogin()
    {
        return view('login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            
            // Si el login es exitoso, redirige al catálogo
            return redirect()->route('catalogo')->with('exito', '¡Bienvenido de nuevo!');
        }

        // Si falla, vuelve atrás con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Procesa el cierre de sesión (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('catalogo')->with('exito', 'Sesión cerrada correctamente.');
    }
}