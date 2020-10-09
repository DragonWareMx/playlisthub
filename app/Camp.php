<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    public function getCostAttribute($value) {
        try{
            return Crypt::decryptString($value);
        }catch(\Exception $e){
            return $value;
        }
    }

    public function getLevelAttribute($value) {
        try{
            return Crypt::decryptString($value);
        }catch(\Exception $e){
            return $value;
        }
    }

    public function setLevelAttribute($value) {
        $this->attributes['level'] = Crypt::encryptString($value);
    }

    public function setCostAttribute($value) {
        $this->attributes['cost'] = Crypt::encryptString($value);
    }

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
