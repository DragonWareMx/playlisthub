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
        <p class="login-text3">¿Ya tienes una cuenta? <a href="">Ingresar aquí</a></p>

        <div class="cuadro-formulario">
            <div class="button-cuadro-form" style="width:100%; align-content:center;">
                <button class="login-button active button-selecters">Músico</button>
                <button onclick="location.href='{{route('register')}}'" class="login-button noactive button-selecters">Curador</button>
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
            <p class="form-text">Registrate aquí para que tu música sea escuchada por los curadores de playlist y creadores de contenido</p>
            <form class="login-form" action="{{ route('registerMusician') }}" method="POST">
                @csrf
                <input type="hidden" name="spotify_id" value="{{$user->id}}">
                <input type="hidden" name="avatar" value="
                @if (isset($user->images[0]->url))
                {{$user->images[0]->url}}
                @else
                https://cdn.pixabay.com/photo/2016/04/07/22/09/note-1314942_960_720.png
                @endif
                ">
                <div class="form-element">
                    <span style="width: 100% !important;">INICIA SESIÓN CON TU CUENTA DE SPOTIFY (Obligatorio)</span>
                    <a href="{{ route('regMusicianSpoty') }}" class="button-spoty"> <img src="{{ asset('/img/iconos/spotify.png')}}"></a>
                    <p class="texto-inicio-sesion">Sesión iniciada con éxito</p>
                </div>
                <div class="espacio-inter" style=""></div>
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
                    <span>FECHA NACIMIENTO</span>
                    <input type="date" name="date" id="date" required>
                </div>
                <div class="form-element">
                    <span>PAÍS DE RESIDENCIA</span>
                    <select id="country" name="country" style="width: 84%" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brasil">Brasil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Guayana Francesa">Guayana Francesa</option>
                        <option value="Granada">Granada</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guayana">Guayana</option>
                        <option value="Haití">Haití</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="México">México</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Panamá">Panamá</option>
                        <option value="Perú">Perú</option>
                        <option value="Puerto">Puerto Rico</option>
                        <option value="República Dominicana">República Dominicana</option>
                        <option value="Surinam">Surinam</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela </option>
                     </select>
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
                    <span>GÉNERO</span>
                    <select name="genero" id="genero" style="width: 84%" required>
                        <option value="">Selecciona una opción</option>
                        <option value="m">Hombre</option>
                        <option value="f">Mujer</option>
                        <option value="o">Otro</option>
                    </select>
                </div>
                <div class="espacio-inter"></div>
                <div class="form-element" style="width: 100%">
                    <button type="submit" class="registro-login" style="cursor: pointer">Registrarme</button>
                </div>
            </form>
        </div>

        <p class="login-text4">Al hacer clic en "Registrarme", aceptas nuestros Términos y condiciones, asi como el Aviso de privacidad. Es posible que te enviemos notificaciones por correo electrónico.</p>
        <div class="espacio-inter" style="margin-top:42px"></div>
    </div>

    @include('subview.footer')
    
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