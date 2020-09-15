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
    {{-- REALIZAR REVIEW/REVISAR SOLICITUD --}}
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="/img/iconos/escribir.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Realizar review</div>
    </div>

    <hr class="hr_100_o">

    <form id="form_review" method="post" action="mailto://test@test.com" style="width: 100%">
        <div class="reviews_list">
            {{-- REVIEW A LA PLAYLIST / VISTA DE MÚSICO --}}
            <div class="review_item">
                {{-- CONTENIDO DE LA REVIEW --}}
                <div class="review_content">
                    {{-- NOMBRES --}}
                    <div class="review_content_names">
                        <div class="review_content_names_name">
                            <div class="m_r"><a href="#" style="color: #8177F5;">Ver campaña</a></div>
                        </div>
                    </div>

                    {{-- CALIFICACION Y FECHA --}}
                    <div class="review_content_sd r_p">
                        {{-- ESTRELLAS --}}
                        <div id="half-stars-example" class="d_m">
                            <div class="rating-group" style="display: inline-flex;">
                                <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-05" value="0.5" type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">
                                <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-15" value="1.5" type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">
                                <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-25" value="2.5" type="radio" checked>
                                <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">
                                <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-35" value="3.5" type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">
                                <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-45" value="4.5" type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio">
                            </div>
                        </div>
                        {{--
                        <div class="review_content_score">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                        </div>
                    --}}
                        <div class="review_content_date">17 de junio de 2020</div>
                        <div class="review_content_date"><b>Playlist</b> <a href="#">Nombre de la playlist</a></div>
                    </div>

                    {{-- REVIEW --}}
                    <div class="review_content_review r_p" style="margin-bottom: 0px">
                        <textarea name="mensaje" placeholder="Escribe tu review (150 caracteres como mínimo)"></textarea>
                    </div>

                    {{-- REALIZAR REVIEW --}}
                    <div class="review_content_realizar_r_div form_rea_r" style="margin-top: 11px; margin-bottom:22px;">
                        <a href="javascript:{}" onclick="document.getElementById('form_review').submit();" class="review_content_realizar_r">
                            Enviar
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
                            <div class="m_r"><a href="#" style="color: #8177F5;">Nombre de la canción</a></div>
                        </div>
                    </div>
                    {{-- CALIFICACION Y FECHA --}}
                    <div class="review_content_sd r_p">
                        {{-- ESTRELLAS --}}
                        <div class="review_content_score">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                            <img src="/img/iconos/op.png" alt="">
                        </div>
                        <div class="review_content_date"><b>Fecha de solicitud</b> 17 de junio de 2020</div>
                        <div class="review_content_date"><b>Playlist solicitada</b> <a href="#">Nombre de la playlist</a></div>
                        <div class="review_content_date"><b>Tokens</b> 3</div>
                    </div>

                    {{-- ARTISTA --}}
                    <div class="review_content_artista r_p">
                        <p><b>ARTISTA</b></p>
                        <p>Nombre del artista</p>
                        <p><b>LINK DEL ARTISTA</b></p>
                        <a href="https://www.spotify.com/">Link del artista</a>
                    </div>

                    {{-- ESTATUS --}}
                    <div class="review_content_buttons_ar r_p">
                        <input type="radio" class="radio" name="x" value="y" id="y" checked="checked"/>
                        <label for="y">Aceptar</label>
                        <input type="radio" class="radio" name="x" value="z" id="z" />
                        <label for="z">Rechazar</label>
                    </div>

                    {{-- REVIEW --}}
                    <div class="review_content_review r_p" style="margin-bottom: 0px">
                        <textarea name="mensaje" placeholder="Escribe tu review (150 caracteres como mínimo)"></textarea>
                    </div>

                    {{-- REALIZAR REVIEW --}}
                    <div class="review_content_realizar_r_div form_rea_r" style="margin-top: 11px; margin-bottom:22px;">
                        <a href="javascript:{}" onclick="document.getElementById('form_review').submit();" class="review_content_realizar_r">
                            Enviar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection