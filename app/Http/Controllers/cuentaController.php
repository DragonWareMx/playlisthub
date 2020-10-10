<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Auth;
use App\Camp;
use App\Genre;
use App\Review;
use App\Genre_Playlist;
use App\Playlist;
use Carbon\Carbon;

class cuentaController extends Controller
{
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
        //CAMPAÑAS
        $hoy = Carbon::now();
        $campsAct=Camp::with('playlist')->orderBy('id','desc')->where([
            ['status', '=', 'espera'],
            ['user_id', '=', Auth::id()],
        ])
        ->orWhere([
            ['end_date','>=',$hoy],
            ['user_id', '=', Auth::id()],
        ])
        ->limit(3)->get();
        $campsAnt=Camp::orderBy('id','desc')->
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
         
        //PLAYLISTS
        $id= Auth::id();
        $error2=false;
        $access_token2=session()->get('access_token');
        $playlists_bd= Playlist::where('user_id',$id)->get();
        $user= User::findOrFail($id);

        //sacamos playlists para vista principal
        $z=0;
        $playlists_registradas=[];
        foreach($playlists_bd as $playlist2)
        {   
            //se extrae el id de la playlist
            $playlist_id2=trim($playlist2->link_playlist,);
            $playlist_id2=str_replace('https://open.spotify.com/playlist/','',$playlist_id2);
            if(substr($playlist_id2, 0, strpos($playlist_id2, "?"))){
                $playlist_id2 = substr($playlist_id2, 0, strpos($playlist_id2, "?"));
            }
            //consultamos la playlist para sacar los datos
            $url2='https://api.spotify.com/v1/playlists/'.$playlist_id2.'?access_token='.$access_token2;
            $conexion2=curl_init();
            curl_setopt($conexion2, CURLOPT_URL, $url2);
            curl_setopt($conexion2, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion2, CURLOPT_RETURNTRANSFER, 1);
            $playlistBD= curl_exec($conexion2);
            curl_close($conexion2);
            
            $playlistBD=json_decode($playlistBD);
            $playlists_registradas[$z]=$playlistBD;
            $z++;
        }
        
        //sacamos las canciones
        $plSongs=[];
        $z=0;
        foreach ($playlists_bd as $playlist2) {
            $plSongs[$z]=$playlist2->id;
            $z++;
        }

        $songs= Camp::with('playlist')->whereIn('playlist_id',$plSongs)->orderBy('playlist_id','asc')->get();
        
        //usamos API para sacar los datos de las canciones
        $songsSpoty=[];
        $z=0;
        foreach ($songs as $song2) {
            //se extrae el id de la canción
            $song_id2=trim($song2->link_song,);
            $song_id2=str_replace('https://open.spotify.com/track/','',$song_id2);
            if(substr($song_id2, 0, strpos($song_id2, "?"))){
                $song_id2 = substr($song_id2, 0, strpos($song_id2, "?"));
            }
            //consultamos la canción para sacar los datos
            $url2='https://api.spotify.com/v1/tracks/'.$song_id2.'?access_token='.$access_token2;
            $conexion2=curl_init();
            curl_setopt($conexion2, CURLOPT_URL, $url2);
            curl_setopt($conexion2, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion2, CURLOPT_RETURNTRANSFER, 1);
            $songsAux= curl_exec($conexion2);
            curl_close($conexion2);
            
            $songsAux=json_decode($songsAux);
            $songsSpoty[$z]=$songsAux;
            $z++;
        }
        //sacamos los nombres de las playlists de las canciones
        //encontramos la posición de las playlist que tienen esas canciones en el arreglo de pl registradas
        $pos=[];
        $z=0;
        foreach ($songs as $song2) {
            $j=0;
            foreach ($plSongs as $pl) {
                if($song2->playlist_id==$pl){
                    $pos[$z]=$j;
                    break;
                }
                $j++;
            }
            $z++;
        }
        //recorremos ese arreglo para sacar el nombre con el arreglo donde guardamos lo que nos entregó la API de las playlists
        $plnames=[];
        $z=0;
        foreach ($pos as $posAct) {
            $plnames[$z]=$playlists_registradas[$posAct]->name;
            $z++;
        }

