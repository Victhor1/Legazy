<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
//use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest',['only'=>'showLoginForm']);
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(){
        $credential = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credential)){
            return redirect('home')->with('success','has inicado sesion');
        }

        return back()
            ->withErrors(['email'=>'No se encontro una cuenta con los datos proporcionados'])
            ->withInput(request(['email']));
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
