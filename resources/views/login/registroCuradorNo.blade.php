<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/L.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css">
    <link rel="icon" href="{{asset('/img/logos/ico-playlist.png')}}" type="image/icon type">
</head>
<body>
    <div class="principal-screen">
        <table class="encabezado">
            <tr>
                <td align="left">
                    <a href="{{route('login')}}"><img src="{{ asset('/img/logos/logo.png') }}"></a>
                </td>
                <td align="right">
                    <button onclick="location.href='{{route('login')}}';" class="login-button">Ingresar</button>
                    <button onclick="location.href='{{route('register')}}';" class="login-button active button-registrarme">Registrarme</button>
                </td>
            </tr>
        </table>
        <p class="login-text">Registrate para ser parte de Playlisthub</p>
        <p class="login-text2">Conectamos artistas con influencers y curadores</p>
        <p class="login-text3">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Ingresar aquí</a></p>

        <div class="cuadro-formulario">
            <div class="button-cuadro-form" style="width:100%; align-content:center;">
                <button onclick="location.href='{{route('register2')}}'" class="login-button noactive button-selecters">Músico</button>
                <button class="login-button active button-selecters">Curador</button>
            </div>
            <p class="form-text">Monetiza tu playlist de spotify y ayuda a miles de músicos independientes a promocionar su música</p>
            <form class="login-form" action="">
                @csrf
                <div class="form-element">
                    <span style="width: 100% !important;">INICIA SESIÓN CON TU CUENTA DE SPOTIFY (Obligatorio)</span>
                    <a href="{{ route('regCuradorSpoty') }}" class="button-spoty"> <img src="{{ asset('/img/iconos/spotify.png')}}"></a>
                    <p class="texto-inicio-sesion">  </p>
                </div>
                <div class="espacio-inter" style="margin-top: 1px"></div>
                <div class="espacio-inter" style="margin-top: 1px"></div>
                <p class="msg-spoty-denied">
                    Lo sentimos, no puedes convertirte en curador de Playlisthub
                </p>
            </form>
        </div>

        <div class="espacio-inter" style="margin-top:42px"></div>
    </div>

    @include('subview.footer')
    
</body>
</html>