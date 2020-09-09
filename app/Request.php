<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //usuario de la campaña
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //reviews de la campaña
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
