@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Ranking
@endsection

@section('contenido')
@if (!$error)
<div class="div_90_o">
    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/ranking.png" alt=""> <span class="txt_title"></span> Ranking de tus playlists
    </div>
    <hr class="hr_100_o">

    <div class="div_content">
        <div class="table_head">
           <div class="img_vacia"></div> <div class="txt_row_head">NIVEL</div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head row_hide">RANKING</div>  <div class="txt_row_head row_hide">SEGUIDORES</div> 
        </div>
        
    
    @php
        $i=0;
    @endphp
    @foreach ($playlists as $playlist)
        <hr class="hr_100_o">    
        <div class="table_row">
            <img class="img_playlist" src="{{$playlist->images[0]->url}}" alt=""> 
            <div class="txt_row_play">
                @php
                   if($playlist->followers->total<=5000) $nivel=1;
                   if($playlist->followers->total>5000 && $playlist->followers->total<=15000) $nivel=2;
                   if($playlist->followers->total>15000 && $playlist->followers->total<=20000) $nivel=3;
                   if($playlist->followers->total>20000 && $playlist->followers->total<=30000) $nivel=4;
                   if($playlist->followers->total>30000 && $playlist->followers->total<=50000) $nivel=5;
                   if($playlist->followers->total>50000 && $playlist->followers->total<=60000) $nivel=6;
                   if($playlist->followers->total>60000 && $playlist->followers->total<=70000) $nivel=7;
                   if($playlist->followers->total>70000 && $playlist->followers->total<=80000) $nivel=8;
                   if($playlist->followers->total>80000 && $playlist->followers->total<=90000) $nivel=9;
                   if($playlist->followers->total>90000) $nivel=10;
                @endphp
                nivel {{$nivel}}
            </div>
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

@else
<div class="div_error_o">
    <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
    <a href="http://127.0.0.1:8000/login/spotify" id="a_error_o" class="inicio-spotybtn">
        <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
    </a>
</div>
@endif
@endsection
