<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Temperatura;
use Carbon\Carbon;

class TemperaturasController extends Controller
{
    public function post(Request $request)
    {        
        $temperatura = Temperatura::get()->last();
        $dado = ['temperatura' => $request->input('t'), 'humidade' => $request->input('h')];
        if (!empty($temperatura)) {
            
            $temperaturaEnviado = (float) $request->input('t');
            $ultimaTemperatura = (float) $temperatura->temperatura;
            if (round($temperaturaEnviado, 2) != round($ultimaTemperatura, 2)) {
                Temperatura::create($dado);
            }
        } else {
            Temperatura::create($dado);
        }        
    }

    public function show()
    {
        return Temperatura::get()->last();
    }

    public function index()
    {
        $data1 = Carbon::now();
        $temperaturas = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderby('id', 'desc')->get();   
        return $temperaturas;
    }
}
