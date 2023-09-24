<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Usuario;
use Exception;

class UsuariosController extends Controller
{
    public function create(Request $request) {

        $dados = [
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone'),
        ];
        try {
            return response(Usuario::create($dados), 201);
        } catch (Exception $e) {
            return response($e->getMessage(), 401);
        }
    }
    
}
