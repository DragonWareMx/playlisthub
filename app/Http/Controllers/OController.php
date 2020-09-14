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

class OController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function favoritos()
    {
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
        return view ('musico.campanas',['campsAct'=>$campsAct,'songsAct'=>$songsAct,'playlistsAct'=>$playlistsAct,'campsAnt'=>$campsAnt,'songsAnt'=>$songsAnt,'playlistsAnt'=>$playlistsAnt,'error'=>$error]);
    }
    public function campanasActuales()
    {
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
        $hoy = Carbon::now();
        $campsAnt=Camp::orderBy('start_date','desc')->
        where([
            ['end_date','<',$hoy],
            ['user_id', '=', Auth::id()]
        ])
        ->limit(3)->get();
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
        $usedGenres=Genre_Playlist::groupBy('genre_id')->get('genre_id');
        $genres=Genre::orderBy('name','asc')->whereIn('id',$usedGenres)->get();
        return view ('musico.crearCampana1',['genres'=>$genres]);
    }
    public function recrearCampana2(){
        return redirect('/crear-paso-1');
    }
    public function recrearCampana3(){
        return redirect('/crear-paso-1');
    }
    public function crearCampana2(request $request)
    {
        $data=request()->validate([
            'link'=>'required',
            'genre'=>'required'
        ]);
        
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
        $user=User::findOrFail(Auth::id());
        $plays=Playlist::with('user')->orderBy('tier','desc')->leftJoin('genre_playlist','playlists.id', '=', 'genre_playlist.playlist_id')
            ->where('genre_playlist.genre_id',$request->genre)->get();
        $playlists=[];
        $i=0;
        foreach($plays as $play){
            $playlist_id=trim($play->link_playlist,);
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
            $item=[];
            $item['id']=$play->id;
            $item['url']=$playlist->external_urls->spotify;
            $item['image']=$playlist->images[0]->url;
            $item['name']=$playlist->name;
            $item['curator_id']=$play->user->id;
            $item['curator_name']=$play->user->name;
            $item['followers']=$playlist->followers->total;
            $total=$playlist->followers->total;
            $cost=10;
            if($total>=500 && $total<1000) $cost=1;
            if($total>=1000 && $total<2000) $cost=2;
            if($total>=2000 && $total<3000) $cost=3;
            if($total>=3000 && $total<4000) $cost=4;
            if($total>=4000 && $total<5000) $cost=5;
            if($total>=5000 && $total<6000) $cost=6;
            $item['cost']=$cost;
            $playlists[$i]=$item;
            $i++;
        }
        return view ('musico.crearCampana2',['data'=>$request,'user'=>$user,'playlists'=>$playlists,'song'=>$song]);
    }
    public function crearCampana3(request $request)
    {
        $access_token=session()->get('access_token');
        $data['song_name']=$request->song_name;
        $data['song_artist']=$request->song_artist;
        $data['song_link']=$request->link;
        $data['song_genre_id']=$request->genre_id;
        $genre=Genre::findOrFail($request->genre_id);
        $data['song_genre']=$genre->name;
        $data['tokens']=$request->cost;
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

        $data['playlist_name']=$playlist->name;
        dd($data);
        return view ('musico.crearCampana3',['data'=>$data]);
    }
    public function tokens()
    {
        return view ('musico.tokens');
    }
}
