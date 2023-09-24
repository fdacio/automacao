<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Usuario;
use Exception;

class UsuariosController extends Controller
{
    public function create(Request $request)
    {
        $dados = [
            'nom' => $request->get('nome'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone'),
        ];
        try {
            $usuario = Usuario::create($dados);
            return response()->json($usuario, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }
}
