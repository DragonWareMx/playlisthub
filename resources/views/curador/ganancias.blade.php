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
        <img class="logo_ganancias" src="img/iconos/ganancias.png" alt="" style=""> &nbsp;&nbsp;<span class="txt_title">Ganancias totales</span>
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <p class="txt_total">$ {{$total}} de ganancias totales</p>
        <p class="txt_content_ganancias">Tienes un saldo de ..., para poder hacer el cobro debes llegar a la cantidad de 10 dolares</p>
    </div>

    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/ranking.png" alt=""> &nbsp;&nbsp;
        <span class="txt_title">Ganancias por playlists</span>    
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <div class="table_head">
           <div class="img_vacia"></div> <div class="txt_row_head">GANANCIAS</div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div> 
           <div class="txt_row_head row_hide">RANKING</div>  <div class="txt_row_head row_hide">SEGUIDORES</div> 
        </div>
        
    @php
        $i=0;
    @endphp
    @foreach ($playlists as $playlist)
    <hr class="hr_100_o">
    <div class="table_row">
        <img class="img_playlist" src="{{$playlist->images[0]->url}}" alt=""> 
        <div class="txt_row_play">$ {{$playlists_bd[$i]->profits}}</div> 
        <div class="txt_row_play row_hide2">{{$playlist->name}}</div> 
        <div class="txt_row_play row_hide">{{$playlists_bd[$i]->tier}}</div> 
        <div class="txt_row_play row_hide">{{$playlist->followers->total}}</div> 
    </div>
    @php
        $i++;
    @endphp
    @endforeach
        
    </div>
</div>
@endsection