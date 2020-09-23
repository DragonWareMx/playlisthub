@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css"> 
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
@endsection

@section('menu')
    Campañas
@endsection

@section('contenido')
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src={{asset("img/iconos/plusGris.png")}} alt="">&nbsp;&nbsp;Agregar campaña</p>
    </div>
    <a style="border:none; background-color:transparent"><b>Paso 2 de 3</b></a>
</div>
<div class="div_90_o">
    <div class="div_content_o">
        <div class="encabezado_paso_2">
            <div class="txt_izquierda_o">Seleciona la playlist en la que deseas ubicar tu campaña (Las playlists estan ordenadas por coincidencias para tu campaña).</div>
            <div class="txt_derecha_o">Tokens totales: {{$user->tokens}} </div>
        </div>
        <div class="table_head_o">
            <div class="img_playlist_o_2" style="margin-bottom:0px"></div> <div class="txt_row_head_o">NOMBRE DE LA PLAYLIST</div>
            <div class="txt_row_head_o">CURADOR</div> <div class="txt_row_head_o"># DE SEGUIDORES</div> 
            <div class="txt_row_head_o">TOKENS REQUERIDOS</div>
        </div>
        <hr class="hr_100_o" style="margin-top:0px;">
        @foreach ($playlists as $playlist)
        <button id="{{$playlist['id']}}" class="table_row_o" onclick="selectPlaylist(this.id,{{$playlist['cost']}},{{$user->tokens}},{{$playlist['curator_id']}})">
            <img class="img_playlist_o" src="{{$playlist['image']}}" alt=""> 
            <a href=" {{$playlist['url']}} "  target="_blank" class="txt_row_play_o a_row_play_o"> {{$playlist['name']}} </a> 
            <div class="txt_row_play_o"> {{$playlist['curator_name']}} </div> 
            <div class="txt_row_play_o"> {{$playlist['followers']}} </div>
            <div class="txt_row_play_o"> {{$playlist['cost']}} </div>
        </button> 
        @endforeach
        <div id="notEnoughTokens" class="txt_izquierda_o txt_italic_14" style="margin-top:40px;" hidden>Numero de tokens insuficientes <a class="a_comprar_o" href="{{Route('tokens')}}" target='_blank'>comprar tokens</a></div>
        <div id="enoughTokens" class="crearCampana_botones"> {{-- botones_margin_subir --}}
            <a class="a_cancelar_o" href="{{url()->previous()}}">Regresar</a>
            <form action="{{Route('crearCampana3')}}" method="POST">
                @csrf
                <input name="link" type="text" value="{{$data->link}}" hidden>
                <input name="image" type="text" value="{{$song->album->images[0]->url}}" hidden>
                <input name="song_name" type="text"value="{{$song->name}}" hidden>
                <input name="song_artist" type="text"value="{{$song->artists[0]->name}}" hidden>
                <input id="selected_playlist" name="selected_playlist" type="text" value required hidden>
                <input id="curator" name="curator" type="text" value="" required hidden>
                <button id="buttonSubmit" type="submit" class="a_continuar_o">Continuar</button> 
            </form>
        </div>
    </div>
</div>
<script>
    function selectPlaylist(id,cost,tokens,curator) {
        document.getElementById('selected_playlist').value=id;
        document.getElementById('curator').value=curator;
        var rows = document.getElementsByClassName('table_row_o');
        for(var i=0; i<rows.length; i++){
            rows[i].style['background-color'] = 'transparent';
        }
        document.getElementById(id).style.backgroundColor="#f8f9fc";
        if(cost > tokens){
            document.getElementById('notEnoughTokens').hidden=false;
            document.getElementById('enoughTokens').classList.add('botones_margin_subir');
            document.getElementById('buttonSubmit').disabled=true;
            document.getElementById('buttonSubmit').style.opacity=0.5;
        }
        else{
            document.getElementById('notEnoughTokens').hidden=true;
            document.getElementById('enoughTokens').classList.remove('botones_margin_subir');
            document.getElementById('buttonSubmit').disabled=false;
            document.getElementById('buttonSubmit').style.opacity=1;
        }
    }
</script>
@endsection