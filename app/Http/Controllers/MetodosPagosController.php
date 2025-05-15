<?php

namespace App\Http\Controllers;

use App\Models\metodos_pagos;
use App\Models\User;
use Illuminate\Http\Request;

class MetodosPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos=metodos_pagos::all();
        return view('pago.index',compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes=User::all();
        return view('pago.create',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pago=metodos_pagos::create($request->all());
        return redirect('/pagos');
    }

    /**
     * Display the specified resource.
     */
    public function show(metodos_pagos $metodos_pagos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pago=metodos_pagos::findorfail($id);
        $clientes=User::all();
        return view('pago.edit',compact('pago','clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pago=metodos_pagos::findorfail($id);
        $pago->update($request->all());
        return redirect('/pagos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago=metodos_pagos::findorfail($id);
        $pago->delete();
        return redirect('/pagos');
    }
}
