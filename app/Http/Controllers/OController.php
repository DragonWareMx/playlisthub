<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camp;
use App\Review;
use Carbon\Carbon;

class OController extends Controller
{
    public function favoritos()
    {
        return view ('musico.favoritos');
    }
    public function campanas()
    {
        $hoy = Carbon::now();
        $campsAct=Camp::with('playlist')->orderBy('start_date','desc')->where('status','espera')->orWhere('end_date','>=',$hoy)->limit(3)->get();
        $campsAnt=Camp::orderBy('start_date','desc')->where('end_date','<',$hoy)->limit(3)->get();
        $i=0;
        $access_token='BQCLO2OOSdx7QjH65M96iaJS84bUqJgzRI6iC_RUXKK1tGkqt-pZ6HTNvgo3RL8gYdWFWcHzUbAQ_8i16KXHs-4fb4qH6tk97RrJreL2zfUj_Csd0i_GESw2pNPdXe354KoSPcfdbkYxc1xvPRqVqw3UVVVXEpt3qfVHMyoY_uAsRob9RNsKOQHx8FWmhwtD9ubBHOvkNlMrFBFPi_EIE1hTGZ3MK8YaqCXGXLWwUq0gHoEeAx5vCi4xk8YkxZkgSgSEgICZZlDToXxzgc8m2jqcQczAuu5e5egd';
        $songsAct=[];
        $playlistsAct=[];
        foreach($campsAct as $camp){
            //Se extrae el id de la canción 
            $song_id=trim($camp->link_song,'https://open.spotify.com/track/');
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
            $playlist_id=trim($camp->playlist->link_playlist,'https://open.spotify.com/playlist/');
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
        return view ('musico.campanas',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt]);
    }
    public function campanasActuales()
    {
        return view ('musico.campanasActuales');
    }
    public function campanasAntiguas()
    {
        return view ('musico.campanasAntiguas');
    }
    public function campana($id)
    {
        return view ('musico.campana');
    }
    public function crearCampana1()
    {
        return view ('musico.crearCampana1');
    }
    public function crearCampana2(request $request)
    {
        return view ('musico.crearCampana2');
    }
    public function crearCampana3()
    {
        return view ('musico.crearCampana3');
    }
    public function tokens()
    {
        return view ('musico.tokens');
    }
}
