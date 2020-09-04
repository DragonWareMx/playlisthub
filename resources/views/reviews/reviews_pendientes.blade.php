@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
@endsection

@section('menu')
    Reviews
@endsection

@section('contenido')

<div class="div_90_o" style="max-width: 1059px;">
    {{-- REVIEWS/SOLICITUDES PENDIENTES--}}
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/pendiente.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Reviews pendientes</div>
    </div>

    <hr class="hr_100_o">

    <div class="reviews_list">
        {{-- REVIEW A LA PLAYLIST / VISTA DE MÚSICO --}}
        <div class="review_item">
            {{-- CONTENIDO DE LA REVIEW --}}
            <div class="review_content">
                {{-- NOMBRES --}}
                <div class="review_content_names">
                    <div class="review_content_names_name">
                        <div class="m_r"><a href="#">Nombre de la canción de la campaña</a></div>
                    </div>
                </div>
                {{-- CALIFICACION Y FECHA --}}
                <div class="review_content_sd r_p">
                    {{-- ESTRELLAS --}}
                    <div class="review_content_score">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                    </div>
                    <div class="review_content_date">17 de junio de 2020</div>
                    <div class="review_content_date"><b>Playlist</b> <a href="#">Nombre de la playlist</a></div>
                </div>

                {{-- REVIEW --}}
                <div class="review_content_review r_p" style="margin-bottom: 0px">
                    Sin calificar
                </div>

                {{-- REALIZAR REVIEW --}}
                <div class="review_content_realizar_r_div">
                    <a href="#" class="review_content_realizar_r">
                        Realizar review
                    </a>
                </div>
            </div>
        </div>

        {{-- SOLICITUD DE CANCIÓN / VISTA DE CURADOR --}}
        <div class="review_item">
            {{-- CONTENIDO DE LA REVIEW --}}
            <div class="review_content">
                {{-- NOMBRES --}}
                <div class="review_content_names">
                    <div class="review_content_names_name">
                        <div class="m_r"><a href="#">Nombre de la canción de la campaña</a></div>
                    </div>
                </div>
                {{-- CALIFICACION Y FECHA --}}
                <div class="review_content_sd r_p">
                    {{-- ESTRELLAS --}}
                    <div class="review_content_score">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                    </div>
                    <div class="review_content_date">17 de junio de 2020</div>
                    <div class="review_content_date"><b>Playlist solicitada</b> <a href="#">Nombre de la playlist</a></div>
                    <div class="review_content_date"><b>Tokens</b> 3</div>
                </div>

                {{-- REVIEW --}}
                <div class="review_content_review r_p" style="margin-bottom: 0px">
                    Sin respuesta
                </div>

                {{-- REALIZAR REVIEW --}}
                <div class="review_content_realizar_r_div">
                    <a href="#" class="review_content_realizar_r">
                        Revisar solicitud
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection