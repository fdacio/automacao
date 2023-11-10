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
        $maxHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->max('humidade');
        $minTemperatura = Temperatura::whereBetween('created_at', [$data1, $data2])->min('temperatura');
        $minHumidade = Temperatura::whereBetween('created_at', [$data1, $data2])->min('humidade');
        
        $temperatura = [
            'temperatura' => $ultima->temperatura,
            'humidade' => $ultima->humidade,
            'maxTemperatura' => $maxTemperatura,
            'maxHumidade' => $maxHumidade,
            'minTemperatura' => $minTemperatura,
            'minHumidade' => $minHumidade 
        ];
        
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

    public function max() 
    {
        $hoje = Carbon::now();
        $data1 = $hoje->format('Y-m-d');
        $data2 = $hoje->addDays(1)->format('Y-m-d');
        $temperatura = DB::table('temperaturas')->select(['id', 'created_at', DB::raw('MAX(temperatura) AS temperatura')])->whereBetween('created_at', [$data1, $data2])->groupBy('id');
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
