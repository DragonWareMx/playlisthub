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
            <div class="txt_derecha_o">Tokens totales: 2</div>
        </div>
        <div class="table_head">
            <div class="img_playlist"></div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head">CURADOR</div> <div class="txt_row_head"># DE SEGUIDORES</div> 
            <div class="txt_row_head">TOKENS REQUERIDOS</div>
        </div>
        <hr class="hr_100_o">
        <div class="table_row row_encabezado_paso_2">
            <img class="img_playlist img_playlist_o" src="https://i.scdn.co/image/ab67706c0000bebb425e1fd6a69c432e484f6c39" alt=""> 
            <a href="#" class="txt_row_play a_row_play_o">👻Ghost!!</a> 
            <a href="#" class="txt_row_play a_row_play_o">Michelada Fantasma</a> 
            <div class="txt_row_play">1000</div>
            <div class="txt_row_play">2</div>
        </div>
        <div class="table_row row_encabezado_paso_2">
            <img class="img_playlist img_playlist_o" src="https://i.scdn.co/image/ab67706c0000bebbdedd7de8deb4404798109985" alt=""> 
            <a href="#" class="txt_row_play a_row_play_o">Oscar bebito uwu❤</a>
            <a href="#" class="txt_row_play a_row_play_o">Michelada Fantasma</a>
            <div class="txt_row_play">2000</div>
            <div class="txt_row_play">3</div>
        </div>
        <div class="txt_izquierda_o txt_italic_14" style="margin-top:40px;">Numero de tokens insuficientes <a class="a_comprar_o" href="{{Route('tokens')}}">comprar tokens</a></div>
        <div class="crearCampana_botones botones_margin_subir">
            <a class="a_cancelar_o" href="{{Route('crearCampana1')}}">Regresar</a>
            <a class="a_continuar_o" href="{{Route('crearCampana3')}}">Continuar</a>
        </div>
    </div>
</div>
@endsection