<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\user;
use App\playlist;
use Auth;

class AController extends Controller
{
    public function playlists(){
        $id= Auth::id();
        $error=false;
        $access_token=session()->get('access_token');
        
        
        //nos conectamos a API de spotify para sacar todas las playlists
        
        $url='https://api.spotify.com/v1/me/playlists?access_token='.$access_token;
        $conexion=curl_init();
        curl_setopt($conexion, CURLOPT_URL, $url);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
        $playlists= curl_exec($conexion);
        curl_close($conexion);
        
        $playlists=json_decode($playlists, true);
    
        //nos conectamos a la API para sacar los followers

        $followers=[];
        $i=0;
        foreach($playlists['items'] as $playlist){
            $url='https://api.spotify.com/v1/playlists/'.$playlist['id'].'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $playlistFollow= curl_exec($conexion);
            curl_close($conexion);
            
            $playlistFollow=json_decode($playlistFollow);
            $followers[$i]=$playlistFollow->followers->total;
            $i++;
        }


        if(isset($playlists->error) || isset($playlistFollow->error)){
            $error=true;
        }
       
        return view('curador.playlists', ['playlists'=>$playlists, 'error'=>$error, 'followers'=>$followers]);
    }
    public function addPlaylist(){

    }
}
