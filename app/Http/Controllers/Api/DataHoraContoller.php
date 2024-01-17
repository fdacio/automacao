<?php

namespace Automacao\Http\Controllers\Api;

use Automacao\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataHoraContoller extends Controller
{
    private $timeZones = [
        1 => ['city' => 'Fortaleza - CEARA', 'timezone' => 'America/Fortaleza'],
        2 => ['city' => 'New York - USA', 'timezone' => 'America/New_York'],
        3 => ['city' => 'Paris - FRACA', 'timezone' => 'Europe/Paris'],
        4 => ['city' => 'Londres - ENG', 'timezone' => 'Europe/London'],
        5 => ['city' => 'Toquio - JAPAO', 'timezone' => 'Asia/Tokyo'],
        6 => ['city' => 'Cairo - EGITO', 'timezone' => 'Africa/Cairo'],
        7 => ['city' => 'Adelaide - AUSTRALIA', 'timezone' => 'Australia/Adelaide'],        
        8 => ['city' => 'Toronto - CANADA', 'timezone' => 'America/Toronto'],
        9 => ['city' => 'Shanghai - CHINA', 'timezone' => 'Asia/Shanghai'],
       10 => ['city' => 'Parnaíba - PIAUI', 'timezone' => 'America/Fortaleza']
    ];
    
    private $timeZoneDefault = 'America/Fortaleza';

    public function data(Request $request)
    {
        $timeZone = (empty($request->get('timezone'))) ? $this->timeZoneDefault : $request->get('timezone');
        $cidade = $this->getCityByTimeZone($timeZone);
        $date = \Carbon\Carbon::now($timeZone)->format('d/m/Y');
        return ['data' => $date, 'cidade' => $cidade ];
    }

    public function hora(Request $request)
    {
        $timeZone = (empty($request->get('timezone'))) ? $this->timeZoneDefault : $request->get('timezone');
        $cidade = $this->getCityByTimeZone($timeZone);
        $time = \Carbon\Carbon::now($timeZone)->format('H:i:s'); 
        return ['hora' => $time, 'cidade' => $cidade ];
    }

    public function dataHora(Request $request)
    {
        $timeZone = (empty($request->get('timezone'))) ? $this->timeZoneDefault : $request->get('timezone');
        $cidade = $this->getCityByTimeZone($timeZone);
        $dateTime = \Carbon\Carbon::now($timeZone)->format('d/m/Y H:i:s');
        return  ['data_hora' => $dateTime, 'cidade' => $cidade ];
    }

    public function timeZones()
    {
        return $this->timeZones;
    }

    private function getCityByTimeZone($timeZone)
    {
        foreach($this->timeZones as $item) 
        {
            if ($item['timezone'] === $timeZone ) {
                return $item['city'];
            }
        }
        return 'Brasilia-DF';
    }

}
