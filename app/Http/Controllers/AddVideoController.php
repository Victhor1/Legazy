<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Capitulo;
use Redirect;

class AddVideoController extends Controller
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
        
        $video = new Video();
        $video->name = $request->input('nombre');
        $video->code = $request->input('code');
        $video->capitulo_id = $request->input('id');
        $video->slug = $request->input('slug').'-'.$request->input('nombre');
        $video->status = 1;

        $video->save();

        return redirect('view/'.$request->input('slug'))->with('success','Video registrado correctamente');

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
        $video = Video::where('id','=',$id)->firstOrFail();

        return view('video.edit',compact('video'));
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
        $video = Video::where('id','=',$id)->firstOrFail();
        $video->name = $request->input('name');
        $video->code = $request->input('code');
        $video->save();

        $capitulo = capitulo::where('id','=',$video->capitulo_id)->firstOrFail();

        return redirect('view/'.$capitulo->slug)->with('success','Video editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::where('id','=',$id)->firstOrFail();
        $video->delete();

        $capitulo = capitulo::where('id','=',$video->capitulo_id)->firstOrFail();
        return redirect('view/'.$capitulo->slug)->with('success','Video eliminado correctamente');
    }
}
