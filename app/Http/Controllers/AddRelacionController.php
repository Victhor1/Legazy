<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relacion;
use App\Serie;
use Redirect;

class AddRelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anime = Serie::where('id','=',$request->input('relacion'))->firstOrFail();

        $relacion = new Relacion();
        $relacion->type = $request->input('type');
        $relacion->serie_id = $request->input('id');
        $relacion->relacion_id = $request->input('relacion');
        $relacion->name = $anime->name;
        $relacion->slug = $anime->slug;
        $relacion->picture = $anime->cover;
        $relacion->Stype = $anime->type;
        $relacion->published = $anime->published;

        $relacion->save();

        $anime = Serie::where('id','=', $request->input('id'))->firstOrFail();

        return redirect('anime/'.$anime->slug)->with('success','Relación agregada correctamente');
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
    public function edit($id)
    {
        $relacion = Relacion::where('id','=',$id)->firstOrFail();
        $anime = Serie::orderBy('name', 'asc')->pluck('name','id');

        return view('relacion.edit',compact('relacion','anime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $relacion = Relacion::where('id','=',$id)->firstOrFail();
        $relacion->name = $request->input('name');
        $relacion->type = $request->input('type');
        $relacion->Stype = $request->input('Stype');
        $relacion->slug = $request->input('slug');
        $relacion->picture = $request->input('picture');
        $relacion->published = $request->input('published');
        $relacion->save();

        $anime = Serie::where('id','=',$request->input('serie_id'))->firstOrFail();

        return redirect('anime/'.$anime->slug)->with('success','Relacion editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relacion = Relacion::where('id','=',$id)
            ->firstOrFail();
        $relacion->delete();
        return redirect()->back()->with('success','Relacion eliminada correctamente');
    }
}
