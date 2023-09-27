<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required|max:60',
                'email' => 'required|max:255|email',
                'telefone' => 'required',
            ],
            [
                'nome.required' => 'Informe o Nome',
                'email.required' => 'Informe o Email',
                'email.email' => 'Email Inválido',
                'telefone.required' => 'Informe o Telefone'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $dados = [
            'nome' => $request->get('nome'),
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
