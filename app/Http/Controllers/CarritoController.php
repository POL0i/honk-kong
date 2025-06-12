<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\detalle_pedidos;
use App\Models\envios;
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
     $carritoCantidad = count($carrito);
        return view('carrito.vercarrito', compact('carrito', 'total','categorias', 'carritoCantidad'));
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
            'numero_targera' => 'required|string',
            'fecha_expiracion' => 'required|string',
            'cvc' => 'required|numeric',
            'direccion_envio' => 'required|string',
        ]);
        
        $user = auth()->user();
        $carrito = session('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }
        
        // 🔍 Verificar si ya existe un método de pago con el mismo número
        $metodoExistente = metodos_pagos::where('numero_targera', $request->numero_targera)
            ->where('user_id', $user->id)
            ->first();
        
        // ✅ Usar el método existente o crearlo si no existe
        if ($metodoExistente) {
            $pago = $metodoExistente;
        } else {
            $pago = metodos_pagos::create([
                'nombre_titular' => $request->nombre_titular,
                'numero_targera' => $request->numero_targera,
                'fecha_expiracion' => $request->fecha_expiracion,
                'cvc' => $request->cvc,
                'user_id' => $user->id
            ]);
        }
        
        // 🧾 Crear el pedido
        $pedido = pedidos::create([
            'user_id' => $user->id,
            'fecha' => now(),
            'total' => collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']),
            'estado' => 'Procesado',
            'direccion_envio' => $request->direccion_envio,
            'id_pago' => $pago->id_pago
        ]);
        
        // 🧩 Crear los detalles del pedido
        foreach ($carrito as $item) {
            detalle_pedidos::create([
                'id_pedido' => $pedido->id_pedido,
                'id_producto' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio']
            ]);
        }
        //crear envio
        envios::create([
            'direccion_envio' => $request->direccion_envio,
            'fecha_envio' => now(),
            'fecha_estimada_llegada' => now()->addMinutes(30),
            'metodo_envio' => 'Envío estándar',
            'estado_envio' => 'Procesado',
            'id_pedido' => $pedido->id_pedido
        ]);
        
        
        // 🧹 Vaciar carrito
        session()->forget('carrito');
        
        return redirect('/')->with('success', '¡Pedido realizado con éxito!');
        
}
public function actualizar(Request $request, $id)
{
    $carrito = session('carrito', []);

    if (isset($carrito[$id])) {
        if ($request->accion === 'sumar') {
            $carrito[$id]['cantidad']++;
        } elseif ($request->accion === 'restar' && $carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
        }
        session(['carrito' => $carrito]);
    }

    return redirect()->back();
}
public function eliminarItem($id)
{
    $carrito = session('carrito', []);
    unset($carrito[$id]);
    session(['carrito' => $carrito]);

    return redirect()->back()->with('success', 'Producto eliminado del carrito');
}
}