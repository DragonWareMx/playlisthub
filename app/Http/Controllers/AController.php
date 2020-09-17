<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use App\Playlist;
use Auth;

class AController extends Controller
{
    public function playlists(){
        $id= Auth::id();
        $error=false;
        $access_token=session()->get('access_token');
        $playlists_bd= Playlist::where('user_id',$id)->get();
   
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
        
        //sacamos playlists para vista principal
        $i=0;
        $playlists_registradas=[];
        foreach($playlists_bd as $playlist)
        {   
            //se extrae el id de la playlist
            $playlist_id=trim($playlist->link_playlist,);
            $playlist_id=str_replace('https://open.spotify.com/playlist/','',$playlist_id);
            if(substr($playlist_id, 0, strpos($playlist_id, "?"))){
                $playlist_id = substr($playlist_id, 0, strpos($playlist_id, "?"));
            }
            //consultamos la playlist para sacar los datos
            $url='https://api.spotify.com/v1/playlists/'.$playlist_id.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $playlistBD= curl_exec($conexion);
            curl_close($conexion);
            
            $playlistBD=json_decode($playlistBD);
            $playlists_registradas[$i]=$playlistBD;
            $i++;
        }

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
       
        return view('curador.playlists', ['playlists'=>$playlists, 'error'=>$error, 'followers'=>$followers, 
        'playlists_registradas'=>$playlists_registradas]);
    }

    public function addPlaylist(){
        $id= Auth::id();
        $access_token=session()->get('access_token');
        $link_playlist=request()->validate([
            'link'=>'required'
        ]);

        try{
            $playlist=new Playlist();
            $playlist->tier='0';
            $playlist->profits='0';
            $playlist->link_playlist=request('link');
            $playlist->user_id=$id;
            $playlist->save();
        }
        catch(QueryException $ex){
            return redirect()->back()->withErrors(['error' => 'ERROR: La playlist no se pudo guardar']);
        }
        return redirect()->route('playlists');
    }
}
