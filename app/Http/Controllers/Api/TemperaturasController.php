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
        $temperaturaMax = Temperatura::where('temperatura', $maxTemperatura)->get()->first();

        $minTemperatura = Temperatura::whereBetween('created_at', [$data1, $data2])->min('temperatura');
        $temperaturaMin = Temperatura::where('temperatura', $minTemperatura)->get()->first();
        
        $maxHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->max('humidade');
        $humidadeMax = Temperatura::where('humidade', $maxHumidade)->get()->first();

        $minHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->min('humidade');
        $humidadeMin = Temperatura::where('humidade', $minHumidade)->get()->first();
       
        return response()->json([], 200);

        $temperatura = [
            
            'temperatura' => number_format($ultima->temperatura, 0),
            'humidade' => number_format($ultima->humidade, 0),
            
            'maxTemperatura' => number_format($temperaturaMax->temperatura, 0),
            'horaTemperaturaMax' => $temperaturaMax->created_at->format('H:i'),
            'minTemperatura' => number_format($temperaturaMin->temperatura, 0),
            'horaTemperaturaMin' => $temperaturaMin->created_at->format('H:i'),
            
            'maxHumidade' => number_format($humidadeMax->humidade, 0),
            'horaHumidadeMax' => $humidadeMax->created_at->format('H:i'), 
            'minHumidade' => number_format($humidadeMin->humidade, 0),
            'horaHumidadeMin' => $humidadeMin->created_at->format('H:i')
        ];

        //dd($temperatura);
        
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
        return response()->json($temperaturas, 200);
    }

    public function chart2()
    {
        $hoje = Carbon::now();
        $ontem = Carbon::now();
        $ontem = $ontem->addDays(-1);
        
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        
        $data3 = $ontem->format('Y-m-d');
        $data4 = $ontem->addDays(1)->format('Y-m-d');

        $temperaturasHoje = Temperatura::where('created_at', '>=' , $data1)->where('created_at', '<' , $data2)->orderby('id', 'asc')->get();
        $temperaturasOntem = Temperatura::where('created_at', '>=' , $data3)->where('created_at', '<' , $data4)->orderby('id', 'asc')->get();

        return response()->json(['hoje' => $temperaturasHoje, 'ontem' => $temperaturasOntem], 200);
    }

}
