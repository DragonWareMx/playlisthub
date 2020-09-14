<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //Playlist a la que se le hace el review
    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

    //Campana a la que se le hace el review
    public function camp()
    {
        return $this->belongsTo('App\Camp');
    }

    //Usuario que escribe el review
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
