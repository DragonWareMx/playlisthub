@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
@endsection

@section('menu')
    Favoritos
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="ico_title_o">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="18" height="18" fill="url(#pattern0)"/>
            <defs>
                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0" transform="scale(0.00416667)"/>
                </pattern>
            <image id="image0" width="240" height="240" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
        <div class="p_title_o">&nbsp;&nbsp;Tus curadores favoritos</div>
    </div>
    <hr class="hr_100_o">
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
                    @php
                        $total=$fav['average'];
                    @endphp
                    @for ($i = 0; $i < 5; $i++)
                        @if ($total>=1)
                            <img class="favs_star_o" src="img/iconos/star review.png" alt="">
                            @php
                              $total--;  
                            @endphp
                        @else 
                            @if ($total<1 && $total>=0.5)
                                <img class="favs_star_o" src="img/iconos/star review 2.png" alt="">
                                @php
                                $total-=$total;  
                                @endphp
                            @else 
                                <img class="favs_star_o" src="img/iconos/reviews.png" alt="">
                            @endif
                        @endif
                    @endfor
                </div>
            </div>
            <div class="div_width100_right"><a class="a_profile_o" href="#">Ver perfil</a></div>
        </div>
    @endforeach
</div>
    
@endsection