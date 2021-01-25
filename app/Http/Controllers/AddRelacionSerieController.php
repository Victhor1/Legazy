<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class AddRelacionSerieController extends Controller
{
    public function create($slug){

        $relacion = Serie::orderBy('name', 'asc')->pluck('name','id');
        $anime = Serie::where('slug','=', $slug)
            ->firstOrFail();

        return view('relacion.create',compact('anime','relacion'));
    }
}
