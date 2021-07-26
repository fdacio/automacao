<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Informacao;
use Carbon\Carbon;

class InformacoesController extends Controller
{
    
    public static $index = 1;
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

 
    public function showDateTime()
    {
        
        $timeZones = [
            1 => ['city' => 'Fortaleza - Brasil', 'timezone' => 'America/Fortaleza'],
            2 => ['city' => 'New York - USA', 'timezone' => 'America/New_York'],
            3 => ['city' => 'Paris - Franca', 'timezone' => 'Europe/Paris'],
            4 => ['city' => 'Roma - Italia', 'timezone' => 'Europe/Rome'],
            5 => ['city' => 'Toquio - Japao', 'timezone' => 'Asia/Tokyo'],
            6 => ['city' => 'Cairo - Egito', 'timezone' => 'Africa/Cairo'],
            7 => ['city' => 'Jerusalem - Israel', 'timezone' => 'Asia/Jerusalem'],
            8 => ['city' => 'Buenos Aires - Argentina', 'timezone' => 'America/Argentina/Buenos_Aires'],
            9 => ['city' => 'Belem - Brasil', 'timezone' => 'America/Belem'],
           10 => ['city' => 'Toronto - Canada', 'timezone' => 'America/Toronto'],
                 
        ];

        $cities = [];
        foreach ($timeZones as $key => $timeZone) {
            $city = $timeZone['city'];
            $date = \Carbon\Carbon::now($timeZone['timezone'])->format('d/m/Y');
            $time = \Carbon\Carbon::now($timeZone['timezone'])->format('H:i:s'); 
            $cities[] = ['local' => $city, 'date' => $date, 'time' => $time];
        }
           
        return $cities;
    }
}
