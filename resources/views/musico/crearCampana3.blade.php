@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
@endsection

@section('menu')
    Campañas
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src={{asset("img/iconos/plusGris.png")}} alt="">
        <div class="p_title_o">&nbsp;&nbsp;Agregar campaña</div>
    </div>
    <div class="crearCampana_pasos">Paso 3 de 3</div>
    <hr class="hr_100_o">
    <div class="div_campana_info_o">
        <div class="campana_info_0">
            <img class="campana_info_3_img" src="{{$data['song_image']}}" alt="">
        </div>
        <div class="campana_info_1">
            <div class="vercampana_title_o">NOMBRE DE LA CANCION</div>
            <div class="vercampana_txt_o">{{Str::limit($data['song_name'], 27)}}</div>
            <div class="vercampana_title_o">LINK DE SPOTIFY</div>
            <a href="{{$data['song_link']}}" target="_blank" class="vercampana_a_o">{{Str::limit($data['song_link'], 27 )}}</a>
            <div class="vercampana_title_o">NOMBRE DEL ARTISTA</div>
            <div class="vercampana_txt_o">{{Str::limit($data['song_artist'], 27)}}</div>
            <div class="vercampana_title_o">FECHA DE INICIO</div>
            <div class="vercampana_txt_o">
                @php
                    $separa=explode("-",$data['date']);
                    $anio=$separa[0];
                    $mes=$separa[1];
                    $dia=explode(" ",$separa[2]);
                    $dia=$dia[0];
                @endphp
                {{$dia}}&nbsp;-
                @switch($mes)
                    @case('01')Enero @break
                    @case('02')Febrero @break
                    @case('03') Marzo @break
                    @case('04')Abril @break
                    @case('05')Mayo @break
                    @case('06')Junio @break
                    @case('07')Julio @break
                    @case('08')Agosto @break
                    @case('09')Septiembre @break
                    @case('10')Octubre @break
                    @case('11')Noviembre @break
                    @case('12')Diciembre @break
                @endswitch-
                {{$anio}}
            </div>
            {{-- <div class="vercampana_title_o">CÓDIGO DE REFERENCIA</div>
            <div class="vercampana_txt_o"></div> --}}
        </div>
        <div class="campana_info_2">
            <div class="vercampana_title_o">TOKENS</div>
            <div class="vercampana_txt_o">{{$data['tokens']}}</div>
            <div class="vercampana_title_o">NOMBRE DE LA PLAYLIST</div>
            <a href="{{$data['playlist_url']}}" target="_blank" class="vercampana_a_o">{{Str::limit($data['playlist_name'],27)}}</a>
            <div class="vercampana_title_o">NOMBRE DEL CURADOR</div>
            <div class="vercampana_txt_o" href="#"> {{Str::limit($data['curator_name'],27)}} </div>
            <div class="vercampana_title_o">FECHA DE TERMINO</div>
            <div class="vercampana_txt_o">Dos semanas después de haber sido aceptada.*</div>
        </div>
        <div class="campana_info_3">
            <img class="campana_info_3_img" src="{{$data['song_image']}}" alt="">
        </div>
        <div class="crearCampana_botones">
            <a class="a_cancelar_o" href="{{Route('crearCampana2')}}">Regresar</a>
            <form action="{{Route('storeCamp')}}" method="POST">
                @csrf
                <input name="start_date" type="text" value="{{$data['date']}}" hidden readonly='readonly'>
                <input name="link_song" type="text" value="{{$data['song_link']}}" hidden readonly='readonly'>
                <input name="playlist_id" type="text" value="{{$data['playlist_id']}}" hidden readonly='readonly'>
                
                <button class="a_continuar_o" type="submit">Confirmar</button>
            </form>
        </div>
    </div>
</div>
@endsection