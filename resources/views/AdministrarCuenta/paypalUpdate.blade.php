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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Link de PayPal.Me</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR LINK</p>
    @foreach ($usuario as $user)
    
    <form action="{{ route('paypal-updateDo', ['id'=>$user->id]) }}" style="width:100%;" method="POST" enctype="multipart/form-data">
        @method("PATCH")
                @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        LINK
        </div>
        <input type="text" name="link" class="input_Ajustes_valor" id="link" placeholder="Paypal.Me/micuenta" value="{{ $user->paypal }}" required>
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