<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    { /*nuevo esto*/
          View::composer('*', function ($view) {
        $carrito = session('carrito', []);
        $totalCantidad = array_sum(array_column($carrito, 'cantidad')); // suma total de cantidades
        $view->with('carritoCantidad', $totalCantidad); // se comparte con todas las vistas
    });
    }
}
