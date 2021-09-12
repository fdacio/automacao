<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Componente;
use Illuminate\Http\Request;

class IotController extends Controller
{
    public function index()
    {
        $componentes = Componente::whereIn('pino', [0,2])->get();
        return view('iot.index', compact('componentes'));
    }
}
