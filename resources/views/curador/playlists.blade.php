@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Playlists
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/campanas.png" alt="" style=""> &nbsp;&nbsp;Tus playlists activas
    </div>
    <div class="btn_addPlaylist" data-toggle="modal" data-target="#addModal">
         <img class="logo_plus" src="img/iconos/plus.png" alt="" style=""> &nbsp;&nbsp;Agregar
    </div>
    <hr class="hr_100_o">
    <!--tabla playlists-->
    <div class="div_content">
        <div class="table_head">
           <div></div> <div>NOMBRE DE LA PLAYLIST</div> <div>GÉNERO</div> <div>NIVEL</div>  <div>SEGUIDORES</div> <div>GANANCIAS</div> 
        </div>
        <hr class="hr_100_o">
    
    <!--estos divs se crean con un foreach-->
        <div class="table_row">
            <img src="" alt=""> <div>nombre</div> <div>rock</div> <div>nivel 10</div>  <div>1000</div> <div>$5,300</div>
        </div>
    </div>

    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/match.png" alt=""> &nbsp;&nbsp;Canciones con match
    </div>
    <a class="item_right" href="#">Solicitudes</a>
    <hr class="hr_100_o">
    <!--tabla canciones con match-->
    <div class="div_content">
        <div class="table_head">
           <div></div> <div>NOMBRE DE LA CANCIÓN</div> <div>PLAYLIST</div> <div>ARTISTA</div>  <div>TOKENS</div> <div>MÚSICO</div> 
        </div>
        <hr class="hr_100_o">
    
    <!--estos divs se crean con un foreach-->
        <div class="table_row">
            <img src="" alt=""> <div>nombre</div> <div>nombre</div> <div>nombre</div>  <div>2</div> <div>nombre</div> 
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div style="text-align: center; margin:20px">
          <h5 class="txt_total">Agregar playlist</h5>
        </div>
          <hr class="hr_100_o">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Agregar</button>
        
      </div>
    </div>
  </div>
@endsection