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

        return view ('curador.perfilCurador', ['usuario' => $usuario]);
    }

    public function perfilPublico()
    {
        return view ('curador.PublicoperfilCurador'); 
    }
}
