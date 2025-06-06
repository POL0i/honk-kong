<?php

namespace App\Http\Controllers;

use App\Models\categorias;
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
    
}