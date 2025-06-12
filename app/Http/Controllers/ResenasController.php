<?php

namespace App\Http\Controllers;

use App\Models\Resena; // Nombre correcto del modelo
use App\Models\User;   // User en PascalCase
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResenasController extends Controller
{
    public function createByUser($productoId)
    {
        $producto = Producto::findOrFail($productoId);
        return view('resenas.create-by-user', compact('producto'));
    }

    public function storeByUser(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|integer|min:1|max:5',
            'producto_id' => 'required|exists:productos,id_producto'
        ]);

        Resena::create([
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
            'fecha' => now(),
            'user_id' => Auth::id(),
            'producto_id' => $request->producto_id
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Reseña agregada exitosamente');
    }


    public function index()
    {
        $reseñas=resenas::all();
        return view('reseña.index',compact('reseñas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=user::all();
        return view('reseña.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reseña=resenas::create($request->all());
        return redirect('/reseñas');
    }

    /**
     * Display the specified resource.
     */
    public function show(resenas $resenas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users=user::all();
        $reseña=resenas::findorfail($id);
        return view('reseña.edit',compact('users','reseña'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reseña=resenas::findorfail($id);
        $reseña->update($request->all());
        return redirect('/reseñas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reseña=resenas::findorfail($id);
        $reseña->delete();
        return redirect('/reseñas');
    }
}
