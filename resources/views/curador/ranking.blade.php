@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Ranking
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/ranking.png" alt=""> <span class="txt_title"></span> Ranking de tus playlists
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <div class="table_head">
           <div class="img_vacia"></div> <div class="txt_row_head">NIVEL</div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head row_hide">GÉNERO</div>  <div class="txt_row_head row_hide">SEGUIDORES</div> 
        </div>
        
    
    <!--estos divs se crean con un foreach-->
        <hr class="hr_100_o">    
        <div class="table_row">
            <img class="img_playlist" src="img/unnamed.jpg" alt=""> 
            <div class="txt_row_play">Nivel 10</div> <div class="txt_row_play row_hide2">nombre</div> 
            <div class="txt_row_play row_hide">rock</div>  <div class="txt_row_play row_hide">1000</div> 
        </div>
    </div>
</div>
@endsection
