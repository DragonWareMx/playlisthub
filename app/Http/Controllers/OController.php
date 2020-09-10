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
        $access_token='BQBs1ary1FabkjpwUzHAWEjSoME_vAFa1jn8yfoSHtUdws7GOPZrQc4xKyCLwTTJEoBIFuNkdq4vLwrbg_W_mShGnaY5uDAeGstu62c8SzLRhk1qrPiALZBHKM6SrbwQngMpE-bS0S7rXCjxJie6E3CZkjte76wuFzpRdrgmdv1RDd9AopCUqaKSmPS0Ig3V8Y9aKb3ACuAde-WkzITRghXZyoMaWnn6U-huxgPuJjxk4-6vu00jd-_3KcxGgr9iXMU7v_FAOMyrf-PoufdEBuKhR_uuDW66lKIO';
        $songsAct=[];
        $playlistsAct=[];
        $error=false;
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
        $i=0;
        $songsAnt=[];
        $playlistsAnt=[];
        foreach($campsAnt as $camp){
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
            $songsAnt[$i]=$song;
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
            $playlistsAnt[$i]=$playlist;
            $i++;
        }
        if(isset($songsAct[0]->error) || isset($songsAnt[0]->error) || isset($playlistsAct[0]->error) || isset($playlistsAnt[0]->error)){
            $error=true;
        }
        return view ('musico.campanas',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);
    }
    public function campanasActuales()
    {
        $hoy = Carbon::now();
        $campsAct=Camp::with('playlist')->orderBy('start_date','desc')->where('status','espera')->orWhere('end_date','>=',$hoy)->get();
        $i=0;
        $access_token='BQBs1ary1FabkjpwUzHAWEjSoME_vAFa1jn8yfoSHtUdws7GOPZrQc4xKyCLwTTJEoBIFuNkdq4vLwrbg_W_mShGnaY5uDAeGstu62c8SzLRhk1qrPiALZBHKM6SrbwQngMpE-bS0S7rXCjxJie6E3CZkjte76wuFzpRdrgmdv1RDd9AopCUqaKSmPS0Ig3V8Y9aKb3ACuAde-WkzITRghXZyoMaWnn6U-huxgPuJjxk4-6vu00jd-_3KcxGgr9iXMU7v_FAOMyrf-PoufdEBuKhR_uuDW66lKIO';
        $songsAct=[];
        $playlistsAct=[];
        $error=false;
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
        if(isset($songsAct[0]->error) || isset($playlistsAct[0]->error) ){
            $error=true;
        }
        return view ('musico.campanasActuales',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'error'=>$error]);
    }
    public function campanasAntiguas()
    {
        $hoy = Carbon::now();
        $campsAnt=Camp::orderBy('start_date','desc')->where('end_date','<',$hoy)->get();
        $i=0;
        $access_token='BQBs1ary1FabkjpwUzHAWEjSoME_vAFa1jn8yfoSHtUdws7GOPZrQc4xKyCLwTTJEoBIFuNkdq4vLwrbg_W_mShGnaY5uDAeGstu62c8SzLRhk1qrPiALZBHKM6SrbwQngMpE-bS0S7rXCjxJie6E3CZkjte76wuFzpRdrgmdv1RDd9AopCUqaKSmPS0Ig3V8Y9aKb3ACuAde-WkzITRghXZyoMaWnn6U-huxgPuJjxk4-6vu00jd-_3KcxGgr9iXMU7v_FAOMyrf-PoufdEBuKhR_uuDW66lKIO';
        $error=false;
        $songsAnt=[];
        $playlistsAnt=[];
        foreach($campsAnt as $camp){
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
            $songsAnt[$i]=$song;
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
            $playlistsAnt[$i]=$playlist;
            $i++;
        }
        if(isset($songsAnt[0]->error) || isset($playlistsAnt[0]->error)){
            $error=true;
        }
        return view ('musico.campanasAntiguas',['campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);
    }
    public function campana($id)
    {
        $camp=Camp::findOrFail($id);
        $access_token='BQBs1ary1FabkjpwUzHAWEjSoME_vAFa1jn8yfoSHtUdws7GOPZrQc4xKyCLwTTJEoBIFuNkdq4vLwrbg_W_mShGnaY5uDAeGstu62c8SzLRhk1qrPiALZBHKM6SrbwQngMpE-bS0S7rXCjxJie6E3CZkjte76wuFzpRdrgmdv1RDd9AopCUqaKSmPS0Ig3V8Y9aKb3ACuAde-WkzITRghXZyoMaWnn6U-huxgPuJjxk4-6vu00jd-_3KcxGgr9iXMU7v_FAOMyrf-PoufdEBuKhR_uuDW66lKIO';
        $error=false;
        $hoy = Carbon::now();

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
        if(isset($song->error) || isset($playlist->error)){
            $error=true;
        }
        return view ('musico.campana',['camp'=>$camp,'song'=>$song,'playlist'=>$playlist,'error'=>$error,'hoy'=>$hoy]);
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
