<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Distancia;
use Illuminate\Http\Request;

class DistanciaController extends Controller
{
    
    public function show(Distancia $distancia)
    {
        return view('distancia.show', compact('distancia'));
    }
}
