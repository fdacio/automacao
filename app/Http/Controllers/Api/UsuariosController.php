<?php

namespace Automacao\Http\Controllers\Api;

use Illuminate\Http\Request;
use Automacao\Http\Controllers\Controller;
use Automacao\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function find(Usuario $usuario)
    {
        return response()->json($usuario, 200);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required|max:60',
                'email' => 'required|max:255|email|unique:usuarios,email',
                'telefone' => 'required',
            ],
            [
                'nome.required' => 'Informe o Nome',
                'email.required' => 'Informe o Email',
                'email.email' => 'Email Inválido',
                'email.unique' => 'Email já cadastrado',
                'telefone.required' => 'Informe o Telefone'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 404);
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

    public function update(Request $request, Usuario $usuario)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required|max:60',
                'email' => "required|max:255|email|unique:usuarios,email,{$usuario->id}",
                'telefone' => 'required',
            ],
            [
                'nome.required' => 'Informe o Nome',
                'email.required' => 'Informe o Email',
                'email.email' => 'Email Inválido',
                'email.unique' => 'Email já cadastrado',
                'telefone.required' => 'Informe o Telefone'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 404);
        }

        $dados = [
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone'),
        ];

        try {
            $usuario->update($dados);
            return response()->json($usuario, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }


    public function index(Request $request)
    {
        try {
            $usuarios = Usuario::orderBy('nome', 'asc')->get();
            return response()->json($usuarios, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json($usuario, 204);
    }
}
