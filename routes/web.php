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
Route::get('/campana/{token}', 'OController@campana')->name('campana');
Route::get('/crear-paso-1','OController@crearCampana1')->name('crearCampana1');
Route::post('/crear-paso-2','OController@crearCampana2')->name('crearCampana2');
Route::get('crear-paso-2','OController@recrearCampana2');
Route::get('/crear-paso-3','OController@crearCampana3')->name('crearCampana3');
Route::get('/tokens','OController@tokens')->name('tokens');

Route::get('/TableroM', 'musicoController@index')->name('inicio-musico');
Route::get('/perfilM', 'musicoController@perfil')->name('perfil-musico');
Route::get('/idMusico', 'musicoController@perfilPublico')->name('perfil-musico-publico');

Route::get('/TableroC', 'curadorController@index')->name('inicio-curador');
Route::get('/perfilC', 'curadorController@perfil')->name('perfil-curador');
Route::get('/idCurador', 'curadorController@perfilPublico')->name('perfil-curador-publico');

/*--------------------------ADMINISTRACION DE LA CUENTA-------------------*/
Route::get('/administrar-cuenta', 'cuentaController@administrar')->name('administrar-cuenta');
Route::get('/nombreUpdate', 'cuentaController@nombreUpdate')->name('nombre-update');
Route::patch('/nombreUpdate/{id}', 'cuentaController@nombreUpdateDo')->name('nombre-updateDo');
Route::get('/contraseñaUpdate', 'cuentaController@contraseñaUpdate')->name('contraseña-update');
Route::patch('/contraseñaUpdate/{id}', 'cuentaController@contraseñaUpdateDo')->name('contraseña-updateDo');
Route::get('/correoUpdate', 'cuentaController@correoUpdate')->name('correo-update');
Route::patch('/correoUpdate/{id}', 'cuentaController@correoUpdateDo')->name('correo-updateDo');
// Route::get('/fotoUpdate', 'cuentaController@fotoUpdate')->name('foto-update');
Route::get('/fechaNacUpdate', 'cuentaController@fecNacUpdate')->name('fecNac-update');
Route::patch('/fechaNacUpdate/{id}', 'cuentaController@fecNacUpdateDo')->name('fecNac-updateDo');
Route::get('/generoUpdate', 'cuentaController@generoUpdate')->name('genero-update');
Route::patch('/generoUpdate/{id}', 'cuentaController@generoUpdateDo')->name('genero-updateDo');
Route::get('/paisUpdate', 'cuentaController@paisUpdate')->name('pais-update');
Route::patch('/paisUpdate/{id}', 'cuentaController@paisUpdateDo')->name('pais-updateDo');
Route::delete('/deleteUser/{id}' , 'cuentaController@userDelete')->name('delete-user');

Route::get('/referencias', 'musicoController@referencias')->name('referencias');

//Rutas CURADOR
Route::get('/ranking', function () {
    return view('curador.ranking');
});
Route::get('/ganancias', function () {
    return view('curador.ganancias');
});
Route::get('/playlists', 'AController@playlists')->name('playlists');
Route::get('/addPlaylist','AController@addPlaylist')->name('addPlaylist');

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
//Para el registro del curador
Route::get('/register/curador','RegistroController@RegistroCurador')->name('register');
Route::get('/register/curador/accepted','RegistroController@RegistroCuradorForm')->name('registerCuratorForm');
Route::post('/register/curador','RegistroController@registrarseCurador')->name('registerCurator');
Route::get('/register/curador/spotify','RegistroController@CuradorSpoty')->name('regCuradorSpoty');
Route::get('/register/curador/spotify/callback','RegistroController@CuradorSpotyCallback');
//para el registro del musico
Route::get('/register/musico','RegistroController@RegistroMusico')->name('register2');
Route::get('/register/musico/accepted','RegistroController@RegistroMusicoForm')->name('registerMusicianForm');
Route::post('/register/musico','RegistroController@registrarseMusico')->name('registerMusician');
Route::get('/register/musico/spotify','RegistroController@MusicoSpoty')->name('regMusicianSpoty');
Route::get('/register/musico/spotify/callback','RegistroController@MusicoSpotyCallback');

Route::get('login/spotify', 'Auth\LoginController@redirectToProvider')->name('login-spotify');
Route::get('login/spotify/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/home', 'HomeController@index');
