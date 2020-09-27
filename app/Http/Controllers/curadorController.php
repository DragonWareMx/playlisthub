<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Database\QueryException;
use App\User;
use Auth;

class curadorController extends Controller
{
    public function index()
    {
        return view ('curador.inicioCurador');
    } 

    // public function perfilPublico($id)
    // {
    //     try { 
    //         $usuario = User::where('spotify_id',$id)->get();
    //     } catch(QueryException $ex){ 
    //         return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
    //     }

    //     if($usuario == null){
    //         return view('errors.404', ['mensaje' => 'No se encontraron resultados']);
    //     }
    //     return view ('curador.PublicoperfilCurador', ['usuario' => $usuario]);
    // }
}
