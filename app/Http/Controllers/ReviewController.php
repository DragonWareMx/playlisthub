<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
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
                ->whereNull('playlist_id')
                ->get();

                //reviews a playlists de curadores que el musico ha realizado
                $realizadas = Review::where('playlist_id','!=',"NULL")->orderBy('date','desc')
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

                //reviews de las playlists del usuario musico
                $reviews = Review::whereHas('playlist', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })->orderBy('date','desc')
                ->get();

                //reviews a campañas de musicos que el curador ha realizado
                $realizadas = Review::with('camp')->orderBy('date','desc')
                                                ->where('user_id', '=', Auth::id())
                                                ->whereNull('playlist_id')
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
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }
    }

    //pagina principal de las reviews musico/curador
    public function reviewsReal()
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

                //reviews a playlists de curadores que el musico ha realizado
                $realizadasN = Review::where('playlist_id','!=',"NULL")->orderBy('date','desc')
                                            ->where('user_id', '=', Auth::id())
                                            ->count();
                $realizadas = Review::where('playlist_id','!=',"NULL")->orderBy('date','desc')
                                            ->where('user_id', '=', Auth::id())
                                            ->paginate(10);

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                return view('reviews.reviews_realizadas',['tipo'=>$tipo, 'numReviews'=>$numReviews, 'realizadas'=>$realizadas,'nrealizadas'=>$realizadasN]);
                break;
            case 'Curador':
                $tipo = false;

                //reviews a campañas de musicos que el curador ha realizado
                $realizadasN = Review::with('camp')->orderBy('date','desc')
                                                ->where('user_id', '=', Auth::id())
                                                ->whereNull('playlist_id')
                                                ->count();

                $realizadas = Review::with('camp')->orderBy('date','desc')
                                                ->where('user_id', '=', Auth::id())
                                                ->whereNull('playlist_id')
                                                ->paginate(10);
                
                return view('reviews.reviews_realizadas',['tipo'=>$tipo, 'realizadas'=>$realizadas,'nrealizadas'=>$realizadasN]);
                break;
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }

        return view('reviews.reviews',['tipo'=>$tipo]);
    }

    //pagina principal de las reviews musico/curador
    public function reviewsRec()
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
                ->whereNull('playlist_id');

                $reviewsn = $reviews;

                $reviewsn = $reviewsn->get();
                $reviews = $reviews->paginate(10);

                //obtenemos el promedio de las reviews y la cantidad de reviews
                $total = 0;
                $numReviews = 0;

                if(count($reviewsn) > 0){
                    foreach($reviewsn as $review){
                        $total+=$review->rating;
                        $numReviews++;
                    }

                    $calificacion = round($total/$numReviews,1);
                }
                else{
                    $calificacion = 0;
                }

                return view('reviews.reviews_recibidas',['tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews]);
                break;
            case 'Curador':
                $tipo = false;

                //reviews de las playlists del usuario musico
                $reviews = Review::whereHas('playlist', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })->orderBy('date','desc');

                $reviewsn = $reviews;

                $reviewsn = $reviewsn->get();
                $reviews = $reviews->paginate(10);

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
                
                return view('reviews.reviews_recibidas',['tipo'=>$tipo, 'reviews'=> $reviews, 'calificacion'=>$calificacion, 'numReviews'=>$numReviews]);
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
                $camps = Camp::where([['user_id', '=', Auth::id()],['status','=','aceptado'],])
                ->with('review')
                ->whereNotIn('id', $campsIds)
                ->orderBy('start_date','desc')
                ->get();

                return view('reviews.reviews_pendientes',['tipo'=>$tipo,'camps'=>$camps]);
                break;
            case 'Curador':
                $tipo = false;

                //Obtiene los IDs de las campañas que ya recibieron una review
                $campsIds = Camp::select('camps.id')
                                            ->join('reviews', 'reviews.camp_id', '=', 'camps.id')
                                            ->distinct()
                                            ->whereNull('reviews.playlist_id')
                                            ->pluck('id')->toArray();

                //Obtiene las campañas que en espera de review
                $camps = Camp::where('status','=','espera')
                ->whereHas('playlist', function ($query) {
                    return $query->where('user_id', '=', Auth::id());
                })
                ->whereNotIn('id', $campsIds)
                ->orderBy('start_date','asc')
                ->get();

                return view('reviews.reviews_pendientes',['tipo'=>$tipo,'camps'=>$camps]);
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

        //verifica que tipo de usuario es
        switch($usuario[0]->type){
            case 'Músico':
                $tipo = true;

                $camp = Camp::find($data);

                if($camp == null){
                    return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                }

                //obtenemos los IDs de las campañas que ya escribieron una review a la playlist
                $campsIds = Camp::select('camps.id')
                                ->join('reviews', 'reviews.camp_id', '=', 'camps.id')
                                ->distinct()
                                ->where('reviews.playlist_id','!=','NULL')
                                ->pluck('id')->toArray();

                //verifica que la campaña aún no haya escrito una review a la playlist del curador
                if(in_array($camp->id, $campsIds)){
                    return view('errors.404', ['mensaje' => 'Esta campaña ya realizó una review.']);
                }
                
                return view('reviews.reviews_realizar',['tipo'=>$tipo,'camp'=>$camp]);
                break;
            case 'Curador':
                $tipo = false;

                $camp = Camp::find($data);

                if($camp == null){
                    return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                }

                //obtenemos los IDs de las campañas que ya recibieron una review
                $campsIds = Camp::select('camps.id')
                                ->join('reviews', 'reviews.camp_id', '=', 'camps.id')
                                ->distinct()
                                ->whereNull('reviews.playlist_id')
                                ->pluck('id')->toArray();

                //verifica que la campaña aún no haya escrito una review a la playlist del curador
                if(in_array($camp->id, $campsIds)){
                    return view('errors.404', ['mensaje' => 'Esta campaña ya realizó una review.']);
                }
                
                return view('reviews.reviews_realizar',['tipo'=>$tipo,'camp'=>$camp]);
                break;
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }
    }

    public function storeReview(request $request){
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
                //valida los campos
                $data=request()->validate([
                    'rating'=>'required|max:5|min:0.5',
                    'review'=>'required|max:3000|min:150'
                ]);

                //Obtiene los IDs de las campañas que ya escribieron una review a la playlist
                $campsIds = Camp::select('camps.id')
                                            ->join('reviews', 'reviews.camp_id', '=', 'camps.id')
                                            ->distinct()
                                            ->where('reviews.playlist_id','!=','NULL')
                                            ->pluck('id')->toArray();
                
                //verifica que la campaña no haya realizado ya la review a la playlist
                if(!in_array(request('camp_id'),$campsIds)){
                    try{
                        \DB::transaction(function() use($usuario)
                        {
                            $today=Carbon::now()->format('Y-m-d H:i:s');

                            //se crea el review
                            $review = new Review();

                            $review->rating = request('rating');
                            $review->comment = request('review');
                            $review->date = $today;
                            $review->user_id = Auth::id();
                            $review->playlist_id = request('playlist_id');
                            $review->camp_id = request('camp_id');
                            $review->save();

                            session()->flash('success',true);
                        });
                    }
                    catch(QueryException $ex){
                        return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']); 
                    }
                }
                
                return redirect()->route('reviews');
                break;
            case 'Curador':
                //valida los campos
                $data=request()->validate([
                    'rating'=>'required|max:5|min:0.5',
                    'estatus'=>'required',
                    'review'=>'required|max:3000|min:150'
                ]);

                //Obtiene los IDs de las campañas que ya recibieron una review
                $campsIds = Camp::select('camps.id')
                                            ->join('reviews', 'reviews.camp_id', '=', 'camps.id')
                                            ->distinct()
                                            ->whereNull('reviews.playlist_id')
                                            ->pluck('id')->toArray();

                //verifica que la campaña no haya recibido ya la review
                if(!in_array(request('camp_id'),$campsIds)){
                    try{
                        \DB::transaction(function() use($usuario)
                        {
                            $today=Carbon::now()->format('Y-m-d H:i:s');

                            //se crea el review
                            $review = new Review();

                            $review->rating = request('rating');
                            $review->comment = request('review');
                            $review->date = $today;
                            $review->user_id = Auth::id();
                            $review->camp_id = request('camp_id');
                            $review->save();

                            //actualizamos el estatus de la campaña
                            $camp = Camp::find(request('camp_id'));

                            if(request('estatus') == "true")
                                $camp->status = "aceptado";
                            else
                                $camp->status = "rechazado";
                        
                            $camp->save();

                            session()->flash('success',true);
                        });
                    }
                    catch(QueryException $ex){
                        return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']); 
                    }
                }

                return redirect()->route('reviews');
                break;
            default:
                return view('errors.404', ['mensaje' => 'No fue posible conectarse con la base de datos']);
                break;
        }
    }
}
