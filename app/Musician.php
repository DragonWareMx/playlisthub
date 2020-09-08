<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    //El usuario dek musico
    public function user()
    {
        return $this->hasOne('App\User');
    }
    //Curadores favoritos
    public function favorites()
    {
        return $this->belongsToMany('App\Curator');
    }
    //Campañas del musico
    public function requests()
    {
        return $this->hasMany('App\Request');
    }
}
