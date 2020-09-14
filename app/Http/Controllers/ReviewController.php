<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use App\Camp;
use App\Review;
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

                //campanas con reviews del usuario musico
                /*$reviews = Review::whereHas('camp', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })->orderBy('date','desc')
                ->get();*/
                $reviews = Review::whereHas('camp', function ($query) {
                    return $query->where('user_id', '=', 1);
                })->orderBy('date','desc')
                ->get();

                //campanas con reviews del usuario musico
                /*$reviews = Review::with('camp')->orderBy('date','desc')
                                                ->where('user_id', '=', Auth::id())
                                                ->limit(3)->get();*/

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                foreach($reviews as $review){
                    $total+=$review->rating;
                    $numReviews++;
                }

                $calificacion = round($total/$numReviews,1);

                return view('reviews.reviews',['tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews]);
                break;
            case 'Curador':
                $tipo = false;

                //reviews del usuario curador
                $reviews;
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
