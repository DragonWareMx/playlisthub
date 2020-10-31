@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
@endsection

@section('menu')
    Inicio
@endsection

@section('contenido')
@if ($error==false || !session()->get('expired'))
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado ">
        <p><img class="img_ico_title_o" src="img/iconos/ganancias.png" alt="">&nbsp;&nbsp;Ganancias</p>
    </div>
</div>
<div class="div_90_o">
    <div class="div_content_o">
        <p class="txt_total">${{$total}} dolares de ganancias totales</p>
        @if($saldo!=null)
        <p class="txt_content_ganancias">Tienes un saldo de ${{$saldo}}, para poder hacer el cobro debes llegar a la cantidad de 10 dolares</p>
        @else
        <p class="txt_content_ganancias">Tienes un saldo de 0, para poder hacer el cobro debes llegar a la cantidad de 10 dolares</p>
        @endif
        @if ($saldo>=10)
        <div style="float:left; border: 0.3px solid #c0c0c0; padding: 5px; border-radius: 5px; ">
            <a href="{{Route('charge')}}" style="Font-family:'Roboto'; Font-size: 13px; sans-serif; color: #819df8">
                <i class="fas fa-wallet"></i>&nbsp;&nbsp;Solicitar pago
            </a>        
        </div>
        @endif
        
    </div>
    
</div>

<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/playlist.png" alt="">&nbsp;&nbsp;Tus playlist activas</p>
    </div>
    <a href="#" data-toggle="modal" data-target="#addModal" class="resize-btn-agregar"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
</div>
 
<div class="div_90_o">
    @if (sizeOf($playlists_registradas)>0)
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
            <a href="{{$playlist->external_urls->spotify}}"  target="_blank" class="txt_row_play_o a_row_play_o"> {{$playlist->name}} </a> 
            <p class="p_responsivep">RANKING</p>
            <div class="txt_row_play_o">{{$playlists_bd[$i]->tier}}</div> 
            <p class="p_responsivep">NIVEL</p>
            <div class="txt_row_play_o">
                @php
                   if($user->premium == 1) $nivel="Premium";
                   else{
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
                   }
                @endphp
                nivel {{$nivel}} 
            </div>
            <p class="p_responsivep">SEGUIDORES</p>
            <div class="txt_row_play_o">{{$playlist->followers->total}}</div> 
        </div>
    @php
        $i++;
    @endphp
    @endforeach
    
    </div>
    @else 
        <div class="div_error_o">
            <div class="txt_error_o">No tienes playlists activas.</div>
        </div>
    @endif
</div>

<!--MODAL de agregar playlist-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content modalPlaylist" >
         
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
            <div class="txt_modal_left">Selecciona la playlist que deseas agregar</div>
           
            @php
                $i=0; 
                $control=true;
            @endphp
            @foreach ($playlists as $playlist)
                @if ($followers[$i]>500)
                    <div id="{{$playlist->id}}" class="div_playlist_modal" value="">
                        <div class="div_img_modal"><img class="img_modal" src="{{$playlist->images['0']->url}}" alt=""></div>  
                        <div class="txt_row">{{$playlist->name}}</div> 
                        <div class="txt_row">{{$followers[$i]}}&nbsp;seguidores</div>
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
    $('.a_cancelarTokens').on('click', function(){
        $('.div_playlist_modal').css('border-color',' #c0c0c0');
        $('#link_pl').val(null);
        click=false;
        control="";
    });
    //para seleccionar el div de la playlist que se elegira
    $('.div_playlist_modal').on('click', function () {
        if(click){
            if(control==this.id){
                $(this).css('border-color','#c0c0c0');
                $('#link_pl').val(null);
                click=false;
                control="";
            }
            else{
                $(this).css('border-color','#8177F5');
                $(this).css('border-width','2px');
                $('#'+control+"").css('border-color','#c0c0c0');
                $('#link_pl').val(this.id);
                control=this.id;
                click=true;
            }  
        }
        else{
            $(this).css('border-color','#8177F5');
            $(this).css('border-width','2px');
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
            <img src="{{ asset('img/iconos/sp white.png') }}">  
        </button>
    </form>
</div>
@endif
@endsection