<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function series(){
    	return $this->belongsToMany('App\Serie');
    }
}
