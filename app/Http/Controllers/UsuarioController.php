<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;

class UsuarioController extends Controller
{
    /* FORMULARIOS */
    public function formularioLogin()
    {
        return view('backend.usuarios.login');
    }

    public function formularioRegistro()
    {
        return view('backend.usuarios.registro');
    }

    /* REGISTRO */
    public function registrar(RegistroRequest $request)
    {
        $data = $request->validated();

        $user = Usuario::create([
            'name'      => $data['name'],
            'apellido'  => $data['apellido'],
            'email'     => $data['email'],
            'telefono'  => $data['telefono'] ?? null,
            'direccion' => $data['direccion'] ?? null,
            'password'  => $data['password'],
            'rol'       => 'cliente'
        ]);

        Auth::login($user);

        return redirect()
            ->route('cliente.dashboard')
            ->with('success', 'Registro exitoso 🎉');
    }

    /* LOGIN */
    public function ingresar(LoginRequest $request)
    {
        // En lugar de usar $request->validated(), seleccionamos estrictamente lo necesario
        $credentials = $request->only('email', 'password');

        // Intentamos autenticar con la opción de "recordarme"
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->with('error', 'Credenciales incorrectas')->withInput();
        }

        // Si pasa, regeneramos la sesión para evitar fijación de sesiones
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirección limpia por rol
        return $user->rol === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('cliente.dashboard');
    }

    /* LOGOUT */
    public function logout(Request $request)
    {
        // 1. Cierra la sesión en el Guard de autenticación
        Auth::logout();

        // 2. Limpia los datos de la sesión actual (como el carrito, etc.)
        $request->session()->flush();

        // 3. Invalida la sesión por completo de forma segura
        $request->session()->invalidate();

        // 4. Regenera el token para la próxima sesión limpia
        $request->session()->regenerateToken();

        // 5. Redirige al login de manera limpia
        return redirect()->to('/login');
    }
}