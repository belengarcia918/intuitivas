<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function registrar(Request $request) {
        // Validación
        if (!$request->input('nombre') || !$request->input('apellido') || !$request->input('email') || !$request->input('password')) {
            return back()->with('error', 'Completá todos los campos');
        }

        if ($request->input('password') !== $request->input('confirmar')) {
            return back()->with('error', 'Las contraseñas no coinciden');
        }

        if (!$request->has('terminos')) {
            return back()->with('error', 'Debés aceptar los términos');
        }

        // Simulación éxito
        return back()->with('success', 'Usuario registrado correctamente 🎉');
    }

    public function ingresar(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!$email || !$password) {
            return back()->with('error', 'Completá todos los campos');
        }

        // Simulación login
        if ($email === "mariabelengarcia.918@gmail.com" && $password === "1234") {
            return redirect()->route('principal')->with('success', 'Inicio de sesión exitoso 🎉');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }
}
