<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Informacao;
use Carbon\Carbon;

class InformacoesController extends Controller
{
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
        $date = \Carbon\Carbon::now("America/Fortaleza")->format('d/m/Y');
        $time = \Carbon\Carbon::now("America/Fortaleza")->format('H:i:s'); 

        return ['date-time' => ['local' => 'Fortaleza - CE', 'date' => $date, 'time' => $time]];
    }
}
