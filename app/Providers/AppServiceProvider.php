<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;


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
        $totalProductos = count($carrito); // número de productos distintos
        $view->with('carritoCantidad', $totalProductos);
        $view->with('carrito', $carrito);
    });

    Blade::component('layouts.guest', 'guest-layout');
    }
}
