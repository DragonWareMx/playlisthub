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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Género</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR GÉNERO</p>
    @foreach ($usuario as $user)
    <form action="{{ route('genero-updateDo', ['id'=>$user->id]) }}" style="width:100%;" method="POST" enctype="multipart/form-data">
        @method("PATCH")
        @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        GÉNERO
        </div>
        <select name="genero" class="input_Ajustes_valor" value="" required id="genero">
            @if($user->genre =='f')
                <option  selected="selected" value="1">Femenino</option>
                <option value="2">Masculino</option>
                <option value="3">Otro</option>
            @else
                @if($user->genre =='m')
                    <option  selected="selected" value="2">Masculino</option>
                    <option value="1">Femenino</option>
                    <option value="3">Otro</option>
                @else
                    <option  selected="selected" value="3">Otro</option>
                    <option value="1">Femenino</option>
                    <option value="2">Masculino</option>
                @endif
            @endif

        </select>
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



@endsection