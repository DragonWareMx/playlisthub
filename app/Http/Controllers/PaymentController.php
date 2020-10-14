<?php

namespace App\Http\Controllers;

use App\User;
use App\Users_reference;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Support\Facades\Auth;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    //
    private $apiContext;
    private $packs= array(
        0=> array(
            "cantidad"=>10,
            "descuento"=>0,
            "descuentoRef"=>10,
            "totalRef"=>90,
            "total"=>100
        ),
        1=> array(
            "cantidad"=>20,
            "descuento"=>10,
            "descuentoRef"=>20,
            "totalRef"=>180,
            "total"=>190
        ),
        2=> array(
            "cantidad"=>30,
            "descuento"=>30,
            "descuentoRef"=>60,
            "totalRef"=>240,
            "total"=>270
        )
    );

    public function __construct()
    {
        $payPalConfig=Config::get('paypal');
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],     // ClientID
                $payPalConfig['secret']      // ClientSecret
            )
        );

        $this->apiContext->setConfig([
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => 'PayPal.log',
            'log.LogLevel' => 'FINE'
        ]);
    }

    public function stripePay(Request $request){
        //dd($request->all());
        $usuario=User::findOrFail(Auth::id());
        $content='Tokens';
        $pakcID=session()->get('packID');
        $pack=$this->packs[$pakcID];
        if(session()->get('descuento')=='true'){
            $total=$pack['totalRef'];
        }
        else{
            $total=$pack['total'];
        }
        try {
            $charge = Stripe::charges()->create([
                'amount'=> $total,
                'currency'=> 'USD',
                'source' => $request->stripeToken,
                'description'=>'Compra de tokens en Playlisthub',
                'receipt_email'=> $usuario->email,
                'metadata' => [
                    'contents'=>$content,
                    'quantity'=>$pack['cantidad'],
                ],
            ]);

            //SUCCESSFUL
            $usuario->tokens=$usuario->tokens+$pack['cantidad'];
            $usuario->ref_active=1;
            $user_refer=new Users_reference();
            $user_refer->user_id=$usuario->id;
            $user_refer->referenced_id=session()->get("referenced_id");
            $user_refer->save();
            $usuario->save();
            //ver si se le tiene que dar otro token gratis
            $cantRef=Users_reference::where('referenced_id',session()->get("referenced_id"))->get();
            $cantRef=count($cantRef);
            $referenciador=User::findOrFail(session()->get("referenced_id"));
            $dif= $cantRef - ($referenciador->ref_payed * 3);
            if($dif>=3){
                $referenciador->tokens=$referenciador->tokens+1;
                $referenciador->ref_payed=$referenciador->ref_payed+1;
                $referenciador->save();
            }

            session()->forget('packID');
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
            return redirect()->route('tokens')->with(compact('status')); 
        }        
    }
    public function payment(Request $request){
        if($request->descuento == "true"){
            $codigo=$request->code;
            $dueno=User::where('reference',$codigo)->first();
            if(!$dueno){
                $status="Hubo un error al intentar procesar ese código de referencia, por favor intentalo más tarde.";
                return redirect()->route('tokens')->with(compact('status'));
            }
            $mismo=User::findOrFail(auth()->user()->id);
            if($mismo->reference==$codigo){
                $status="Hubo un error al intentar procesar ese código de referencia, por favor intentalo más tarde.";
                return redirect()->route('tokens')->with(compact('status'));
            }
            $codigo=Users_reference::where('user_id',$mismo->id)->where('referenced_id',$dueno->id)->first();
            if(!$codigo){
                session()->put("descuento","true");
                session()->put("referenced_id",$dueno->id);
            }else{
                $status="Hubo un error al intentar procesar ese código de referencia, por favor intentalo más tarde.";
                return redirect()->route('tokens')->with(compact('status'));
            }
        }

        if($request->paytype=='stripe'){
            $packID=$request->packID;
            session()->put('packID',$packID);
            if(session()->get('descuento')){
                $descuento=1;
            }
            else{
                $descuento=0;
            }
            return view('compra',['tokens'=>$this->packs[$packID],'desRef'=>$descuento]);
        }
         // After Step 2
         $payer = new Payer();
         $payer->setPaymentMethod('paypal');
 
         //Parte para sacar los items del carrito y meterlos a paypal
         $packID=$request->packID;
         $packs=$this->packs[$packID];
         session()->put('packID',$packID);
         $items=[];
         $items[0]=new Item();
         $items[0]->setName('Paquete de '.$packs['cantidad'].' tokens')
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($packs['cantidad'] * 10);
         if($packs['descuento']>0){
            $items[1]=new Item();
            $items[1]->setName('Descuento')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(-$packs['descuento']);
         }
         $item_list = new ItemList();
         $item_list->setItems($items);
         
         $amount = new Amount();
         $amount->setTotal($packs['total']);
         $amount->setCurrency('USD');
         $transaction = new Transaction();
         $transaction->setAmount($amount);
         $transaction->setDescription('Compra de tokens en Playlisthub');
         $transaction->setItemList($item_list);
 
         $callbackurl=route('statusPayPal');
         $redirectUrls = new RedirectUrls();
         $redirectUrls->setReturnUrl($callbackurl)
             ->setCancelUrl($callbackurl);
 
         $payment = new Payment();
         $payment->setIntent('sale')
             ->setPayer($payer)
             ->setTransactions(array($transaction))
             ->setRedirectUrls($redirectUrls);
 
         try {
             $payment->create($this->apiContext);
             //echo $payment;
             return redirect()->away($payment->getApprovalLink());
         }
         catch (PayPalConnectionException $ex) {
             
             echo $ex->getData();
         }
    }

    public function payPalStatus(Request $request){
        $paymentId=$request->input('paymentId');
        $payerId=$request->input('PayerID');
        $token=$request->input('token');

        if(!$paymentId || !$payerId || !$token){
            $status="No se pudo proceder con el pago através de PayPal.";
            return redirect()->route('tokens')->with(compact('status'));
        }
        $payment= Payment::get($paymentId,$this->apiContext);

        $execution=new PaymentExecution();
        $execution->setPayerId($payerId);

        $result= $payment->execute($execution,$this->apiContext);

        if($result->getState()=='approved'){
            //se registra la venta en la BD en la tabla Sell
            $usuario=User::findOrFail(Auth::id());
            $pakcID=session()->get('packID');
            $pack=$this->packs[$pakcID];
            $usuario->tokens=$usuario->tokens+$pack['cantidad'];
            $usuario->ref_active=1;
            $usuario->save();
            session()->forget('packID');
            
            //Mail::to($sell->correo)->send(new SendMailable($sell->id));
            
            $status="Gracias! El pago a través de PayPal se ha procesado correctamente. Se te enviará un correo electrónico con los detalles de tu pedido.";
            return redirect()->route('tokens')->with(compact('status'));
        }
            $status="Lo sentimos! El pago a través de PayPal no se pudo realizar.";
            return redirect()->route('tokens')->with(compact('status'));
    }
}
