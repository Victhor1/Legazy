<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicidad;

class AddPublicidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adds = Publicidad::all();

        return view('admin.publicidad.index',compact('adds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publicidad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Publicidad();
        $add->name = $request->input('name');
        $add->slug = str_slug($add->name);
        $add->code = $request->input('code');
        $add->state = $request->input('state');

        $add->save();
        return redirect('publicidad/')->with('success','Publicidad registrada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicidad $publicidad)
    {
        return view('admin.publicidad.edit',compact('publicidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicidad $publicidad)
    {
        $publicidad->name = $request->input('name');
        $publicidad->code = $request->input('code');
        $publicidad->state = $request->input('state');

        $publicidad->save();
        return redirect('publicidad/')->with('success','Publicidad editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicidad $publicidad)
    {
        $publicidad->delete();
        return redirect('publicidad/')->with('success','Publicidad eliminada correctamente');
    }
}
