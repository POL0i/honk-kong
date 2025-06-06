<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\PromocionesController;
use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\ResenasController;
use App\Http\Controllers\MetodosPagosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\EnviosController;
use App\Http\Controllers\AplicacionesPromocionesController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AplicacionesDescuentosController;
use App\Http\Controllers\DetallePedidosController;
use App\Http\Controllers\AplicacionesResenasController;
use App\Http\Controllers\AplicacionesMetodosPagosController;
use App\Http\Controllers\AplicacionesPedidosController;
use App\Http\Controllers\AplicacionesEnviosController;
use App\Http\Controllers\AplicacionesCarritoController;
use App\Http\Controllers\AplicacionesProductosController;
use App\Http\Controllers\AplicacionesCategoriasController;
use App\http\Controllers\AplicacionesUsuariosController;



Route::get('/', [TiendaController::class, 'index'])->name('inicio');
Route::get('/quienes', [TiendaController::class, 'mostrar'])->name('quienes');
Route::get('/contactanos', [TiendaController::class, 'contacto'])->name('contactanos');
Route::get('/buscar/{id}', [TiendaController::class, 'buscar'])->name('buscar');
Route::get('/reseña', [TiendaController::class, 'reseña'])->name('reseña');
Route::get('/perfil', [TiendaController::class, 'mostrarPerfil'])->name('mostrarPerfil');
Route::get('/perfil/{id}/editar', [TiendaController::class, 'editarperfil'])->name('editperfil');
//prueva
route::Put('/perfil/{id}/actualizar', [TiendaController::class, 'actualizarPerfil'])->name('actualizarPerfil');

Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    
}); 


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('dashboard');
    //rutas para producto


Route::middleware(['auth', 'can:admin-only'])->group(function () {

route::get('/producto', [ProductosController::class, 'index'])->name('home'); 
route::get('/producto/crear', [ProductosController::class, 'create'])->name('home');
route::post('/producto/guardar',[ProductosController::class, 'store'])->name('home');
route::get('/producto/{id}/editar',[ProductosController::class, 'edit'])->name('home');
route::Put('/producto/{id}/actualizar', [ProductosController::class, 'update'])->name('home');
route::delete('/producto/{id}/eliminar', [ProductosController::class, 'destroy'])->name('home');


//users
route::get('/user', [UsersController::class, 'index'])->name('home'); 
route::get('/user/crear', [UsersController::class, 'create'])->name('home');
route::post('/user/guardar',[UsersController::class, 'store'])->name('home');
route::get('/user/{id}/editar',[UsersController::class, 'edit'])->name('home');
route::Put('/user/{id}/actualizar', [UsersController::class, 'update'])->name('home');
route::delete('/user/{id}/eliminar', [UsersController::class, 'destroy'])->name('home');

// web.php
Route::post('/user/{id}/cambiar-rol', [UsersController::class, 'cambiarRol'])->name('user.cambiarRol');


//categorias
route::get('/categorias', [categoriasController::class, 'index'])->name('home'); 
route::get('/categorias/crear', [categoriasController::class, 'create'])->name('home');
route::post('/categorias/guardar',[categoriasController::class, 'store'])->name('home');
route::get('/categorias/{id}/editar',[categoriasController::class, 'edit'])->name('home');
route::Put('/categorias/{id}/actualizar', [categoriasController::class, 'update'])->name('home');
route::delete('/categorias/{id}/eliminar', [categoriasController::class, 'destroy'])->name('home');
//promociones
route::get('promociones', [promocionesController::class, 'index'])->name('home'); 
route::get('/promociones/crear', [promocionesController::class, 'create'])->name('home');
route::post('promociones/guardar',[promocionesController::class, 'store'])->name('home');
route::get('promociones/{id}/editar',[promocionesController::class, 'edit'])->name('home');
route::Put('promociones/{id}/actualizar', [promocionesController::class, 'update'])->name('home');
route::delete('promociones/{id}/eliminar', [promocionesController::class, 'destroy'])->name('home');
//descuentos
route::get('/descuentos', [descuentosController::class, 'index'])->name('home'); 
route::get('/descuentos/crear', [descuentosController::class, 'create'])->name('home');
route::post('/descuentos/guardar',[descuentosController::class, 'store'])->name('home');
route::get('/descuentos/{id}/editar',[descuentosController::class, 'edit'])->name('home');
route::Put('/descuentos/{id}/actualizar', [descuentosController::class, 'update'])->name('home');
route::delete('/descuentos/{id}/eliminar', [descuentosController::class, 'destroy'])->name('home');
//reseñas
route::get('/reseñas', [resenasController::class, 'index'])->name('home'); 
route::get('/reseñas/crear', [resenasController::class, 'create'])->name('home');
route::post('/reseñas/guardar',[resenasController::class, 'store'])->name('home');
route::get('/reseñas/{id}/editar',[resenasController::class, 'edit'])->name('home');
route::Put('/reseñas/{id}/actualizar', [resenasController::class, 'update'])->name('home');
route::delete('/reseñas/{id}/eliminar', [resenasController::class, 'destroy'])->name('home');
//metodos de pago
route::get('/pagos', [metodosPagosController::class, 'index'])->name('home'); 
route::get('/pagos/crear', [metodosPagosController::class, 'create'])->name('home');
route::post('/pagos/guardar',[metodosPagosController::class, 'store'])->name('home');
route::get('/pagos/{id}/editar',[metodosPagosController::class, 'edit'])->name('home');
route::Put('/pagos/{id}/actualizar', [metodosPagosController::class, 'update'])->name('home');
route::delete('/pagos/{id}/eliminar', [metodosPagosController::class, 'destroy'])->name('home');
//pedidos
route::get('/pedidos', [pedidosController::class, 'index'])->name('home'); 
route::get('/pedidos/crear', [pedidosController::class, 'create'])->name('home');
route::post('/pedidos/guardar',[pedidosController::class, 'store'])->name('home');
route::get('/pedidos/{id}/editar',[pedidosController::class, 'edit'])->name('home');
route::Put('/pedidos/{id}/actualizar', [pedidosController::class, 'update'])->name('home');
route::delete('/pedidos/{id}/eliminar', [pedidosController::class, 'destroy'])->name('home');
//envios
route::get('/envios', [enviosController::class, 'index'])->name('home'); 
route::get('/envios/crear', [enviosController::class, 'create'])->name('home');
route::post('/envios/guardar',[enviosController::class, 'store'])->name('home');
route::get('/envios/{id}/editar',[enviosController::class, 'edit'])->name('home');
route::Put('/envios/{id}/actualizar', [enviosController::class, 'update'])->name('home');
route::delete('/envios/{id}/eliminar', [enviosController::class, 'destroy'])->name('home');
//aplicaiones de promociones
route::get('/appromociones', [aplicacionespromocionesController::class, 'index'])->name('home'); 
route::get('/appromociones/crear', [aplicacionespromocionesController::class, 'create'])->name('home');
route::post('/appromociones/guardar',[aplicacionespromocionesController::class, 'store'])->name('home');
route::get('/appromociones/{id1}/{id2}/editar',[aplicacionespromocionesController::class, 'edit'])->name('home');
route::Put('/appromociones/{id1}/{id2}/actualizar', [aplicacionespromocionesController::class, 'update'])->name('home');
route::delete('/appromociones/{id1}/{id2}/eliminar', [aplicacionespromocionesController::class, 'destroy'])->name('home');
//con autentificacion    



});




});
