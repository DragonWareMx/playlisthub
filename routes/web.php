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
Route::get('/campanas-actuales', 'OController@campanasActuales')->name('campanasActuales');
Route::get('/campanas-antiguas', 'OController@campanasAntiguas')->name('campanasAntiguas');
Route::get('/campana/{id}', 'OController@campana')->name('campana');
Route::get('/crear-paso-1','Ocontroller@crearCampana1')->name('crearCampana1');
Route::post('/crear-paso-2','Ocontroller@crearCampana2')->name('crearCampana2');
Route::get('/crear-paso-3','Ocontroller@crearCampana3')->name('crearCampana3');
Route::get('/tokens','Ocontroller@tokens')->name('tokens');

Route::get('/perfil', 'musicoController@perfil')->name('perfil-musico');
Route::get('/administrar-cuenta', 'musicoController@administrar')->name('administrar-cuenta');
Route::get('/nombre', 'musicoController@nombreUpdate')->name('nombre-update');
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

Route::get('/iniciar-sesion',function(){
    return view('login.inicioSesion');
})->name('login');

/*---------------- COMBO WOMBO 4 ----------------*/
Route::get('/reviews', function () {
    return view('musico.reviews');
});