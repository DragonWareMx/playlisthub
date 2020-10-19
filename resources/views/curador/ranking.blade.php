@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css"> 
    <link rel="stylesheet" type="text/css" href="/css/L.css">
@endsection

@section('menu')
    Ranking
@endsection

@section('contenido')
@if (!$error) 
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/ranking.png" alt="">&nbsp;&nbsp;Ranking de tus playlists</p>
    </div>
</div>
<div class="div_90_o">
    @if (sizeOf($playlists)>0)
    <div class="div_content_o">
            <div class="table_head_o">
                <div class="img_playlist_o_2" style="margin-bottom:0px"></div>
                <div class="txt_row_head_o">NIVEL</div>
                <div class="txt_row_responsive">NIVEL</div> 
                <div class="txt_row_head_o">NOMBRE DE LA PLAYLIST</div>
                <div class="txt_row_responsive">PLAYLIST</div> 
                <div class="txt_row_head_o">RANKING</div>
                <div class="txt_row_responsive">RANKING</div> 
                <div class="txt_row_head_o">SEGUIDORES</div>
                <div class="txt_row_responsive">SEGUIDORES</div> 
            </div>    
    @php
        $i=0;
    @endphp
    @foreach ($playlists as $playlist)
        <hr class="hr_100_o">    
        <div class="table_row_o table_noBorder">
            @if ($playlist->images[0]->url)
            <img class="img_playlist_o" src="{{$playlist->images[0]->url}}" alt="">
            @else
            <img class="img_playlist_o" src="{{asset('img/logos/logo.png')}}" alt="">    
            @endif
            
            <p class="p_responsivep">NIVEL</p>
            <div class="txt_row_play_o">
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
            <p class="p_responsivep">PLAYLIST</p>
            <div class="txt_row_play_o">
                <a href="{{$playlist->external_urls->spotify}}"  target="_blank" class="txt_row_play_o a_row_play_o"> {{$playlist->name}} </a>             
            </div>
            <p class="p_responsivep">RANKING</p> 
            <div class="txt_row_play_o">{{$playlists_bd[$i]->tier}}</div> 
            <p class="p_responsivep">SEGUIDORES</p>
            <div class="txt_row_play_o">{{$playlist->followers->total}}</div> 
        </div>
        @php
            $i++;
        @endphp
    @endforeach
        
    </div>
    @else 
        <div class="div_error_o">
            <div class="txt_error_o">No tienes playlists activas.</div>
        </div>
    @endif
</div>

@else
<div class="div_error_o">
    <form action="{{route('relogin')}}" method="POST">
        @csrf
        <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
        <button type="submit" id="a_error_o" class="inicio-spotybtn">
            <img src="{{ asset('img/iconos/sp white.png') }}">  
        </button>
    </form>
</div>
    @endif
@endsection
