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
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src={{asset("img/iconos/plusGris.png")}} alt="">
        <div class="p_title_o">&nbsp;&nbsp;Agregar campaña</div>
    </div>
    <div class="crearCampana_pasos">Paso 3 de 3</div>
    <hr class="hr_100_o">
    <div class="div_campana_info_o">
        <div class="campana_info_0">
            <img class="campana_info_3_img" src="https://i.scdn.co/image/ab67616d0000b27328933b808bfb4cbbd0385400" alt="">
        </div>
        <div class="campana_info_1">
            <div class="vercampana_title_o">NOMBRE DE LA CANCION</div>
            <div class="vercampana_txt_o">Glorius</div>
            <div class="vercampana_title_o">LINK DE SPOTIFY</div>
            <a href="https://open.spotify.com/track/6IfitwQQ1Gu9g9QnLWDHRY?si=sdRK-1pUTqOVihs6QF8dbw" target="_blank" class="vercampana_a_o">{{Str::limit('https://open.spotify.com/track/6IfitwQQ1Gu9g9QnLWDHRY?si=sdRK-1pUTqOVihs6QF8dbw', 27 )}}</a>
            <div class="vercampana_title_o">NOMBRE DEL ARTISTA</div>
            <div class="vercampana_txt_o">Muse</div>
            <div class="vercampana_title_o">FECHA DE INICIO</div>
            <div class="vercampana_txt_o">01-Septiembre-2020</div>
            <div class="vercampana_title_o">CÓDIGO DE REFERENCIA</div>
            <div class="vercampana_txt_o">012287</div>
        </div>
        <div class="campana_info_2">
            <div class="vercampana_title_o">ARTISTAS A LOS QUE SE PARECE</div>
            <div class="vercampana_txt_o">#Radio Head #The Killers #Interpol</div>
            <div class="vercampana_title_o">TOKENS</div>
            <div class="vercampana_txt_o">5</div>
            <div class="vercampana_title_o">NOMBRE DE LA PLAYLIST</div>
            <div class="vercampana_txt_o">🎃 Muse</div>
            <div class="vercampana_title_o">NOMBRE DEL CURADOR</div>
            <a class="vercampana_a_o" href="#">🍺 Michelada Fantasma</a>
            <div class="vercampana_title_o">FECHA DE TERMINO</div>
            <div class="vercampana_txt_o">15-Septiembre-2020</div>
        </div>
        <div class="campana_info_3">
            <img class="campana_info_3_img" src="https://i.scdn.co/image/ab67616d0000b27328933b808bfb4cbbd0385400" alt="">
        </div>
        <div class="crearCampana_botones">
            <a class="a_cancelar_o" href="{{Route('crearCampana2')}}">Regresar</a>
            <a class="a_continuar_o" href="#">Confirmar</a>
        </div>
    </div>
</div>
@endsection