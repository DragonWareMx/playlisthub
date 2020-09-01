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
    <div class="ico_title_o">
        <a style="margin-top:-3px;" href="{{route('campanas')}}"><img class="img_ico_title_o" src={{asset("img/iconos/regresar.png")}} alt=""></a>
        <div class="p_title_o">&nbsp;&nbsp;Campaña "Nombre de la canción"</div>
    </div>
    <hr class="hr_100_o">
    <div class="div_campana_info_o">
        <div class="campana_info_0">
            <img class="campana_info_3_img" src="https://i.scdn.co/image/ab67616d0000b27349e3b7e85829da2fbc68bc46" alt="">
        </div>
        <div class="campana_info_1">
            <div class="vercampana_title_o">NOMBRE DE LA CANCION</div>
            <div class="vercampana_txt_o">Nombre completo de la canción</div>
            <div class="vercampana_title_o">LINK DE SPOTIFY</div>
            <div class="vercampana_txt_o">https://linkdespotify.com</div>
            <div class="vercampana_title_o">NOMBRE DEL ARTISTA</div>
            <div class="vercampana_txt_o">Nombre del artista</div>
            <div class="vercampana_title_o">LINK DEL ARTISTA</div>
            <div class="vercampana_txt_o">{{Str::limit('https://linkdelartista/playlisthub.com', 27 )}}</div>
            <div class="vercampana_title_o">FECHA DE INICIO</div>
            <div class="vercampana_txt_o">25-Agosto-2020</div>
        </div>
        <div class="campana_info_2">
            <div class="vercampana_title_o">ARTISTAS A LOS QUE SE PARECE</div>
            <div class="vercampana_txt_o">#TagNombre1 #TagNombre2</div>
            <div class="vercampana_title_o">TOKENS</div>
            <div class="vercampana_txt_o">5</div>
            <div class="vercampana_title_o">NOMBRE DE LA PLAYLIST</div>
            <div class="vercampana_txt_o">Nombre completo de la playlists</div>
            <div class="vercampana_title_o">NOMBRE DEL CURADOR</div>
            <a class="vercampana_a_o" href="#">Nombre completo del curador</a>
            <div class="vercampana_title_o">FECHA DE INICIO</div>
            <div class="vercampana_txt_o">25-Agosto-2020</div>
        </div>
        <div class="campana_info_3">
            <img class="campana_info_3_img" src="https://i.scdn.co/image/ab67616d0000b27349e3b7e85829da2fbc68bc46" alt="">
        </div>
        <div class="campana_estatus_o" style="display:none">
            <div class="campana_info_3_status">
                <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>   
                <div class="vercampana_txt_status">En espera de revisión</div>
            </div>
        </div>
        <div class="campana_estatus_o">
            <a class="campana_estatus_renovar_o campana_info_3_status" href="#">Renovar</a>
        </div>
    </div>
</div>
@endsection