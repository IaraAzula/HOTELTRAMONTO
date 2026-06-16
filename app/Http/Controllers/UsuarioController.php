<?php


namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Muestra el listado de usuarios con su relación (Evita consultas N+1)
     */ 
    
 public function index()
{
    // Filtramos por rol_id (Asegúrate que 1 sea Admin y 2 sea Cliente)
    $administradores = Usuario::where('rol_id', 1)->get(); 
    $clientes = Usuario::where('rol_id', 2)->get();

    return view('admin.usuarios.index', compact('administradores', 'clientes'));
}
    /**
     * Muestra el formulario de creación/registro de usuario
     */
    public function create()
    {
    $roles = Rol::all(); 
    return view('registro', compact('roles')); 
    }

   /**
     * Valida y registra un nuevo usuario (PÚBLICO)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed', 
            'rol_id' => 'required|exists:roles,id', 
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'rol_id.required' => 'El rol es obligatorio.',
        ]);

        Usuario::create($request->only(['nombre', 'apellido', 'email', 'password', 'rol_id']));
        
        return redirect()->route('catalogo')->with('exito', '¡Cuenta creada con éxito! Ya podés iniciar sesión.');
    }

       /**
     * Valida y registra un nuevo administrador (ADMIN)
     */
   public function storeAdmin(Request $request)
{
    // 1. Validamos los nuevos campos de password
    $request->validate([
        'nombre'   => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'email'    => 'required|email|unique:usuarios,email',
        'password' => 'required|min:8|confirmed', // 'confirmed' valida que password == password_confirmation
    ], [
        'password.required' => 'La contraseña es obligatoria.',
        'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed'=> 'Las contraseñas no coinciden.',
    ]);

    // 2. Creamos el usuario con la contraseña encriptada
    Usuario::create([
        'nombre'   => $request->nombre,
        'apellido' => $request->apellido,
        'email'    => $request->email,
        'password' => Hash::make($request->password), // Encriptación correcta
        'rol_id'   => 1, // Administrador
    ]);

    return redirect()->route('admin.usuarios.index')->with('success', 'Administrador creado con éxito.');
}

    public function show(Usuario $usuario) {}
    public function edit(Usuario $usuario) {}
    public function update(Request $request, Usuario $usuario) {}

    /**
     * Baja lógica del usuario
     */
 public function destroy($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->delete(); 
    
    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
}


}