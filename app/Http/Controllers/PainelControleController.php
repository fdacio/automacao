<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Componente;

class PainelControleController extends Controller
{
    public function index()
    {
        
        $componentes = Componente::whereNotIn('nome', ['IoT 0', 'IoT 2'])->get();
        return view('painel-controle.index');
    }
}


        