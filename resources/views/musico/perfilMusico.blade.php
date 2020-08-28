@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
@endsection

@section('menu')
    Perfil 
@endsection

@section('contenido')
<div class="div_perfilMusico">
    <div class="div_infoPerfilM">
        <div class="div_fotoPerfilM">
            <img src="/img/unnamed.jpg">
        </div>
        <div class="div_txtPM">
            <p class="txt-infoNombrePM">Nombre completo del usuario</p>
            <p class="txt-infoUserP">Músico</p>
            <p class="txt-informacionP">México</p>   
            <p class="txt-informacionP">correoelectrónico@ejemplo.com</p>
        </div>
    </div>
</div>

@endsection