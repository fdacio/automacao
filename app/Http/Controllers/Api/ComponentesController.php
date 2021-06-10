<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Componente;

class ComponentesController extends Controller
{

    public function statusInicial()
    {
        return Componente::get();
    }

    public function statusAtual()
    {
        $componentes = Componente::whereColumn('sinal' ,'!=', 'sinal_anterior')->get();
        foreach(Componente::all() as $componente) {
            $componente->sinal_anterior = $componente->sinal;
            $componente->update(); 
        }
        return $componentes;

    }
    
    /**
     *  Obtém um componente pelo token
     *  
     * @return Automacao\Models\Componente
     */
    public function show($id)
    {
        return Componente::find($id);
    }

    /**
     * Atualiza o token de um componente
     * 
     *  @return Automacao\Models\Componente
     */
    public function updateSinal(Request $request)
    {
        if ($request->isMethod('put')) {
            $id = $request->input('id');
            $componente = Componente::find($id);
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
}
