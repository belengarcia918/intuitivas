<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function registrar(Request $request)
    {
        // Validación
        if (!$request->nombre || !$request->apellido || !$request->email || !$request->password) {
            return back()->with('error', 'Completá todos los campos');
        }

        if ($request->password !== $request->confirmar) {
            return back()->with('error', 'Las contraseñas no coinciden');
        }

        if (!$request->has('terminos')) {
            return back()->with('error', 'Debés aceptar los términos');
        }

        // Simulación éxito
        return back()->with('success', 'Usuario registrado correctamente 🎉');
    }
}
