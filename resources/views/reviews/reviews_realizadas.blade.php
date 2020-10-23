@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
    <link rel="stylesheet" type="text/css" href="/css/Reviews.css">
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
@if ($error)
    <div class="div_error_o">
        <form action="{{route('relogin')}}" method="POST">
            @csrf
            <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
            <button type="submit" id="a_error_o" class="inicio-spotybtn">
                <img src="{{ asset('img/iconos/sp white.png') }}">   
            </button>
        </form>
    </div>
@else
<div class="div_CabeceraApartado reviews-cabecera" style="margin-top:40px">
    <div class="div_tituloApartado" style="width:auto">
        <p><img class="img_ico_title_o" src={{asset("img/iconos/overtime.png")}} alt="">&nbsp;&nbsp;Reviews realizadas</p>
    </div>
    {{-- ESTRELLAS (CALIFICACIÓN) --}}
    <div href="#" class="review_calificacion">
        {{-- PENDIENTES(MUSICO)/SOLICITUDES(CURADOR) --}}
        <div class="review_calificacion_item" style="margin-top: 8px">
            <a href="{{Route('reviewsPendientes')}}">@if($tipo)Pendientes @else Solicitudes @endif</a>
        </div>

        {{-- NUMERO DE REVIEWS --}}
        <div class="review_calificacion_item review_calificacion_item_margin">
            <img class="img_review" src="img/iconos/user.png" alt="">
            <div class="p_review">{{ $nrealizadas }} en total</div>
        </div>
    </div> 
</div>

<div class="div_90_o" style="max-width: 1059px;">

    

    <div class="reviews_list">
        {{-- !!!!!!!!!!! EN ESTA PARTE MAXIMO DEBEN APARECER 3 REVIEWS !!!!!!!!!!! --}}

        @php
            //contador para identificar los contenidos / sirve para el funcionamiento del boton leer mas
            $contador = 1;
            $contadorReal = 1;
            $realizadasSongs = array();
        @endphp

        {{-- si el usuario es del tipo musico / si es falso entonces es de curador--}}
        @if($tipo)
            @if (count($realizadas) > 0)
                @foreach ($realizadas as $review)
                    {{-- REVIEW A LA PLAYLIST / VISTA DE MÚSICO --}}
                    <div class="review_item">
                        {{-- CONTENIDO DE LA REVIEW --}}
                        <div class="review_content">
                            {{-- NOMBRES --}}
                            <div class="review_content_names">
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
                            <div class="review_content_sd r_p">
                                {{-- ESTRELLAS --}}
                                <div class="review_content_score">
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
                                <div class="review_content_date">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>

                                {{-- PLAYLIST --}}

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
                                <div class="review_content_date"><b>Playlist</b> <a href="{{ $review->playlist->link_playlist }}" target="_blank">{{Str::limit($playlist->name, 48)}}</a></div>
                            </div>
                            {{-- REVIEW --}}
                            <div class="review_content_review r_p">
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
                        $contadorReal++; 
                    @endphp
                    
                @endforeach
            @else
                <div class="div_error_o">
                    <div class="txt_error_o">No has realizado reviews aún.</div>
                </div>
            @endif
        @else
            @if (count($realizadas) > 0)
                @foreach ($realizadas as $review)
                    {{-- REVIEW A LA CANCIÓN / VISTA DE CURADOR --}}
                    <div class="review_item">
                        {{-- CONTENIDO DE LA REVIEW --}}
                        <div class="review_content">
                            {{-- NOMBRES --}}
                            <div class="review_content_names">
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

                                        $array = array( 'id' => $review->camp->link_song,
                                                        'name' => $song->name,
                                                        'artist' => $song->artists[0]);

                                        array_push($realizadasSongs, $array);
                                    @endphp
                                    <div class="m_r"><a href="{{ $review->camp->link_song }}" target="_blank">{{Str::limit($song->name, 48)}}</a></div>
                                </div>
                            </div>
                            {{-- CALIFICACION Y FECHA --}}
                            <div class="review_content_sd r_p">
                                {{-- ESTRELLAS --}}
                                <div class="review_content_score">
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
                                <div class="review_content_date">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>
                                {{-- ESTATUS --}}
                                <div class="review_content_date"><b>Estatus</b> {{ $review->camp->status }}</div>
                            </div>
                            {{-- REVIEW --}}
                            <div class="review_content_review r_p">
                                @if (strlen($review->comment) < 387)
                                    {{ $review->comment }}
                                @else
                                    {{ substr($review->comment, 0, 387) }}<span id="dots{{$contador}}">...</span><span id="more{{$contador}}" style="display: none;">{{ substr($review->comment, 387) }}</span>
                                    <a href="#" onclick="leermas({{$contador}})" id="leermasbtn{{$contador}}" class="btnLeerMas">leer más</a>
                                @endif
                            </div>

                            <a href="#" id="btnModal" onclick="compartir({{$review->id}})" class="btnLeerMas" style="float: right; font-size: 15px; margin-right:13px;margin-bottom:8px">Compartir</a>
                        </div>
                    </div>

                    @php
                        $contador++;
                        $contadorReal++;   
                    @endphp

                @endforeach
            @else
                <div class="div_error_o">
                    <div class="txt_error_o">No has realizado reviews aún.</div>
                </div>
            @endif
        @endif
    </div>

    {{-- PAGINACION --}}
    {{ $realizadas->links() }}
