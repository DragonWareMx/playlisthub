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
        $campsAct=Camp::orderBy('start_date','desc')->where('status','espera')->orWhere('end_date','>=',$hoy)->limit(3)->get();
        $campsAnt=Camp::orderBy('start_date','desc')->where('end_date','<',$hoy)->limit(3)->get();
        $i=0;
        $access_token='BQB-L1L7NfSmpWCdBMoA80dXjBcRqB6FohUATeDqPJIa8o-OfWaKkufBpodgZ224N0FahlUxhKqbQXZD9ze_a2zsett7nMIHbQ3CF9yVZKALwIBrhhr8O-VBPrq3-kQTIsprGaH_iL0SB0grYq-62YHTwKtWi1dsYFwFb65M-6zQ_4BOv_rpFicNSBnca0Dq8adF-1laKBUlgd5QvXPoYN_VBXEKYlxPVNh6WeTMYoruVHfTkwCigl6l7dhJgRPH_g1ydxBgLcOtSANKWHoZrwR6aEDz8mHL1Msr';
        $arraySong=[];
        $arrayPlaylist=[];
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
            $arraySong[$i]=$song;
            $i++;
        }   
        return view ('musico.campanas',['campsAct'=>$campsAct,'campsAnt'=>$campsAnt]);
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
