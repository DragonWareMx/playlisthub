<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payment(Request $request){
        if($request->paytype=='stripe'){
            
            return view('compra');
        }
        return 'vilecaca';
    }
}
