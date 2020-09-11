<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use Auth;

class cuentaController extends Controller
{
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
            $usuario = User::where('id',1)->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.nombreUpdate', ['usuario' => $usuario]);
    }
    public function contraseñaUpdate()
    {
        return view ('AdministrarCuenta.contraseñaUpdate');
    }
    public function correoUpdate()
    {
        try { 
            $usuario = User::where('id',1)->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.correoUpdate', ['usuario' => $usuario]);
    }
    public function fecNacUpdate()
    {
        try { 
            $usuario = User::where('id',1)->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.fecNacUpdate', ['usuario' => $usuario]);
    }
    public function fotoUpdate()
    {
        try { 
            $usuario = User::where('id',1)->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.fotoUpdate', ['usuario' => $usuario]);
    }
    public function generoUpdate()
    {
        try { 
            $usuario = User::where('id',1)->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.generoUpdate', ['usuario' => $usuario]);
    }
    public function paisUpdate()
    {
        try { 
            $usuario = User::where('id',1)->get();
        } 
        catch(QueryException $ex){ 
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        if($usuario == null){
            return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
        }

        return view ('AdministrarCuenta.paisUpdate', ['usuario' => $usuario]);
    }
}
