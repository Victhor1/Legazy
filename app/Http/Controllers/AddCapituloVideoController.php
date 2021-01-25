<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capitulo;
use Redirect;

class AddCapituloVideoController extends Controller
{
    public function create($slug){

        $capitulo = Capitulo::where('slug','=', $slug)
            ->firstOrFail();

        return view('video.create',compact('capitulo'));
    }
}
