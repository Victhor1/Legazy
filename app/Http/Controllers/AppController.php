<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Report;
use App\Capitulo;

class AppController extends Controller
{
    public function index(){

        $count = Serie::contadorbd();
        $reports = Report::contadorbd();
        $sum = Serie::contadorView();
        $cero = Serie::contadorVoid();
        $capitulo = Capitulo::contadorbd();

        return view('admin.index',compact('count','sum','cero','reports','capitulo'));
    }
}
