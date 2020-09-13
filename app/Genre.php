<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function playlists()
   {
        return $this->belongsToMany('App\Playlist');
   }
}
