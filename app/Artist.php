<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }
}
