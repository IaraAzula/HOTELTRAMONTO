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

            // Ahora que configuramos auth.php, esto va a buscar directo en tu tabla 'usuarios'
            if (Auth::attempt($credenciales)) {
                $request->session()->regenerate();

                // Redirige a la sección de admin sólo si es un usuario administrador verdadero
                if (Auth::user()->rol_id == 1 || (Auth::user()->rol && Auth::user()->rol->nombre === 'Admin')) {
                    return redirect()->route('admin.dashboard')->with('exito', '¡Bienvenido al panel de administrador!');
                }

                return redirect()->route('catalogo')->with('exito', '¡Bienvenido de nuevo!');
            }

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