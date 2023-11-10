<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Temperatura;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TemperaturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $ultima = Temperatura::get()->last();
        
        $maxTemperatura = Temperatura::whereBetween('created_at', [$data1, $data2])->max('temperatura');
        $temperaturaMax = Temperatura::where('temperatura', $maxTemperatura)->get();

        $minTemperatura = Temperatura::whereBetween('created_at', [$data1, $data2])->min('temperatura');
        $temperaturaMin = Temperatura::where('temperatura', $minTemperatura)->get();
        
        $maxHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->max('humidade');
        $humidadeMax = Temperatura::where('humidade', $maxHumidade)->get();

        $minHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->min('humidade');
        $humidadeMin = Temperatura::where('humidade', $minHumidade)->get();
       
        $temperatura = [
            
            'temperatura' => $ultima->temperatura,
            'humidade' => $ultima->humidade,
            
            'maxTemperatura' => $temperaturaMax->temperatura,
            'horaTemperaturaMax' => $temperaturaMax->created_at,
            'minTemperatura' => $temperaturaMin->temperatura,
            'horaTemperaturaMin' => $temperaturaMin->created_at,
            
            'maxHumidade' => $humidadeMax->humidade,
            'horaHumidadeMax' => $humidadeMax->created_at, 
            'minHumidade' => $humidadeMin->humidade,
            'horaHumidadeMin' => $humidadeMin->creted_at
        ];

        dd($temperatura);
        
        return response()->json($temperatura, 200);
    }

    public function create(Request $request)
    {
        $dados = [
            'temperatura' => $request->input('t'),
            'humidade' => $request->input('h')
        ];

        $temperatura = Temperatura::create($dados);
        return response()->json($temperatura, 201);
    }

    public function maxTemperatura() 
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $maxTemperatura = Temperatura::whereBetween('created_at', [$data1, $data2])->max('temperatura');
        $temperatura = Temperatura::where('temperatura', $maxTemperatura)->get();
        return response()->json($temperatura, 200);
    }

    public function minTemperatura() 
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $minTemperatura = Temperatura::whereBetween('created_at', [$data1, $data2])->min('temperatura');
        $temperatura = Temperatura::where('temperatura', $minTemperatura)->get();
        return response()->json($temperatura, 200);
    }

    public function maxHumidade() 
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $maxHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->max('humidade');
        $temperatura = Temperatura::where('humidade', $maxHumidade)->get();
        return response()->json($temperatura, 200);
    }

    public function minHumidade() 
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $minHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->min('humidade');
        $temperatura = Temperatura::where('humidade', $minHumidade)->get();
        return response()->json($temperatura, 200);
    }

    public function chart()
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $temperaturas = Temperatura::whereBetween('created_at', [$data1, $data2])->orderby('id', 'asc')->get();
        return $temperaturas;
    }

    public function chart2()
    {
        $hoje = Carbon::now();
        $ontem = $hoje->addDays(1);
        
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        
        $data3 = $ontem->format('Y-m-d');
        $data4 = $ontem->addDays(1)->format('Y-m-d');

        $temperaturasHoje = Temperatura::whereBetween('created_at', [$data1, $data2])->orderby('id', 'asc')->get();
        $temperaturasOntem = Temperatura::whereBetween('created_at', [$data3, $data4])->orderby('id', 'asc')->get();
        return ['hoje' => $temperaturasHoje, 'ontem' => $temperaturasOntem];
    }

}
