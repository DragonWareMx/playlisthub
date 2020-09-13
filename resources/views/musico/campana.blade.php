@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
@endsection

@section('menu')
    Campañas
@endsection

@section('contenido')
    @if (!$error)
        <div class="div_90_o">
            <div class="ico_title_o">
                <a style="margin-top:-3px;" href="{{route('campanas')}}"><img class="img_ico_title_o" src={{asset("img/iconos/regresar.png")}} alt=""></a>
                <div class="p_title_o">&nbsp;&nbsp;Campaña "{{$song->name}}"</div>
            </div>
            <hr class="hr_100_o">
            <div class="div_campana_info_o">
                <div class="campana_info_0">
                    <img class="campana_info_3_img" src="{{$song->album->images[0]->url}}" alt="">
                </div>
                <div class="campana_info_1">
                    <div class="vercampana_title_o">NOMBRE DE LA CANCION</div>
                    <div class="vercampana_txt_o">{{$song->name}}</div>
                    <div class="vercampana_title_o">LINK DE SPOTIFY</div>
                    <a href="{{$camp->link_song}}" target="_blank" class="vercampana_a_o">{{Str::limit($camp->link_song, 25)}}</a>
                    <div class="vercampana_title_o">NOMBRE DEL ARTISTA</div>
                    <div class="vercampana_txt_o">{{$song->artists[0]->name}}</div>
                    <div class="vercampana_title_o">FECHA DE INICIO</div>
                    <div class="vercampana_txt_o">
                        @php
                            $separa=explode("-",$camp->start_date);
                            $anio=$separa[0];
                            $mes=$separa[1];
                            $dia=$separa[2];
                        @endphp
                        {{$dia}}&nbsp;-
                        @switch($mes)
                            @case('01')Enero @break
                            @case('02')Febrero @break
                            @case('03') Marzo @break
                            @case('04')Abril @break
                            @case('05')Mayo @break
                            @case('06')Junio @break
                            @case('07')Julio @break
                            @case('08')Agosto @break
                            @case('09')Septiembre @break
                            @case('10')Octubre @break
                            @case('11')Noviembre @break
                            @case('12')Diciembre @break
                        @endswitch-
                        {{$anio}}
                    </div>
                </div>
                <div class="campana_info_2">
                    <div class="vercampana_title_o">GÉNERO</div>
                    <div class="vercampana_txt_o">{{$camp->genre}}</div>
                    <div class="vercampana_title_o">TOKENS</div>
                    <div class="vercampana_txt_o">{{$camp->cost}}</div>
                    <div class="vercampana_title_o">NOMBRE DE LA PLAYLIST</div>
                    <div class="vercampana_txt_o">{{$playlist->name}}</div>
                    <div class="vercampana_title_o">NOMBRE DEL CURADOR</div>
                    <a class="vercampana_a_o" href="#"></a>
                    <div class="vercampana_title_o">FECHA DE TERMINO</div>
                    <div class="vercampana_txt_o">
                        @if ($camp->end_date)
                            @php
                                $separa=explode("-",$camp->start_date);
                                $anio=$separa[0];
                                $mes=$separa[1];
                                $dia=$separa[2];
                            @endphp
                            {{$dia}}&nbsp;-
                            @switch($mes)
                                @case('01')Enero @break
                                @case('02')Febrero @break
                                @case('03') Marzo @break
                                @case('04')Abril @break
                                @case('05')Mayo @break
                                @case('06')Junio @break
                                @case('07')Julio @break
                                @case('08')Agosto @break
                                @case('09')Septiembre @break
                                @case('10')Octubre @break
                                @case('11')Noviembre @break
                                @case('12')Diciembre @break
                            @endswitch-
                            {{$anio}}
                        @else
                            Por determinar
                        @endif
                    </div>
                </div>
                <div class="campana_info_3">
                    <img class="campana_info_3_img" src="{{$song->album->images[0]->url}}" alt="">
                </div>
                @if ($camp->status=='espera')
                    <div class="campana_estatus_o">
                        <div class="campana_info_3_status">
                            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>   
                            <div class="vercampana_txt_status">En espera de revisión</div>
                        </div>
                    </div>
                @endif
                @if ($camp->status=='aceptado' && $camp->end_date<$hoy)
                    <div class="campana_estatus_o">
                        <a class="campana_estatus_renovar_o campana_info_3_status" href="#">Renovar</a>
                    </div>
                @endif
                @if ($camp->status=='aceptado' && $camp->end_date>=$hoy)
                    <div class="campana_estatus_o">
                        <div class="campana_info_3_status">
                            <div class="vercampana_txt_status">En curso</div>
                        </div>
                    </div>
                @endif
                @if ($camp->status=='rechazado')
                    <div class="campana_estatus_o">
                        <a class="campana_estatus_renovar_o campana_info_3_status" href="#">Renovar</a>
                    </div>
                @endif
            </div>
        </div>
    @else 
        <div class="div_error_o">
            <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
            <a href="http://127.0.0.1:8000/login/spotify" id="a_error_o" class="inicio-spotybtn">
                <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
            </a>
        </div>
    @endif
@endsection