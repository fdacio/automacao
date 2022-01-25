<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Componente;
use Illuminate\Http\Request;

class SensoresController extends Controller
{
    public function index()
    {
        return view('sensores.index');
    }
}
