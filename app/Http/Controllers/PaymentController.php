<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //

    public function stripePay(Request $request){
        //dd($request->all());
        $usuario=User::findOrFail(Auth::id());
        $content='Tokens';
        $cantidad=session()->get('cantidad');
        $total=$cantidad*10;
        try {
            $charge = Stripe::charges()->create([
                'amount'=> $total,
                'currency'=> 'USD',
                'source' => $request->stripeToken,
                'description'=>'Compra de tokens en Playlisthub',
                'receipt_email'=> $usuario->email,
                'metadata' => [
                    'contents'=>$content,
                    'quantity'=>$cantidad,
                ],
            ]);

            //SUCCESSFUL
            $usuario->tokens=$usuario->tokens+$cantidad;
            $usuario->save();
            session()->forget('cantidad');
            //Mail::to($sell->correo)->send(new SendMailable($sell->id));
            $status="Gracias por tu compra!. Se te enviará un correo electrónico con los detalles de tu pedido.";
            return redirect()->route('tokens')->with(compact('status'));
        } catch (CardErrorException $e) {
            //throw $th;
            if($e->getMessage()=='Your card has insufficient funds.'){
                $status='Error! Tu tarjeta no tiene fondos suficientes.';    
            }
            else if($e->getMessage()=='Your card was declined.'){
                $status='Error! Tu tarjeta fue declinada.';    
            }
            else if($e->getMessage()=='Your card has expired.'){
                $status='Error! Tu tarjeta ha expirado.';    
            }
            else if($e->getMessage()=="Your card's security code is incorrect."){
                $status='Error! El código de seguridad de tu tarjeta es incorrecto.';    
            }
            else if($e->getMessage()=="An error occurred while processing your card. Try again in a little bit."){
                $status='Error! Un problema ocurrió mientras procesabamos tu tarjeta. Inténtalo de nuevo más tarde.';    
            }
            else{
                $status='Error! '.$e->getMessage();
            }
            return redirect()->back()->with(compact('status'));
        }        
    }
    public function payment(Request $request){
        if($request->paytype=='stripe'){
            $cantidad=$request->cantidad;
            session()->put('cantidad',$cantidad);
            return view('compra',['cantidad'=>$cantidad]);
        }
        return 'vilecaca';
    }
}
