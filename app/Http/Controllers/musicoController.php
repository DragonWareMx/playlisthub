<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use Auth;

class musicoController extends Controller
{
    public function perfil()
    {
        try { 
            // $usuario = User::where('id',Auth::id())->get();
            $usuario = User::where('id',1)->get();
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }
        
        return view ('musico.perfilMusico', ['usuario' => $usuario]);
    }
    public function perfilPublico()
    {
        return view ('musico.PublicoperfilMusico');
    }
}
