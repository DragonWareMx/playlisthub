<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Camp;
use App\Review;
use App\User;
use App\Genre;
use App\Genre_Playlist;
use App\Playlist;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\camp_mail;

class OController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function favoritos()
    {
        Gate::authorize('haveaccess','musico.perm');
        $user=User::with('favorites')->findOrFail(Auth::id());
        $favorites=[];
        $i=0;
        foreach($user->favorites as $favorite){
            $favorites[$i]=$favorite->id;
            $i++;
        }
        $favorites=User::with('playlists')->whereIn('id',$favorites)->get();
        $i=0;
        $favs=[];
        foreach($favorites as $favorite){
            $item['id']=$favorite->id;
            $item['avatar']=$favorite->avatar;
            $item['name']=$favorite->name;
            $item['country']=$favorite->country;
            $item['playlists']=sizeOf($favorite->playlists);
            $total=0;
            $numPlaylists=0;
            foreach($favorite->playlists as $playlist){
                $total+=$playlist->tier;
                $numPlaylists++;
            }
            if($numPlaylists>0){ 
                $item['average']=round($total/$numPlaylists,2);
            }
            else{
                $item['average']=0;
            }
            $favs[$i]=$item;
            $i++;
        }
        return view ('musico.favoritos',['favs'=>$favs]);
    }
    public function campanas()
    {
        Gate::authorize('haveaccess','musico.perm');
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
        return view ('musico.campanas',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);
    }
    public function campanasActuales()
    {
        Gate::authorize('haveaccess','musico.perm');
        $hoy = Carbon::now();
        $campsAct=Camp::with('playlist')->orderBy('id','desc')->where([
            ['status', '=', 'espera'],
            ['user_id', '=', Auth::id()],
        ])
        ->orWhere([
            ['end_date','>=',$hoy],
            ['user_id', '=', Auth::id()],
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
        if(isset($songsAct[0]->error) || isset($playlistsAct[0]->error) ){
            $error=true;
        }
        return view ('musico.campanasActuales',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'error'=>$error]);
    }
    public function campanasAntiguas()
    {
        Gate::authorize('haveaccess','musico.perm');
        $hoy = Carbon::now();
        $campsAnt=Camp::orderBy('id','desc')->
        where([
            ['end_date','<',$hoy],
            ['user_id', '=', Auth::id()]
        ])
        ->get();
        $i=0;
        $access_token=session()->get('access_token');
        $error=false;
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
        if(isset($songsAnt[0]->error) || isset($playlistsAnt[0]->error)){
            $error=true;
        }
        return view ('musico.campanasAntiguas',['campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);
    }
    public function campana(request $request)
    {
        Gate::authorize('haveaccess','musico.perm');
        $id=$request->id;
        $camp=Camp::findOrFail($id);
        if(Auth::id()==$camp->user_id){
            $access_token=session()->get('access_token');
            $error=false;
            $hoy = Carbon::now();

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
            if(isset($song->error) || isset($playlist->error)){
                $error=true;
            }
            return view ('musico.campana',['camp'=>$camp,'song'=>$song,'playlist'=>$playlist,'error'=>$error,'hoy'=>$hoy]);
        }
        else{
            return redirect('/inicio');
        }
    }
    public function crearCampana1()
    {
        Gate::authorize('haveaccess','musico.perm');
        return view ('musico.crearCampana1');
    }
    public function recrearCampana2()
    {
        Gate::authorize('haveaccess','musico.perm');
        return redirect('/crear-paso-1');
    }
    public function recrearCampana3(){
        Gate::authorize('haveaccess','musico.perm');
        return redirect('/crear-paso-1');
    }
    public function crearCampana2(request $request)
    {
        Gate::authorize('haveaccess','musico.perm');
        ini_set('max_execution_time', 500);
        $data=request()->validate([
            'link'=>'required'
        ]);
        $user=User::findOrFail(Auth::id());
        $error=false;
        $access_token=session()->get('access_token');
        $song_id=trim($request->link,);
        $song_id=str_replace('https://open.spotify.com/track/','',$song_id);
        if(substr($song_id, 0, strpos($song_id, "?"))){
            $song_id = substr($song_id, 0, strpos($song_id, "?"));
        }
        $url='https://api.spotify.com/v1/tracks/'.$song_id.'?access_token='.$access_token;
        $conexion=curl_init();
        curl_setopt($conexion, CURLOPT_URL, $url);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
        $song= curl_exec($conexion);
        curl_close($conexion);
        $song=json_decode($song);
        if(!$song){
            session()->flash('badLink',true);
            return redirect('/crear-paso-1');
        }
        if(isset($song->error->message)){
            if($song->error->message == 'invalid id'){
                session()->flash('badLink',true);
                return redirect('/crear-paso-1');
            }
            else{
                session()->flash('expiredToken',true);
                return redirect('/crear-paso-1');
            }
        }
        session()->put('link_song',$request->link);
        $artists=[];
        $i=0;
        $id_principal=$song->artists[0]->id;
        foreach($song->artists as $artist){
            $artists[$i]=$artist->id;
            $i++;
        }
        //voy a sacar los artistas relacionados
        $url='https://api.spotify.com/v1/artists/'.$id_principal.'/related-artists?access_token='.$access_token;
        $conexion=curl_init();
        curl_setopt($conexion, CURLOPT_URL, $url);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
        $related_artists= curl_exec($conexion);
        curl_close($conexion);
        $related_artists=json_decode($related_artists);
        if(isset($related_artists->error)){
            session()->flash('expiredToken',true);
            session()->forget('link_song');
            return redirect('/crear-paso-1');
        }
        foreach($related_artists->artists as $artist){
            $artists[$i]=$artist->id;
            $i++;
        }
        $allPlays=Playlist::get();
        $playlists=[];
        $playlistsCosts=[];
        $i=0;
        $k=0;
        foreach($allPlays as $allPlay){
            $allPlay_id=trim($allPlay->link_playlist,);
            $allPlay_id=str_replace('https://open.spotify.com/playlist/','',$allPlay_id);
            if(substr($allPlay_id, 0, strpos($allPlay_id, "?"))){
                $allPlay_id = substr($allPlay_id, 0, strpos($allPlay_id, "?"));
            }
            $url='https://api.spotify.com/v1/playlists/'.$allPlay_id.'/tracks?access_token='.$access_token.'&fields=items(track(artists(id)))&limit=50';
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $tracks= curl_exec($conexion);
            curl_close($conexion);
            $tracks=json_decode($tracks);
            if(isset($tracks->error)){
                session()->flash('expiredToken',true);
                session()->forget('link_song');
                return redirect('/crear-paso-1');
            }
            $j=0;
            $coincidencias=0;
            foreach($tracks->items as $track){
                foreach($artists as $artist){
                    if($track->track->artists[0]->id == $artist){
                        $coincidencias++;
                    }
                }
                $j++;
            }
            if($coincidencias>0){
                $url='https://api.spotify.com/v1/playlists/'.$allPlay_id.'?access_token='.$access_token;
                $conexion=curl_init();
                curl_setopt($conexion, CURLOPT_URL, $url);
                curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                $playlist= curl_exec($conexion);
                curl_close($conexion);
                $playlist=json_decode($playlist);
                if(isset($playlist->error)){
                    session()->flash('expiredToken',true);
                    session()->forget('link_song');
                    return redirect('/crear-paso-1');
                }
                $item=[];
                $item['id']=$allPlay->id;
                $item['url']=$playlist->external_urls->spotify;
                $item['coincidences']=$coincidencias;
                $item['image']=$playlist->images[0]->url;
                $item['name']=$playlist->name;
                $item['curator_id']=$allPlay->user->id;
                $item['curator_name']=$allPlay->user->name;
                $item['followers']=$playlist->followers->total;
                $total=$playlist->followers->total;
                $cost=100;
                if($total>=500 && $total<=5000) $cost=1;
                if($total>=5001 && $total<15000) $cost=1;
                if($total>=15001 && $total<=20000) $cost=1;
                if($total>=20001 && $total<=30000) $cost=1;
                if($total>=30001 && $total<=50000) $cost=2;
                if($total>=50001 && $total<=60000) $cost=2;
                if($total>=60001 && $total<=70000) $cost=3;
                if($total>=70001 && $total<=80000) $cost=3;
                if($total>=80001 && $total<=90000) $cost=4;
                if($total>=90001) $cost=4;
                $item['cost']=$cost;
                if($total>=500){
                    $playlists[$k]=$item;
                    $itemCost=[];
                    $itemCost['playlist']=$allPlay->id;
                    $itemCost['cost']=$cost;
                    $playlistsCosts[$k]=$itemCost;
                    $k++;
                }
            } 
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if(!$playlists){
            $url='https://api.spotify.com/v1/artists/'.$id_principal.'?access_token='.$access_token;
            $conexion=curl_init();
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
            $artist= curl_exec($conexion);
            curl_close($conexion);
            $artist=json_decode($artist);
            if(isset($artist->error)){
                session()->flash('expiredToken',true);
                session()->forget('link_song');
                return redirect('/crear-paso-1');
            }
            $playlists=[];
            $playlistsCosts=[];
            $i=0;
            $k=0;
            foreach($allPlays as $allPlay){
                $allPlay_id=trim($allPlay->link_playlist,);
                $allPlay_id=str_replace('https://open.spotify.com/playlist/','',$allPlay_id);
                if(substr($allPlay_id, 0, strpos($allPlay_id, "?"))){
                    $allPlay_id = substr($allPlay_id, 0, strpos($allPlay_id, "?"));
                }
                $url='https://api.spotify.com/v1/playlists/'.$allPlay_id.'/a?access_token='.$access_token.'&fields=items(track(artists(id)))&limit=15';
                $conexion=curl_init();
                curl_setopt($conexion, CURLOPT_URL, $url);
                curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                $tracks_artists= curl_exec($conexion);
                curl_close($conexion);
                $tracks_artists=json_decode($tracks_artists);
                if(isset($tracks_artists->error)){
                    session()->flash('expiredToken',true);
                    session()->forget('link_song');
                    return redirect('/crear-paso-1');
                }

                $j=0;
                $coincidencias=0;
                foreach($tracks_artists->items as $item_artist){
                    if(!$item_artist->track->artists[0]->id)continue;
                    $url='https://api.spotify.com/v1/artists/'.$item_artist->track->artists[0]->id.'?access_token='.$access_token;
                    $conexion=curl_init();
                    curl_setopt($conexion, CURLOPT_URL, $url);
                    curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                    curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                    $track_artist= curl_exec($conexion);
                    curl_close($conexion);
                    $track_artist=json_decode($track_artist);
                    if(isset($track_artist->error)){
                        session()->flash('expiredToken',true);
                        session()->forget('link_song');
                        return redirect('/crear-paso-1');
                    }
                    foreach($track_artist->genres as $genreA){
                        foreach($artist->genres as $genreB){
                            if($genreA == $genreB){
                                $coincidencias++;
                            }
                        }
                        $j++;
                    } 
                }
                if($coincidencias>0){
                    $url='https://api.spotify.com/v1/playlists/'.$allPlay_id.'?access_token='.$access_token;
                    $conexion=curl_init();
                    curl_setopt($conexion, CURLOPT_URL, $url);
                    curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                    curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                    $playlist= curl_exec($conexion);
                    curl_close($conexion);
                    $playlist=json_decode($playlist);
                    if(isset($playlist->error)){
                        session()->flash('expiredToken',true);
                        session()->forget('link_song');
                        return redirect('/crear-paso-1');
                    }
                    $item=[];
                    $item['id']=$allPlay->id;
                    $item['url']=$playlist->external_urls->spotify;
                    $item['coincidences']=$coincidencias;
                    $item['image']=$playlist->images[0]->url;
                    $item['name']=$playlist->name;
                    $item['curator_id']=$allPlay->user->id;
                    $item['curator_name']=$allPlay->user->name;
                    $item['followers']=$playlist->followers->total;
                    $total=$playlist->followers->total;
                    $cost=100;
                    if($total>=500 && $total<=5000) $cost=1;
                    if($total>=5001 && $total<15000) $cost=1;
                    if($total>=15001 && $total<=20000) $cost=1;
                    if($total>=20001 && $total<=30000) $cost=1;
                    if($total>=30001 && $total<=50000) $cost=2;
                    if($total>=50001 && $total<=60000) $cost=2;
                    if($total>=60001 && $total<=70000) $cost=3;
                    if($total>=70001 && $total<=80000) $cost=3;
                    if($total>=80001 && $total<=90000) $cost=4;
                    if($total>=90001) $cost=4;
                    $item['cost']=$cost;
                    if($total>=500){
                        $playlists[$k]=$item;
                        $itemCost=[];
                        $itemCost['playlist']=$allPlay->id;
                        $itemCost['cost']=$cost;
                        $playlistsCosts[$k]=$itemCost;
                        $k++;
                    }
                }  
            }
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        session()->put('playlistsCosts',$playlistsCosts);
        //ordena las playlists por orden de coincidencias 
        function order(&$arr_ini, $col,$order=SORT_DESC){
            $arr_aux=array();
            foreach($arr_ini as $key=>$row){
                $arr_aux[$key]=is_object($row) ? $arr_aux[$key]=$row->$col : $row[$col];
                $arr_aux[$key]=strtolower($arr_aux[$key]);
            }
            array_multisort($arr_aux,$order,$arr_ini);
        }
        order($playlists,'coincidences',$order=SORT_DESC);
        return view ('musico.crearCampana2',['data'=>$request,'user'=>$user,'playlists'=>$playlists,'song'=>$song]);
    }
    public function crearCampana3(request $request)
    {
        Gate::authorize('haveaccess','musico.perm');
        foreach(session()->get('playlistsCosts') as $playlistCost){
            if($playlistCost['playlist'] == $request->selected_playlist){
                $cost=$playlistCost['cost'];
                session()->put('selected_playlist',$playlistCost['playlist']);
                session()->put('playlist_cost',$cost);
            }
        }
        $access_token=session()->get('access_token');
        $data['song_name']=$request->song_name;
        $data['song_artist']=$request->song_artist;
        $data['song_link']=$request->link;
        $data['song_image']=$request->image;
        $data['tokens']=$cost;
        $hoy=Carbon::now();
        $data['date']=$hoy;
        $data['curator_id']=$request->curator;
        $curator=User::findOrFail($request->curator);
        $data['curator_name']=$curator->name;
        $data['playlist_id']=$request->selected_playlist;
        $playlist=Playlist::findOrFail($request->selected_playlist);
        $data['playlist_url']=$playlist->link_playlist;

        $playlist_id=trim($playlist->link_playlist,);
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
        if(isset($playlist->error)){
            session()->flash('expiredToken',true);
            session()->forget('link_song');
            return redirect('/crear-paso-1');
        }

        $data['playlist_name']=$playlist->name;
        return view ('musico.crearCampana3',['data'=>$data]);
    }
    public function storeCamp(request $request){
        Gate::authorize('haveaccess','musico.perm');
        $cost=session()->get('playlist_cost');
        $playlist_id=session()->get('selected_playlist');
        $user=User::findOrFail(Auth::id());
        if($user->tokens-$cost<0){
            session()->flash('unexpected',true);
            return redirect('/crear-paso-1');
        }
        $camp=new Camp();
        $camp->start_date=Carbon::now();
        $camp->cost=$cost;
        $camp->link_song=session()->get('link_song');;
        $camp->user_id=Auth::id();
        $camp->playlist_id=$playlist_id;
        $camp->status='espera';
        $camp->save();
        $user->tokens=$user->tokens-$cost;
        $user->save();
        $playlist=Playlist::with('user')->findOrFail(session()->get('selected_playlist'));
        $curator=User::findOrFail($playlist->user->id);
        Mail::to($curator->email)->send(new camp_mail($camp->id,$curator->name));
        // session()->forget('playlistsCosts');
        // session()->forget('selected_playlist');
        // session()->forget('playlist_cost');
        // session()->forget('link_song');
        // session()->flash('success',true);
        return redirect('/campanas');
    }
    public function tokens()
    {
        Gate::authorize('haveaccess','musico.perm');

        try { 
            $usuario = User::where('id',Auth::id())->get();
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }
        return view ('musico.tokens', ['usuario'=>$usuario]);
    }
}
