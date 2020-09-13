<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use Auth;

class ReviewController extends Controller
{
    //pagina principal de las reviews musico/curador
    public function reviews()
    {
        //variables
        $usuario = null;
        //booleano que indica el tipo del usuario (true = musico, false = curador)
        $tipo;

        //obtenemos el usuario que inicio sesion
        try { 
            $usuario = User::where('id',Auth::id())->get();
        } catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null || count($usuario) == 0){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        //verifica que tipo de usuario es
        switch($usuario[0]->type){
            case 'Músico':
                $tipo = true;
                break;
            case 'Curador':
                $tipo = false;
                break;
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }

        return view('reviews.reviews',['tipo'=>$tipo]);
    }

    //reviews pendientes musico/curador
    public function reviewsPendientes()
    {
        return view('reviews.reviews_pendientes');
    }
}
