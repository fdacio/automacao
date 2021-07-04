<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Distancia;

class DistanciaController extends Controller
{
    public function post(Request $request) 
    {
        $temDistancia = Distancia::get()->count() > 0;
        if ($temDistancia) {
            $distancia = Distancia::first();
            $distancia->distancia = $request->input('distancia');
            $distancia->update();
        } else {
            Distancia::create($request->all());
        }
    }

    public function show()
    {
        return Distancia::get()->last();
    }
}
