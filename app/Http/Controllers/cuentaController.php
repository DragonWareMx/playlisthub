<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cuentaController extends Controller
{
    public function administrar()
    {
        return view ('administrarCuenta');
    }

    public function nombreUpdate()
    {
        return view ('AdministrarCuenta.nombreUpdate');
    }
    public function contraseñaUpdate()
    {
        return view ('AdministrarCuenta.contraseñaUpdate');
    }
    public function correoUpdate()
    {
        return view ('AdministrarCuenta.correoUpdate');
    }
    public function fecNacUpdate()
    {
        return view ('AdministrarCuenta.fecNacUpdate');
    }
    public function fotoUpdate()
    {
        return view ('AdministrarCuenta.fotoUpdate');
    }
    public function generoUpdate()
    {
        return view ('AdministrarCuenta.generoUpdate');
    }
    public function paisUpdate()
    {
        return view ('AdministrarCuenta.paisUpdate');
    }
    public function FcompañiaUpdate()
    {
        return view ('AdministrarCuenta.FcompañiaUpdate');
    }
    public function FdireccionUpdate()
    {
        return view ('AdministrarCuenta.FdireccionUpdate');
    }
    public function FnombreUpdate()
    {
        return view ('AdministrarCuenta.FnombreUpdate');
    }
}
