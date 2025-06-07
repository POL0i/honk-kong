<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\detalle_pedidos;
use App\Models\metodos_pagos;
use App\Models\pedidos;
use Illuminate\Http\Request;
use App\Models\productos;

class CarritoController extends Controller
{
    public function agregar($id)
    {
        $productoDB = Productos::findorfail($id);

        if (!$productoDB) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }
    
        $producto = [
            'id' => $productoDB->id_producto,
            'nombre' => $productoDB->nombre,
            'precio' => $productoDB->precio,
            'cantidad' => 1,
        ];
    
        $carrito = session()->get('carrito', []);
    
        if (isset($carrito[$producto['id']])) {
            $carrito[$producto['id']]['cantidad'] += 1;
        } else {
            $carrito[$producto['id']] = $producto;
        }
    
        session(['carrito' => $carrito]);
    
        return redirect('/');
    }

    public function ver()
    {
        $categorias=categorias::all();
        $carrito = session('carrito', []);
        $total = 0;
    
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
    
        return view('carrito.vercarrito', compact('carrito', 'total','categorias'));
    }

    public function eliminar()
    {
        session()->forget('carrito');
        return redirect()->back()->with('success', 'Carrito vaciado correctamente');
    }

    public function pago()
    {
        $categorias=categorias::all();
        return view('carrito.pago',compact('categorias'));
    }

    public function procesarPago(Request $request)
    {
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para completar el pago.');
    }

    $request->validate([
        'nombre_titular' => 'required|string',
        'numero_targera' => 'required|numeric',
        'fecha_expiracion' => 'required|string',
        'cvc' => 'required|numeric',
        'direccion_envio' => 'required|string',
    ]);

    $user = auth()->user();
    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect()->back()->with('error', 'El carrito está vacío.');
    }

    // Guardar método de pago
    $pago = metodos_pagos::create([
        'nombre_titular' => $request->nombre_titular,
        'numero_targera' => $request->numero_targera,
        'fecha_expiracion' => $request->fecha_expiracion,
        'cvc' => $request->cvc,
        'user_id' => $user->id
    ]);

    // Crear pedido
    $pedido =pedidos::create([
        'user_id' => $user->id,
        'fecha' => now(),
        'total' => collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']),
        'estado' => 'Pendiente',
        'direccion_envio' => $request->direccion_envio,
        'id_pago' => $pago->id_pago
    ]);

    // Crear detalle del pedido
    foreach ($carrito as $item) {
        detalle_pedidos::create([
            'id_pedido' => $pedido->id_pedido,
            'id_producto' => $item['id'],
            'cantidad' => $item['cantidad'],
            'precio' => $item['precio']
        ]);
    }

    // Vaciar carrito
    session()->forget('carrito');

    return redirect('/')->with('success', '¡Pedido realizado con éxito!');
}

    
}