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
    <a href="{{route('administrar-cuenta')}}" style="color: #8177F5"><i class="fas fa-cog"></i>&nbsp;&nbsp;Administrar tu cuenta</a>
    </div>

    <div class="div_infoPerfilM">
        <div class="div_fotoPerfilM">
            <img src="/img/cat.jpg">
        <a href="{{route('foto-update')}}"><i class="fas fa-pencil-alt"></i>&nbsp;Cambiar foto</a>
        </div>
        <div class="div_txtPM">
            @foreach ($usuario as $user)
        <p class="txt-infoNombrePM">{{ $user -> name }}</p>
            <p class="txt-infoUserP">Músico</p>
            <p class="txt-informacionP">{{ $user -> country }}</p>   
            <p class="txt-informacionP">{{ $user -> email }}</p>
            @endforeach
        </div>
    </div>

    <div class="div_CabeceraApartado" style="margin-top:40px">
        <div class="div_tituloApartado resize_tituloApartado">
            <p><img class="img_ico_title_o" src="img/iconos/campanas.png" alt="">&nbsp;&nbsp;Campañas actuales</p>
        </div>
        <a href="#" style="color: #8177F5; width:10%"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a>
    </div>

    <div class="div_campanasAP">
        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://images.genius.com/2fd19d66c434ba81543c4f8c0a681f8b.959x959x1.jpg');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
        </div>

        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://images-na.ssl-images-amazon.com/images/I/712rrJUrcrL._AC_SL1256_.jpg');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
        </div>

        <div class="div_item_campana_o">
            <div class="img_item_campana_o" style="background-image:url('https://images-na.ssl-images-amazon.com/images/I/81KWwt9-szL._AC_SL1400_.jpg');
            background-size: contain;
            -moz-background-size: cover;
            -o-background-size: cover;
            -webkit-background-size: cover;">
                <div class="campanas_encabezado_cancion_o">
                    {{Str::limit('Nombre de la canción', 39)}}
                </div>
                <div class="campanas_encabezado_artista_o">
                    {{Str::limit('NOMBRE DEL ARTISTA', 39)}}
                </div>
                <div style="width:100%; height:0px;"><img class="img_sp_logo_o" src="img/iconos/sp white logo.png" alt=""></div>
            </div>
            <div class="campana_title_o">TOKENS</div>
            <div class="campana_text_o">25</div>
            <div class="campana_title_o">PLAYLIST</div>
            <div class="campana_text_o">{{Str::limit('Nombre de la playlist', 48)}}</div>
            <div class="campana_title_o">FECHA DE TÉRMINO</div>
            <div class="campana_text_o">20-Agosto-2020</div>
            <a class="a_campana_o" href="{{route('campana', ['id'=>1])}}">Más info.</a>
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