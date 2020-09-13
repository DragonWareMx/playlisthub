@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Campañas
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src={{asset("img/iconos/plusGris.png")}} alt="">
        <div class="p_title_o">&nbsp;&nbsp;Agregar campaña</div>
    </div>
    <div class="crearCampana_pasos">Paso 2 de 3</div>
    <hr class="hr_100_o">

    <div class="div_content">
        <div class="encabezado_paso_2">
            <div class="txt_izquierda_o">Seleciona la playlist en la que deseas ubicar tu campaña</div>
            <div class="txt_derecha_o">Tokens totales: {{$user->tokens}} </div>
        </div>
        <div class="table_head">
            <div class="img_playlist_o_2" style="margin-bottom:0px"></div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head">CURADOR</div> <div class="txt_row_head"># DE SEGUIDORES</div> 
            <div class="txt_row_head">TOKENS REQUERIDOS</div>
        </div>
        <hr class="hr_100_o" style="margin-top:0px;">
        @foreach ($playlists as $playlist)
        <div id=" {{$playlist['id']}} " class="table_row row_encabezado_paso_2">
            <img class="img_playlist img_playlist_o" src="{{$playlist['image']}}" alt=""> 
            <a href=" {{$playlist['url']}} "  target="_blank" class="txt_row_play a_row_play_o"> {{$playlist['name']}} </a> 
            <div class="txt_row_play"> {{$playlist['curator']}} </div> 
            <div class="txt_row_play"> {{$playlist['followers']}} </div>
            <div class="txt_row_play"> {{$playlist['profits']}} </div>
        </div> 
        @endforeach
        <div class="txt_izquierda_o txt_italic_14" style="margin-top:40px;">Numero de tokens insuficientes <a class="a_comprar_o" href="{{Route('tokens')}}">comprar tokens</a></div>
        <div class="crearCampana_botones botones_margin_subir">
            <a class="a_cancelar_o" href="{{Route('crearCampana1')}}">Regresar</a>
            <a class="a_continuar_o" href="{{Route('crearCampana3')}}">Continuar</a>
        </div>
    </div>
</div>
@endsection