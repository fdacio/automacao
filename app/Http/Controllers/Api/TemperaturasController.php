<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Temperatura;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class TemperaturasController extends Controller
{

    public function post(Request $request)
    {
        $maxId = DB::table('temperaturas')->max('id');
        $temperatura = Temperatura::find($maxId);

        $dado = [
            'temperatura' => $request->input('t'),
            'humidade' => $request->input('h')
        ];

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
        try {
            
            $maxId = DB::table('temperaturas')->max('id');
            $tempLast = Temperatura::find($maxId);
            $temp = floor($tempLast->temperatura);
            $humi = floor($tempLast->humidade);

            $t_max = 0;
            $t_hr_max = 0;
            $t_min = 0;
            $t_hr_min = 0;
            $h_max = 0;
            $h_hr_max = 0;
            $h_min = 0;
            $h_hr_min = 0;

            $hoje = Carbon::now();
            $data1 = $hoje->format('Y-m-d');
            $data2 = $hoje->addDays(1)->format('Y-m-d');

            $temperaturas = Temperatura::whereBetween('created_at', [$data1, $data2])->orderBy('temperatura', 'asc')->get();
            if ($temperaturas->count() > 0) {
                $tempMax = $temperaturas->last();
                $tempMin = $temperaturas->first();
                $t_max = $tempMax->temperatura;
                $t_hr_max = $tempMax->created_at->format('H:i');
                $t_min = $tempMin->temperatura;
                $t_hr_min = $tempMin->created_at->format('H:i');
            }

            $humidades = Temperatura::whereBetween('created_at', [$data1, $data2])->orderBy('humidade', 'asc')->get();
            if ($humidades->count() > 0) {
                $humiMax = $humidades->last();
                $humiMin = $humidades->first();
                $h_max = $humiMax->humidade;
                $h_hr_max = $humiMax->created_at->format('H:i');
                $h_min = $humiMin->humidade;
                $h_hr_min = $humiMin->created_at->format('H:i');
            }

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
        } catch (Exception $e) {
            return response($e->getMessage(), 403);
        }
    }

    public function index(Request $request)
    {   
        $data1 = $request->get('data');
        
        $temperaturas = Temperatura::orderby('id', 'desc');

        if (empty($data1)) {
            $data1 = Carbon::now();
            $temperaturas = $temperaturas->whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')]);
        }
        
        $temperaturas =  $temperaturas->paginate(10);

        return response()->json($temperaturas, 200);
    }

    public function temperatura()
    {
        $maxId = DB::table('temperaturas')->max('id');
        $tempLast = Temperatura::find($maxId);
        $temperatura = floor($tempLast->temperatura);
        return ['temperatura' => $temperatura];
    }

    public function humidade()
    {
        $maxId = DB::table('temperaturas')->max('id');
        $tempLast = Temperatura::find($maxId);
        $humidade = floor($tempLast->humidade);
        return ['humidade' => $humidade];
    }

    public function chart()
    {
        $data1 = Carbon::now();
        $temperaturas = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderby('id', 'asc')->get();
        return $temperaturas;
    }

    public function chart2()
    {
        $hoje = Carbon::now();
        $ontem = Carbon::now()->addDays(-1);
        $temperaturasHoje = Temperatura::whereBetween('created_at', [$hoje->format('Y-m-d'), $hoje->addDays(1)->format('Y-m-d')])->orderby('id', 'asc')->get();
        $temperaturasOntem = Temperatura::whereBetween('created_at', [$ontem->format('Y-m-d'), $ontem->addDays(1)->format('Y-m-d')])->orderby('id', 'asc')->get();
        return ['hoje' => $temperaturasHoje, 'ontem' => $temperaturasOntem];
    }

}
