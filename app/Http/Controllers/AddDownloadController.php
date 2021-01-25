<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Download;
use App\Capitulo;
use Redirect;

class AddDownloadController extends Controller
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
        $download = new Download();
        $download->name = $request->input('nombre');
        $download->code = $request->input('code');
        $download->capitulo_id = $request->input('id');
        $download->slug = $request->input('slug').'-'.$request->input('nombre');
        $download->status = 1;

        $download->save();

        return redirect('view/'.$request->input('slug'))->with('success','Descarga registrada correctamente');
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
        $download = Download::where('id','=',$id)->firstOrFail();

        return view('download.edit',compact('download'));
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
        $download = Download::where('id','=',$id)->firstOrFail();
        $download->name = $request->input('name');
        $download->code = $request->input('code');
        $download->save();

        $capitulo = capitulo::where('id','=',$download->capitulo_id)->firstOrFail();

        return redirect('view/'.$capitulo->slug)->with('success','Descarga editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $download = Download::where('id','=',$id)->firstOrFail();
        $download->delete();

        $capitulo = capitulo::where('id','=',$download->capitulo_id)->firstOrFail();
        return redirect('view/'.$capitulo->slug)->with('success','Descarga eliminada correctamente');
    }
}
