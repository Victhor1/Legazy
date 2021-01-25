<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use DB;

class ResetController extends Controller
{
    //
    public function reset(){
        DB::table('series')
        	->select('.*')
        	->update(['counterView' => 0]);

        return redirect()->back()->with('success','Conteo iniciado en 0');
    }
}
