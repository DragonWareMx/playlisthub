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
    <div class="crearCampana_pasos">Paso 2 de 3</div>
    <hr class="hr_100_o">
    
</div>
@endsection