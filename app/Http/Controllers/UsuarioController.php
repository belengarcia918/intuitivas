<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;

class UsuarioController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 1. FLUJO DE AUTENTICACIÓN
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra el formulario de Login (Frontend Público).
     */
    public function formularioLogin()
    {
        return view('backend.usuarios.login');
    }

    /**
     * Muestra el formulario de Registro (Frontend Público).
     */
    public function formularioRegistro()
    {
        return view('backend.usuarios.registro');
    }

    /**
     * Procesa la creación real de la cuenta usando RegistroRequest.
     */
    public function registrar(RegistroRequest $request) 
    {
        // Si el flujo continúa acá, significa que pasó todas las reglas de validación de RegistroRequest
        $datos = $request->validated();

        // Creación física del usuario en MariaDB usando la data validada de forma segura
        $user = Usuario::create([
            'name'      => $datos['name'],
            'apellido'  => $datos['apellido'],
            'email'     => $datos['email'],
            'telefono'  => $datos['telefono'] ?? null,   
            'direccion' => $datos['direccion'] ?? null,  
            'password'  => Hash::make($datos['password']),
            'rol'       => 'cliente' 
        ]);

        // Autenticación automática tras registrarse de manera exitosa
        Auth::login($user);

        return redirect()->route('cliente.dashboard')->with('success', 'Usuario registrado correctamente 🎉');
    }

    /**
     * Procesa el inicio de sesión real usando LoginRequest.
     */
    public function ingresar(LoginRequest $request) 
    {
        // La validación de obligatoriedad y formato de email se resuelve automáticamente
        $datos = $request->validated();

        $credenciales = [
            'email'    => $datos['email'],
            'password' => $datos['password']
        ];

        // Intento de autenticación gestionando el estado de persistencia (recordar token)
        if (Auth::attempt($credenciales, $request->has('recordar'))) {
            $request->session()->regenerate();

            // Redirección inteligente basada en el rol del usuario autenticado
            if (Auth::user()->rol === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido Administrador! 👋');
            }

            return redirect()->route('cliente.dashboard')->with('success', 'Inicio de sesión exitoso 🎉');
        }

        // Si falla el attempt, se devuelve con el mensaje de credenciales erróneas
        return back()->with('error', 'Credenciales incorrectas')->withInput();
    }

    /**
     * Cierra la sesión de forma segura invalidando los tokens actuales.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | 2. VISTAS DE ENTORNOS PRIVADOS
    |--------------------------------------------------------------------------
    */

    /**
     * Dashboard del Administrador.
     */
    public function adminDashboard()
    {
        return view('backend.admin.dashboard');
    }

    /**
     * Dashboard del Cliente.
     */
    public function clienteDashboard()
    {
        $cantItems = session('carrito') ? count(session('carrito')) : 0;
        return view('backend.usuarios.cliente', compact('cantItems'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. GESTIÓN INTERNA DEL PANEL - CRUD & BAJAS LÓGICAS
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra el listado de administradores y clientes en el panel con filtros de búsqueda.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        // Búsqueda de Administradores incluyendo los desactivados por Soft Deletes
        $administradores = Usuario::withTrashed()
            ->where('rol', 'admin') 
            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%") 
                      ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->get();

        // Búsqueda de Clientes incluyendo los desactivados por Soft Deletes
        $clientes = Usuario::withTrashed()
            ->where('rol', 'cliente') 
            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%")
                      ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->get();

        return view('backend.admin.vistaUsuarios', compact('administradores', 'clientes'));
    }

    /**
     * Cambia el rol de un usuario asegurando que el admin en sesión no se degrade a sí mismo.
     */
    public function cambiarRol(Request $request, $id)
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403);
        }

        $request->validate([
            'rol' => 'required|in:admin,cliente'
        ]);

        $usuario = Usuario::withTrashed()->findOrFail($id);

        if ($usuario->id == Auth::id() && $request->rol === 'cliente') {
            return back()->with('error', 'No puedes quitarte tu propio rol de administrador');
        }

        $usuario->rol = $request->rol;
        $usuario->save();

        return back()->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Aplica la Baja Lógica (Soft Delete) o Restauración cumpliendo con las reglas de negocio.
     */
    public function destroy($id)
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403);
        }

        $usuario = Usuario::withTrashed()->findOrFail($id);

        // REGLA 1: El administrador no puede auto-eliminarse
        if ($usuario->id == Auth::id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta');
        }

        // REGLA 2: Evita dejar el panel de control huérfano sin administradores activos.
        if ($usuario->rol === 'admin' && Usuario::where('rol', 'admin')->count() <= 1) {
            return back()->with('error', 'No puedes eliminar el último administrador');
        }

        // Si ya contaba con una baja lógica, se procede a su restauración (Activar)
        if ($usuario->trashed()) {
            $usuario->restore();
            return back()->with('success', 'Usuario activado correctamente 🎉');
        }

        // Si el usuario estaba activo, se aplica la baja lógica (Desactivar)
        $usuario->delete();

        return back()->with('success', 'Usuario desactivado correctamente');
    }
}