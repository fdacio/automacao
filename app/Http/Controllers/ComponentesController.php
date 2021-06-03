<?php

namespace Automacao\Http\Controllers;

use Automacao\Models\Componente;
use Illuminate\Http\Request;

class ComponentesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $componentes = Componente::orderBy('id');
        $nome = request()->get('nome');
        if (!empty($nome)) {
            $componentes =  $componentes->where('nome', 'LIKE', '%' . $nome . '%');
        }
        $componentes =  $componentes->paginate(10);

        return view('componentes.index', compact('componentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pinos = [
            2 => 'Pino 2', 
            3 => 'Pino 3', 
            4 => 'Pino 4', 
            5 => 'Pino 5', 
            6 => 'Pino 6',
            7 => 'Pino 7',
            8 => 'Pino 8',
            9 => 'Pino 9',
            10 => 'Pino 10',
            11 => 'Pino 11',
            12 => 'Pino 12',
        ];
        return view('componentes.create', compact('pinos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Componente::create($request->all());
        return redirect()->route('componentes.index')->with('success', 'Cadastrado com sucesso!');
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
    public function edit(Componente $componente)
    {
        $pinos = [
            2 => 'Pino 2', 
            3 => 'Pino 3', 
            4 => 'Pino 4', 
            5 => 'Pino 5', 
            6 => 'Pino 6',
            7 => 'Pino 7',
            8 => 'Pino 8',
            9 => 'Pino 9',
            10 => 'Pino 10',
            11 => 'Pino 11',
            12 => 'Pino 12',
        ];
        return view('componentes.update', compact('componente', 'pinos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Componente $componente)
    {
        $componente->update($request->all());
        return redirect()->route('componentes.index')->with('success', 'Cadastrado com sucesso!');
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
