@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
@endsection

@section('menu')
@foreach ($usuario as $user)  
    {{ $user -> name }}
@endforeach
@endsection

@section('contenido')
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @if (!$error) --}}
    <div class="div_perfilMusico">
        <div class="div_CabeceraApartado"> 
            <div class="div_tituloApartado">
                <p><i class="fas fa-user-circle" style="color:#5C5C5C"></i>&nbsp;&nbsp;Datos generales</p>
            </div>
            <a href="{{route('administrar-cuenta')}}" style="color: #8177F5"><i class="fas fa-cog"></i>&nbsp;&nbsp;Administrar tu cuenta</a>
        </div>  
        @foreach ($usuario as $user)  
        <div class="div_infoPerfilM">
            <div class="div_fotoPerfilM">
                <img src="{{ $user ->avatar}}"> 
            </div>
            <div class="div_txtPM">
                
                <p class="txt-infoNombrePM">{{ $user -> name }}</p>
                <p class="txt-infoUserP">Curador</p>
                <p class="txt-informacionP">{{ $user -> country }}</p>   
                <p class="txt-informacionP">Miembro desde el&nbsp;{{ \Carbon\Carbon::parse($user->created_at)->format('Y')}}</p>
                @endforeach
            </div>
        </div>

        <div class="div_CabeceraApartado" style="margin-top:40px">
            <div class="div_tituloApartado resize_tituloApartado">
                <p><img class="img_ico_title_o" src="/img/iconos/playlist.png" alt="">&nbsp;&nbsp;Playlists actuales</p>
            </div>
            <a href="#" class="resize-btn-agregar"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
        </div>

        
    </div>
{{-- @else
    <div class="div_error_o">
        <div class="txt_error_o">Tu token de acceso ha expirado, por favor presiona el siguiente botón.</div>
        <a href="http://127.0.0.1:8000/login/spotify" id="a_error_o" class="inicio-spotybtn">
            <img src="http://127.0.0.1:8000/img/iconos/sp white.png">  
        </a>
    </div>
@endif --}}
@endsection