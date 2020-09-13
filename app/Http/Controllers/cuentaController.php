<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'passActual'=>'required|min:8',
            'password'=>'required|min:8',
            'cfmPassword'=>'required|min:8'
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

    // public function fotoUpdate()
    // {
    //     try { 
    //         $usuario = User::where('id',Auth::id())->get();
    //     } 
    //     catch(QueryException $ex){ 
    //         return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
    //     }

    //     if($usuario == null){
    //         return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
    //     }

    //     return view ('AdministrarCuenta.fotoUpdate', ['usuario' => $usuario]);
    // }

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
