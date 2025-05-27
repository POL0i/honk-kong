<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\Promociones;
use App\Models\Resenas;
use App\Models\User;

class TiendaController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        $productos = Productos::all();
        $clientes=User::all();
        $reseñas=Resenas::with('users')->latest()->take(10)->get();
        return view('tienda.inicio', compact('categorias','productos','reseñas','clientes'));
    }
    public function categoria($id)
    {
        $categoria = Categorias::findOrFail($id);
        $productos = Productos::where('categoria_id', $id)->get();

        //return view('tienda.show', compact('categoria', 'productos'));
    }
   
}
