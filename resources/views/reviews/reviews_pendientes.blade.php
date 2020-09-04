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
    {{-- REVIEWS RECIBIDAS --}}
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/pendiente.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Reviews pendientes</div>
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

    <hr class="hr_100_o">

    <div class="reviews_list">
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
                    <div class="review_content_names_name"><a href="#">Nombre completo del curador</a></div>
                    <div class="review_content_names_name">
                        <div class="m_r"><a href="#">Nombre de la canción del review</a></div>
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
                    Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla... <a href="#">leer más</a>
                </div>
            </div>
        </div>

        <div class="review_item">
            {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
            <div class="review_img">
                <img src="img/iconos/perfil.png" alt="">
            </div>

            {{-- CONTENIDO DE LA REVIEW --}}
            <div class="review_content">
                {{-- NOMBRES --}}
                <div class="review_content_names">
                    <div class="review_content_names_name"><a href="#">Nombre completo del curador</a></div>
                    <div class="review_content_names_name">
                        <div class="m_r"><a href="#">Nombre de la canción del review</a></div>
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
                    Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla... <a href="#">leer más</a>
                </div>
            </div>
        </div>

        <div class="review_item">
            {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
            <div class="review_img">
                <img src="img/iconos/perfil.png" alt="">
            </div>

            {{-- CONTENIDO DE LA REVIEW --}}
            <div class="review_content">
                {{-- NOMBRES --}}
                <div class="review_content_names">
                    <div class="review_content_names_name"><a href="#">Nombre completo del curador</a></div>
                    <div class="review_content_names_name">
                        <div class="m_r"><a href="#">Nombre de la canción del review</a></div>
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
                    Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla... <a href="#">leer más</a>
                </div>
            </div>
        </div>
    </div>

    {{-- VER MÁS --}}
    <div style="width:100%; margin-top:21px; margin-bottom:21px;">
        <a class="a_derecha_o" style="width: fit-content" href="{{Route('campanasActuales')}}">Ver más</a>
    </div>
</div>
@endsection