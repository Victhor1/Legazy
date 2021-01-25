<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
	protected $table = "series";
	protected $fillable = ['name', 'cover', 'banner','type','status','description'];

    public function genres(){
    	return $this->belongsToMany('App\Genre');
	}
	
	public function capitulos(){
    	return $this->hasMany('App\Capitulo')->orderBy('number','asc');
	}
	
	public function relaciones(){
    	return $this->hasMany('App\Relacion')->orderBy('published','asc');
	}

	public function relaciones2(){
    	return $this->hasOne('App\Relacion','relacion_id');
	}

    public function getRouteKeyName()
	{
		return 'slug';
	}

	public static function contadorbd(){
    	return DB::table('series')
    		->count('*');
	}
	
	public static function contadorView(){
    	return DB::table('capitulos')
    		->sum('counterView');
	}
	
	public static function contadorVoid(){
    	return DB::table('series')
    		->where('counterView','=',0)
    		->count();
    }
}
