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
    <div class="crearCampana_pasos">Paso 1 de 3</div>
    <hr class="hr_100_o">
    <div class="div_campana_info_o">
        <form action="{{Route('crearCampana2')}}" style="width:100%; display:flex; flex-wrap:wrap;" method="POST">
            @csrf
            <div class="campana_info_0">
                <img class="campana_info_3_img" src="https://i.scdn.co/image/ab67616d0000b27328933b808bfb4cbbd0385400" alt="">
            </div>
            <div id="crearCampana_50" class="campana_info_1">
                <div class="vercampana_title_o">NOMBRE DE LA CANCION</div>
                <input class="input_crearCampana" type="text" required>
                <div class="vercampana_title_o">LINK DE SPOTIFY</div>
                <input class="input_crearCampana" type="text" required>
                <div class="vercampana_title_o">NOMBRE DEL ARTISTA</div>
                <input class="input_crearCampana" type="text" required>
                <div class="vercampana_title_o">ARTISTAS A LOS QUE SE PARECE</div>
                <input class="input_crearCampana" type="text" required>
                <div class="vercampana_title_o" style="display:flex">CÓDIGO DE REFERENCIA <h1 class="normalizar_letra">(Opcional)</h1></div>
                <input class="input_crearCampana" type="text">
            </div>
            <div id="crearCampana_50" class="campana_info_3">
                <img class="campana_info_3_img" src="https://i.scdn.co/image/ab67616d0000b27328933b808bfb4cbbd0385400" alt="">
            </div>
            <div class="crearCampana_botones">
                <a class="a_cancelar_o" href="{{Route('campanas')}}">Cancelar</a>
                <button class="a_continuar_o" type="submit">Continuar</button>
            </div>
        </form>
    </div>
</div>
@endsection