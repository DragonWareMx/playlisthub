@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Inicio
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/ganancias.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Ganancias</div>
    </div>
    <hr class="hr_100_o">
    <div class="div_tokens_o"> $5,000 de ganancias totales</div>

    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/playlist.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Tus playlist activas</div>
    </div>
    <button id="btnModal" class="a_agregar_o">
        <img class="img_a_agregar_o" src="img/iconos/plus.png" alt="">
        <div id="" class="txt_a_o">Agregar</div>
    </button>
    <hr class="hr_100_o">
</div>

@endsection