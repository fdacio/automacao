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
        $tempLast = Temperatura::get()->last();
        $temp = number_format($tempLast->temperatura, 0);
        $humi = number_format($tempLast->humidade, 0);

        $data1 = Carbon::now();        
        $tempMax = Temperatura:: whereBetween('created_at', [$data1->format('Y-m-d'), $data1->format('Y-m-d')])->orderby('temperatura', 'desc')->first();
        $tempMin = Temperatura:: whereBetween('created_at', [$data1->format('Y-m-d'), $data1->format('Y-m-d')])->orderby('temperatura', 'asc')->first();
        
        $t_max = $tempMax->temperatura;
        $h_max = $tempMax->created_at->format('H:i');
        $t_min = $tempMin->temperatura;
        $h_min = $tempMin->created_at->format('H:i');
        
        return [
            'temperatura' => $temp,
            'humidade' => $humi,
            't_max' => $t_max,
            'h_max' => $h_max,
            't_min' => $t_min,
            'h_min' => $h_min
        ];
    }

    public function index()
    {
        $data1 = Carbon::now();
        $temperaturas = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderby('id', 'desc')->get();   
        return $temperaturas;
    }
}
