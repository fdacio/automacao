<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Componente;

class ComponentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Componente::get();
    }

    /**
     *  Obtém um componente pelo token
     *  
     * @return Automacao\Models\Componente
     */
    public function byToken($token)
    {
        return Componente::where('token', $token)->first();
    }

    /**
     * Atualiza o token de um componente
     * 
     *  @return Automacao\Models\Componente
     */
    public function updateToken(Request $request)
    {
        if ($request->isMethod('put')) {
            $id = $request->input('id');
            $token = $request->input('token');
            $componente = Componente::where('token', $token)->where('id', '<>', $id)->first();
            if (empty($componente)) {
                $componente = Componente::find($id);
                $componente->token = $token;
                $componente->update();
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Componente já vinculado'];
            }
        }
        return ['success' => false, 'message' => 'Método inválido'];
    }

        /**
     * Atualiza o token de um componente
     * 
     *  @return Automacao\Models\Componente
     */
    public function updateSinal(Request $request)
    {
        if ($request->isMethod('put')) {
            $token = $request->input('token');
            $componente = Componente::where('token', $token)->first();
            if (!empty($componente)) {
                $componente->sinal = (empty($componente->sinal)) ? true : !$componente->sinal;
                $componente->update();
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Componente não vinculado'];
            }
        }
        return ['success' => false, 'message' => 'Método inválido'];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
