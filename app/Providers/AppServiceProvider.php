<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Session;
use App\Models\Categoria; // <-- ¡No te olvides de agregar este use aquí arriba!

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View Composer unificado para todo el sitio
        View::composer('*', function ($view) {
            // 1. LÓGICA DEL CARRITO (La tuya que ya funciona impecable)
            $carrito = Session::get('carrito', []);
            $cantItems = collect($carrito)->sum('cantidad');

            // 2. LÓGICA DE CATEGORÍAS DINÁMICAS (Ordenadas alfabéticamente)
            $categoriasMenu = Categoria::orderBy('nombre', 'asc')->get();

            // Inyectamos ambas variables a las vistas al mismo tiempo
            $view->with([
                'cantItems' => $cantItems,
                'categoriasMenu' => $categoriasMenu
            ]);
        });
    }
}
