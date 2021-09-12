<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Componente;
use Illuminate\Http\Request;

class IotController extends Controller
{
    public function index()
    {
        $componentes = Componente::whereIn('name', ['IoT 0', 'IoT 2'])->get();
        return view('iot.index', compact('componentes'));
    }
}
