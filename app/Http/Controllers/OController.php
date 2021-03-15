<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Camp;
use App\Review;
use App\User;
use App\Genre;
use App\Genre_Playlist;
use Illuminate\Support\Facades\Crypt;
use App\Playlist;
use App\Artist;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\camp_mail;
use App\Users_reference;

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
            $item['idsp']=$favorite->spotify_id;
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

    public function favoritosUpdate($idUser, $idsp){
        Gate::authorize('haveaccess','musico.perm');
        try { 
            
            $usuarioEx = User::where('id',$idUser)->get();
            $usuario = User::where('id',Auth::id())->first();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null || $usuarioEx ==null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }
        else{
            $usuarioLoggeado=User::with('favorites')->findOrFail(Auth::id());
            $marcaFav=false;
            foreach($usuarioLoggeado->favorites as $favorite){
                if($favorite->id == $idUser){
                    $marcaFav=true;
                }
            }
            if($marcaFav==false){
                //MARCAR COMO FAVORITO (AGREGAR)
                $usuario->favorites()->attach($usuarioEx);
            } 
            else{
                //DESMARCAR COMO FAVORITO (ELIMINAR)
                $usuario->favorites()->detach($usuarioEx);
            }
            return redirect(route('perfil-publico',['id'=>$idsp]));
            
        }
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
        $artists=Artist::orderBy('name','asc')->get('name');
        $arr_artists=[];
        $i=0;
        foreach($artists as $artist){
            $arr_artists[$i]=$artist->name;
            $i++;
        }
        return view ('musico.crearCampana1',['arr_artists'=>$arr_artists]);
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
            'link'=>'required',
            'artists'=>'required'
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
            session()->put('badLink',true);
            return redirect('/crear-paso-1');
        }
        if(isset($song->error->message)){
            if($song->error->message == 'invalid id'){
                session()->put('badLink',true);
                return redirect('/crear-paso-1');
            }
            else{
                session()->put('expiredToken',true);
                return redirect('/crear-paso-1');
            }
        }
        session()->put('link_song',$request->link);
        $artists=trim($request->artists);
        $artists=explode(',',$artists);
        $i=0;
        function elimina_acentos($text){
            $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
            $text = strtolower($text);
            $patron = array (
                '/\+/' => '',
                '/&agrave;/' => 'a','/&egrave;/' => 'e','/&igrave;/' => 'i','/&ograve;/' => 'o','/&ugrave;/' => 'u',
                '/&aacute;/' => 'a','/&eacute;/' => 'e','/&iacute;/' => 'i','/&oacute;/' => 'o','/&uacute;/' => 'u',
                '/&acirc;/' => 'a','/&ecirc;/' => 'e','/&icirc;/' => 'i','/&ocirc;/' => 'o','/&ucirc;/' => 'u',
                '/&atilde;/' => 'a','/&etilde;/' => 'e','/&itilde;/' => 'i','/&otilde;/' => 'o','/&utilde;/' => 'u',
                '/&auml;/' => 'a','/&euml;/' => 'e','/&iuml;/' => 'i','/&ouml;/' => 'o','/&uuml;/' => 'u',
                '/&auml;/' => 'a','/&euml;/' => 'e','/&iuml;/' => 'i','/&ouml;/' => 'o','/&uuml;/' => 'u','/&aring;/' => 'a','/&ntilde;/' => 'n',
            );
            $text = preg_replace(array_keys($patron),array_values($patron),$text);
            return $text;
        }
        foreach($artists as $artist){
            if(empty($artist))
                unset($artists[$i]);
            else
                $artists[$i]=elimina_acentos(trim($artist));
            $i++;
        }
        $artists=array_values($artists);
        $all_playlists=Playlist::with('artists','user')->get();
        $playlists=[];
        $playlistsCosts=[];
        $i=0;
        $cont=false;
        foreach($all_playlists as $all_playlist){
            $coincidencias=0;
            foreach($all_playlist->artists as $artist){
                if(in_array(elimina_acentos($artist->name),$artists)){
                    $coincidencias++;;
                    $cont=true;
                }
            }
            if($coincidencias>0){
                $playlist_id=trim($all_playlist->link_playlist,);
                $playlist_id=str_replace('https://open.spotify.com/playlist/','',$playlist_id);
                if(substr($playlist_id, 0, strpos($playlist_id, "?"))){
                    $playlist_id = substr($playlist_id, 0, strpos($playlist_id, "?"));
                }
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
                    session()->put('expiredToken',true);
                    session()->forget('link_song');
                    return redirect('/crear-paso-1');
                }
                $item=[];
                $item['id']=$all_playlist->id;
                $item['coincidences']=$coincidencias;
                $item['url']=$playlist->external_urls->spotify;
                $item['image']=$playlist->images[0]->url;
                $item['name']=$playlist->name;
                $item['curator_id']=$all_playlist->user->id;
                $item['curator_name']=$all_playlist->user->name;
                $item['followers']=$playlist->followers->total;
                $item['premium']=$all_playlist->user->premium;
                $total=$playlist->followers->total;
                $cost=100;
                $level=100;
                if($all_playlist->user->premium == 0){
                    if($total>=500 && $total<=5000){
                        $cost=0;
                        $level=1;
                    }
                    else if($total>=5001 && $total<15000){
                        $cost=0;
                        $costPrint=1;
                        $level=2;
                    }
                    else if($total>=15001 && $total<=20000){
                        $cost=0;
                        $costPrint=1;
                        $level=3;
                    }
                    else if($total>=20001 && $total<=30000){
                        $cost=0;
                        $costPrint=1;
                        $level=4;
                    }
                    else if($total>=30001 && $total<=50000){
                        $cost=0;
                        $costPrint=2;
                        $level=5;
                    }
                    else if($total>=50001 && $total<=60000){
                        $cost=0;
                        $costPrint=2;
                        $level=6;
                    }
                    else if($total>=60001 && $total<=70000){
                        $cost=0;
                        $costPrint=3;
                        $level=7;
                    }
                    else if($total>=70001 && $total<=80000){
                        $cost=0;
                        $costPrint=3;
                        $level=8;
                    }
                    else if($total>=80001 && $total<=90000){
                        $cost=0;
                        $costPrint=4;
                        $level=9;
                    }
                    else if($total>=90001){
                        $cost=0;
                        $costPrint=4;
                        $level=10;
                    }
                }
                else{
                    $cost=0;
                    $costPrint=5;
                    $level=11;
                }
                $item['cost']=$cost;
                $item['level']=$level;
                $item['costPrint']=$costPrint;
                if($total>=500){
                    $playlists[$i]=$item;
                    $itemCost=[];
                    $itemCost['playlist']=$all_playlist->id;
                    $itemCost['cost']=$cost;
                    $itemCost['level']=$level;
                    $playlistsCosts[$i]=$itemCost;
                    $i++;
                }
            }
        }
        if(!$cont){
            session()->put('badArtists',true);
            session()->forget('link_song');
            return redirect('/crear-paso-1');
        }
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
                session()->put('playlist_level',$playlistCost['level']);
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
            session()->put('expiredToken',true);
            session()->forget('link_song');
            return redirect('/crear-paso-1');
        }

        $data['playlist_name']=$playlist->name;
        return view ('musico.crearCampana3',['data'=>$data]);
    }
    public function storeCamp(){
        try{
            DB::transaction(function () {
                Gate::authorize('haveaccess','musico.perm');
                $cost=session()->get('playlist_cost');
                $level=session()->get('playlist_level');
                $playlist_id=session()->get('selected_playlist');
                $user=User::findOrFail(Auth::id());
                if($user->tokens-$cost<0){
                    session()->put('unexpected',true);
                    return redirect('/crear-paso-1');
                }
                $camp=new Camp();
                $camp->start_date=Carbon::now();
                $camp->cost=$cost;
                $camp->level=$level;
                $camp->link_song=session()->get('link_song');;
                $camp->user_id=Auth::id();
                $camp->playlist_id=$playlist_id; 
                $camp->status='espera';
                $camp->save();
                $user->tokens=$user->tokens-$cost;
                $user->save();
                $playlist=Playlist::with('user')->findOrFail(session()->get('selected_playlist'));
                $curator=User::findOrFail($playlist->user->id);
            });
            session()->forget('playlistsCosts');
            session()->forget('selected_playlist');
            session()->forget('playlist_cost');
            session()->forget('playlist_level');
            session()->forget('link_song');
            session()->put('success',true);
            return redirect('/campanas');
        }
        catch(QueryException $ex){
            
            session()->forget('playlistsCosts');
            session()->forget('selected_playlist');
            session()->forget('playlist_cost');
            session()->forget('playlist_level');
            session()->forget('link_song');
            session()->put('fail',true);
            return redirect('/crear-paso-1');
        }
    }
    public function tokens()
    {
        Gate::authorize('haveaccess','musico.perm');

        try {
            session()->forget("descuento");
            session()->forget("referenced_id"); 
            $usuario = User::where('id',Auth::id())->get();
            $referencias = User::whereNotNull('reference')->where('ref_active',1)->get();
            $references=[];
            foreach($referencias as $ref){
                if($ref->id != auth()->user()->id){
                    $item=[];
                    $item['user']=$ref->id;
                    $item['code']=$ref->reference;
                    $references[]=$item;
                }
            } 
            $usados=Users_reference::where('user_id',auth()->user()->id)->get();
            foreach($usados as $usado){
                $i=0;
                foreach($references as $ref){
                    if($ref['user'] == $usado->referenced_id ){
                        unset($references[$i] );  
                    }
                    $i++;
                }
                $references=array_values($references);
            }
            $references=array_values($references);
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }
        return view ('musico.tokens', ['usuario'=>$usuario,'ref'=>$references]);
    }

    public function inicio(){
        if(auth()->user()->type=='Músico'){
            return redirect()->route('inicio-musico');
        }
        if(auth()->user()->type=='Curador'){
            return redirect()->route('inicio-curador');
        }
        if(auth()->user()->type=='Administrador'){
            return view('inicio');
        }
    }
}
