<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    //Campaña a la que se le hace el review
    public function request()
    {
        return $this->hasOne('App\Request');
    }

    //Playlist a la que se le hace el review
    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }
}
