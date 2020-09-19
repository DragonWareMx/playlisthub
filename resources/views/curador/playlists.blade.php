@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@endsection

@section('menu')
    Playlists
@endsection

@section('contenido')
@if (!$error)
<div class="div_90_o">
    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/campanas.png" alt="" style=""> &nbsp;&nbsp;<span class="txt_title"> playlists activas </span>
    </div>
    <div class="btn_addPlaylist" data-toggle="modal" data-target="#addModal">
         <img class="logo_plus" src="img/iconos/plus.png" alt="" style=""> &nbsp;&nbsp;<span class="txt_hide">Agregar</span>
    </div>
    <hr class="hr_100_o">
    <!--tabla playlists-->
    <div class="div_content">
        <div class="table_head">
           <div class="img_vacia"></div> <div class="txt_row_head">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head">RANKING</div> <div class="txt_row_head row_hide">NIVEL</div> 
            <div class="txt_row_head row_hide">SEGUIDORES</div> <div class="txt_row_head row_hide">GANANCIAS</div> 
        </div>
        
    
    <!--estos divs se crean con un foreach-->
    @php
        $i=0;
    @endphp
    @foreach ($playlists_registradas as $playlist)
    <hr class="hr_100_o">
        <div id="{{$playlist->id}}" class="table_row">
            <img class="img_playlist" src="{{$playlist->images[0]->url}}" alt=""> 
            <div class="txt_row_play">{{$playlist->name}}</div> <div class="txt_row_play row_hide2">{{$playlists_bd[$i]->tier}}</div> 
            <div class="txt_row_play row_hide">
                @php
                   if($playlist->followers->total<=5000) $nivel=1;
                   if($playlist->followers->total>5000 && $playlist->followers->total<=15000) $nivel=2;
                   if($playlist->followers->total>15000 && $playlist->followers->total<=20000) $nivel=3;
                   if($playlist->followers->total>20000 && $playlist->followers->total<=30000) $nivel=4;
                   if($playlist->followers->total>30000 && $playlist->followers->total<=50000) $nivel=5;
                   if($playlist->followers->total>50000 && $playlist->followers->total<=60000) $nivel=6;
                   if($playlist->followers->total>60000 && $playlist->followers->total<=70000) $nivel=7;
                   if($playlist->followers->total>70000 && $playlist->followers->total<=80000) $nivel=8;
                   if($playlist->followers->total>80000 && $playlist->followers->total<=90000) $nivel=9;
                   if($playlist->followers->total>90000) $nivel=10;
                @endphp
                nivel {{$nivel}}
            </div>
            <div class="txt_row_play row_hide">{{$playlist->followers->total}}</div> 
            <div class="txt_row_play row_hide">${{$playlists_bd[$i]->profits}}</div>
        </div>
    @php
        $i++;
    @endphp
    @endforeach
    
    </div>

    

    <div class="p_title_o">
        <img class="logo_ranking" src="img/iconos/match.png" alt=""> &nbsp;&nbsp;<span class="txt_title">Canciones con match</span>
    </div>
    <a class="item_right" href="#">Solicitudes</a>
    <hr class="hr_100_o">
    <!--tabla canciones con match-->
    <div class="div_content">
        <div class="table_head">
           <div class="img_vacia"></div> <div class="txt_row_head">NOMBRE DE LA CANCIÓN</div> 
           <div class="txt_row_head">PLAYLIST</div> <div class="txt_row_head row_hide">ARTISTA</div>  
           <div class="txt_row_head row_hide">TOKENS</div> <div class="txt_row_head row_hide">MÚSICO</div> 
        </div>
        
    
    <!--estos divs se crean con un foreach-->
    <hr class="hr_100_o">
        <div class="table_row">
            <img class="img_playlist" src="img/unnamed.jpg" alt=""> 
            <div class="txt_row_play">nombre muy largo alv</div> <div class="txt_row_play row_hide2">nombre más que largo mucho mucho mucho</div> 
            <div class="txt_row_play row_hide">nombre</div>  
            <div class="txt_row_play row_hide">2</div> <div class="txt_row_play row_hide">nombre</div> 
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
           
            @php
                $i=0;
                $control=true;
            @endphp
            @foreach ($playlists as $playlist)
                @if ($followers[$i]>500)
                    <div id="{{$playlist['external_urls']['spotify']}}" class="div_playlist_modal" value="">
                        <div><img class="img_modal" src="{{$playlist['images']['0']['url']}}" alt=""></div>  
                        <div class="txt_row">{{$playlist['name']}}</div> 
                        <div class="txt_row">{{$followers[$i]}}</div>
                    </div>
                    @php
                        $control=false;
                    @endphp
                @endif
            @php
                $i++;
            @endphp                
            @endforeach
            @if ($control)
            <div class="txt_modal_center">Lo sentimos, ninguna de tus playlists sin registrar tiene un número mayor a 500 seguidores</div>
            @endif
                <form action="{{Route('addPlaylist')}}" method="POST">
                    <input id="link_pl" type="text" required style="display: none" name="link">
                @csrf
                <div class="botones_modal">
                    <button type="button" class="btn_modal_cancel" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn_modal_add">Agregar</button>    
                </div>
            </form>
            
      </div>
    </div>
  </div>
    
  <script>
      var click= false;
      var control;

    //al dar click en el cancel del modal deja todo como estaba
    $('.btn_modal_cancel').on('click', function(){
        $('.div_playlist_modal').css('border-color','#5C5C5C');
        $('#link_pl').val(null);
        click=false;
        control="";
    });
    //para seleccionar el div de la playlist que se elegira
    $('.div_playlist_modal').on('click', function () {
        if(click){
            if(control==this.id){
                $(this).css('border-color','#5C5C5C');
                $('#link_pl').val(null);
                click=false;
                control="";
            }
            else{
                $('#'+control+'').css('border-color','#5C5C5C');
                $(this).css('border-color','#8177F5');
                $('#link_pl').val(this.id);
                control=this.id;
                click=true;
            }  
        }
        else{
            $(this).css('border-color','#8177F5');
            $('#link_pl').val(this.id);
            control=this.id;
            click=true;
        }
      });
  </script>
  
@else
<div class="div_error_o">
    <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
    <a href="http://127.0.0.1:8000/login/spotify" id="a_error_o" class="inicio-spotybtn">
        <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
    </a>
</div>
@endif
@endsection