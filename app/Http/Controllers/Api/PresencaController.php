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
        $presenca = Presenca::get()->last();
        if (!empty($presenca)) {
            if ($request->input('presenca') != $presenca->presenca) {
                Presenca::create($request->all());
            }
        } else {
            Presenca::create($request->all());
        }
    }

    public function show()
    {
        return Presenca::get()->last();
    }
}
