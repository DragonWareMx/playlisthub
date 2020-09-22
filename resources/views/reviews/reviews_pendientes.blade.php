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
    use Illuminate\Support\Facades\Crypt;
@endphp
<div class="div_CabeceraApartado reviews-cabecera" style="margin-top:40px">
    <div class="div_tituloApartado" style="width:auto">
        <p><img class="img_ico_title_o" src={{asset("img/iconos/pendiente.png")}} alt="">@if($tipo)&nbsp;&nbsp;Reviews pendientes @else&nbsp;&nbsp;Solicitudes pendientes @endif</p>
    </div>
</div>
<div class="div_90_o" style="max-width: 1059px;">

    <div class="reviews_list">
        {{-- si el usuario es del tipo musico / si es falso entonces es de curador--}}
        @if($tipo)
            @if (count($camps) > 0)
                @foreach ($camps as $camp)
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
                                    <div class="m_r"><a href="{{ $camp->link_song }}" target="_blank">{{Str::limit($song->name, 48)}}</a></div>
                                </div>
                            </div>
                            {{-- CALIFICACION Y FECHA --}}
                            <div class="review_content_sd r_p">
                                {{-- ESTRELLAS --}}
                                <div class="review_content_score">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                </div>

                                {{-- FECHA --}}
                                @php
                                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    $fecha = Carbon::parse($camp->start_date);
                                    $mes = $meses[($fecha->format('n')) - 1];
                                @endphp 
                                <div class="review_content_date">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>

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
                                <div class="review_content_date"><b>Playlist</b> <a href="{{ $camp->playlist->link_playlist }}" target="_blank">{{Str::limit($playlist->name, 48)}}</a></div>
                            </div>

                            {{-- REVIEW --}}
                            <div class="review_content_review r_p" style="margin-bottom: 0px">
                                Sin calificar
                            </div>

                            {{-- REALIZAR REVIEW --}}
                            <div class="review_content_realizar_r_div">
                                @php
                                    $id= Crypt::encrypt($camp->id);
                                @endphp
                                <a href="{{ route('realizarReview',[$id]) }}" class="review_content_realizar_r">
                                    Realizar review
                                </a>
                            </div>

                            
                        </div>
                    </div>
                @endforeach
            @else
                <div class="div_error_o">
                    <div class="txt_error_o">No tienes reviews pendientes.</div>
                </div>
            @endif
        @else
            @if (count($camps) > 0)
                @foreach ($camps as $camp)
                    {{-- SOLICITUD DE CANCIÓN / VISTA DE CURADOR --}}
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
                                    <div class="m_r"><a href="{{ $camp->link_song }}" target="_blank">{{Str::limit($song->name, 48)}}</a></div>
                                </div>
                            </div>
                            {{-- CALIFICACION Y FECHA --}}
                            <div class="review_content_sd r_p">
                                {{-- ESTRELLAS --}}
                                <div class="review_content_score">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                    <img src="img/iconos/op.png" alt="">
                                </div>
                                {{-- FECHA --}}
                                @php
                                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    $fecha = Carbon::parse($camp->start_date);
                                    $mes = $meses[($fecha->format('n')) - 1];
                                @endphp 
                                <div class="review_content_date">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>

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
                                <div class="review_content_date"><b>Playlist solicitada</b> <a href="{{ $camp->playlist->link_playlist }}" target="_blank">{{Str::limit($playlist->name, 48)}}</a></div>

                                {{-- TOKENS --}}
                                <div class="review_content_date"><b>Tokens</b> {{ $camp->cost }}</div>
                            </div>

                            {{-- REVIEW --}}
                            <div class="review_content_review r_p" style="margin-bottom: 0px">
                                Sin respuesta
                            </div>

                            {{-- REALIZAR REVIEW --}}
                            <div class="review_content_realizar_r_div">
                                @php
                                    $id= Crypt::encrypt($camp->id);
                                @endphp
                                <a href="{{ route('realizarReview',[$id]) }}" class="review_content_realizar_r" >
                                    Revisar solicitud
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="div_error_o">
                    <div class="txt_error_o">No tienes reviews pendientes.</div>
                </div>
            @endif
        @endif
    </div>
</div>

<br>
<div class="div_eliminarCuenta" style="display: flex; justify-content:right">
    <div class="div_contbtns">
        <a href="{{route('reviews')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
    </div>
</div>
<br>
@endsection