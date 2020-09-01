@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

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
           <div class="img_playlist"></div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head">GÉNERO</div> <div class="txt_row_head">NIVEL</div> 
            <div class="txt_row_head">SEGUIDORES</div> <div class="txt_row_head">GANANCIAS</div> 
        </div>
        
    
    <!--estos divs se crean con un foreach-->
    <hr class="hr_100_o">
        <div class="table_row">
            <img class="img_playlist" src="img/unnamed.jpg" alt=""> 
            <div class="txt_row_play">nombre</div> <div class="txt_row_play">rock</div> <div class="txt_row_play">nivel 10</div>
              <div class="txt_row_play">1000</div> <div class="txt_row_play">$5,300</div>
        </div>
    <!--este es de prueba-->
        <hr class="hr_100_o">
        <div class="table_row">
            <img class="img_playlist" src="img/unnamed.jpg" alt=""> 
            <div class="txt_row_play">nombre</div> <div class="txt_row_play">rock</div> <div class="txt_row_play">nivel 10</div>
              <div class="txt_row_play">1000</div> <div class="txt_row_play">$5,300</div>
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
           <div class="img_playlist"></div> <div class="txt_row_head">NOMBRE DE LA CANCIÓN</div> 
           <div class="txt_row_head">PLAYLIST</div> <div class="txt_row_head">ARTISTA</div>  
           <div class="txt_row_head">TOKENS</div> <div class="txt_row_head">MÚSICO</div> 
        </div>
        
    
    <!--estos divs se crean con un foreach-->
    <hr class="hr_100_o">
        <div class="table_row">
            <img class="img_playlist" src="img/unnamed.jpg" alt=""> 
            <div class="txt_row_play">nombre muy largo alv</div> <div class="txt_row_play">nombre más que largo mucho mucho mucho</div> <div class="txt_row_play">nombre</div>  
            <div class="txt_row_play">2</div> <div class="txt_row_play">nombre</div> 
        </div>
    </div>
</div>
<!--MODAL de agregar playlist-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="padding: 5%">
         
            <div class="modal_head">
                <div class="div_30_a"></div>
                <div class="title_modal" style=""> 
                    <div class="txt_total">Agregar playlist</div>
                </div>
                <div class="div_30_a">
                    <img class="logo_spotify" src="img/iconos/spotify.png" alt="">    
                </div>            
            </div>
            
            <hr class="hr_100_blue">
            
            <div class="txt_modal_center">Playlists que cumplen con los requisitos</div>
            <div class="txt_modal_left">Selecciona la playlist que vas a agregar</div>

            <!--se hacen con un for-->
            <div id="1" class="div_playlist_modal">
                <div><img class="img_playlist" src="img/unnamed.jpg" alt=""></div>  
                <div class="txt_row">Nombre de la playlist muy largo pero muy largo ala verga muy muy muy </div> <div class="txt_row">2,000 seguidores (nivel 10)</div>
            </div>

            <div class="botones_modal">
                <button type="button" class="btn_modal_cancel" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn_modal_add">Agregar</button>    
            </div>
      </div>
    </div>
  </div>
    
  <script>
      var click= false;
    $('#1').on('click', function () {
        if(click){
            $(this).css('border-color','#5C5C5C');
            click=false;
        }
        else{
            $(this).css('border-color','#8177F5');
            click=true;
        }
      });
  </script>
  
@endsection