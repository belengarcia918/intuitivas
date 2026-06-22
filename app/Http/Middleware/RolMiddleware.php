<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $rol = trim(strtolower($user->rol ?? ''));

        $roles = array_map(fn($r) => trim(strtolower($r)), $roles);

        if (!in_array($rol, $roles, true)) {
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
}