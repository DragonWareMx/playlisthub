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
        <img class="logo_ranking" src="img/iconos/ranking.png" alt=""> Ranking de tus playlists
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <div class="table_head">
           <div></div> <div>NIVEL</div> <div>NOMBRE DE LA PLAYLIST</div> <div>GÉNERO</div>  <div>SEGUIDORES</div> 
        </div>
        <hr class="hr_100_o">
    
    <!--estos divs se crean con un foreach-->
        <div class="table_row">
            <img src="" alt=""> <div>Nivel 10</div> <div>nombre</div> <div>rock</div>  <div>1000</div> 
        </div>
    </div>
</div>
@endsection
