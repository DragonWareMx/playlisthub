@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
@endsection

@section('menu')
    Perfil 
@endsection

@section('contenido')
<div class="div_perfilMusico">

    <div class="div_CabeceraApartado">
        <div class="div_tituloApartado">
            <p><i class="fas fa-user-circle" style="color:#5C5C5C"></i>&nbsp;&nbsp;Datos generales</p>
        </div>
        <a class="marcarFav" href="#" style="color: #8177F5; border:none; background-color:transparent"><i style="color: #b1b1b1" class="fas fa-heart"></i>&nbsp;&nbsp;Añadir a favoritos</a>
        <a class="desmarcarFav" href="#" style="color: #8177F5; border:none; background-color:transparent"><i class="fas fa-heart"></i>&nbsp;&nbsp;Desmarcar de favoritos</a>
    </div>

    <div class="div_infoPerfilM">
        <div class="div_fotoPerfilM">
            <img src="{{auth()->user()->avatar}}">
        {{-- <a href="{{route('foto-update')}}"><i class="fas fa-pencil-alt"></i>&nbsp;Cambiar foto</a> --}}
        </div>
        <div class="div_txtPM">
            @foreach ($usuario as $user) 
        <p class="txt-infoNombrePM">{{ $user -> name }}</p>
            <p class="txt-infoUserP">Curador</p>
            <p class="txt-informacionP">{{ $user -> country }}</p>   
            <p class="txt-informacionP">Miembro desde el&nbsp;{{ \Carbon\Carbon::parse($user->created_at)->format('Y')}}</p>
            @endforeach
        </div>
    </div>

    <div class="div_CabeceraApartado" style="margin-top:40px">
        <div class="div_tituloApartado resize_tituloApartado">
            <p><img class="img_ico_title_o" src="img/iconos/playlist.png" alt="">&nbsp;&nbsp;Playlist actuales</p>
        </div>
    </div>

    
    <div class="div_CabeceraApartado" style="margin-top:40px">
        <div class="div_tituloApartado resize_tituloApartado" style="width: 70%">
            <p><img class="img_ico_title_o" src="img/iconos/reviews.png" alt="">&nbsp;&nbsp;Reviews</p>
        </div>

            {{-- ESTRELLAS (CALIFICACIÓN) --}}
        <div href="#" class="review_calificacion">
            {{-- CALIFICACION --}}
            <div class="review_calificacion_item">
                {{-- CALIFICACION --}}
                <div class="p_review p_review_bold" style="margin-right: 5px;">4.6</div>
                {{-- ESTRELLAS --}}
                <img class="img_review" src="img/iconos/star review.png" alt="">
                <img class="img_review" src="img/iconos/star review.png" alt="">
                <img class="img_review" src="img/iconos/star review 2.png" alt="">
                <img class="img_review" src="img/iconos/op.png" alt="">
                <img class="img_review" src="img/iconos/op.png" alt="">
            </div>

            <div class="review_calificacion_item review_calificacion_item_margin">
                {{-- NUMERO DE REVIEWS --}}
                <img class="img_review" src="img/iconos/user.png" alt="">
                <div class="p_review">25 en total</div>
            </div>
        </div>
    </div>

    <div class="reviews_list" style="width: 90%; margin-right:auto; margin-left:auto">
        {{-- REVIEW --}}
        <div class="review_item">
            {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
            <div class="review_img">
                <img src="img/iconos/perfil.png" alt="">
            </div>

            {{-- CONTENIDO DE LA REVIEW --}}
            <div class="review_content">
                {{-- NOMBRES --}}
                <div class="review_content_names">
                    <div class="review_content_names_name">Nombre completo del curador</div>
                    <div class="review_content_names_name">
                        <div class="m_r">Nombre de la canción del review</div>
                    </div>
                </div>
                {{-- CALIFICACION Y FECHA --}}
                <div class="review_content_sd">
                    {{-- ESTRELLAS --}}
                    <div class="review_content_score">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                    </div>
                    <div class="review_content_date">17 de junio de 2020</div>
                </div>
                {{-- REVIEW --}}
                <div class="review_content_review">
                    Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla
                </div>
            </div>
        </div>





</div>

@endsection