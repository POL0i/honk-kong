<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\Promociones;
use App\Models\Resenas;

class TiendaController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        $productos = Productos::all();
        return view('tienda.inicio', compact('categorias','productos'));
    }
    public function categoria($id)
    {
        $categoria = Categorias::findOrFail($id);
        $productos = Productos::where('categoria_id', $id)->get();

        //return view('tienda.show', compact('categoria', 'productos'));
    }
   
}
