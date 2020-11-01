<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        Gate::authorize('haveaccess','admin.perm');
        $users=User::where('solicitud','1')->get();
        return view('Administrador.solicitudes',['users'=>$users]);
    }

    public function patch(Request $request){
        Gate::authorize('haveaccess','admin.perm');
        $user=User::findOrFail($request->idUser);
        $user->saldo=$user->saldo - $request->saldoAct;
        $user->solicitud=0;
        $user->save();
        $status="La información fue actualizada correctamente";
            return redirect()->route('solicitudes')->with(compact('status'));
        
    }
}
