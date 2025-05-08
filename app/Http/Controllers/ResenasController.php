<?php

namespace App\Http\Controllers;

use App\Models\resenas;
use App\Models\user;
use Illuminate\Http\Request;

class ResenasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return redirect('/reseña');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reseña=resenas::findorfail($id);
        $reseña->delete();
        return redirect('/reseña');
    }
}
