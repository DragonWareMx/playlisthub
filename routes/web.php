<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/favoritos', 'OController@favoritos')->name('favoritos');
Route::get('/campanas', 'OController@campanas')->name('campanas');
Route::get('/campanas-actuales', 'OController@campanasActuales')->name('campanasActuales');
Route::get('/campanas-antiguas', 'OController@campanasAntiguas')->name('campanasAntiguas');
Route::get('/campana/{id}', 'OController@campana')->name('campana');
Route::get('/crear-paso-1','Ocontroller@crearCampana1')->name('crearCampana1');
Route::post('/crear-paso-2','Ocontroller@crearCampana2')->name('crearCampana2');
Route::get('/crear-paso-3','Ocontroller@crearCampana3')->name('crearCampana3');
Route::get('/tokens','Ocontroller@tokens')->name('tokens');

Route::get('/perfilM', 'musicoController@perfil')->name('perfil-musico');
Route::get('/idMusico', 'musicoController@perfilPublico')->name('perfil-musico-publico');
Route::get('/perfilC', 'curadorController@perfil')->name('perfil-curador');
Route::get('/idCurador', 'curadorController@perfilPublico')->name('perfil-curador-publico');

/*--------------------------ADMINISTRACION DE LA CUENTA-------------------*/
Route::get('/administrar-cuenta', 'cuentaController@administrar')->name('administrar-cuenta');
Route::get('/nombreUpdate', 'cuentaController@nombreUpdate')->name('nombre-update');
Route::get('/contraseñaUpdate', 'cuentaController@contraseñaUpdate')->name('contraseña-update');
Route::get('/correoUpdate', 'cuentaController@correoUpdate')->name('correo-update');
Route::get('/fechaUpdate', 'cuentaController@fecNacUpdate')->name('fecNac-update');
Route::get('/fotoUpdate', 'cuentaController@fotoUpdate')->name('foto-update');
Route::get('/generoUpdate', 'cuentaController@generoUpdate')->name('genero-update');
Route::get('/paisUpdate', 'cuentaController@paisUpdate')->name('pais-update');
Route::get('/FcompañiaUpdate', 'cuentaController@FcompañiaUpdate')->name('Fcompañia-update');
Route::get('/FdireccionUpdate', 'cuentaController@FdireccionUpdate')->name('Fdireccion-update');
Route::get('/FnombreUpdate', 'cuentaController@FnombreUpdate')->name('Fnombre-update');

//Rutas CURADOR
Route::get('/ranking', function () {
    return view('curador.ranking');
});
Route::get('/ganancias', function () {
    return view('curador.ganancias');
});
Route::get('/playlists', function () {
    return view('curador.playlists');
});

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/inicio',function(){
    return view('inicio');
})->name('home')->middleware('auth');

Route::get('/registro-curador',function(){
    return view('login.registroCurador');
})->name('register-curador');

Route::get('/registro-curador-no',function(){
    return view('login.registroCuradorNo');
})->name('register-curador-no');

Route::get('/registro-musico',function(){
    return view('login.registroMusico');
})->name('register-musico');

Route::get('/login2',function(){
    return view('login.login');
})->name('login');

Route::get('/forgot',function(){
    return view('login.recuperarContra');
})->name('forgotpass');

/*---------------- COMBO WOMBO 4 ----------------*/
Route::get('/reviews', function () {
    return view('reviews.reviews');
});

Route::get('/reviews-pendientes', function () {
    return view('reviews.reviews_pendientes');
});

Route::get('/reviews-realizar', function () {
    return view('reviews.reviews_realizar');
});

//Rutas del sistema de Auth
Auth::routes(['register' => false]);
Route::get('/register/curador','RegistroController@RegistroCurador')->name('register');
Route::post('/register/curador','RegistroController@registrarseCurador')->name('registerCurator');
Route::get('/register/curador/spotify','RegistroController@CuradorSpoty')->name('regCuradorSpoty');
Route::get('/register/curador/spotify/callback','RegistroController@CuradorSpotyCallback');

Route::get('login/spotify', 'Auth\LoginController@redirectToProvider')->name('login-spotify');
Route::get('login/spotify/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/home', 'HomeController@index');
