<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="{{ asset('/css/L.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/new.css') }}">
    <link rel="icon" href="{{asset('/img/logos/ico-playlist.png')}}" type="image/icon type">
</head>
<body>
    <div class="principal-screen">
        <table class="encabezado">
            <tr>
                <td align="left">
                    <img onclick="location.href='{{route('home')}}';" src="{{ asset('/img/logos/logo.png') }}">
                </td>
                <td align="right">
                    <button onclick="location.href='{{route('login')}}';" class="login-button">Ingresar</button>
                    <button onclick="location.href='{{route('register')}}';" class="login-button active">Registrarme</button>
                </td>
            </tr>
        </table>
        <p class="login-text">¿Olvidaste tu contraseña?</p>
        <p class="login-text2">Recuperar contraseña</p>

        <div class="cuadro-formulario-login">
            <div class="button-cuadro-form" style="width:100%; align-content:center;">
                <img class="login-button active" src="{{ asset('/img/logos/logo-white.png') }}" alt="" 
                style="background-color: #8177F5;cursor:default;">
            </div>
            <form class="login-form" style="margin-bottom: 0px" method="POST" action="{{ route('password.email') }}">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success" role="alert" style="font-family: Roboto; color:#8177f5">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-element login">
                    <span>CORREO ELÉCTRONICO</span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color: firebrick">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="espacio-inter"></div>
                <p class="text-forgot">
                    Se enviará un mensaje a su correo electrónico con un enlace para restaurar la contraseña
                </p>
                
                <div class="form-element login">
                    <button type="submit" class="inicio-sesionbtn">Enviar Correo</button>
                </div>
            </form>
            <p class="login-text-opcion">o ingresa con</p>
            <hr>
            <div class="login-form" style="padding-top: 0px">
                <div class="form-element login">
                    <button class="inicio-spotybtn">
                        <img src="{{ asset('/img/iconos/sp white.png') }}">
                    </button>
                </div>
            </div>
        </div>

        <div class="espacio-inter" style="margin-top:42px"></div>
    </div>

    @include('subview.footer')
</body>
</html>