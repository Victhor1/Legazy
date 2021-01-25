<?php

namespace App\Http\Controllers;

use App\Capitulo;
use Illuminate\Http\Request;

class AddCapituloDownloadController extends Controller
{
    public function create($slug){

        $capitulo = Capitulo::where('slug','=', $slug)
            ->firstOrFail();

        return view('download.create',compact('capitulo'));
    }
}
