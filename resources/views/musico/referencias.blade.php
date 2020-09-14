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
            0124789248885
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
        <p class="txt-codigoParametro"> DESCUENTOS PROPORCIONADOS </p>
        <p class="txt-codigoValor"> 0 </p>
    </div>
</div>
<p class="txt-funcionamiento">Texto especifico de cómo funciona el sistema de referencias lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum dolor sit amet consectetur adipiscing elit</p>
@endsection