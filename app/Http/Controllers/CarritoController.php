<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $producto = productos::findOrFail($request->id_producto);
        $cantidad = $request->cantidad ?? 1;

        $carrito = session()->get('carrito', []);

        if(isset($carrito[$producto->id_producto])){
            $carrito[$producto->id_producto]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto->id] = [
                "nombre" => $producto->nombre,
                "precio" => $producto->precio,
                "cantidad" => $cantidad,
                "imagen" => $producto->imagen_url,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return view('tienda.carrito', compact('carrito'));
    }

    public function eliminar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        if(isset($carrito[$request->producto_id])){
            unset($carrito[$request->producto_id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }
}