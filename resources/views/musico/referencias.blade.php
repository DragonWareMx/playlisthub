@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/Referencias.css">
@endsection

@section('menu')
    Referencias 
@endsection

@section('contenido')
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/referencias.png" alt="">&nbsp;&nbsp;Sistema de referencias</p>
    </div>
</div>

<div class="div_contenido_Codigo">
    <div class="div_infoCodigo">
        <div class="div_txt_codigo">
            Código único
        </div>
        <div class="div_codigo">
            @if (!$reference)
                Para activar tu código de referencia, primero es necesario haber realizado una compra de tokens.
            @else 
                {{$reference}}
            @endif
        </div>
        <div class="div_alert_codigo">
            Este código es único e irrepetible
        </div>
    </div>
    <div class="div_infoReferencias">
        <p class="txt-codigoParametro"> NÚMERO DE VECES UTILIZADO </p>
        <p class="txt-codigoValor"> 25 veces </p>
        <p class="txt-codigoParametro"> NÚMERO DE TOKENS GRATIS ASIGNADOS </p>
        <p class="txt-codigoValor"> 18 tokens </p>
    </div>
</div>

<p class="txt-funcionamiento">Activa tu código de referencia realizando una primera compra, una vez que esté activo puedes compartirlo con tus amigos. Tus beneficios: cada vez que TRES amigos tuyos usen el código 
    para comprar tokens en Playlisthub, tú obtendrás un token extra. Ellos también ganan: si usan un código de referencia obtendrán un 10% de descuento 
    en cualquier paquete que elijan.</p>

@endsection