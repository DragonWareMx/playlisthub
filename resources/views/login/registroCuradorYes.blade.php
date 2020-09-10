<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - Curador</title>
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
                <button onclick="location.href='{{route('register2')}} class="login-button">Músico</button>
                <button class="login-button active">Curador</button>
            </div>
            @if($errors->any())
                <div class="alert alert-danger" role="alert" style="background-color: firebrick;width:100%;margin:10px auto 0px auto;padding:10px 0px 10px 0px">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color: white;font-family:Roboto"><strong>{{$error}}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p class="form-text">Monetiza tu playlist de spotify y ayuda a miles de músicos independientes a promocionar su música</p>
            <form class="login-form" id="register-form" action="{{ route('registerCurator') }}" method="POST">
                @csrf
                <input type="hidden" name="spotify_id" value="{{$user->id}}">
                <input type="hidden" name="avatar" value="{{$user->images[0]->url}}">
                <input type="hidden" name="type" value="curador">
                <div class="form-element">
                    <span>INICIA SESIÓN CON TU CUENTA DE SPOTIFY (Obligatorio)</span>
                    <a href="{{ route('regCuradorSpoty') }}" class="button-spoty"> <img src="{{ asset('/img/iconos/spotify.png')}}"></a>
                    <p class="texto-inicio-sesion">Sesión iniciada con éxito</p>
                </div>
                <div class="espacio-inter" style="margin-top: 1px"></div>
                <p class="msg-spoty-approved">
                    ¡Excelente! Parece que calificas para convertirte en curador de Playlisthub <br>
                    Continúa llenando los siguientes campos.
                </p>
                <div class="form-element">
                    <span>CORREO ELÉCTRONICO</span>
                    <input type="email" name="email" id="email" required autocomplete="email">
                </div>
                <div class="form-element">
                    <span>NOMBRE COMPLETO</span>
                    <input type="text" name="name" id="name" value="{{$user->display_name}}">
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>GÉNERO</span>
                    <select name="genero" id="genero" required>
                        <option value="">Selecciona una opción</option>
                        <option value="m">Hombre</option>
                        <option value="f">Mujer</option>
                        <option value="o">Otro</option>
                    </select>
                </div>
                <div class="form-element">
                    <span>FECHA NACIMIENTO</span>
                    <input type="date" name="date" id="date" required>
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>CONTRASEÑA</span>
                    <input type="password" onchange="validatePassword()" name="password" id="password" required>
                </div>
                <div class="form-element">
                    <span>CONFIRMAR CONTRASEÑA</span>
                    <input type="password" onkeyup="validatePassword()" name="password_confirmation" id="confirm_password" required>
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element">
                    <span>PAÍS</span>
                    <select id="country" name="country" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belize">Belize</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Canada">Canada</option>
                        <option value="Canary Islands">Canary Islands</option>
                        <option value="Chile">Chile</option>
                        <option value="Cocos Island">Cocos Island</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Curaco">Curacao</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Falkland Islands">Falkland Islands</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Nevis">Nevis</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Panama">Panama</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="St Barthelemy">St Barthelemy</option>
                        <option value="St Eustatius">St Eustatius</option>
                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                        <option value="St Lucia">St Lucia</option>
                        <option value="St Maarten">St Maarten</option>
                        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                        <option value="Spain">Spain</option>
                        <option value="United States of America">United States of America</option>
                        <option value="Uraguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                     </select>
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element" style="width: 100%">
                    <button type="submit" class="registro-login">Registrarme</button>
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
    
    <script>
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Las contraseñas no coinciden");
                confirm_password.reportValidity();
            } else {
                confirm_password.setCustomValidity('');
                confirm_password.reportValidity();
            }
        }
    </script>
</body>
</html>