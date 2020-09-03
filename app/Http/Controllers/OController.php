<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OController extends Controller
{
    public function favoritos()
    {
        return view ('musico.favoritos');
    }
    public function campanas()
    {
        return view ('musico.campanas');
    }
    public function campanasActuales()
    {
        return view ('musico.campanasActuales');
    }
    public function campanasAntiguas()
    {
        return view ('musico.campanasAntiguas');
    }
    public function campana($id)
    {
        return view ('musico.campana');
    }
    public function crearCampana1()
    {
        return view ('musico.crearCampana1');
    }
    public function crearCampana2(request $request)
    {
        return view ('musico.crearCampana2');
    }
    public function crearCampana3()
    {
        return view ('musico.crearCampana3');
    }
    public function tokens()
    {
        return view ('musico.tokens');
    }
}
