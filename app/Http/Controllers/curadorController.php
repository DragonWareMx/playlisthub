<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class curadorController extends Controller
{
    // 
    public function perfil()
    {
        return view ('curador.perfilCurador'); 
    }

    public function perfilPublico()
    {
        return view ('curador.PublicoperfilCurador'); 
    }
}
