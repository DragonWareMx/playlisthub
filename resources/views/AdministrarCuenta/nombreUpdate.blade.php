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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Nombre</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR NOMBRE</p>
    @foreach ($usuario as $user)
    
    <form action="{{ route('nombre-updateDo', ['id'=>$user->id]) }}" style="width:100%;" method="POST" enctype="multipart/form-data">
        @method("PATCH")
                @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        NOMBRE
        </div>
        <input type="text" name="nombre" class="input_Ajustes_valor" id="nombre" value="{{ $user ->name }}" required>
    </div>
    <div class="div_btnsUpdate">
        <div class="div_contbtns">
            <a href="javascript:history.back(-1);">Cancelar</a>
            <input class="" type="submit" value="Guardar">
        </div>
    </div>
    </form>
    @endforeach
</div>

<br>
<div class="div_eliminarCuenta" style="display: flex; justify-content:right">
    <div class="div_contbtns">
        <a href="{{route('administrar-cuenta')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
    </div>
</div>
<br>

@endsection