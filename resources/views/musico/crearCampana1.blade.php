@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
@endsection

@section('menu')
    Campañas
@endsection

@section('contenido')
@if (session()->get('badLink'))
    <div class="error_msg_o">
        ERROR: El link debe pertenecer a una canción registrada en Spotify
    </div>
@endif
@if (session()->get('unexpected'))
    <div class="error_msg_o">
        ERROR: Sucedió algo inesperado, por favor inténtalo de nuevo más tarde
    </div>
@endif
@if (!session()->get('expiredToken'))
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
                    <img class="campana_info_3_img" src="https://cdn.pixabay.com/photo/2016/04/28/23/53/spotify-1360002_960_720.jpg" alt="">
                </div>
                <div id="crearCampana_50" class="campana_info_1">
                    <div class="vercampana_title_o">LINK DE SPOTIFY</div>
                    <input name="link" class="input_crearCampana" type="text" required>
                    <div class="vercampana_title_o" style="display:flex">CÓDIGO DE REFERENCIA <h1 class="normalizar_letra">(Opcional)</h1></div>
                    <input name="code" class="input_crearCampana" type="text">
                </div>
                <div id="crearCampana_50" class="campana_info_3">
                    <img class="campana_info_3_img" src="https://cdn.pixabay.com/photo/2016/04/28/23/53/spotify-1360002_960_720.jpg" alt="">
                </div>
                <div class="crearCampana_botones">
                    <a class="a_cancelar_o" href="{{Route('campanas')}}">Cancelar</a>
                    <button class="a_continuar_o" type="submit">Continuar</button> 
                </div>
            </form>
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