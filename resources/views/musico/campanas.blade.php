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
            <div class="img_item_campana_o" style="background-image:url('https://i.scdn.co/image/ab67706c0000bebb8d0ce13d55f634e290f744ba');
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
        </div>
        <div class="div_item_campana_o">
            
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