<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Distancia;
use Automacao\Models\Presenca;

class PresencaController extends Controller
{
    public function post(Request $request) 
    {
        $temPresenca = Presenca::get()->count() > 0;
        if ($temPresenca) {
            $presenca = Presenca::first();
            $presenca->presenca = $request->input('presenca');
            $presenca->update();
        } else {
            Presenca::create($request->all());
        }
    }

    public function show()
    {
        return Presenca::get()->last();
    }
}
