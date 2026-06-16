<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario; // Tu modelo personalizado mapeado a la tabla de usuarios
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 1. MÓDULO DE AUTENTICACIÓN (Páginas 3 a 7 del PDF de la Cátedra)
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra la vista Blade de registro (Página 4)
     */
    public function formularioRegistro()
    {
        // Ubicación exacta estipulada en la estructura de vistas del PDF
        return view('backend.usuarios.registro');
    }

    /**
     * Muestra la vista Blade de login (Página 4)
     */
    public function formularioLogin()
    {
        // Ubicación exacta estipulada en la estructura de vistas del PDF
        return view('backend.usuarios.login');
    }

    /**
     * Procesa el formulario de registro e inicia sesión (Páginas 4 y 5)
     */
    public function registrar(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email', // Valida contra tu tabla 'usuarios'
            'password' => 'required|min:6|confirmed'
        ]);

        // Creación del usuario con el rol por defecto asignado a clientes
        $user = Usuario::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), 
            'rol'      => 'cliente' 
        ]);

        // Autenticación automática tras el registro
        Auth::login($user);

        // Redirecciona al subentorno de clientes protegido por el middleware
        return redirect()->route('cliente.dashboard');
    }

    /**
     * Procesa el inicio de sesión y evalúa la redirección según Rol (Calcado a la filmina)
     */
    public function autenticar(Request $request)
    {
        // Validación de campos tal cual la diapositiva (image_3ddce0.png)
        $credenciales = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Intento de inicio de sesión con las credenciales provistas
        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            // ESTRUCTURA EXACTA DEL PROFESOR: Guarda el usuario en la variable $user (image_3ddce0.png)
            $user = Auth::user();

            // Bifurcación condicional evaluando la propiedad del rol (image_3ddce0.png)
            if ($user->rol === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirección exacta a /admin
            }

            return redirect()->route('cliente.dashboard'); // Redirección exacta a /cliente
        }

        // Si la autenticación falla, regresa con error de sesión (image_3ddce0.png)
        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos'
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión de forma segura destruyendo los tokens de cookie (Página 7)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    /*
    |--------------------------------------------------------------------------
    | 2. MÓDULO ADMINISTRATIVO (Gestión de Usuarios del Panel Privado)
    |--------------------------------------------------------------------------
    | Estos métodos dan soporte a las acciones de control de cuentas del Administrador.
    */

    /**
     * Lista todos los usuarios registrados en el sistema
     */
    public function indexUsuarios()
    {
        // Traemos todos los usuarios para renderizarlos en una tabla administrativa
        $usuarios = Usuario::all();
        return view('backend.admin.usuarios', compact('usuarios'));
    }

    /**
     * Permite al administrador alternar o cambiar el rol de un usuario
     */
    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required|in:admin,cliente'
        ]);

        $usuario = Usuario::findOrFail($id);
        
        // CONTROL DE SEGURIDAD: Evitar que el administrador se quite el rol a sí mismo usando comparación estricta
        if ((int) Auth::user()->id === (int) $usuario->id) {
            return back()->with('error-message', 'No podés cambiar tu propio rol de administrador.');
        }

        $usuario->rol = $request->rol;
        $usuario->save();

        return back()->with('success-message', 'El rol del usuario fue actualizado correctamente.');
    }

    /**
     * Elimina una cuenta de usuario permanentemente
     */
    public function destroyUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);

        // CONTROL DE SEGURIDAD: Evitar que el administrador borre su propia cuenta estando en sesión
        if ((int) Auth::user()->id === (int) $usuario->id) {
            return back()->with('error-message', 'No podés eliminar tu propia cuenta mientras estés en sesión.');
        }

        $usuario->delete();

        return back()->with('success-message', 'El usuario ha sido dado de baja de la plataforma correctamente.');
    }
}