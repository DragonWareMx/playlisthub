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
                    <img src="{{ asset('/img/logos/logo.png') }}">
                </td>
                <td align="right">
                    <button class="login-button">Ingresar</button>
                    <button class="login-button active">Registrarme</button>
                </td>
            </tr>
        </table>
        <p class="login-text">Registrate para ser parte de Playlisthub</p>
        <p class="login-text2">Conectamos artistas con influencers y curadores</p>
        <p class="login-text3">¿Ya tienes una cuenta? <a href="">Ingresar aquí</a></p>

        <div class="cuadro-formulario">
            <div class="button-cuadro-form" style="width:100%; align-content:center;">
                <button class="login-button">Músico</button>
                <button class="login-button active">Curador</button>
            </div>
            <p class="form-text">Monetiza tu playlist de spotify y ayuda a miles de músicos independientes a promocionar su música</p>
            <form class="login-form" action="">
                <div class="form-element">
                    <span>PAÍS DE RESIDENCIA</span>
                    <select name="" id="">
                        <option value="Mexico" selected>Mexico</option>
                    </select>
                </div>
                <div class="form-element">
                    <span>CORREO ELÉCTRONICO</span>
                    <input type="text" name="" id="">
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>¿CUÁNTOS SEGUIDORES TIENE TU PLAYLIST MÁS GRANDE DE SPOTIFY?</span>
                    <select name="" id="">
                        <option value="Mexico" selected>15</option>
                    </select>
                </div>
                <div class="espacio-inter" style="margin-top: 1px"></div>
                <p class="msg-spoty-approved">
                    ¡Excelente! Parece que calificas para convertirte en curador de Playlisthub <br>
                    Continúa llenando los siguientes campos.
                </p>
                <div class="form-element">
                    <span>NOMBRE COMPLETO</span>
                    <input type="text" name="" id="">
                </div>
                <div class="form-element">
                    <span>GÉNERO</span>
                    <select name="" id="">
                        <option value="Mexico" selected>Hombre</option>
                        <option value="Mexico" selected>Mujer</option>
                        <option value="Mexico" selected>Otro</option>
                    </select>
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>CONTRASEÑA</span>
                    <input type="password" name="" id="">
                </div>
                <div class="form-element">
                    <span>CONFIRMAR CONTRASEÑA</span>
                    <input type="password" name="" id="">
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>FECHA NACIMIENTO</span>
                    <input type="date" name="" id="">
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>INICIA SESIÓN CON TU CUENTA DE SPOTIFY (Obligatorio)</span>
                    <a href="" class="button-spoty"> <img src="{{ asset('/img/iconos/spotify.png')}}"></a>
                    <p class="texto-inicio-sesion">Sesión iniciada con éxito</p>
                </div>
                <div class="form-element">
                    <button class="registro-login">Registrarme</button>
                </div>
            </form>
        </div>

        <p class="login-text4">Al hacer clic en "Registrarme", aceptas nuestros Términos y condiciones, asi como el Aviso de privacidad. Es posible que te enviemos notificaciones por correo electrónico.</p>
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