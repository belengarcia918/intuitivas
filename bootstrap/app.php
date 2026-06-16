<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Importamos la clase Request

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 1. Registro del alias de tu middleware para los roles
        $middleware->alias([
            'rol' => \App\Http\Middleware\RolMiddleware::class,
        ]);

        // 2. Redirección inteligente para usuarios invitados y autenticados
        $middleware->redirectTo(
            guests: '/login', // Si no está logueado e intenta entrar a una ruta protegida, va al Login
            users: function (Request $request) {
                // Si ya inició sesión e intenta forzar la URL de /login o /registro,
                // Laravel lo intercepta y lo redirige a tu ruta 'principal' (la raíz /)
                return route('principal');
            }
        );

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
