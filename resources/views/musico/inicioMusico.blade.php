@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
@endsection

@section('menu')
    Inicio
@endsection 

@section('contenido')
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error) 
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (!$error)
        <div class="div_CabeceraApartado" style="margin-top:40px">
            <div class="div_tituloApartado resize_tituloApartado">
                <p><img class="img_ico_title_o" src="img/iconos/tokens.png" alt="">&nbsp;&nbsp;Tus Tokens</p>
            </div>
            <a href="{{route('tokens')}}" class="resize-btn-agregar"><i class="fas fa-plus"></i>&nbsp;&nbsp;Comprar</a>
        </div>
        <div class="div_90_o">
            @foreach ($usuario as $user)
            <div class="div_tokens_o"> {{$user->tokens}}&nbsp;tokens</div>
            @endforeach 
        </div>

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
                            <div class="campana_text_o"><a href="#" style="color: #5C5C5C" target="blank">{{Str::limit($playlistsAct[$i]->name, 45)}}</a></div>
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

@endsection