<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Serie;
use Redirect;

class AddSerieLegazyController extends Controller
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
        $genre = Genre::orderBy('name', 'asc')->pluck('name','id');
        return view('serie.legazy.create',compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $nameCover = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/covers/', $nameCover);
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $nameBanner = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/banners/', $nameBanner);
        }

        $serie = new Serie();
        $serie->name = $request->input('name');
        $serie->slug = str_slug($serie->name);
        $serie->url = 'https://legazy.net/anime/'.$serie->slug;
        $serie->cover = $nameCover;
        $serie->banner = $nameBanner;
        $serie->status = $request->input('status');
        $serie->type = $request->input('type');
        $serie->method = 3;
        $serie->counterView = 0;
        $serie->description = $request->input('description');
        $serie->keyswords = $serie->name;
        $serie->video = 'void';
        $serie->published = $request->input('published');
        $serie->hidden = $request->input('hidden');
        $serie->languaje = $request->input('languaje');

        $serie->save();
        $serie->genres()->sync($request->genres);

        return redirect('/anime'.'/'.$serie->slug)->with('success','Anime Registrado correctamente');
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
