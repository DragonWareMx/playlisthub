@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css"> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@endsection

@section('menu')
    Playlists
@endsection

@section('contenido') 
@if (!$error)
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/playlist.png" alt="">&nbsp;&nbsp;Playlist activas</p>
    </div>
    <a href="#" class="resize-btn-agregar" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
</div>
<div class="div_90_o">
    <!--tabla playlists-->
    <div class="div_content_o">
        <div class="table_head_o">
            <div class="img_playlist_o_2" style="margin-bottom:0px"></div>
            <div class="txt_row_head_o">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_responsive">PLAYLIST</div> 
            <div class="txt_row_head_o">RANKING</div>
            <div class="txt_row_responsive">RANKING</div> 
            <div class="txt_row_head_o">NIVEL</div>
            <div class="txt_row_responsive">NIVEL</div> 
            <div class="txt_row_head_o">SEGUIDORES</div>
            <div class="txt_row_responsive">SEGUIDORES</div> 
            {{-- <div class="txt_row_head_o">GANANCIAS</div>
            <div class="txt_row_responsive">GANANCIAS</div>  --}}
        </div>
    
    <!--estos divs se crean con un foreach-->
    @php
        $i=0;
    @endphp
    @foreach ($playlists_registradas as $playlist)
    <hr class="hr_100_o">
        <div id="{{$playlist->id}}" class="table_row_o table_noBorder">
            <img class="img_playlist_o" src="{{$playlist->images[0]->url}}" alt=""> 
            <p class="p_responsivep">PLAYLIST</p>
            <div class="txt_row_play_o">{{$playlist->name}}</div> 
            <p class="p_responsivep">RANKING</p>
            <div class="txt_row_play_o">{{$playlists_bd[$i]->tier}}</div> 
            <p class="p_responsivep">NIVEL</p>
            <div class="txt_row_play_o">
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
            <p class="p_responsivep">SEGUIDORES</p>
            <div class="txt_row_play_o">{{$playlist->followers->total}}</div> 
            {{-- <p class="p_responsivep">GANANCIAS</p>
            <div class="txt_row_play_o">${{$playlists_bd[$i]->profits}}</div> --}}
        </div>
    @php
        $i++;
    @endphp
    @endforeach
    
    </div>
</div>
<div class="div_CabeceraApartado" >
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/match.png" alt="">&nbsp;&nbsp;Canciones con match</p>
    </div>
    <a href="{{route('reviewsPendientes')}}" class="resize-btn-agregar btn-solicitudesC">Solicitudes</a>
</div>  
<div class="div_90_o"> 
    <div class="div_content_o">
        <div class="table_head_o">
            {{-- <div class="img_playlist_o_2" style="margin-bottom:0px"></div> --}}
           <div class="txt_row_head_o">NOMBRE DE LA CANCIÓN</div> 
           <div class="txt_row_responsive">CANCIÓN</div> 
           <div class="txt_row_head_o">PLAYLIST</div>
           <div class="txt_row_responsive">PLAYLIST</div> 
           <div class="txt_row_head_o">ARTISTA</div> 
           <div class="txt_row_responsive">ARTISTA</div>  
           <div class="txt_row_head_o">TOKENS</div>
           <div class="txt_row_responsive">TOKENS</div> 
           <div class="txt_row_head_o">ESTATUS</div> 
           <div class="txt_row_responsive">ESTATUS</div> 
        </div>
    @php
        $i=0
    @endphp
    @foreach ($songsSpoty as $song)
    <hr class="hr_100_o">
    <div class="table_row_o table_noBorder" style="border:none">
        <img class="img_playlist_o_match" src="{{$song->album->images[0]->url}}" alt=""> 
        <p class="p_responsivep">CANCIÓN</p>
        <div class="txt_row_play_o">{{$song->name}}</div> 
        <p class="p_responsivep">PLAYLIST</p>
        <div class="txt_row_play_o">{{$plnames[$i]}}</div> 
        <p class="p_responsivep">ARTISTA</p>
        <div class="txt_row_play_o">{{$song->artists[0]->name}}</div>  
        <p class="p_responsivep">TOKENS</p>
        <div class="txt_row_play_o">{{$songs[$i]->cost}}</div>
        <p class="p_responsivep">ESTATUS</p>
        <div class="txt_row_play_o">{{$songs[$i]->status}}</div> 
    </div>
        @php
            $i++;
        @endphp
    @endforeach
    
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
                <div class="div_tokens_botones">
                    <a class="a_cancelarTokens close" style="color: #8177F5 !important;" data-dismiss="modal">Cancelar</a>
                    <button class="a_comprarTokens" type="submit">Agregar</button>  
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
      <form action="{{route('relogin')}}" method="POST">
          @csrf
          <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
          <button type="submit" id="a_error_o" class="inicio-spotybtn">
              <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
          </button>
      </form>
  </div>
@endif
@endsection