<?php

namespace Automacao\Http\Controllers;

use Automacao\Http\Requests\CreateComponenteRequest;
use Automacao\Http\Requests\UpdateComponenteRequest;
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
        $pinos = Componente::PINOS;
        $cores = Componente::CORES;
        return view('componentes.create', compact('pinos', 'cores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateComponenteRequest $request)
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
        $pinos = Componente::PINOS;
        $cores = Componente::CORES;
        return view('componentes.update', compact('componente', 'pinos', 'cores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComponenteRequest $request, Componente $componente)
    {
        $componente->update($request->all());
        return redirect()->route('componentes.index')->with('success', 'Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Componente $componente)
    {
        Componente::destroy($componente);
        return redirect()->route('componentes.index')->with('success', 'Cadastrado excluído com sucesso!');

    }
}