        //nos conectamos a API de spotify para sacar todas las playlists, esto es para modal
        $url2='https://api.spotify.com/v1/me/playlists?access_token='.$access_token2;
        $conexion2=curl_init();
        curl_setopt($conexion2, CURLOPT_URL, $url2);
        curl_setopt($conexion2, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($conexion2, CURLOPT_RETURNTRANSFER, 1);
        $playlists= curl_exec($conexion2);
        curl_close($conexion2);
        $playlists=json_decode($playlists, true);
        
        //REVIWS

        //booleano que indica el tipo del usuario (true = musico, false = curador)
        $tipo;
        //verifica que tipo de usuario es
        switch($usuario[0]->type){
            case 'Músico':
                $tipo = true;

                //reviews de las campanas del usuario musico
                $reviews = Review::whereHas('camp', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })->orderBy('date','desc')
                ->whereNull('playlist_id')
                ->get();

                //reviews a playlists de curadores que el musico ha realizado
                $realizadas = Review::where('playlist_id','!=',"NULL")->orderBy('date','desc')
                                            ->where('user_id', '=', Auth::id())
                                            ->get();

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                if(count($reviews) > 0){
                    foreach($reviews as $review){
                        $total+=$review->rating;
                        $numReviews++;
                    }

                    $calificacion = round($total/$numReviews,1);
                }
                else{
                    $calificacion = 0;
                }
                 return view ('perfil', ['usuario' => $usuario,'campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error,'tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews, 'realizadas'=>$realizadas,'nrealizadas'=>count($realizadas),'playlists'=>$playlists, 'error'=>$error2, 
                 'playlists_registradas'=>$playlists_registradas, 'playlists_bd'=>$playlists_bd, 'songsSpoty'=>$songsSpoty, 
                 'songs'=>$songs, 'plnames'=>$plnames]);
                
                break;
            case 'Curador':
                $tipo = false;

                //reviews de las playlists del usuario musico
                $reviews = Review::whereHas('playlist', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })->orderBy('date','desc')
                ->get();

                //reviews a campañas de musicos que el curador ha realizado
                $realizadas = Review::with('camp')->orderBy('date','desc')
                                                ->where('user_id', '=', Auth::id())
                                                ->whereNull('playlist_id')
                                                ->get();

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                if(count($reviews) > 0){
                    foreach($reviews as $review){
                        $total+=$review->rating;
                        $numReviews++;
                    }

                    $calificacion = round($total/$numReviews,1);
                }
                else{
                    $calificacion = 0;
                }
                 return view ('perfil', ['usuario' => $usuario,'campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error,'tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews, 'realizadas'=>$realizadas,'nrealizadas'=>count($realizadas),'playlists'=>$playlists, 'error'=>$error2, 
                 'playlists_registradas'=>$playlists_registradas, 'playlists_bd'=>$playlists_bd, 'songsSpoty'=>$songsSpoty, 
                 'songs'=>$songs, 'plnames'=>$plnames]);
                
