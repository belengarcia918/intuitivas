<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Carrito;
use App\Services\CarritoService;
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
        $sessionAnterior = $request->session()->getId();

        if (!Auth::attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            return back()->with('error', 'Credenciales incorrectas')->withInput();
        }

        CarritoService::migrarDesdeSesion($sessionAnterior);

        $request->session()->regenerate();

        $user = Auth::user();

        return $user->rol === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('cliente.dashboard');
    }

    /* LOGOUT */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}