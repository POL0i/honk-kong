<?php

namespace App\Http\Controllers;

use App\Models\envios;
use App\Models\pedidos;
use Illuminate\Http\Request;

class EnviosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $envios=envios::all();
        $pedidos=pedidos::all();
        return view('envio.index',compact('envios','pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pedidos=pedidos::all();
        return view('envio.create',compact('pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $envio=envios::create($request->all());
        return redirect('/envios');
    }

    /**
     * Display the specified resource.
     */
    public function show(envios $envios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $envio=envios::findorfail($id);
        $pedidos=pedidos::all();
        return view('envio.edit',compact('envio','pedidos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $envio=envios::findorfail($id);
        $envio->update($request->all());
        return redirect('/envios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $envio=envios::findorfail($id);
        $envio->delete();
        return redirect('/envios');
    }
}
