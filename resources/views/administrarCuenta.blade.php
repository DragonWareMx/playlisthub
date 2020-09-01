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
        <p><img class="img_ico_title_o" src="img/iconos/info.png" alt="">&nbsp;&nbsp;Ajustes de cuenta</p>
    </div>
</div>
<div class="div_Ajustes">
    <p class="txt-descAjustes">Es posible que cierta información sea visible para otras personas que usan los servicios de Playlishub. <a target="blank" href="https://playlisthub.io/aviso-de-privacidad/">Más información</a></p>
    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        FOTO
        </div>
        <div class="div_Ajustes_valor">
        Agrega una foto para personalizar tu cuenta
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        NOMBRE
        </div>
        <div class="div_Ajustes_valor">
        Nombre completo del usuario
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        GÉNERO
        </div>
        <div class="div_Ajustes_valor">
        Femenino
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        FECHA DE NACIMIENTO
        </div>
        <div class="div_Ajustes_valor">
        02 - Agosto - 1999
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        PAÍS DE RESIDENCIA
        </div>
        <div class="div_Ajustes_valor">
        México
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        CORREO ELECTRÓNICO
        </div>
        <div class="div_Ajustes_valor">
        correo@ejemplo.com
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

</div>


<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/privacidad.png" alt="">&nbsp;&nbsp;Privacidad de la cuenta</p>
    </div>
</div>
<div class="div_Ajustes">
    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        CONTRASEÑA
        </div>
        <div class="div_Ajustes_valor">
        ***********
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>
</div>


<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/facturacion.png" alt="">&nbsp;&nbsp;Dirección de facturación</p>
    </div>
</div>
<div class="div_Ajustes">
    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        NOMBRE
        </div>
        <div class="div_Ajustes_valor">
        Nombre completo
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        NOMBRE DE LA COMPAÑÍA (Opcional)
        </div>
        <div class="div_Ajustes_valor">
        Nombre de la compañía
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>

    <div class="div_Ajustes_item">
        <div class="div_Ajustes_name">
        DIRECCIÓN
        </div>
        <div class="div_Ajustes_valor">
        País, estado, ciudad y código postal
        </div>
        <div><i class="fas fa-chevron-right" style="font-size: 14px;"></i></div>
    </div>
</div>

<br>
<div class="div_eliminarCuenta">
    <a href="#"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Eliminar cuenta</a>
    <a href="{{route('perfil-musico')}}" style="color:#5C5C5C; text-decoration:none"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Regresar</a>
</div>
<br>
@endsection
