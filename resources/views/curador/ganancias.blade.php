@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Ganancias
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="p_title_o">
        <img class="logo_ganancias" src="img/iconos/ganancias.png" alt="" style=""> &nbsp;&nbsp;Ganancias totales
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <p class="txt_total">$ de ganancias totales</p>
        <p class="txt_content_ganancias">Tienes un saldo de ..., para poder hacer el cobro debes llegar a la cantidad de ...</p>
    </div>

    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/ranking.png" alt=""> &nbsp;&nbsp;Ganancias por playlists
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <div class="table_head">
           <div></div> <div>GANANCIAS</div> <div>NOMBRE DE LA PLAYLIST</div> <div>GÉNERO</div>  <div>SEGUIDORES</div> 
        </div>
        <hr class="hr_100_o">
    
    <!--estos divs se crean con un foreach-->
        <div class="table_row">
            <img src="" alt=""> <div>$</div> <div>nombre</div> <div>rock</div>  <div>1000</div> 
        </div>
    </div>
</div>
@endsection