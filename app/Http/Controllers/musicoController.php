<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use Auth;
use App\Camp;
use App\Genre;
use App\Genre_Playlist;
use App\Playlist;
use Carbon\Carbon;

class musicoController extends Controller
{
    public function index()
    {
        return view ('musico.inicioMusico');
    } 

    public function perfil()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        $hoy = Carbon::now();
        $campsAct=Camp::with('playlist')->orderBy('start_date','desc')->where([
            ['status', '=', 'espera'],
            ['user_id', '=', Auth::id()],
        ])
        ->orWhere([
            ['end_date','>=',$hoy],
            ['user_id', '=', Auth::id()],
        ])
        ->limit(3)->get();
        $campsAnt=Camp::orderBy('start_date','desc')->
        where([
            ['end_date','<',$hoy],
            ['user_id', '=', Auth::id()]
        ])
        ->limit(3)->get();
        $i=0;
        $access_token=session()->get('access_token');
        $songsAct=[];
        $playlistsAct=[];
        $error=false;
        foreach($campsAct as $camp){
            //Se extrae el id de la canción 
            $song_id=trim($camp->link_song,);
            $song_id=str_replace('https://open.spotify.com/track/','',$song_id);
            if(substr($song_id, 0, strpos($song_id, "?"))){
                $song_id = substr($song_id, 0, strpos($song_id, "?"));
            }
            //Se hace la conexión con la api de spotify
            $url='https://api.spotify.com/v1/tracks/'.$song_id.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $song= curl_exec($conexion);
            curl_close($conexion);
            $song=json_decode($song);
            $songsAct[$i]=$song;
            //Se extrae el id de la playlist 
            $playlist_id=trim($camp->playlist->link_playlist,);
            $playlist_id=str_replace('https://open.spotify.com/playlist/','',$playlist_id);
            if(substr($playlist_id, 0, strpos($playlist_id, "?"))){
                $playlist_id = substr($playlist_id, 0, strpos($playlist_id, "?"));
            }
            //Se hace la conexión con la api de spotify
            $url='https://api.spotify.com/v1/playlists/'.$playlist_id.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $playlist= curl_exec($conexion);
            curl_close($conexion);
            $playlist=json_decode($playlist);
            $playlistsAct[$i]=$playlist;
            $i++;
        }
        $i=0;
        $songsAnt=[];
        $playlistsAnt=[];
        foreach($campsAnt as $camp){
            //Se extrae el id de la canción 
            $song_id=trim($camp->link_song,);
            $song_id=str_replace('https://open.spotify.com/track/','',$song_id);
            if(substr($song_id, 0, strpos($song_id, "?"))){
                $song_id = substr($song_id, 0, strpos($song_id, "?"));
            }
            //Se hace la conexión con la api de spotify
            $url='https://api.spotify.com/v1/tracks/'.$song_id.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $song= curl_exec($conexion);
            curl_close($conexion);
            $song=json_decode($song);
            $songsAnt[$i]=$song;
            //Se extrae el id de la playlist 
            $playlist_id=trim($camp->playlist->link_playlist,);
            $playlist_id=str_replace('https://open.spotify.com/playlist/','',$playlist_id);
            if(substr($playlist_id, 0, strpos($playlist_id, "?"))){
                $playlist_id = substr($playlist_id, 0, strpos($playlist_id, "?"));
            }
            //Se hace la conexión con la api de spotify
            $url='https://api.spotify.com/v1/playlists/'.$playlist_id.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $playlist= curl_exec($conexion);
            curl_close($conexion);
            $playlist=json_decode($playlist);
            $playlistsAnt[$i]=$playlist;
            $i++;
        }
        if(isset($songsAct[0]->error)  || isset($playlistsAct[0]->error) || isset($songsAnt[0]->error) || isset($playlistsAnt[0]->error)){
            $error=true;
        }
        // return view ('musico.campanas',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);

        return view ('musico.perfilMusico', ['usuario' => $usuario, 'campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);
    }
    public function perfilPublico()
    {
        return view ('musico.PublicoperfilMusico');
    }

    public function referencias(){
        return view('musico.referencias');
    }
}
