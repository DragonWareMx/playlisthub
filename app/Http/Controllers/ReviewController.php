<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
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

                //reviews de las campanas del usuario musico
                $reviews = Review::whereHas('camp', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })->orderBy('date','desc')
                ->get();

                //reviews a playlists de curadores que el musico ha realizado
                $realizadas = Review::with('playlist')->orderBy('date','desc')
                                                ->where('user_id', '=', Auth::id())
                                                ->get();

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                if(count($reviews) > 0){
                    foreach($reviews as $review){
                        $total+=$review->rating;
                        $numReviews++;
                    }

                    $calificacion = round($total/$numReviews,1);
                }
                else{
                    $calificacion = 0;
                }

                return view('reviews.reviews',['tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews, 'realizadas'=>$realizadas,'nrealizadas'=>count($realizadas)]);
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

                //Obtiene los IDs de las campañas que ya escribieron una review a la playlist
                $campsIds = Camp::select('camps.id')
                                            ->join('reviews', 'reviews.camp_id', '=', 'camps.id')
                                            ->distinct()
                                            ->where('reviews.playlist_id','!=','NULL')
                                            ->pluck('id')->toArray();

                //Obtiene las campañas que ya fueron aceptadas que aun no hacen una review a la playlist
                /*$camps = Camp::where([['user_id', '=', Auth::id()],['status','=','aceptado'],])
                ->with('review')
                ->whereNotIn('id', $campsIds)
                ->orderBy('start_date','desc')
                ->get();*/
                $camps = Camp::where([['user_id', '=', 1],['status','=','aceptado'],])
                ->with('review')
                ->whereNotIn('id', $campsIds)
                ->orderBy('start_date','desc')
                ->get();

                return view('reviews.reviews_pendientes',['tipo'=>$tipo,'camps'=>$camps]);
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

        return view('reviews.reviews_pendientes');
    }

    //realizar review musico/curador
    public function realizarReview($id)
    {
        $data = Crypt::decrypt($id);

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
        
        return view('reviews.reviews_realizar');
    }
}
