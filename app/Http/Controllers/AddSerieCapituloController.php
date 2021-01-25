<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use Redirect;

class AddSerieCapituloController extends Controller
{
    public function create($slug){

        $anime = Serie::where('slug','=', $slug)
            ->firstOrFail();

        return view('capitulo.create',compact('anime'));
    }
}
