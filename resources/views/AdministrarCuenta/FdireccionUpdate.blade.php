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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Dirección de facturación</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR DIRECCIÓN DE FACTURACIÓN</p>

    <form action="" style="width:100%;" method="POST" enctype="multipart/form-data">
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        PAÍS
        </div>
        <input type="text" name="Fpais" class="input_Ajustes_valor" id="" value="Pais actual" required>
    </div>

    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        ESTADO
        </div>
        <input type="text" name="estado" class="input_Ajustes_valor" id="" value="Estado actual" required>
    </div>

    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CIUDAD
        </div>
        <input type="text" name="ciudad" class="input_Ajustes_valor" id="" value="Ciudad actual" required>
    </div>

    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CÓDIGO POSTAL
        </div>
        <input type="text" name="codigop" class="input_Ajustes_valor" id="" value="58770" required>
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