<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
Route::get('/', function () {
    return view('home');
});


 //rutas para producto


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('dashboard');
    route::get('/producto', [ProductosController::class, 'index'])->name('home');
    route::get('/producto/crear', [ProductosController::class, 'create'])->name('home');
    route::post('/producto/guardar',[ProductosController::class, 'store'])->name('home');
    route::get('/producto/{id}/editar',[ProductosController::class, 'edit'])->name('home');
    route::Put('/producto/{id}/actualizar', [ProductosController::class, 'update'])->name('home');
    route::delete('/producto/{id}/eliminar', [ProductosController::class, 'destroy'])->name('home');
});
