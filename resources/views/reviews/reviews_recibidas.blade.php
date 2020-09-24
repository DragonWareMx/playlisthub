@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
@endsection

@section('menu')
    Reviews
@endsection

@section('contenido')

@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="div_CabeceraApartado reviews-cabecera" style="margin-top:40px">
    <div class="div_tituloApartado" style="width:auto">
        <p><img class="img_ico_title_o" src={{asset("img/iconos/reviews.png")}} alt="">&nbsp;&nbsp;Reviews recibidas</p>
    </div>
    {{-- ESTRELLAS (CALIFICACIÓN) --}}
    <div href="#" class="review_calificacion">

        {{-- CALIFICACION DEL MÚSICO/CURADOR--}}
        <div class="review_calificacion_item">

            {{-- CALIFICACION --}}
            <div class="p_review p_review_bold" style="margin-right: 5px;">{{ $calificacion }}</div>

            {{-- ESTRELLAS --}}
            @for ($i = 0; $i < 5; $i++)
                @if ($total>=1)
                <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                    @php
                    $total--;  
                    @endphp
                @else 
                    @if ($total<1 && $total>=0.5)
                        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                        @php
                        $total-=$total;  
                        @endphp
                    @else 
                    <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                    @endif
                @endif
            @endfor
        </div>

        {{-- NUMERO DE REVIEWS --}}
        <div class="review_calificacion_item review_calificacion_item_margin">
            <img class="img_review" src="img/iconos/user.png" alt="">
            <div class="p_review">{{ $numReviews }} en total</div>
        </div>
    </div>
