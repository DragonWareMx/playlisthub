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
        <a style="margin-top:-3px;" href="#"><img class="img_ico_title_o" src={{asset("img/iconos/regresar.png")}} alt=""></a>
        <div class="p_title_o">&nbsp;&nbsp;Campaña "Nombre de la canción"</div>
    </div>
    <hr class="hr_100_o">
</div>
@endsection