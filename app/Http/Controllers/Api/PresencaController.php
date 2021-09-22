<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Distancia;
use Automacao\Models\Presenca;
use Carbon\Carbon;

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

    public function index()
    {
        $data1 = Carbon::now();
        $data2 = $data1->addDay(1);
        $presencas = Presenca::where('created_at', '>=', $data1)->where('created_at', '<=', $data2)->get();   
        dd($data1, $data2);
        return $presencas;
    }
}
