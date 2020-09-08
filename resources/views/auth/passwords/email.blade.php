<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
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
        <p class="login-text">¿Olvidaste tu contraseña?</p>
        <p class="login-text2">Recuperar contraseña</p>

        <div class="cuadro-formulario-login">
            <div class="button-cuadro-form" style="width:100%; align-content:center;">
                <button class="login-button active">Músico</button>
                <button class="login-button">Curador</button>
            </div>
            <form class="login-form" style="margin-bottom: 0px" method="POST" action="{{ route('password.email') }}">
                @csrf
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

    <footer class="footer-main">   
        <div class="footer-left">
            <a href="" class="footer-logos-izquierda" style="margin-left: auto;margin-right:55px">
                <img src="{{ asset('/img/iconos/facebook.png') }}" width="36px" height="36px">        
            </a>
        </div>
        <div class="footer-right">
            <a href="" class="footer-logos-derecha" style="margin-left: 55px;margin-right:auto">
                <img src="{{ asset('/img/iconos/instagram.png') }}" width="36px" height="36px"> 
            </a> 
        </div>
        <div class="footer-left">
            <span class="footer-text" style="margin-left: auto;margin-right:45px;font-weight: bold;">Ingresar</span>
        </div>
        <div class="footer-right">
            <span class="footer-text" style="margin-left: 45px;margin-right:auto;font-weight: bold;">Aplicar</span>
        </div>
        <div class="footer-left">
            <span class="footer-text" style="margin-left: auto;margin-right:25px">Aviso de privacidad</span>
        </div>
        <div class="footer-right">
            <span class="footer-text" style="margin-left: 25px;margin-right:auto">Términos y condiciones</span>    
        </div> 
        <div class="footer-left">
            <span class="footer-text" style="margin-left: auto;margin-right:10px">Copyright © 2020 Playlisthub</span>
        </div>
        <div class="footer-right">
            <span class="footer-text" style="margin-left: 10px;margin-right:auto">Desarrollado por DragonWare</span>    
        </div>    
    </footer>
    
</body>
</html>