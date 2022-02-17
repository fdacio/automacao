<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Temperatura;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $temp = floor($tempLast->temperatura);
        $humi = floor($tempLast->humidade);

        $data1 = Carbon::now();      

        $temperaturas = Temperatura:: whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderby('temperatura', 'asc')->get();
        $tempMax = $temperaturas->last();
        $tempMin = $temperaturas->first();
        
        $data2 = Carbon::now();
        $humidades = Temperatura:: whereBetween('created_at', [$data2->format('Y-m-d'), $data2->addDays(1)->format('Y-m-d')])->orderby('humidade', 'asc')->get();
        $humiMax = $humidades->last();
        $humiMin = $humidades->first();
        
        $t_max = $tempMax->temperatura;
        $t_hr_max = $tempMax->created_at->format('H:i');
        $t_min = $tempMin->temperatura;
        $t_hr_min = $tempMin->created_at->format('H:i');
        
        $h_max = $humiMax->humidade;
        $h_hr_max = $humiMax->created_at->format('H:i');
        $h_min = $humiMin->humidade;
        $h_hr_min = $humiMin->created_at->format('H:i');

        return [
            
            'temperatura' => $temp,
            'humidade' => $humi,
            
            't_max' => $t_max,
            't_hr_max' => $t_hr_max,
            't_min' => $t_min,
            't_hr_min' => $t_hr_min,

            'h_max' => $h_max,
            'h_hr_max' => $h_hr_max,
            'h_min' => $h_min,
            'h_hr_min' => $h_hr_min
        ];
    }

    public function index()
    {
        $data1 = Carbon::now();
        $temperaturas = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderby('id', 'desc')->get();   
        return $temperaturas;
    }
}
