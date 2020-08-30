@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
@endsection

@section('menu')
    Perfil 
@endsection

@section('contenido')
<div class="div_perfilMusico">

    <div class="div_CabeceraApartado">
        <div class="div_tituloApartado">
            <p><i class="fas fa-user-circle" style="color:#5C5C5C"></i>&nbsp;&nbsp;Datos generales</p>
        </div>
    <a href="{{route('administrar-cuenta')}}" style="color: #8177F5"><i class="fas fa-cog"></i>&nbsp;&nbsp;Administrar tu cuenta</a>
    </div>

    <div class="div_infoPerfilM">
        <div class="div_fotoPerfilM">
            <img src="/img/unnamed.jpg">
            <a href="#"><i class="fas fa-pencil-alt"></i>&nbsp;Cambiar foto</a>
        </div>
        <div class="div_txtPM">
            <p class="txt-infoNombrePM">Nombre completo del usuario</p>
            <p class="txt-infoUserP">Músico</p>
            <p class="txt-informacionP">México</p>   
            <p class="txt-informacionP">correoelectrónico@ejemplo.com</p>
        </div>
    </div>

    <div class="div_CabeceraApartado" style="margin-top:40px">
        <div class="div_tituloApartado resize_tituloApartado">
            <p><img class="img_ico_title_o" src="img/iconos/campanas.png" alt="">&nbsp;&nbsp;Campañas actuales</p>
        </div>
        <a href="#" style="color: #8177F5; width:10%"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
    </div>

    <div class="div_campanasAP">
        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://images.genius.com/2fd19d66c434ba81543c4f8c0a681f8b.959x959x1.jpg');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
        </div>

        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://images-na.ssl-images-amazon.com/images/I/712rrJUrcrL._AC_SL1256_.jpg');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
        </div>

        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://images-na.ssl-images-amazon.com/images/I/81KWwt9-szL._AC_SL1400_.jpg');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
        </div>
    </div>
    
    <div class="div_CabeceraApartado" style="margin-top:40px">
        <div class="div_tituloApartado resize_tituloApartado">
            <p><img class="img_ico_title_o" src="img/iconos/reviews.png" alt="">&nbsp;&nbsp;Reviews</p>
        </div>
    </div>

</div>

@endsection