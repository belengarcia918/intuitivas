<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Carrito;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $carrito = \App\Models\Carrito::firstOrCreate([
                'usuario_id' => auth()->id(),
                'session_id' => auth()->check() ? null : session()->getId(),
            ]);

            $cantItems = $carrito->items()->sum('cantidad');

            $categoriasMenu = \App\Models\Categoria::orderBy('nombre')->get();

            $view->with([
                'cantItems' => $cantItems,
                'categoriasMenu' => $categoriasMenu
            ]);
        });
    }
}
