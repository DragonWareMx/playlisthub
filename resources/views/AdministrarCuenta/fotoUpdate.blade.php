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
        <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Foto de perfil</p>
    </div>
</div>

<div class="div_Ajustes">
    <p class="txt-descAjustes">EDITAR FOTO DE PERFIL</p>

    <form action="" style="width:100%;" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_fotoPerfilM">
            <img src="/img/unnamed.jpg" alt="Imagen" id="imagenPrevisualizacion"> 
            {{-- cargar imagen actual --}}
        </div>
        <input type="file" name="imagen" class="input_Ajustes_valor" id="seleccionArchivos" accept="image/*" value="al" required style="padding: 8%; padding-left:1%">
    </div>
    <div class="div_btnsUpdate">
        <div class="div_contbtns">
            <a href="{{route('administrar-cuenta')}}">Cancelar</a>
            <input class="" type="submit" value="Guardar">
        </div>
    </div>
    </form>
</div>



<script>
const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", () => {
  // Los archivos seleccionados, pueden ser muchos o uno
  const archivos = $seleccionArchivos.files;
  // Si no hay archivos salimos de la función y quitamos la imagen
  if (!archivos || !archivos.length) {
    $imagenPrevisualizacion.src = "";
    return;
  }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
  const primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
  const objectURL = URL.createObjectURL(primerArchivo);
  // Y a la fuente de la imagen le ponemos el objectURL
  $imagenPrevisualizacion.src = objectURL;
});
</script>
@endsection