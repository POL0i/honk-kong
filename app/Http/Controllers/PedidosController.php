<?php

namespace App\Http\Controllers;

use App\Models\pedidos;
use App\Models\metodos_pagos;
use App\Models\user;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos=metodos_pagos::all();
        $pedidos=pedidos::all();
        $clientes=user::all();
        return view('pedido.index',compact('pagos','pedidos','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $pagos=metodos_pagos::all();
        $clientes=user::all();
        return view('pedido.create',compact('pagos','clientes'));   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pedido=pedidos::create($request->all());
        return redirect('/pedidos');
    }

    /**
     * Display the specified resource.
     */
    public function show(pedidos $pedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pedido=pedidos::findorfail($id);
        $clientes=user::all();
        $pagos=metodos_pagos::all();
        return view('pedido.edit',compact('pedido','clientes','pagos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pedido=pedidos::findorfail($id);
        $pedido->update($request->all());
        return redirect('/pedidos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pedido=pedidos::findorfail($id);
        $pedido->delete();
        return redirect('/pedidos');
    }
}
