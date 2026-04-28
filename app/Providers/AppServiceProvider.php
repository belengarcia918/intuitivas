<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Session;

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
        // El View Composer debe ir aquí adentro
        View::composer('*', function ($view) {
            $carrito = Session::get('carrito', []);
            
            // Sumamos todas las cantidades de los productos en el carrito
            $cantItems = array_sum(array_column($carrito, 'cantidad'));

            $view->with('cantItems', $cantItems);
        });
    }
}