</div>

<br>
<div class="div_eliminarCuenta" style="display: flex; justify-content:right">
    <div class="div_contbtns">
        <a href="{{route('reviews')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
    </div>
</div>
<br>

<!-- Modal -->
<div id="tvesModal" class="modalContainer" style="z-index: 999">
    <div class="modal-content" style="height: fit-content; max-width: 648px;">
        <div class="modal_title_tokens" >Compartir review</div>
        <hr class="hr_modal_o"> 
        <div class="modal_compartir">
                <img class="modal_compartir_facebook" src="img/iconos/facebook png.png" onclick="compartir_facebook()">
            <img src="img/iconos/twt png.png" onclick="compartir_twitter()">
        </div>
        <div class="div_tokens_botones">
            <a class="a_cancelarTokens close" style="color: #8177F5 !important;">Cancelar</a>
        </div>
    </div>
</div>

<script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '2883649638525553',
        xfbml      : true,
        version    : 'v3.2'
      });
      FB.AppEvents.logPageView();
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/es_LA/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>

<script type="text/javascript">
    var realizadas = @json($realizadas);
    var songs = @json($realizadasSongs);
    var song = null;
    var review = null;

    var modal = document.getElementById("tvesModal");
    var span = document.getElementsByClassName("close")[0];
    var body = document.getElementsByTagName("body")[0];

    $( document ).ready(function() {

        span.onclick = function() {
            modal.style.display = "none";

            body.style.position = "inherit";
            body.style.height = "auto";
            body.style.overflow = "visible";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";

                body.style.position = "inherit";
                body.style.height = "auto";
                body.style.overflow = "visible";
            }
        }
    });


    //obtiene los datos del review en base al id
    function getReview(id){
        var reviewG;

        realizadas.data.forEach(reviewReal => {
            if(reviewReal["id"] == id){
                reviewG = reviewReal;
                return false
            }
            else return true
        });

        return reviewG;
    }

    //obtiene los datos de la cancion en base al id
    function getSong(id){
        var songG;

        songs.forEach(songR => {
            if(songR["id"] == id){
                songG = songR;
                return false
            }
            else return true
        });

        return songG;
    }

    //boton compartir de cada review
    function compartir(id) {
        modal.style.display = "block";

        body.style.position = "static";
        body.style.height = "100%";
        body.style.overflow = "hidden";

        review = getReview(id);
        song = getSong(review["camp"]["link_song"]);
    }

    function compartir_facebook() {
        if(review != null && song != null){
            FB.ui(
                {
                    method: 'share',
                    href: 'https://playlisthub.io/',
                    hashtag: '#playlisthub',
                    quote: 'Califiqué a la canción "'+ song["name"] +'" de "'+ song["artist"]["name"] +'" con '+ review["rating"] +'/5.0 estrellas. Te recomiendo escucharla en: '+ song["id"]+'\n ¡Visita playlisthub para ganar dinero con tus playlists!',
                },
                // Si quieres que salga una alerta
                function(response) {
                    review = null;
                    song = null;
                }
            );
        }
    }

    function compartir_twitter(){
        var url = "https://playlisthub.io/";
        var text = 'Califiqué a la canción "'+ truncate(song["name"]) +'" de "'+ truncate(song["artist"]["name"]) +'" con '+ review["rating"] +'/5.0 estrellas. Te recomiendo escucharla en: '+ song["id"]+'\n ¡Visita #PlaylistHub para ganar dinero con tus playlists! \n';
        window.open('https://twitter.com/share?url='+encodeURIComponent(url)+'&text='+encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
 
    }

    function truncate(input) {
        if (input.length > 34) {
            return input.substring(0, 34) + '...';
        }
        return input;
    }
</script>

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
@endif
@endsection