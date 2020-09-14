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

@php
    use Carbon\Carbon;
@endphp

<div class="div_90_o" style="max-width: 1059px;">
    {{-------------------------- REVIEWS RECIBIDAS --------------------------}}
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/reviews.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Reviews recibidas</div>
    </div>

    {{-- ESTRELLAS (CALIFICACIÓN) --}}
    <div href="#" class="review_calificacion">
        {{-- CALIFICACION DEL MÚSICO/CURADOR--}}
        <div class="review_calificacion_item">
            {{-- CALIFICACION --}}
            <div class="p_review p_review_bold" style="margin-right: 5px;">{{ $calificacion }}</div>
            {{-- ESTRELLAS --}}
            @for ($i = 0; $i < 5; $i++)
                @if ($calificacion>=1)
                    <img class="img_review" src="img/iconos/star review.png" alt="">
                    @php
                    $calificacion--;  
                    @endphp
                @else 
                    @if ($calificacion<1 && $calificacion>=0.5)
                        <img class="img_review" src="img/iconos/star review 2.png" alt="">
                        @php
                        $calificacion-=$calificacion;  
                        @endphp
                    @else 
                        <img class="img_review" src="img/iconos/op.png" alt="">
                    @endif
                @endif
            @endfor
            {{--<img class="img_review" src="img/iconos/star review.png" alt="">
            <img class="img_review" src="img/iconos/star review.png" alt="">
            <img class="img_review" src="img/iconos/star review 2.png" alt="">
            <img class="img_review" src="img/iconos/op.png" alt="">
            <img class="img_review" src="img/iconos/op.png" alt="">--}}
        </div>

        {{-- NUMERO DE REVIEWS --}}
        <div class="review_calificacion_item review_calificacion_item_margin">
            <img class="img_review" src="img/iconos/user.png" alt="">
            <div class="p_review">{{ $numReviews }} en total</div>
        </div>
    </div>

    <hr class="hr_100_o">

    @php
        //contador para identificar los contenidos / sirve para el funcionamiento del boton leer mas
        $contador = 1;
    @endphp

    <div class="reviews_list">
        {{-- !!!!!!!!!!! EN ESTA PARTE MAXIMO DEBEN APARECER 3 REVIEWS !!!!!!!!!!! --}}

        {{-- si el usuario es del tipo musico / si es falso entonces es de curador--}}
        @if($tipo)
            @foreach ($reviews as $review)
                {{-- REVIEW DEL CURADOR / VISTA DE MÚSICO --}}
                <div class="review_item">
                    {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
                    <div class="review_img">
                        <img src="img/iconos/perfil.png" alt="">
                    </div>

                    {{-- CONTENIDO DE LA REVIEW --}}
                    <div class="review_content">
                        {{-- NOMBRES --}}
                        <div class="review_content_names">
                            {{-- NOMBRE DEL CURADOR --}}
                            <div class="review_content_names_name autor"><a href="#">{{ $review->user->name }}</a></div>
                            {{-- NOMBRE DE CANCION --}}
                            <div class="review_content_names_name">
                                {{-- conexion con spotify --}}
                                @php
                                    $access_token=session()->get('access_token');
                                    //Se extrae el id de la canción 
                                    $song_id=trim($review->camp->link_song,);
                                    $song_id=str_replace('https://open.spotify.com/track/','',$song_id);
                                    if(substr($song_id, 0, strpos($song_id, "?"))){
                                        $song_id = substr($song_id, 0, strpos($song_id, "?"));
                                    }
                                    //Se hace la conexión con la api de spotify
                                    $url='https://api.spotify.com/v1/tracks/'.$song_id.'?access_token='.$access_token;
                                    $conexion=curl_init();
                                    curl_setopt($conexion, CURLOPT_URL, $url);
                                    curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
                                    curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                    curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
                                    $song= curl_exec($conexion);
                                    curl_close($conexion);
                                    $song=json_decode($song);
                                @endphp
                                <div class="m_r"><a href="{{ $review->camp->link_song }}" target="_blank">{{Str::limit($song->name, 48)}}</a></div>
                            </div>
                        </div>

                        {{-- CALIFICACION Y FECHA --}}
                        <div class="review_content_sd">
                            {{-- ESTRELLAS --}}
                            <div class="review_content_score m_f">
                                @php
                                    $total = $review->rating;
                                @endphp 
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($total>=1)
                                        <img src="img/iconos/star review.png" alt="">
                                        @php
                                        $total--;  
                                        @endphp
                                    @else 
                                        @if ($total<1 && $total>=0.5)
                                            <img src="img/iconos/star review 2.png" alt="">
                                            @php
                                            $total-=$total;  
                                            @endphp
                                        @else 
                                            <img src="img/iconos/op.png" alt="">
                                        @endif
                                    @endif
                                @endfor
                                {{--<img src="img/iconos/reviews.png" alt="">
                                <img src="img/iconos/reviews.png" alt="">
                                <img src="img/iconos/reviews.png" alt="">
                                <img src="img/iconos/op.png" alt="">
                                <img src="img/iconos/op.png" alt="">--}}
                            </div>
                            @php
                                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                $fecha = Carbon::parse($review->date);
                                $mes = $meses[($fecha->format('n')) - 1];
                            @endphp 
                            <div class="review_content_date s_m">{{ $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') }}</div>
                            <div class="review_content_date s_m"><b>Estatus</b> {{ $review->camp->status }}</div>
                        </div>
                        {{-- REVIEW --}}
                        <div class="review_content_review">
                            @if (strlen($review->comment) < 387)
                                {{ $review->comment }}
                            @else
                                {{ substr($review->comment, 0, 387) }}<span id="dots{{$contador}}">...</span><span id="more{{$contador}}" style="display: none;">{{ substr($review->comment, 387) }}</span>
                                <a href="#" onclick="leermas({{$contador}})" id="leermasbtn{{$contador}}" class="btnLeerMas">leer más</a>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $contador++;    
                @endphp

                @if ($contador == 4)
                    @php
                        break;
                    @endphp
                @endif

            @endforeach
        @else
            {{-- REVIEW DEL MÚSICO / VISTA DE CURADOR --}}
            <div class="review_item">
                {{-- IMG PERFIL QUE HIZO LA REVIEW --}}
                <div class="review_img">
                    <img src="img/iconos/perfil.png" alt="">
                </div>

                {{-- CONTENIDO DE LA REVIEW --}}
                <div class="review_content">
                    {{-- NOMBRES --}}
                    <div class="review_content_names">
                        <div class="review_content_names_name autor"><a href="#">Nombre completo del músico</a></div>
                        <div class="review_content_names_name">
                            <div class="m_r"><b>Playlist </b><a href="#">Nombre de la playlist</a></div>
                        </div>
                    </div>
                    {{-- CALIFICACION Y FECHA --}}
                    <div class="review_content_sd">
                        {{-- ESTRELLAS --}}
                        <div class="review_content_score m_f">
                            <img src="img/iconos/reviews.png" alt="">
                            <img src="img/iconos/reviews.png" alt="">
                            <img src="img/iconos/reviews.png" alt="">
                            <img src="img/iconos/op.png" alt="">
                            <img src="img/iconos/op.png" alt="">
                        </div>
                        <div class="review_content_date s_m">17 de junio de 2020</div>
                    </div>
                    {{-- REVIEW --}}
                    <div class="review_content_review">
                        Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla... <a href="#">leer más</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- VER MÁS --}}
    <div style="width:100%; margin-top:21px;">
        <a class="a_derecha_o" style="width: fit-content" href="#">Ver más</a>
    </div>

    {{-------------------------- REVIEWS REALIZADAS --------------------------}}
    <div style="margin-top:30px;" class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/overtime.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Reviews realizadas</div>
    </div>

    {{-- ESTRELLAS (CALIFICACIÓN) --}}
    <div href="#" class="review_calificacion" style="margin-top:30px;">
        {{-- PENDIENTES(MUSICO)/SOLICITUDES(CURADOR) --}}
        <div class="review_calificacion_item">
            <a href="#">Pendientes</a>
        </div>

        {{-- NUMERO DE REVIEWS --}}
        <div class="review_calificacion_item review_calificacion_item_margin">
            <img class="img_review" src="img/iconos/user.png" alt="">
            <div class="p_review">25 en total</div>
        </div>
    </div>

    <hr class="hr_100_o">

    <div class="reviews_list">
        {{-- !!!!!!!!!!! EN ESTA PARTE MAXIMO DEBEN APARECER 3 REVIEWS !!!!!!!!!!! --}}

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
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                    </div>
                    <div class="review_content_date">17 de junio de 2020</div>
                    <div class="review_content_date"><b>Playlist</b> <a href="#">Nombre de la playlist</a></div>
                </div>
                {{-- REVIEW --}}
                <div class="review_content_review r_p">
                    Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla
                </div>
            </div>
        </div>

        {{-- REVIEW A LA CANCIÓN / VISTA DE CURADOR --}}
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
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/reviews.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                        <img src="img/iconos/op.png" alt="">
                    </div>
                    <div class="review_content_date">17 de junio de 2020</div>
                    <div class="review_content_date"><b>Estatus</b> Aceptada</div>
                </div>
                {{-- REVIEW --}}
                <div class="review_content_review r_p">
                    Descripción del review Lorem ipsum dolor sit amet consectetur adipiscing elit risus, class enim laoreet senectus suspendisse suscipit nascetur, aliquet pellentesque vivamus ultricies eros rutrum scelerisque. Quam nostra aliquam praesent scelerisque libero vitae sed tellus, pharetra semper elementum varius aliquet pretium a volutpat, aptent mauris fusce eu mollis sem lectus. Fringilla
                </div>
            </div>
        </div>
    </div>

    {{-- VER MÁS --}}
    <div style="width:100%; margin-top:21px; margin-bottom:21px;">
        <a class="a_derecha_o" style="width: fit-content" href="#">Ver más</a>
    </div>
</div>

<script>
    function leermas(numero) {
        var dots = document.getElementById("dots"+numero);
        var moreText = document.getElementById("more"+numero);
        var btnText = document.getElementById("leermasbtn"+numero);

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "leer mas";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "leer menos";
            moreText.style.display = "inline";
        }
    }

    $('a.btnLeerMas').click(function(e)
    {
        // Special stuff to do when this link is clicked...

        // Cancel the default action
        e.preventDefault();
    });
</script>
@endsection