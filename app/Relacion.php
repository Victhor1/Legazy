<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    public function serieRelacion()
    {
        return $this->belongsTo('App\Serie');
    }
}
