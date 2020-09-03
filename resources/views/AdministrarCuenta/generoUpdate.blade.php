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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Género</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR GÉNERO</p>

    <form action="" style="width:100%;" method="POST" enctype="multipart/form-data">
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        GÉNERO
        </div>
        <select name="genero" class="input_Ajustes_valor" value="" required>
            <option  selected="selected" value="1">Femenino</option>
            <option value="2">Masculino</option>
            <option value="3">Otro</option>
        </select>
    </div>
    <div class="div_btnsUpdate">
        <a href="javascript:history.back(-1);">Cancelar</a>
        <input class="" type="submit" value="Guardar">
    </div>
    </form>
</div>

<br>
<div class="div_eliminarCuenta" style="display: flex; justify-content:right">
    <a href="{{route('administrar-cuenta')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
</div>
<br>

@endsection