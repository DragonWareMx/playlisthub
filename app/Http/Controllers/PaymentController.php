<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function stripePay(Request $request){
        dd($request->all());
    }
    public function payment(Request $request){
        if($request->paytype=='stripe'){
            $cantidad=$request->cantidad;
            return view('compra',['cantidad'=>$cantidad]);
        }
        return 'vilecaca';
    }
}
