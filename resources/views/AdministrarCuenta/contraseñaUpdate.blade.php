@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
   <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Contraseña</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR CONTRASEÑA</p> 
    @foreach ($usuario as $user)
    <form action="{{ route('contraseña-updateDo', ['id'=>$user->id]) }}" style="width:100%;" method="POST" enctype="multipart/form-data" id="formCheckPassword">
        @method("PATCH")
        @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CONTRASEÑA ACTUAL
        </div>
    <input type="password" name="passActual" class="input_Ajustes_valor inputUPP" id="passActual" value="" required style=" width:30%; background-color:transparent; border-bottom: solid 1px #8177F5;">

    </div>
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        NUEVA CONTRASEÑA
        </div>
        <input type="password" name="password" id="password" class="input_Ajustes_valor"  value="" required style="width:30%; background-color:transparent; border-bottom: solid 1px #8177F5;">
    </div>
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CONFIRMAR CONTRASEÑA
        </div>
        <input type="password" name="cfmPassword" id="cfmPassword" class="input_Ajustes_valor" value="" required style="width:30%; background-color:transparent; border-bottom: solid 1px #8177F5;">
    </div>
    <div class="div_btnsUpdate">
        <div class="div_contbtns">
            <a href="{{route('administrar-cuenta')}}">Cancelar</a>
            <input class="" type="submit" value="Guardar">
        </div>
    </div>
    </form>
</div>

@endforeach
<script>
    $("#formCheckPassword").validate({
           rules: {
               password: { 
                 required: true,
                    minlength: 8,
                    maxlength: 10,

               } , 
               passActual: { 
                 required: true
               } ,

                   cfmPassword: { 
                    equalTo: "#password",
                     minlength: 8,
                     maxlength: 10
               }


           },
     messages:{
         password: { 
                 required:" Contraseña requerida",
                 minlength: " Mínimo 8 caracteres",
                 maxlength: " Máximo 10 caracteres"
               },

        passActual: { 
                 required:" Contraseña requerida",
                },
        cfmPassword: { 
                required:" Contraseña requerida",
                equalTo: " Las contraseñas no coinciden",
                minlength: " Mínimo 8 caracteres",
                maxlength: " Máximo 10 caracteres"
       }
     }

});
</script>
@endsection