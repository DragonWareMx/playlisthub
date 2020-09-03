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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;PAÍS DE RESIDENCIA</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR PAÍS DE RESIDENCIA</p>

    <form action="" style="width:100%;" method="POST" enctype="multipart/form-data">
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        PAÍS
        </div>
        <select name="pais" size=1  class="input_Ajustes_valor"OnChange="javascript:pais();" required> 
                <option  selected="selected" value="1">México</option>
                <option value="2">Argentina</option>
                <option value="3">Bolivia</option>
                <option value="4">Brasil</option>
                <option value="5">Chile</option>
                <option value="6">Colombia</option>
                <option value="7">Costa Rica</option>
                <option value="8">Cuba</option>
                <option value="9">Ecuador</option>
                <option value="10">El Salvador</option>
                <option value="11">Guayana Francesa</option>
                <option value="12">Granada</option>
                <option value="13">Guatemala</option>
                <option value="14">Guayana</option>
                <option value="15">Haití</option>
                <option value="16">Honduras</option>
                <option value="17">Jamaica</option>
                <option value="18">México</option>
                <option value="19">Nicaragua</option>
                <option value="20">Paraguay</option>
                <option value="21">Panamá</option>
                <option value="22">Perú</option>
                <option value="23">Puerto Rico</option>
                <option value="24">República Dominicana</option>
                <option value="25">Surinam</option>
                <option value="26">Uruguay</option>
                <option value="27">Venezuela </option>
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