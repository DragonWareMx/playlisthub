<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //musico de la campaña
    public function musician()
    {
        return $this->belongsTo('App\Musician');
    }
}
