<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegistroController extends Controller
{
    //
    public function RegistroCurador(){

        return view('login.registroCurador');
    }

    public function CuradorSpoty(){
        $client_id = env('SPOTIFY_CLIENT_ID',null); // client id de dashboard
        $client_secret = env('SPOTIFY_CLIENT_SECRET',null); // clien secret de dashboard
        $redirect_uri = 'http://127.0.0.1:8000/register/curador/spotify/callback'; //redirect uri para ver playlists
        $scope = '';//permisos que spotify solicitará
        $text = '';//texto aleatorio CAMBIAR POR MÉTODO ORIGINAL!!!!!
        $possible = Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T',
        'U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t',
        'u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
        for ($i=0; $i <16 ; $i++) { 
          $text=$text.$possible[array_rand($possible)];
        }

        $request ='https://accounts.spotify.com/authorize?response_type=code&client_id='.$client_id.'&scope='.$scope.'&redirect_uri='.$redirect_uri.'&state='.$text;
        return redirect($request);
    }

    public function CuradorSpotyCallback(Request $request){
        $client_id = env('SPOTIFY_CLIENT_ID',null); // client id de dashboard
        $client_secret = env('SPOTIFY_CLIENT_SECRET',null); // clien secret de dashboard

        $code=$request->code;
        $state=$request->state;

        $storedState=null;
        if(isset($_COOKIE['stateKey'])) {
            $storedState=$_COOKIE['stateKey'];
        }
        $redirect_uri='http://127.0.0.1:8000/register/curador/spotify/callback';
        $rutaError='http://127.0.0.1:8000/error?error=state_mismatch';

        if($state === null /*|| $state !== $storedState*/){
            return redirect($rutaError); 
        }
        else{
            setcookie('stateKey', "", time() - 3600);
            $url='https://accounts.spotify.com/api/token';

            $postdata = http_build_query(
                array(
                    'grant_type'=>'authorization_code',
                    'code'=>$code,
                    'redirect_uri'=>$redirect_uri,
                    'client_id'=>$client_id,
                    'client_secret'=>$client_secret,
                    'show_dialog'=>true
                )
            );
            $opts = array('http'=>
                array(
                    'method'=> 'POST',
                    'header'=> 'Content-type:application/x-www-form-urlencoded',
                    'content'=>$postdata
                )
            );
            
            $context=stream_context_create($opts);
            $dataAccess=file_get_contents($url,false,$context);
            $dataAccess=json_decode($dataAccess);

            $access_token=$dataAccess->access_token;
            $refresh_token=$dataAccess->refresh_token;
            Session::put('access_token',$access_token);

            $url='https://api.spotify.com/v1/me?Authorization=Bearer&access_token='.$dataAccess->access_token;
            $conexion=curl_init();
            
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

            $user= curl_exec($conexion);
            curl_close($conexion);
            $user=json_decode($user);
            $url='https://api.spotify.com/v1/me/playlists?access_token='.$dataAccess->access_token;
            $conexion=curl_init();
            
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

            $playlists= curl_exec($conexion);
            curl_close($conexion);
            $playlists=json_decode($playlists,true);
            $numPlaylists=sizeof($playlists['items']);
            $aprobado=false;
            for ($i=0; $i < $numPlaylists ; $i++) { 
                if ($playlists['items'][$i]['owner']['id'] == $user->id) {
                    $url='https://api.spotify.com/v1/playlists/'.$playlists['items'][$i]['id'].'?access_token='.$dataAccess->access_token;
                    $conexion=curl_init();
                    
                    curl_setopt($conexion, CURLOPT_URL, $url);
                    curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                    curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

                    $playlist= curl_exec($conexion);
                    curl_close($conexion);
                    $playlist=json_decode($playlist,true);
                    if ($playlist['followers']['total'] >= 17) {
                        $aprobado=true;
                    }
                }
            }

            if ($aprobado) {
                Session::put('user',$user);
                Session::put('aprobado',$aprobado);
                return redirect()->route('registerCuratorForm');
            }
            return view('login.registroCuradorNo');
            
        }
    }
    public function RegistroCuradorForm(){
        $user=session()->get('user');
        if (!$user || session()->get('aprobado')!=true) {
            return 'error pillin';
        }
        return view('login.registroCuradorYes',['user'=>$user]);
    }

    public function registrarseCurador(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3|max:80',
            'email' => 'email|required|unique:users',
            'spotify_id' => 'required|unique:users',
            'genero' => 'required',
            'country' => 'required',
            'date' => 'date|required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->spotify_id=$request->spotify_id;
        $user->avatar=$request->avatar;
        $user->genre=$request->genero;
        $user->birth_date=$request->date;
        $user->country=$request->country;
        $user->type='Curador';
        $user->tokens=0;
        $user->save();

        session()->forget('user');
        return redirect()->route('home');
    }

    public function RegistroMusico(){

        return view('login.registroMusico');
    }

    public function MusicoSpoty(){
        $client_id = env('SPOTIFY_CLIENT_ID',null); // client id de dashboard
        $client_secret = env('SPOTIFY_CLIENT_SECRET',null); // clien secret de dashboard
        $redirect_uri = 'http://127.0.0.1:8000/register/musico/spotify/callback'; //redirect uri para ver playlists
        $scope = '';//permisos que spotify solicitará
        $text = '';//texto aleatorio CAMBIAR POR MÉTODO ORIGINAL!!!!!
        $possible = Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T',
        'U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t',
        'u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
        for ($i=0; $i <16 ; $i++) { 
          $text=$text.$possible[array_rand($possible)];
        }

        $request ='https://accounts.spotify.com/authorize?response_type=code&client_id='.$client_id.'&scope='.$scope.'&redirect_uri='.$redirect_uri.'&state='.$text;
        return redirect($request);
    }

    public function MusicoSpotyCallback(Request $request){
        $client_id = env('SPOTIFY_CLIENT_ID',null); // client id de dashboard
        $client_secret = env('SPOTIFY_CLIENT_SECRET',null); // clien secret de dashboard

        $code=$request->code;
        $state=$request->state;

        $storedState=null;
        if(isset($_COOKIE['stateKey'])) {
            $storedState=$_COOKIE['stateKey'];
        }
        $redirect_uri='http://127.0.0.1:8000/register/musico/spotify/callback';
        $rutaError='http://127.0.0.1:8000/error?error=state_mismatch';

        if($state === null /*|| $state !== $storedState*/){
            return redirect($rutaError); 
        }
        else{
            setcookie('stateKey', "", time() - 3600);
            $url='https://accounts.spotify.com/api/token';

            $postdata = http_build_query(
                array(
                    'grant_type'=>'authorization_code',
                    'code'=>$code,
                    'redirect_uri'=>$redirect_uri,
                    'client_id'=>$client_id,
                    'client_secret'=>$client_secret,
                    'show_dialog'=>true
                )
            );
            $opts = array('http'=>
                array(
                    'method'=> 'POST',
                    'header'=> 'Content-type:application/x-www-form-urlencoded',
                    'content'=>$postdata
                )
            );
            
            $context=stream_context_create($opts);
            $dataAccess=file_get_contents($url,false,$context);
            $dataAccess=json_decode($dataAccess);

            $access_token=$dataAccess->access_token;
            $refresh_token=$dataAccess->refresh_token;
            Session::put('access_token',$access_token);

            $url='https://api.spotify.com/v1/me?Authorization=Bearer&access_token='.$dataAccess->access_token;
            $conexion=curl_init();
            
            curl_setopt($conexion, CURLOPT_URL, $url);
            curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
            curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

            $user= curl_exec($conexion);
            curl_close($conexion);
            $user=json_decode($user);

            Session::put('user',$user);
            return redirect()->route('registerMusicianForm');
        }
    }

    public function RegistroMusicoForm(){
        $user=session()->get('user');
        if (!$user) {
            return 'error pillin';
        }
        return view('login.registroMusicoYes',['user'=>$user]);
    }

    public function registrarseMusico(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3|max:80',
            'email' => 'email|required|unique:users',
            'spotify_id' => 'required|unique:users',
            'genero' => 'required',
            'country' => 'required',
            'date' => 'date|required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->spotify_id=$request->spotify_id;
        $user->avatar=$request->avatar;
        $user->genre=$request->genero;
        $user->birth_date=$request->date;
        $user->country=$request->country;
        $user->type='Músico';
        $user->tokens=0;
        $user->save();

        session()->forget('user');
        return redirect()->route('home');
    }

}
