<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', 'FrontController@index');
Route::get('animes', 'FrontController@animes');
Route::get('emision', 'FrontController@emision');
Route::get('/anime/{serie}', 'FrontController@show');
Route::get('genre/{slug}',['as' => 'genre', 'uses' => 'FrontController@genreshow']);
Route::get('view/{slug}',['as' => 'capitulo', 'uses' => 'FrontController@view']);
Route::get('tipo/{type}',['as' => 'serie', 'uses' => 'FrontController@type']);
Route::resource('report','AddReportController');


Route::get('login','Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');


Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', 'AppController@index');
    Route::get('capituloAddserie/{slug}',['as' => 'serie', 'uses' => 'AddSerieCapituloController@create']);
    Route::get('capituloAddserieL/{slug}',['as' => 'serie', 'uses' => 'AddSerieCapituloController@legazy']);
    Route::get('videoAddCapitulo/{slug}',['as' => 'capitulo', 'uses' => 'AddCapituloVideoController@create']);
    Route::get('downloadAddCapitulo/{slug}',['as' => 'capitulo', 'uses' => 'AddCapituloDownloadController@create']);
    Route::get('relacionAddSerie/{slug}',['as' => 'serie', 'uses' => 'AddRelacionSerieController@create']);
    Route::resource('serie', 'AddSerieController');
    Route::resource('serieL','AddSerieLegazyController');
    Route::resource('seriejk', 'AddSerieJkController');
    Route::resource('monoschinos', 'AddSerieMCController');
    Route::resource('genre', 'AddGenreController');
    Route::resource('video', 'AddVideoController');
    Route::resource('download', 'AddDownloadController');
    Route::resource('capitulo', 'AddCapituloController');
    Route::resource('capituloL', 'AddCapituloLegazyController');
    Route::resource('relacion', 'AddRelacionController');
    Route::resource('user', 'AddUsuarioController');
    Route::resource('publicidad','AddPublicidadController');
    Route::get('register','AddCapituloController@register');
    Route::get('reset','ResetController@reset');

});