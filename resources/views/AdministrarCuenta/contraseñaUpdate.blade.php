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
<div class="div_CabeceraApartado">
    <div class="div_tituloApartado">
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Contraseña</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR CONTRASEÑA</p>
    <form action="" style="width:100%;" method="POST" enctype="multipart/form-data" id="formCheckPassword">
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CONTRASEÑA ACTUAL
        </div>
    <input type="password" name="passActual" class="input_Ajustes_valor" id="" value="" required style=" width:30%; background-color:#f1f1f1;">
    </div>
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        NUEVA CONTRASEÑA
        </div>
        <input type="password" name="password" id="password" class="input_Ajustes_valor"  value="" required style="width:30%; background-color:#f1f1f1; ">
    </div>
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CONFIRMAR CONTRASEÑA
        </div>
        <input type="password" name="cfmPassword" id="cfmPassword" class="input_Ajustes_valor" value="" required style="width:30%; background-color:#f1f1f1; ">
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

<script>
    $("#formCheckPassword").validate({
           rules: {
               password: { 
                 required: true,
                    minlength: 6,
                    maxlength: 10,

               } , 

                   cfmPassword: { 
                    equalTo: "#password",
                     minlength: 6,
                     maxlength: 10
               }


           },
     messages:{
         password: { 
                 required:"Contraseña requerida",
                 minlength: "Mínimo 6 carácteres",
                 maxlength: "Máximo 10 carácteres"
               },
       cfmPassword: { 
         equalTo: "La contraseña debe ser igual al anterior",
         minlength: "Mínimo 6 carácteres",
         maxlength: "Máximo 10 carácteres"
       }
     }

});
</script>
@endsection