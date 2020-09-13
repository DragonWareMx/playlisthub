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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;PAÍS DE RESIDENCIA</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR PAÍS DE RESIDENCIA</p>
    @foreach ($usuario as $user)
    <form action="{{ route('pais-updateDo', ['id'=>$user->id]) }}" style="width:100%;" method="POST" enctype="multipart/form-data">
        @method("PATCH")
        @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        PAÍS
        </div>
        <select name="pais" size=1 id="pais" class="input_Ajustes_valor" OnChange="javascript:pais();" required> 
                <option  selected="selected" value="{{$user ->country}}">{{$user ->country}}</option>
                <option value="Argentina">Argentina</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Brasil">Brasil</option>
                <option value="Chile">Chile</option>
                <option value="Colombia">Colombia</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cuba">Cuba</option>
                <option value="Ecuador">Ecuador</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Guayana Francesa">Guayana Francesa</option>
                <option value="Granada">Granada</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guayana">Guayana</option>
                <option value="Haití">Haití</option>
                <option value="Honduras">Honduras</option>
                <option value="Jamaica">Jamaica</option>
                <option value="México">México</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Panamá">Panamá</option>
                <option value="Perú">Perú</option>
                <option value="Puerto">Puerto Rico</option>
                <option value="República Dominicana">República Dominicana</option>
                <option value="Surinam">Surinam</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Venezuela">Venezuela </option>
                </select>
    </div>
    <div class="div_btnsUpdate">
        <a href="javascript:history.back(-1);">Cancelar</a>
        <input class="" type="submit" value="Guardar">
    </div>
    </form>
    @endforeach
</div>

<br>
<div class="div_eliminarCuenta" style="display: flex; justify-content:right">
    <a href="{{route('administrar-cuenta')}}" style="color:#5C5C5C; text-decoration:none;float: right;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
</div>
<br>

@endsection