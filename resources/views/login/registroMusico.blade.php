<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - Músico</title>
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
                    <img src="{{ asset('/img/logos/logo.png') }}">
                </td>
                <td align="right">
                    <button onclick="location.href='{{route('login')}}';" class="login-button">Ingresar</button>
                    <button onclick="location.href='{{route('register')}}';" class="login-button active">Registrarme</button>
                </td>
            </tr>
        </table>
        <p class="login-text">Registrate para ser parte de Playlisthub</p>
        <p class="login-text2">Conectamos artistas con influencers y curadores</p>
        <p class="login-text3">¿Ya tienes una cuenta? <a href="">Ingresar aquí</a></p>

        <div class="cuadro-formulario">
            <div class="button-cuadro-form" style="width:100%; align-content:center;">
                <button class="login-button active">Músico</button>
                <button onclick="location.href='{{route('register')}}'" class="login-button noactive">Curador</button>
            </div>
            <p class="form-text">Registrate aquí para que tu música sea escuchada por los curadores de playlist y creadores de contenido</p>
            <form class="login-form" action="">
                <div class="form-element">
                    <span style="width: 100% !important;">INICIA SESIÓN CON TU CUENTA DE SPOTIFY (Obligatorio)</span>
                    <a href="{{route('regMusicianSpoty')}}" class="button-spoty"> <img src="{{ asset('/img/iconos/spotify.png')}}"></a>
                    <p class="texto-inicio-sesion error">
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                {{$error}}
                            @endforeach
                        @endif 
                    </p>
                </div>
                <div class="espacio-inter"></div>
            </form>
        </div>

        <p class="login-text4">Al hacer clic en "Registrarme", aceptas nuestros Términos y condiciones, asi como el Aviso de privacidad. Es posible que te enviemos notificaciones por correo electrónico.</p>
        <div class="espacio-inter" style="margin-top:42px"></div>
    </div>

    @include('subview.footer')
    
</body>
</html>