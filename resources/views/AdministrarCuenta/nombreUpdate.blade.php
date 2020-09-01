@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
@endsection

@section('menu')
    Administrar cuenta
@endsection

@section('contenido')
<div class="div_CabeceraApartado">
    <div class="div_tituloApartado">
        <p><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Nombre</p>
    </div>
</div>

<br>
<div class="div_eliminarCuenta">
    <a href="{{route('perfil-musico')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
</div>
<br>

@endsection