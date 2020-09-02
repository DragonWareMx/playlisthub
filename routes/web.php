<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/campana/{id}', 'OController@campana')->name('campana');
Route::get('/crear-paso-1','Ocontroller@crearCampana1')->name('crearCampana1');
Route::post('/crear-paso-2','Ocontroller@crearCampana2')->name('crearCampana2');
Route::post('/crear-paso-3','Ocontroller@crearCampana3')->name('crearCampana3');

Route::get('/perfil', 'musicoController@perfil')->name('perfil-musico');

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
    return view('welcome');
});

Route::get('/prueba',function(){
    return view('inicio');
})->name('inicio');

Route::get('/registro-curador',function(){
    return view('login.registroCurador');
})->name('register-curador');

Route::get('/registro-curador-no',function(){
    return view('login.registroCuradorNo');
})->name('register-curador-no');

Route::get('/registro-musico',function(){
    return view('login.registroMusico');
})->name('register-musico');

Route::get('/login',function(){
    return view('login.login');
})->name('login');

Route::get('/forgot',function(){
    return view('login.recuperarContra');
})->name('forgotpass');

/*---------------- COMBO WOMBO 4 ----------------*/
Route::get('/reviews', function () {
    return view('musico.reviews');
});