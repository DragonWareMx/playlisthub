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
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="div_CabeceraApartado">
    <div class="div_tituloApartado">
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Correo electrónico</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR CORREO ELECTRÓNICO</p>
    @foreach ($usuario as $user)
    <form action="{{ route('correo-updateDo', ['id'=>$user->id]) }}" style="width:100%;" method="POST" enctype="multipart/form-data">
        @method("PATCH")
        @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CORREO
        </div>  
        <input type="email" name="correo" class="input_Ajustes_valor" id="correo" value="{{$user ->email}}" required>
    </div>
    <div class="div_btnsUpdate">
        <div class="div_contbtns">
            <a href="{{route('administrar-cuenta')}}">Cancelar</a>
            <input class="" type="submit" value="Guardar">
        </div>
    </div>
    </form>
    @endforeach
</div>

<

@endsection