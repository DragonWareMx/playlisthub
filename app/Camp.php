<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
   //usuario de la campaña
   public function user()
   {
       return $this->belongsTo('App\User');
   }
   
   //reviews de la campaña
   public function review()
   {
       return $this->hasOne('App\Review');
   }
   //playlists a la que pertenece la campaña
   public function playlist()
   {
       return $this->belongsTo('App\Playlist');
   }
}
