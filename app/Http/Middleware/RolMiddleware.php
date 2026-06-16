<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    /**
     * El parámetro $rol recibe el valor del grupo de rutas (ej: 'admin' o 'cliente')
     */
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        // 1. Si no está logueado, lo manda directo al Login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Compara el rol del usuario con el exigido por la ruta
        if (Auth::user()->rol === $rol) {
            return $next($request); // Rol correcto, lo deja pasar al controlador
        }

        // Si el rol no coincide (ej: un cliente intentando vulnerar /admin), frena con 403
        abort(403, 'Acceso no autorizado. Se requiere el rol de ' . $rol);
    }
}