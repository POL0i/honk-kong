<?php

namespace App\Http\Controllers;

use App\Models\aplicaciones_promociones;
use App\Models\productos;
use App\Models\promociones;
use Illuminate\Http\Request;

class AplicacionesPromocionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appromociones=aplicaciones_promociones::all();
        $productos=productos::all();
        $promociones=promociones::all();
        return view('appromocion.index',compact('appromociones','productos','promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos=productos::all();
        $promociones=promociones::all();
        return view('appromocion.create',compact('productos','promociones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $aplicaciones_promocione=aplicaciones_promociones::create($request->all());
        return redirect('/appromociones');
    }

    /**
     * Display the specified resource.
     */
    public function show(aplicaciones_promociones $aplicaciones_promociones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id1 , $id2)
    {
        $appromocion=aplicaciones_promociones::where('id_producto',$id1)->where('id_promocion',$id2)->first();
        $productos=productos::all();
        $promociones=promociones::all();
        return view('appromocion.edit',compact('appromocion','productos','promociones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id1 , $id2)
    {
        $appromocion=aplicaciones_promociones::where('id_producto',$id1)->where('id_promocion',$id2)->delete();
        $appromocion=aplicaciones_promociones::create($request->all());
        return redirect('/appromociones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id1 , $id2)
    {
        $appromocion=aplicaciones_promociones::where('id_producto',$id1)->where('id_promocion',$id2)->delete();
        return redirect('/appromociones');
    }
}
