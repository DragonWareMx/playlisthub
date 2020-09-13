<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //usuario de la playlist
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //reviews de la campaña
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }
}
