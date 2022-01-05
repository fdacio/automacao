<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Informacao;
use Carbon\Carbon;

class InformacoesController extends Controller
{
    
    public static $index = 1;

    private $timeZones = [
        1 => ['city' => 'Fortaleza', 'timezone' => 'America/Fortaleza'],
        2 => ['city' => 'New York', 'timezone' => 'America/New_York'],
        3 => ['city' => 'Paris', 'timezone' => 'Europe/Paris'],
        4 => ['city' => 'Londres', 'timezone' => 'Europe/London'],
        5 => ['city' => 'Toquio', 'timezone' => 'Asia/Tokyo'],
        6 => ['city' => 'Cairo', 'timezone' => 'Africa/Cairo'],
        7 => ['city' => 'Jerusalem', 'timezone' => 'Asia/Jerusalem'],
        8 => ['city' => 'Parnaiba', 'timezone' => 'America/Fortaleza'],
        9 => ['city' => 'Toronto', 'timezone' => 'America/Toronto'],
       10 => ['city' => 'B.Aires', 'timezone' => 'America/Argentina/Buenos_Aires']     
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Informacao::all();
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $informacao = Informacao::find($id);
        return $informacao->texto;
    }

    public function city($index)
    {
        $city = $this->timeZones[$index]['city'];
        $date = \Carbon\Carbon::now($this->timeZones[$index]['timezone'])->format('d/m/Y');
        $time = \Carbon\Carbon::now($this->timeZones[$index]['timezone'])->format('H:i:s'); 
        return ['date-time' => ['local' => $city, 'date' => $date, 'time' => $time]];
    }

 
    public function fusoHorarios()
    {
        $cities = [];
        foreach ($this->timeZones as $key => $timeZone) {
            $city = $timeZone['city'];
            $date = \Carbon\Carbon::now($timeZone['timezone'])->format('d/m/Y');
            $time = \Carbon\Carbon::now($timeZone['timezone'])->format('H:i:s'); 
            $cities[] = ['local' => $city, 'date' => $date, 'time' => $time];
        }
           
        return $cities;
    }

    public function dataHora()
    {
        $date = \Carbon\Carbon::now('America/Fortaleza')->format('d/m/Y');
        $time = \Carbon\Carbon::now('America/Fortaleza')->format('H:i:s'); 
        $city = 'Fortaleza';
        return  ['local' => $city, 'date' => $date, 'time' => $time];
    }
}
