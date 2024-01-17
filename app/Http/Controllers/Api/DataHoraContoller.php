<?php

namespace Automacao\Http\Controllers\Api;

use Automacao\Http\Controllers\Controller;

class DataHoraContoller extends Controller
{
    private $timeZone = 'America/Fortaleza';

    public function data()
    {
        $date = \Carbon\Carbon::now($this->timeZone)->format('d/m/Y');
        return ['data' => $date];
    }

    public function hora()
    {
        $time = \Carbon\Carbon::now($this->timeZone)->format('H:i:s'); 
        return ['hora' => $time];
    }

    public function dataHora()
    {
        $dateTime = \Carbon\Carbon::now($this->timeZone)->format('d/m/Y H:i:s');
        return  ['data_hora' => $dateTime];
    }

}
