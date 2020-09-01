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
    public function campana($id)
    {
        return view ('musico.campana');
    }
    public function crearCampana1()
    {
        return view ('musico.crearCampana1');
    }
}
