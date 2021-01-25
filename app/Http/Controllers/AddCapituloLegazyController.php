<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capitulo;

class AddCapituloLegazyController extends Controller
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
        $capitulo = new Capitulo();
        $capitulo->url = 'https://legazy.net/view/'.$request->input('slug').'-'.$request->input('number');
        $capitulo->name = $request->input('name');
        $capitulo->slug = $request->input('slug').'-'.$request->input('number');
        $capitulo->number = $request->input('number');
        $capitulo->status = 1;
        $capitulo->AnimeStatus = $request->input('status');
        $capitulo->picture = $request->input('banner');
        $capitulo->counterView = 0;
        $capitulo->method = 3;
        $capitulo->serie_id = $request->input('id');

        $capitulo->save();

        return redirect('view/'.$capitulo->slug)->with('success','Capítulo registrado correctamente');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
