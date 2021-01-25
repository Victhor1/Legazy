<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Report extends Model
{
    public function capitulo()
    {
        return $this->belongsTo('App\Capitulo');
    }

    public static function contadorbd(){
    	return DB::table('reports')
    		->count('*');
	}
}
