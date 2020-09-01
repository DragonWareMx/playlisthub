<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class musicoController extends Controller
{
    public function perfil()
    {
        return view ('musico.perfilMusico');
    }

    public function administrar()
    {
        return view ('administrarCuenta');
    }

    public function nombreUpdate()
    {
        return view ('AdministrarCuenta.nombreUpdate');
    }
}
