@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">    
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
            <div class="div_width100_right"><a class="a_profile_o" href="{{route('perfil-publico',['id'=>$fav['idsp']])}}">Ver perfil</a></div>
        </div>
    @endforeach
</div>
    
@endsection