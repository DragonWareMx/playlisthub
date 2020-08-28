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