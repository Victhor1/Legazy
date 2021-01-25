<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{

    public function getRouteKeyName()
	{
		return 'slug';
	}

    public function serie(){
        return $this->belongsTo('App\Serie');
    }

    public function videos(){
    	return $this->hasMany('App\Video')->orderBy('name','asc');
    }

    public function downloads(){
    	return $this->hasMany('App\Download')->orderBy('name','asc');
    }

    public function report()
    {
        return $this->hasOne('App\Report');
    }

    public static function suma(){
        return DB::table('capitulos')
            ->where('serie_id','=','serie_id')
            ->get();
    }

    public static function contadorbd(){
    	return DB::table('capitulos')
    		->count('*');
    }
    
    public static function contadorbdView(){
        return DB::table('capitulos')
            ->where('counterView','!=',0)
    		->count('*');
    }
    
    public static function contadorbdNoView(){
        return DB::table('capitulos')
            ->where('counterView','=',0)
    		->count('*');
    }
    
    public static function contadorbdNoStatus(){
        return DB::table('capitulos')
            ->where('status','=',0)
    		->count('*');
	}
}
