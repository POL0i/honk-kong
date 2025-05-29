<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\aplicaciones_promociones;
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
        $aplicaciones = aplicaciones_promociones::with(['productos', 'promociones'])->whereHas('productos')->get();
        //dd($aplicaciones->pluck('aplicaciones'));
        return view('tienda.inicio', compact('categorias','productos','reseñas','clientes','aplicaciones'));
    }

   public function mostrar()
   {
    $categorias = Categorias::all();
    return view('tienda.quienes',compact('categorias'));
   }
   public function contacto()
   {
    $categorias = Categorias::all();
    return view('tienda.contactanos',compact('categorias'));
   }
   public function buscar($id)
   {
    $categorias = Categorias::all();
    $productos=Productos::where('id_categoria',$id)->get();
    return view('tienda.buscar',compact('productos','categorias'));
   }
   public function reseña(){
    $categorias = Categorias::all();
    $reseñas=resenas::All();
    return view('tienda.reseña',compact('categorias','reseñas'));
   }

}
