<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Componente;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $componentes = Componente::whereNotIn('nome', ['IoT 0', 'IoT 2'])->get();
        return view('home', compact('componentes'));
    }
}
