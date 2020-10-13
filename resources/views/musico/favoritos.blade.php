@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css"> 
    <link rel="stylesheet" type="text/css" href="/css/Reviews.css">      
@endsection

@section('menu')
    Favoritos
@endsection

@section('contenido')
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/fav.png" alt="">&nbsp;&nbsp;Tus curadores favoritos</p>
    </div>
</div>
<div class="div_90_o">
    @if (sizeOf($favs)>0)
    @foreach ($favs as $fav)
        <div class="div_item_fav_o">
            <div class="div_profile_image_o">
                <img class="img_circle_o" src="{{$fav['avatar']}}" alt="">
                <img class="heart_profile_o" src="img/iconos/marcadofav.png" alt="">
            </div>
            <div class="item_subtitle_o">{{Str::limit($fav['name'], 37)}}</div>
            <div class="item_title_o">PAÍS</div>
            <div class="item_text_o">{{Str::limit($fav['country'], 37)}}</div>
            <div class="item_title_o">PLAYLISTS ACTIVAS</div>
            <div class="item_text_o">{{$fav['playlists']}}</div>
            <div class="item_title_o">REVIEW</div>
            <div class="item_text_o display_flex_o">
                {{$fav['average']}}&nbsp;&nbsp;
                <div class="stars_favoritos_o">
                    <div class="review_content_score">
                        @php
                            $total = $fav['average'];
                        @endphp 
                        @for ($i = 0; $i < 5; $i++)
                            @if ($total>=1)
                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                @php
                                $total--;  
                                @endphp
                            @else 
                                @if ($total<1 && $total>=0.5)
                                    <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                    <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                                    @php
                                    $total-=$total;  
                                    @endphp
                                @else 
                                <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--none fa fa-star"></i></label>
                                @endif
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            <div class="div_width100_right"><a class="a_profile_o" href="{{route('perfil-publico',['id'=>$fav['idsp']])}}">Ver perfil</a></div>
        </div>
    @endforeach
    @else
    <div class="div_error_o">
        <div class="txt_error_o">No tienes curadores favoritos aún.</div>
    </div>
    @endif
</div>
    
@endsection