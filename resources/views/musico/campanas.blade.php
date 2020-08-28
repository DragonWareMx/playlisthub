@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
@endsection

@section('menu')
    Campañas
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/campanas.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Campañas actuales</div>
    </div>
    <a href="#" class="a_agregar_o">
        <img class="img_a_agregar_o" src="img/iconos/plus.png" alt="">
        <div class="txt_a_o">Agregar</div>
    </a>
    <hr class="hr_100_o">
    <div class="div_campanas_actuales_o">
        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://i.scdn.co/image/ab67706c0000bebbe896b6f341992e1a041b7944');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
        </div>
        <div class="div_item_campana_o">
            
        </div>
        <div class="div_item_campana_o">
            
        </div>
        <div class="div_item_campana_o">
            
        </div>
        <div class="div_item_campana_o">
            
        </div>
    </div>
    <div style="margin-top:30px;"class="ico_title_o">
        <img class="img_ico_title_o" src="img/iconos/overtime.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Campañas antiguas</div>
    </div>
    <hr class="hr_100_o">
    <div class="div_campanas_actuales_o">
        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://i.scdn.co/image/ab67706c0000bebbdedd7de8deb4404798109985');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
            <a class="a_campana_o" href="#">Renovar</a>
        </div>

        <div class="div_item_campana_o">
            
        </div>
        <div class="div_item_campana_o">
            
        </div>
        <div class="div_item_campana_o">
            
        </div>
        <div class="div_item_campana_o">
            
        </div>
    </div>
</div>
@endsection