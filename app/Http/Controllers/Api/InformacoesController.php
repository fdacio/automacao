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
        1 => ['city' => 'Fortaleza - CE', 'timezone' => 'America/Fortaleza'],
        2 => ['city' => 'New York - USA', 'timezone' => 'America/New_York'],
        3 => ['city' => 'Paris - FRA', 'timezone' => 'Europe/Paris'],
        4 => ['city' => 'Londres - ENG', 'timezone' => 'Europe/London'],
        5 => ['city' => 'Tóquio - JAP', 'timezone' => 'Asia/Tokyo'],
        6 => ['city' => 'Cairo - EGT', 'timezone' => 'Africa/Cairo'],
        7 => ['city' => 'Jerusalem - ISL', 'timezone' => 'Asia/Jerusalem'],        
        8 => ['city' => 'Toronto - CND', 'timezone' => 'America/Toronto'],
        9 => ['city' => 'Buenos Aires - ARG', 'timezone' => 'America/Argentina/Buenos_Aires'],
       10 => ['city' => 'Parnaíba - PI', 'timezone' => 'America/Fortaleza']
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
        $city = 'Fortaleza - CE';
        return  ['local' => $city, 'date' => $date, 'time' => $time];
    }
}
