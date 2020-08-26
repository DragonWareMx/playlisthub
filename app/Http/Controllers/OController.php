<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OController extends Controller
{
    public function favoritos()
    {
        return view ('musico.favoritos');
    }
}
