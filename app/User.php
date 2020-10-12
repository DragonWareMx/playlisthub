<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\Permission\Traits\UserTrait;
use Illuminate\Support\Facades\Crypt;


class User extends Authenticatable
{
    use Notifiable,UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getSaldoAttribute($value) {
        try{
            return Crypt::decryptString($value);
        }catch(\Exception $e){
            return $value;
        }
    }

    public function getTokensAttribute($value) {
        try{
            return Crypt::decryptString($value);
        }catch(\Exception $e){
            return $value;
        }
    }

    public function setSaldoAttribute($value) {
        $this->attributes['saldo'] = Crypt::encryptString($value);
    }

    public function setTokensAttribute($value) {
        $this->attributes['tokens'] = Crypt::encryptString($value);
    }

    //Curadores favoritos del musico
    public function favorites()
    {
        return $this->belongsToMany('App\User','favorites_user', 'user_id', 'favorite_id');
    }

    //Campañas del musico
    public function requests()
    {
        return $this->hasMany('App\Request');
    }

    //Reviews del usuario
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }

    public function references()
    {
      return $this->belongsToMany('User', 'users_references', 'user_id', 'referenced_id');
    }
    
    // Same table, self referencing, but change the key order
    public function theFriends()
    {
      return $this->belongsToMany('User', 'users_references', 'referenced_id', 'user_id');
    }

     /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
