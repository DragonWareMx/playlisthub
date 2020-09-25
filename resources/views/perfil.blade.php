@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Perfil 
@endsection

@section('contenido') 
@php
    use Carbon\Carbon;
    use App\User;
@endphp

@if (!$error)
        <div class="div_CabeceraApartado">
            <div class="div_tituloApartado">
                <p><i class="fas fa-user-circle" style="color:#5C5C5C"></i>&nbsp;&nbsp;Datos generales</p>
            </div>
        <a href="{{route('administrar-cuenta')}}" style="color: #8177F5"><i class="fas fa-cog"></i>&nbsp;&nbsp;Administrar tu cuenta</a>
        </div>
        @foreach ($usuario as $user)
            <div class="div_infoPerfilM">
                <div class="div_fotoPerfilM">
                    <img src="{{$user->avatar}}">
                </div>
                <div class="div_txtPM"> 
                    <p class="txt-infoNombrePM">{{ $user -> name }}</p>
                    @if($user->type=='Músico')
                        <p class="txt-infoUserP">Músico</p>
                    @else
                        <p class="txt-infoUserP">Curador</p>
                    @endif
                    <p class="txt-informacionP">{{ $user -> country }}</p>   
                    <p class="txt-informacionP">Miembro desde el&nbsp;{{ \Carbon\Carbon::parse($user->created_at)->format('Y')}}</p>
                </div>
            </div>
            @if($user->type=='Músico')
                {{-- APARTADO MÚSICO --}}
                {{-- CAMPAÑAS --}}
                <div class="div_CabeceraApartado" style="margin-top:40px">
                    <div class="div_tituloApartado resize_tituloApartado">
                        <p><img class="img_ico_title_o" src="img/iconos/campanas.png" alt="">&nbsp;&nbsp;Campañas actuales</p>
                    </div>
                    <a href="{{route('crearCampana1')}}" class="resize-btn-agregar"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
                </div>

                <div class="div_90_o">
                    @if (sizeOf($campsAct)>0)
                        <div class="div_campanas_actuales_o">
                            @php
                                $i=0;
                            @endphp
                            @foreach ($campsAct as $camp)
                                <div class="div_item_campana_o">
                                    <div class="img_item_campana_o" style="background-image:url('{{$playlistsAct[$i]->images[0]->url}}');
                                        background-size: contain;
                                        -moz-background-size: cover;
                                        -o-background-size: cover;
                                        -webkit-background-size: cover;">
                                        <div class="campanas_encabezado_cancion_o">
                                            {{Str::limit($songsAct[$i]->name, 39)}}
                                        </div>
                                        <div class="campanas_encabezado_artista_o">
                                            {{Str::limit($songsAct[$i]->artists[0]->name, 39)}}
                                        </div>
                                        <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
                                    </div>
                                    <div class="background_o"></div>
                                    <div class="campana_title_o">TOKENS</div>
                                    <div class="campana_text_o">{{$camp->cost}}</div>
                                    <div class="campana_title_o">PLAYLIST</div>
                                    <div class="campana_text_o">{{Str::limit($playlistsAct[$i]->name, 45)}}</div>
                                    <div class="campana_title_o">FECHA DE TÉRMINO</div>
                                    @if ($camp->end_date)
                                        @php
                                            $separa=explode("-",$camp->end_date);
                                            $anio=$separa[0];
                                            $mes=$separa[1];
                                            $dia=$separa[2];
                                        @endphp
                                        <div class="campana_text_o">
                                            {{$dia}}&nbsp;-
                                            @switch($mes)
                                                @case('01')
                                                    Enero
                                                    @break
                                                @case('02')
                                                    Febrero
                                                    @break
                                                @case('03')
                                                    Marzo
                                                    @break
                                                @case('04')
                                                    Abril
                                                    @break
                                                @case('05')
                                                    Mayo
                                                    @break
                                                @case('06')
                                                    Junio
                                                    @break
                                                @case('07')
                                                    Julio
                                                    @break
                                                @case('08')
                                                    Agosto
                                                    @break
                                                @case('09')
                                                    Septiembre
                                                    @break
                                                @case('10')
                                                    Octubre
                                                    @break
                                                @case('11')
                                                    Noviembre
                                                    @break
                                                @case('12')
                                                    Diciembre
                                                    @break
                                            @endswitch-
                                            {{$anio}}
                                        </div>
                                    @else
                                        <div class="campana_text_o">Por determinar</div>
                                    @endif
                                    <a class="a_campana_o" href="{{route('campana', ['token'=>Str::random(150),'id'=>$camp->id,'index'=>Str::random(150)])}}">Más info.</a>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                        <a class="a_derecha_o" href="{{Route('campanasActuales')}}">Ver más</a>
                    @else 
                        <div class="div_error_o">
                            <div class="txt_error_o">No tienes campañas actuales.</div>
                        </div>
                    @endif
                </div>
            @else
            
            {{-- APARTADO CURADOR --}}
            {{-- PLAYLISTS --}}
            <div class="div_CabeceraApartado" style="margin-top:40px">
                <div class="div_tituloApartado resize_tituloApartado">
                    <p><img class="img_ico_title_o" src="img/iconos/playlist.png" alt="">&nbsp;&nbsp;Playlist activas</p>
                </div>
                <a href="{{route('playlists')}}" class="resize-btn-agregar" ><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
            </div>
            <div class="div_90_o">
                <!--tabla playlists-->
                <div class="div_content_o">
                    <div class="table_head_o">
                        <div class="img_playlist_o_2" style="margin-bottom:0px"></div>
                        <div class="txt_row_head_o">NOMBRE DE LA PLAYLIST</div>
                        <div class="txt_row_responsive">PLAYLIST</div> 
                        <div class="txt_row_head_o">RANKING</div>
                        <div class="txt_row_responsive">RANKING</div> 
                        <div class="txt_row_head_o">NIVEL</div>
                        <div class="txt_row_responsive">NIVEL</div> 
                        <div class="txt_row_head_o">SEGUIDORES</div>
                        <div class="txt_row_responsive">SEGUIDORES</div> 
                        {{-- <div class="txt_row_head_o">GANANCIAS</div>
                        <div class="txt_row_responsive">GANANCIAS</div>  --}}
                    </div>
                
                <!--estos divs se crean con un foreach-->
                @php
                    $i=0;
                @endphp
                @foreach ($playlists_registradas as $playlist)
                <hr class="hr_100_o">
                    <div id="{{$playlist->id}}" class="table_row_o table_noBorder">
                        <img class="img_playlist_o" src="{{$playlist->images[0]->url}}" alt=""> 
                        <p class="p_responsivep">PLAYLIST</p>
                        <a href=" # "  target="_blank" class="txt_row_play_o a_row_play_o"> {{$playlist->name}} </a> 
                        <p class="p_responsivep">RANKING</p>
                        <div class="txt_row_play_o">{{$playlists_bd[$i]->tier}}</div> 
                        <p class="p_responsivep">NIVEL</p>
                        <div class="txt_row_play_o">
                            @php
                               if($playlist->followers->total<=5000) $nivel=1;
                               if($playlist->followers->total>5000 && $playlist->followers->total<=15000) $nivel=2;
                               if($playlist->followers->total>15000 && $playlist->followers->total<=20000) $nivel=3;
                               if($playlist->followers->total>20000 && $playlist->followers->total<=30000) $nivel=4;
                               if($playlist->followers->total>30000 && $playlist->followers->total<=50000) $nivel=5;
                               if($playlist->followers->total>50000 && $playlist->followers->total<=60000) $nivel=6;
                               if($playlist->followers->total>60000 && $playlist->followers->total<=70000) $nivel=7;
                               if($playlist->followers->total>70000 && $playlist->followers->total<=80000) $nivel=8;
                               if($playlist->followers->total>80000 && $playlist->followers->total<=90000) $nivel=9;
                               if($playlist->followers->total>90000) $nivel=10;
                            @endphp
                            nivel {{$nivel}}
                        </div>
                        <p class="p_responsivep">SEGUIDORES</p>
                        <div class="txt_row_play_o">{{$playlist->followers->total}}</div> 
                    </div>
                @php
                    $i++;
                @endphp
                @endforeach
                
                </div>
            </div>


            @endif
            @endforeach
            {{-- REVIEWS --}}
            <div class="div_CabeceraApartado reviews-cabecera" style="margin-top:40px">
                <div class="div_tituloApartado" style="width:auto">
                    <p><img class="img_ico_title_o" src={{asset("img/iconos/reviews.png")}} alt="">&nbsp;&nbsp;Reviews recibidas</p>
                </div>
                {{-- ESTRELLAS (CALIFICACIÓN) --}}
                <div href="#" class="review_calificacion" style="margin-bottom: 8px">
            
                    {{-- CALIFICACION DEL MÚSICO/CURADOR--}}
                    <div class="review_calificacion_item">
            
                        {{-- CALIFICACION --}}
                        <div class="p_review p_review_bold" style="margin-right: 5px;">{{ $calificacion }}</div>
                        
                        {{-- ESTRELLAS --}}
                        @php
                            $total = $calificacion;
                        @endphp 
                        <div class="review_content_score">
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
                    </div>
            
                    {{-- NUMERO DE REVIEWS --}}
                    <div class="review_calificacion_item review_calificacion_item_margin">
                        <img class="img_review" src="img/iconos/user.png" alt="">
                        <div class="p_review">{{ $numReviews }} en total</div>
                    </div>
                </div>
                {{-- <a style="border:none; background-color:transparent"><b>Paso 1 de 3</b></a> --}}
            </div>


            <div class="div_90_o" style="max-width: 1059px;" >
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
                                            <div class="review_content_names_name autor"><a href="#">{{ $review->user->name }}</a></div>
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
            
                                @if ($contador == 4)
                                    @php
                                        if (isset($reviews[3])) {
                                            $contador++;
                                        }
                                        break;
                                    @endphp
                                @endif
            
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
                                            <div class="review_content_names_name autor"><a href="#">{{ $review->user->name }}</a></div>
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
            
                                @if ($contador == 4)
                                    @php
                                        if (isset($reviews[3])) {
                                            $contador++;
                                        }
                                        break;
                                    @endphp
                                @endif
            
                            @endforeach
                        @else
                            <div class="div_error_o">
                                <div class="txt_error_o">No has recibido reviews aún.</div>
                            </div>
                        @endif
                    @endif
                </div>
            
                {{-- VER MÁS --}}
                @if ($contador > 4)
                    <div style="width:100%; margin-top:21px;">
                        <a class="a_derecha_o" style="width: fit-content; float: right;" href="{{ route('reviewsRec') }}">Ver más</a>
                    </div>
                @endif
            
            </div>





        
@else
    <div class="div_error_o">
        <form action="{{route('relogin')}}" method="POST">
            @csrf
            <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
            <button type="submit" id="a_error_o" class="inicio-spotybtn">
                <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
            </button>
        </form>
    </div>
@endif
<script>
    function leermas(numero) {
        var dots = document.getElementById("dots"+numero);
        var moreText = document.getElementById("more"+numero);
        var btnText = document.getElementById("leermasbtn"+numero);

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "leer más";
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