@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
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
@if ($error)
    <div class="div_error_o">
        <form action="{{route('relogin')}}" method="POST">
            @csrf
            <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
            <button type="submit" id="a_error_o" class="inicio-spotybtn">
                <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
            </button>
        </form>
    </div>
@else
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="div_CabeceraApartado reviews-cabecera" style="margin-top:40px">
    <div class="div_tituloApartado" style="width:auto">
        <p><img class="img_ico_title_o" src={{asset("img/iconos/escribir.png")}} alt="">@if($tipo)&nbsp;&nbsp;Realizar review @else&nbsp;&nbsp;Revisar solicitud @endif</p>
    </div>
</div>

<div class="div_90_o" style="max-width: 1059px;">
    

    <form id="form_review" method="post" action="{{Route('storeReview')}}" style="width: 100%">
        @csrf

        <input name="camp_id" value="{{ $camp->id }}" hidden>
        <div class="reviews_list">

            {{-- si el usuario es del tipo musico / si es falso entonces es de curador--}}
            @if($tipo)
                <input name="playlist_id" value="{{ $camp->playlist_id }}" hidden>

                {{-- REVIEW A LA PLAYLIST / VISTA DE MÚSICO --}}
                <div class="review_item">
                    {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
                    <div class="review_img">
                        @if(isset(User::find($camp->playlist->user_id)->avatar))
                            <img src="{{User::find($camp->playlist->user_id)->avatar}}" alt="" style="object-fit:cover; border-radius:50%;">
                        @else
                            <img src="{{ asset('/img/iconos/perfil.png') }}" alt="" style="object-fit:cover; border-radius:50%;">
                        @endif
                    </div>

                    {{-- CONTENIDO DE LA REVIEW --}}
                    <div class="review_content">
                        {{-- NOMBRES --}}
                        <div class="review_content_names">
                            {{-- NOMBRE DEL CURADOR --}}
                            <div class="review_content_names_name autor"><a href="#" target="_blank">{{ $camp->playlist->user->name }}</a></div>
                            {{-- NOMBRE DE CANCION --}}
                            <div class="review_content_names_name">
                                <div class="m_r"><a href="{{route('campana', ['token'=>Str::random(150),'id'=>$camp->id,'index'=>Str::random(150)])}}" style="color: #8177F5;" target="_blank">Ver campaña</a></div>
                            </div>
                        </div>

                        {{-- CALIFICACION Y FECHA --}}
                        <div class="review_content_sd">
                            {{-- ESTRELLAS --}}
                            <div id="half-stars-example" class="d_m">
                                <div class="rating-group" style="display: inline-flex;">
                                    @if (old('rating'))
                                        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio" {{ (old('rating') == 0.5) ? "checked" : "" }}>
                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio" {{ (old('rating') == 1.0) ? "checked" : "" }}>
                                        <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio" {{ (old('rating') == 1.5) ? "checked" : "" }}>
                                        <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio" {{ (old('rating') == 2.0) ? "checked" : "" }}>
                                        <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio" {{ (old('rating') == 2.5) ? "checked" : "" }}>
                                        <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio" {{ (old('rating') == 3.0) ? "checked" : "" }}>
                                        <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio" {{ (old('rating') == 3.5) ? "checked" : "" }}>
                                        <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio" {{ (old('rating') == 4.0) ? "checked" : "" }}>
                                        <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio" {{ (old('rating') == 4.5) ? "checked" : "" }}>
                                        <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio" {{ (old('rating') == 5.0) ? "checked" : "" }}>
                                    @else
                                        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio">
                                        <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio">
                                        <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio" checked>
                                        <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio">
                                        <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio">
                                        <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio">
                                    @endif
                                </div>
                            </div>
                            {{--
                            <div class="review_content_score">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                            </div>
                            --}}
                            {{-- FECHA --}}
                            @php
                                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                $fecha = Carbon::now();
                                $mes = $meses[($fecha->format('n')) - 1];
                            @endphp 
                            <div class="review_content_date s_m">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>
                            {{-- PLAYLIST --}}

                            {{-- conexion con spotify --}}
                            @php
                                $access_token=session()->get('access_token');
                                //Se extrae el id de la canción 
                                $playlist_id=trim($camp->playlist->link_playlist,);
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
                            <div class="review_content_date s_m"><b>Playlist</b> <a href="{{ $camp->playlist->link_playlist }}" target="_blank">{{Str::limit($playlist->name, 48)}}</a></div>
                        </div>

                        {{-- REVIEW --}}
                        <div class="review_content_review" style="margin-bottom: 0px">
                            <textarea id="review" name="review" placeholder="Escribe tu review (150 caracteres como mínimo)" oninput="auto_grow(this)">{{ old('review') }}</textarea>
                            <div id="caracteres_escritos" style="font-size: 12px; font-weight:200">caracteres: 0</div>
                            <div id="msj1" class="msjErro-r1">
                                La review debe tener 150 caracteres como mínimo
                            </div>
                            <div id="msj2" class="msjErro-r2">
                                La review puede tener 3000 caracteres como máximo
                            </div>
                        </div>
                        
                        {{-- REALIZAR REVIEW --}}
                        <div class="div_btnsUpdate" >
                            <div class="div_contbtns btns-R-R" >
                                <a href="javascript:history.back(-1);">Cancelar</a>
                                <a href="javascript:{}" onclick="checkForm()">Enviar</a>
                            </div>
                        </div>

                    </div>
                </div>
            @else
                {{-- SOLICITUD DE CANCIÓN / VISTA DE CURADOR --}}
                <div class="review_item">
                    {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
                    <div class="review_img">
                        @if(isset(User::find($camp->user_id)->avatar))
                            <img src="{{User::find($camp->user_id)->avatar}}" alt="" style="object-fit:cover; border-radius:50%;">
                        @else
                            <img src="{{ asset('/img/iconos/perfil.png') }}" alt="" style="object-fit:cover; border-radius:50%;">
                        @endif
                    </div>

                    {{-- CONTENIDO DE LA REVIEW --}}
                    <div class="review_content">
                        {{-- NOMBRES --}}
                        <div class="review_content_names">
                            {{-- NOMBRE DEL MUSICO --}}
                            <div class="review_content_names_name autor"><a href="#" target="_blank">{{ $camp->user->name }}</a></div>
                                
                            {{-- NOMBRE DE CANCION --}}
                            <div class="review_content_names_name">
                                {{-- conexion con spotify --}}
                                @php
                                    $access_token=session()->get('access_token');
                                    //Se extrae el id de la canción 
                                    $song_id=trim($camp->link_song,);
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
                                <div class="m_r"><a href="{{ $camp->link_song }}" target="_blank" style="color: #8177F5;">{{Str::limit($song->name, 48)}}</a></div>
                            </div>
                        </div>
                        {{-- CALIFICACION Y FECHA --}}
                        <div class="review_content_sd">
                            {{-- ESTRELLAS --}}
                            <div id="half-stars-example" class="d_m">
                                <div class="rating-group" style="display: inline-flex;">
                                    @if (old('rating'))
                                        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio" {{ (old('rating') == 0.5) ? "checked" : "" }}>
                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio" {{ (old('rating') == 1.0) ? "checked" : "" }}>
                                        <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio" {{ (old('rating') == 1.5) ? "checked" : "" }}>
                                        <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio" {{ (old('rating') == 2.0) ? "checked" : "" }}>
                                        <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio" {{ (old('rating') == 2.5) ? "checked" : "" }}>
                                        <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio" {{ (old('rating') == 3.0) ? "checked" : "" }}>
                                        <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio" {{ (old('rating') == 3.5) ? "checked" : "" }}>
                                        <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio" {{ (old('rating') == 4.0) ? "checked" : "" }}>
                                        <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio" {{ (old('rating') == 4.5) ? "checked" : "" }}>
                                        <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio" {{ (old('rating') == 5.0) ? "checked" : "" }}>
                                    @else
                                        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio">
                                        <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio">
                                        <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio" checked>
                                        <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio">
                                        <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio">
                                        <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio">
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="review_content_score">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                                <img src="/img/iconos/op.png" alt="">
                            </div> --}}

                            {{-- FECHA --}}
                            @php
                                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                $fecha = Carbon::parse($camp->start_date);
                                $mes = $meses[($fecha->format('n')) - 1];
                            @endphp 
                            <div class="review_content_date s_m"><b>Fecha de solicitud</b> {{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>

                            {{-- PLAYLIST --}}

                            {{-- conexion con spotify --}}
                            @php
                                $access_token=session()->get('access_token');
                                //Se extrae el id de la canción 
                                $playlist_id=trim($camp->playlist->link_playlist,);
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
                            <div class="review_content_date s_m"><b>Playlist solicitada</b> <a href="{{ $camp->playlist->link_playlist }}" target="_blank">{{Str::limit($playlist->name, 48)}}</a></div>
                            <div class="review_content_date s_m"><b>Tokens</b> {{ $camp->cost }}</div>
                        </div>

                        {{-- ARTISTA --}}
                        <div class="review_content_artista">
                            <p><b>ARTISTA</b></p>
                            <p>{{$song->artists[0]->name}}</p>
                            <p><b>LINK DEL ARTISTA</b></p>
                            <a href="https://open.spotify.com/artist/{{$song->artists[0]->id}}" target="blank">https://open.spotify.com/artist/{{$song->artists[0]->id}}</a>
                        </div>

                        {{-- ESTATUS --}}
                        <div class="review_content_buttons_ar">
                            @if (old('estatus'))
                                <input type="radio" class="radio" name="estatus" value="true" id="true" {{ (old('estatus') == "true") ? "checked=\"checked\"" : "" }}/>
                                <label for="true">Aceptar</label>
                                <input type="radio" class="radio" name="estatus" value="false" id="false" {{ (old('estatus') == "false") ? "checked=\"checked\"" : "" }}/>
                                <label for="false">Rechazar</label>
                            @else
                                <input type="radio" class="radio" name="estatus" value="true" id="true" checked="checked"/>
                                <label for="true">Aceptar</label>
                                <input type="radio" class="radio" name="estatus" value="false" id="false" />
                                <label for="false">Rechazar</label>
                            @endif
                        </div>

                        {{-- REVIEW --}}
                        <div class="review_content_review" style="margin-bottom: 0px;" >
                            <textarea id="review" name="review" placeholder="Escribe tu review (150 caracteres como mínimo)" oninput="auto_grow(this)" onchange="caracteres(this)">{{ old('review') }}</textarea>
                            <div id="caracteres_escritos" style="font-size: 12px; font-weight:200">caracteres: 0</div>
                            <div id="msj1" class="msjErro-r1">
                                La review debe tener 150 caracteres como mínimo
                            </div>
                            <div id="msj2" class="msjErro-r2">
                                La review puede tener 3000 caracteres como máximo
                            </div>
                        </div>
                        
                        {{-- REALIZAR REVIEW --}}
                        
                        <div class="div_btnsUpdate" >
                            <div class="div_contbtns btns-R-R" >
                                <a href="javascript:history.back(-1);">Cancelar</a>
                                <a href="javascript:{}" onclick="checkForm()">Enviar</a> 
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </form>
</div>

<script>
    function caracteres(){
    }

    function checkForm() {

        //VERIFICA QUE EL COMENTARIO CUMPLA CON LA LONGITUD MINIMA Y MAXIMA
        var minLength = 150;
        var maxLength = 3000;
        var msj1= document.getElementById('msj1');
        var msj2= document.getElementById('msj2');

        var textarea = document.getElementById('review');

        if(textarea.value.length < minLength) {
            msj2.style.display = 'none';
            msj1.style.display = 'block';
            // alert('La review debe tener ' + minLength + ' caracteres como mínimo.');
            return false;
        }
        else if(textarea.value.length > maxLength){
            msj1.style.display = 'none';
            msj2.style.display = 'block';
            // alert('La review puede tener ' + maxLength + ' caracteres como máximo.');
            return false;
        }

        document.getElementById('form_review').submit();
    }

    function auto_grow(element) {
        if(element.scrollHeight > 66){
            element.style.height = "66px";
            element.style.height = (element.scrollHeight+2)+"px";
        }

        document.getElementById('caracteres_escritos').innerHTML = "caracteres: "+element.value.length;
    }
</script>
@endif
@endsection