</div>
<div class="div_90_o" style="max-width: 1059px;">

    @php
        //contador para identificar los contenidos / sirve para el funcionamiento del boton leer mas
        $contador = 1;
    @endphp

    <div class="reviews_list">
        {{-- !!!!!!!!!!! EN ESTA PARTE MAXIMO DEBEN APARECER 3 REVIEWS !!!!!!!!!!! --}}

        {{-- si el usuario es del tipo musico / si es falso entonces es de curador--}}
        @if($tipo)
            @if (count($reviews) > 0)
                @foreach ($reviews as $review)
                    {{-- REVIEW DEL CURADOR / VISTA DE MÚSICO --}}
                    <div class="review_item">
                        {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
                        <div class="review_img">
                            <img src="{{User::find($review->user_id)->avatar}}" alt="" style="object-fit:cover; border-radius:50%;">
                        </div>

                        {{-- CONTENIDO DE LA REVIEW --}}
                        <div class="review_content">
                            {{-- NOMBRES --}}
                            <div class="review_content_names">
                                {{-- NOMBRE DEL CURADOR --}}
                                <div class="review_content_names_name autor"><a href="{{ route('perfil-curador-publico',$review->playlist->user_id) }}" target="_blank">{{ $review->user->name }}</a></div>
                                {{-- NOMBRE DE CANCION --}}
                                <div class="review_content_names_name">
                                    {{-- conexion con spotify --}}
                                    @php
                                        $access_token=session()->get('access_token');
                                        //Se extrae el id de la canción 
                                        $song_id=trim($review->camp->link_song,);
                                        $song_id=str_replace('https://open.spotify.com/track/','',$song_id);
                                        if(substr($song_id, 0, strpos($song_id, "?"))){
                                            $song_id = substr($song_id, 0, strpos($song_id, "?"));
                                        }
                                        //Se hace la conexión con la api de spotify
                                        $url='https://api.spotify.com/v1/tracks/'.$song_id.'?access_token='.$access_token;
                                        $conexion=curl_init();
                                        curl_setopt($conexion, CURLOPT_URL, $url);
                                        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                                        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                                        $song= curl_exec($conexion);
                                        curl_close($conexion);
                                        $song=json_decode($song);
                                    @endphp
                                    <div class="m_r"><a href="{{ $review->camp->link_song }}" target="_blank">{{Str::limit($song->name, 48)}}</a></div>
                                </div>
                            </div>

                            {{-- CALIFICACION Y FECHA --}}
                            <div class="review_content_sd">
                                {{-- ESTRELLAS --}}
                                <div class="review_content_score m_f">
                                    @php
                                        $total = $review->rating;
                                    @endphp 
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($total>=1)
                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            @php
                                            $total--;  
                                            @endphp
                                        @else 
                                            @if ($total<1 && $total>=0.5)
                                                <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                                                @php
                                                $total-=$total;  
                                                @endphp
                                            @else 
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                                            @endif
                                        @endif
                                    @endfor
                                </div>

                                {{-- FECHA --}}
                                @php
                                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    $fecha = Carbon::parse($review->date);
                                    $mes = $meses[($fecha->format('n')) - 1];
                                @endphp 
                                <div class="review_content_date s_m">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>

                                {{-- ESTATUS --}}
                                <div class="review_content_date s_m"><b>Estatus</b> {{ $review->camp->status }}</div>
                            </div>
                            {{-- REVIEW --}}
                            <div class="review_content_review">
                                @if (strlen($review->comment) < 387)
                                    {{ $review->comment }}
                                @else
                                    {{ substr($review->comment, 0, 387) }}<span id="dots{{$contador}}">...</span><span id="more{{$contador}}" style="display: none;">{{ substr($review->comment, 387) }}</span>
                                    <a href="#" onclick="leermas({{$contador}})" id="leermasbtn{{$contador}}" class="btnLeerMas">leer más</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @php
                        $contador++;    
                    @endphp

                @endforeach
            @else
                <div class="div_error_o">
                    <div class="txt_error_o">No has recibido reviews aún.</div>
                </div>
            @endif
        @else
            @if (count($reviews) > 0)
                @foreach ($reviews as $review)
                    {{-- REVIEW DEL MÚSICO / VISTA DE CURADOR --}}
                    <div class="review_item">
                        {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
                        <div class="review_img">
                            <img src="{{User::find($review->user_id)->avatar}}" alt="" style="object-fit:cover; border-radius:50%;">
                        </div>

                        {{-- CONTENIDO DE LA REVIEW --}}
                        <div class="review_content">
                            {{-- NOMBRES --}}
                            <div class="review_content_names">
                                {{-- NOMBRE DEL CURADOR --}}
                                <div class="review_content_names_name autor"><a href="{{ route('perfil-musico-publico',$review->user_id) }}" target="_blank">{{ $review->user->name }}</a></div>
                                {{-- PLAYLIST --}}
                                <div class="review_content_names_name">
                                    {{-- conexion con spotify --}}
                                    @php
                                        $access_token=session()->get('access_token');
                                        //Se extrae el id de la canción 
                                        $playlist_id=trim($review->playlist->link_playlist,);
                                        $playlist_id=str_replace('https://open.spotify.com/playlist/','',$playlist_id);
                                        if(substr($playlist_id, 0, strpos($playlist_id, "?"))){
                                            $playlist_id = substr($playlist_id, 0, strpos($playlist_id, "?"));
                                        }
                                        //Se hace la conexión con la api de spotify
                                        $url='https://api.spotify.com/v1/playlists/'.$playlist_id.'?access_token='.$access_token;
                                        $conexion=curl_init();
                                        curl_setopt($conexion, CURLOPT_URL, $url);
                                        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                                        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                                        $playlist= curl_exec($conexion);
                                        curl_close($conexion);
                                        $playlist=json_decode($playlist);
                                    @endphp
                                    <div class="m_r"><b>Playlist</b> <a href="{{ $review->playlist->link_playlist }}" target="_blank">{{Str::limit($playlist->name, 48)}}</a></div>
                                </div>
                            </div>
                            {{-- CALIFICACION Y FECHA --}}
                            <div class="review_content_sd">
                                {{-- ESTRELLAS --}}
                                <div class="review_content_score m_f">
                                    @php
                                        $total = $review->rating;
                                    @endphp 
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($total>=1)
                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            @php
                                            $total--;  
                                            @endphp
                                        @else 
                                            @if ($total<1 && $total>=0.5)
                                                <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                                                @php
                                                $total-=$total;  
                                                @endphp
                                            @else 
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                                @php
                                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    $fecha = Carbon::parse($review->date);
                                    $mes = $meses[($fecha->format('n')) - 1];
                                @endphp 
                                <div class="review_content_date s_m">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>
                            </div>
                            {{-- REVIEW --}}
                            <div class="review_content_review">
                                @if (strlen($review->comment) < 387)
                                    {{ $review->comment }}
                                @else
                                    {{ substr($review->comment, 0, 387) }}<span id="dots{{$contador}}">...</span><span id="more{{$contador}}" style="display: none;">{{ substr($review->comment, 387) }}</span>
                                    <a href="#" onclick="leermas({{$contador}})" id="leermasbtn{{$contador}}" class="btnLeerMas">leer más</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @php
                        $contador++;    
                    @endphp

                @endforeach
            @else
                <div class="div_error_o">
                    <div class="txt_error_o">No has recibido reviews aún.</div>
                </div>
            @endif
        @endif
    </div>

    {{-- PAGINACION --}}
    {{ $reviews->links() }}
</div>

<br>
<div class="div_eliminarCuenta" style="display: flex; justify-content:right">
    <div class="div_contbtns">
        <a href="{{route('reviews')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
    </div>
</div>
<br>

<script>
    function leermas(numero) {
        var dots = document.getElementById("dots"+numero);
        var moreText = document.getElementById("more"+numero);
        var btnText = document.getElementById("leermasbtn"+numero);

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "leer mas";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "leer menos";
            moreText.style.display = "inline";
        }
    }

    $('a.btnLeerMas').click(function(e)
    {
        // Special stuff to do when this link is clicked...

        // Cancel the default action
        e.preventDefault();
    });
</script>
@endsection