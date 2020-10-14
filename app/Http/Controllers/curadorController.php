<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Database\QueryException;
use App\User;
use Auth;
use App\Playlist;
use App\Camp;
use App\Artist;

 
class curadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id= Auth::id();
        $error=false;
        $access_token=session()->get('access_token');
        $playlists_bd2= Playlist::where('user_id',$id)->orderBy('profits','desc')->get();
        $user= User::findOrFail($id);
        $saldo= $user->saldo;
        //sacamos datos de playlists de API
        $i=0;
        $playlists2=[];
        $total=0;
        foreach($playlists_bd2 as $playlist)
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
            $playlists2[$i]=$playlistBD;
            $total+=$playlist->profits;
            $i++;
        }

        if(isset($playlistBD->error)){
            $error=true;
        }


        $playlists_bd= Playlist::where('user_id',$id)->get();

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
        
        //sacamos las canciones
        $plSongs=[];
        $i=0;
        foreach ($playlists_bd as $playlist) {
            $plSongs[$i]=$playlist->id;
            $i++;
        }

        $songs= Camp::with('playlist')->whereIn('playlist_id',$plSongs)->orderBy('playlist_id','asc')->get();
        
        //usamos API para sacar los datos de las canciones
        $songsSpoty=[];
        $i=0;
        foreach ($songs as $song) {
            //se extrae el id de la canción
            $song_id=trim($song->link_song,);
            $song_id=str_replace('https://open.spotify.com/track/','',$song_id);
            if(substr($song_id, 0, strpos($song_id, "?"))){
                $song_id = substr($song_id, 0, strpos($song_id, "?"));
            }
            //consultamos la canción para sacar los datos
            $url='https://api.spotify.com/v1/tracks/'.$song_id.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $songsAux= curl_exec($conexion);
            curl_close($conexion);
            
            $songsAux=json_decode($songsAux);
            $songsSpoty[$i]=$songsAux;
            $i++;
        }
        //sacamos los nombres de las playlists de las canciones
        //encontramos la posición de las playlist que tienen esas canciones en el arreglo de pl registradas
        $pos=[];
        $i=0;
        foreach ($songs as $song) {
            $j=0;
            foreach ($plSongs as $pl) {
                if($song->playlist_id==$pl){
                    $pos[$i]=$j;
                    break;
                }
                $j++;
            }
            $i++;
        }
        //recorremos ese arreglo para sacar el nombre con el arreglo donde guardamos lo que nos entregó la API de las playlists
        $plnames=[];
        $pllinks=[];
        $i=0;
        foreach ($pos as $posAct) {
            $plnames[$i]=$playlists_registradas[$posAct]->name;
            $pllinks[$i]=$playlists_registradas[$posAct]->external_urls->spotify;
            $i++;
        }

        //nos conectamos a API de spotify para sacar todas las playlists, esto es para modal
        $url='https://api.spotify.com/v1/me/playlists?access_token='.$access_token;
        $conexion=curl_init();
        curl_setopt($conexion, CURLOPT_URL, $url);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
        $playlists= curl_exec($conexion);
        curl_close($conexion);
        $playlists=json_decode($playlists);

        if(isset($playlists->error)){
            session()->flash('expired',true);
            return redirect()->back();
        }
        
        //for para mostrar en modal sólo las que no están registradas ya y las que sí son mismo id que owner
        $playlistsModal=[];
        $i=0;
        foreach ($playlists->items as $playlist) {
            $control=false;
            foreach ($playlists_bd as $playlist2) {
                if($playlist->external_urls->spotify==$playlist2->link_playlist){
                    $control=true;
                    break;
                }
            }
            if($control==false && $playlist->owner->id==$user->spotify_id) {
                $playlistsModal[$i]=$playlist;
                $i++;
            }
        }
        $playlists=$playlistsModal;
        
        //nos conectamos a la API para sacar los followers, sólo son para las del modal
        $followers=[];
        $i=0;
        foreach($playlists as $playlist){
            $url='https://api.spotify.com/v1/playlists/'.$playlist->id.'?access_token='.$access_token;
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
            if(isset($playlists->error) || isset($playlistFollow->error) || isset($playlistBD->error) || isset($songsAux->error)){
            $error=true;
            }

        return view('curador.inicioCurador', ['playlists'=>$playlists, 'error'=>$error, 'followers'=>$followers, 
        'playlists_registradas'=>$playlists_registradas, 'playlists_bd'=>$playlists_bd, 'songsSpoty'=>$songsSpoty, 
        'songs'=>$songs, 'plnames'=>$plnames, 'pllinks'=>$pllinks, 'playlists2'=>$playlists2, 
        'playlists_bd2'=>$playlists_bd2, 'total'=>$total, 'saldo'=>$saldo]);
    } 
}
