<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Temperatura;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TemperaturaIOTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data1 = Carbon::now();
        $ultima = Temperatura::get()->last();
        $maxTemperatura = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->max('temperatura');
        $maxHumidade = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->max('humidade');
        $minTemperatura = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->min('temperatura');
        $minHumidade = Temperatura::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->min('humidade');
        
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

}
