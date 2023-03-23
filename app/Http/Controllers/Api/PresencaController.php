<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Presenca;
use Carbon\Carbon;
use Exception;

class PresencaController extends Controller
{
    public function post(Request $request)
    {        
        $presenca = Presenca::get()->last();
        $dado = ['presenca' => $request->input('p')];
        if (!empty($presenca)) {
            if ($request->input('p') != $presenca->presenca) {
                Presenca::create($dado);
            }
        } else {
            Presenca::create($dado);
        }        
    }

    public function show()
    {
        dd('ok');
        try {
            $data1 = Carbon::now();
            $presenca = Presenca::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderBy('id', 'desc')->get()->first();
            return $presenca;
        } catch(Exception $e) {
            return response($e->getMessage(), 403);
        }
    }

    public function index()
    {
        $data1 = Carbon::now();
        $presencas = Presenca::whereBetween('created_at', [$data1->format('Y-m-d'), $data1->addDays(1)->format('Y-m-d')])->orderby('id', 'desc')->get();   
        return $presencas;
    }
}