                break;
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }
         
    }
    public function perfilPublico($idUser){
        try { 
            $usuario = User::where('spotify_id',$idUser)->get(); 
            $newId=User::where('spotify_id',$idUser)->value('id');
            // dd($newId);
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }
        else{
        //CAMPAÑAS
        $hoy = Carbon::now();
        $campsAct=Camp::with('playlist')->orderBy('id','desc')->where([
            ['status', '=', 'espera'],
            ['user_id', '=', $newId],
        ])
        ->orWhere([
            ['end_date','>=',$hoy],
            ['user_id', '=', $newId],
        ])
        ->get();
        $campsAnt=Camp::orderBy('id','desc')->
        where([
            ['end_date','<',$hoy],
            ['user_id', '=', $newId]
        ])
        ->get();
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
         
        //PLAYLISTS
        $id= $newId;
        $error2=false;
        $access_token2=session()->get('access_token');
        $playlists_bd= Playlist::where('user_id',$id)->get();
        $user= User::findOrFail($id);

        //sacamos playlists para vista principal
        $z=0;
        $playlists_registradas=[];
        foreach($playlists_bd as $playlist2)
        {   
            //se extrae el id de la playlist
            $playlist_id2=trim($playlist2->link_playlist,);
            $playlist_id2=str_replace('https://open.spotify.com/playlist/','',$playlist_id2);
            if(substr($playlist_id2, 0, strpos($playlist_id2, "?"))){
                $playlist_id2 = substr($playlist_id2, 0, strpos($playlist_id2, "?"));
            }
            //consultamos la playlist para sacar los datos
            $url2='https://api.spotify.com/v1/playlists/'.$playlist_id2.'?access_token='.$access_token2;
            $conexion2=curl_init();
            curl_setopt($conexion2, CURLOPT_URL, $url2);
            curl_setopt($conexion2, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion2, CURLOPT_RETURNTRANSFER, 1);
            $playlistBD= curl_exec($conexion2);
            curl_close($conexion2);
            
            $playlistBD=json_decode($playlistBD);
            $playlists_registradas[$z]=$playlistBD;
            $z++;
        }
        
        //sacamos las canciones
        $plSongs=[];
        $z=0;
        foreach ($playlists_bd as $playlist2) {
            $plSongs[$z]=$playlist2->id;
            $z++;
        }

        $songs= Camp::with('playlist')->whereIn('playlist_id',$plSongs)->orderBy('playlist_id','asc')->get();
        
        //usamos API para sacar los datos de las canciones
        $songsSpoty=[];
        $z=0;
        foreach ($songs as $song2) {
            //se extrae el id de la canción
            $song_id2=trim($song2->link_song,);
            $song_id2=str_replace('https://open.spotify.com/track/','',$song_id2);
            if(substr($song_id2, 0, strpos($song_id2, "?"))){
                $song_id2 = substr($song_id2, 0, strpos($song_id2, "?"));
            }
            //consultamos la canción para sacar los datos
            $url2='https://api.spotify.com/v1/tracks/'.$song_id2.'?access_token='.$access_token2;
            $conexion2=curl_init();
            curl_setopt($conexion2, CURLOPT_URL, $url2);
            curl_setopt($conexion2, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion2, CURLOPT_RETURNTRANSFER, 1);
            $songsAux= curl_exec($conexion2);
            curl_close($conexion2);
            
            $songsAux=json_decode($songsAux);
            $songsSpoty[$z]=$songsAux;
            $z++;
        }
        //sacamos los nombres de las playlists de las canciones
        //encontramos la posición de las playlist que tienen esas canciones en el arreglo de pl registradas
        $pos=[];
        $z=0;
        foreach ($songs as $song2) {
            $j=0;
            foreach ($plSongs as $pl) {
                if($song2->playlist_id==$pl){
                    $pos[$z]=$j;
                    break;
                }
                $j++;
            }
            $z++;
        }
        //recorremos ese arreglo para sacar el nombre con el arreglo donde guardamos lo que nos entregó la API de las playlists
        $plnames=[];
        $z=0;
        foreach ($pos as $posAct) {
            $plnames[$z]=$playlists_registradas[$posAct]->name;
            $z++;
        }

        //nos conectamos a API de spotify para sacar todas las playlists, esto es para modal
        $url2='https://api.spotify.com/v1/me/playlists?access_token='.$access_token2;
        $conexion2=curl_init();
        curl_setopt($conexion2, CURLOPT_URL, $url2);
        curl_setopt($conexion2, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($conexion2, CURLOPT_RETURNTRANSFER, 1);
        $playlists= curl_exec($conexion2);
        curl_close($conexion2);
        $playlists=json_decode($playlists, true);
        
        //FAVORITOS
        $usuarioLoggeado=User::with('favorites')->findOrFail(Auth::id());
        
        $marcaFav=false;
        foreach($usuarioLoggeado->favorites as $favorite){
            if($favorite->id == $newId){
                $marcaFav=true;
            }
        }
        //REVIWS

        //booleano que indica el tipo del usuario (true = musico, false = curador)
        
        // dd($newId);
        $tipo;
        //verifica que tipo de usuario es
        switch($usuario[0]->type){
            case 'Músico':
                $tipo = true;
                //reviews de las campanas del usuario musico
                $reviews = Review::whereHas('camp', function ($query) use($newId) {
                    return $query->where('user_id', '=', $newId);
                })->orderBy('date','desc')
                ->whereNull('playlist_id')
                ->get();

                //reviews a playlists de curadores que el musico ha realizado
                $realizadas = Review::where('playlist_id','!=',"NULL")->orderBy('date','desc')
                                            ->where('user_id', '=', $newId)
                                            ->get();

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                if(count($reviews) > 0){
                    foreach($reviews as $review){
                        $total+=$review->rating;
                        $numReviews++;
                    }

                    $calificacion = round($total/$numReviews,1);
                }
                else{
                    $calificacion = 0;
                }
                 return view ('perfilPublico', ['usuario' => $usuario,'campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error,'tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews, 'realizadas'=>$realizadas,'nrealizadas'=>count($realizadas),'playlists'=>$playlists, 'error'=>$error2, 
                 'playlists_registradas'=>$playlists_registradas, 'playlists_bd'=>$playlists_bd, 'songsSpoty'=>$songsSpoty, 
                 'songs'=>$songs, 'plnames'=>$plnames, 'marcaFav'=>$marcaFav]);
                
                break;
            case 'Curador':
                $tipo = false;
                //reviews de las playlists del usuario musico
                $reviews = Review::whereHas('playlist', function ($query) use($newId) {
                    return $query->where('user_id', '=', $newId);
                })->orderBy('date','desc')
                ->get();

                //reviews a campañas de musicos que el curador ha realizado
                $realizadas = Review::with('camp')->orderBy('date','desc')
                                                ->where('user_id', '=', $newId)
                                                ->whereNull('playlist_id')
                                                ->get();

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                if(count($reviews) > 0){
                    foreach($reviews as $review){
                        $total+=$review->rating;
                        $numReviews++;
                    }

                    $calificacion = round($total/$numReviews,1);
                }
                else{
                    $calificacion = 0;
                }
                 return view ('perfilPublico', ['usuario' => $usuario,'campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error,'tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews, 'realizadas'=>$realizadas,'nrealizadas'=>count($realizadas),'playlists'=>$playlists, 'error'=>$error2, 
                 'playlists_registradas'=>$playlists_registradas, 'playlists_bd'=>$playlists_bd, 'songsSpoty'=>$songsSpoty, 
                 'songs'=>$songs, 'plnames'=>$plnames, 'marcaFav'=>$marcaFav]);
                
                break;
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }
        }

    }
    public function administrar()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }


        return view ('administrarCuenta', ['usuario' => $usuario]);
    }

    public function nombreUpdate()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.nombreUpdate', ['usuario' => $usuario]);
    }

    public function nombreUpdateDo($id){

        $data=request()->validate([
            'nombre'=>'required|max:191'
        ]);
        try{
             DB::transaction(function() use ($id)
             {
                $user=User::findOrFail($id);
                $user->name=request('nombre');
                $user->save();

             });
        }
        catch(QueryException $ex){
             return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }
        return redirect()->route('administrar-cuenta');
    }

    public function contraseñaUpdate()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }
        return view ('AdministrarCuenta.contraseñaUpdate', ['usuario' => $usuario]);
    }

    public function contraseñaUpdateDo($id){

        $data=request()->validate([
            'passActual'=>'required',
            'password'=>'required',
            'cfmPassword'=>'required'
        ]);

        $change=0;
        try{
            $user=User::findOrFail($id);
            if( Hash::check( request('passActual'), $user->password ) ){
                $change=1;
                $user->password=bcrypt(request('password'));
                $user->save();
                
            }
            else{
                $change=2;
                }
        }
        catch(QueryException $ex){
            return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }

        if($change == 1){
            return redirect()->route('administrar-cuenta');
        }
        else if($change == 2){
            return redirect()->back()->withErrors(['error' => 'ERROR: La contraseña es incorrecta']);
        }
        else{
            return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }
    }

    public function correoUpdate()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.correoUpdate', ['usuario' => $usuario]);
    }

    public function correoUpdateDo($id){

        $data=request()->validate([
            'correo'=>'required'
        ]);
        try{
             DB::transaction(function() use ($id)
             {
                $user=User::findOrFail($id);
                $user->email=request('correo');
                $user->save();

             });
        }
        catch(QueryException $ex){
             return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }
        return redirect()->route('administrar-cuenta');
    }

    public function fecNacUpdate()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.fecNacUpdate', ['usuario' => $usuario]);
    }

    public function fecNacUpdateDo($id){

        $data=request()->validate([
            'fecha'=>'required|date'
        ]);
        try{
             DB::transaction(function() use ($id)
             {
                $user=User::findOrFail($id);
                $user->birth_date=request('fecha');
                $user->save();

             });
        }
        catch(QueryException $ex){
             return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }
        return redirect()->route('administrar-cuenta');
    }


    public function generoUpdate()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.generoUpdate', ['usuario' => $usuario]);
    }

    public function generoUpdateDo($id){
        
        $data=request()->validate([
            'genero'=>'required'
        ]);

        try{
             DB::transaction(function() use ($id)
             {
                $user=User::findOrFail($id);
                if(request('genero') == '2'){
                    $user->genre='m';
                }
                else if (request('genero') == '1'){
                    $user->genre='f';
                }
                else if (request('genero') == '3'){
                    $user->genre='o';
                }
                $user->save();

             });
        }
        catch(QueryException $ex){
             return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }
        return redirect()->route('administrar-cuenta');
    }

    public function paisUpdate()
    {
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.paisUpdate', ['usuario' => $usuario]);
    }

    public function paisUpdateDo($id){
        
        $data=request()->validate([
            'pais'=>'required'
        ]);

        try{
             DB::transaction(function() use ($id)
             {
                $user=User::findOrFail($id);
                $user->country=request('pais');
                $user->save();

             });
        }
        catch(QueryException $ex){
             return redirect()->back()->withErrors(['error' => 'ERROR: No se pudieron actualizar los datos']);
        }
        return redirect()->route('administrar-cuenta');
    }

    public function userDelete($id){
        try{
            DB::transaction(function() use ($id)
            {
               $user=User::findOrFail($id);
               $user->delete();

            });
       }
       catch(QueryException $ex){
            return redirect()->back()->withErrors(['error' => 'ERROR: No se pudó eliminar la cuenta']);
       }
       return redirect()->route('login');
    }
}
