<?php

namespace Automacao\Http\Controllers;

use Automacao\Http\Requests\CreateInformacaoRequest;
use Automacao\Http\Requests\UpdateInformacaoRequest;
use Automacao\Models\Informacao;
use Illuminate\Http\Request;

class InformacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informacoes = Informacao::orderBy('id');
        $texto = request()->get('texto');
        if (!empty($texto)) {
            $informacoes =  $informacoes->where('texto', 'LIKE', '%' . $texto . '%');
        }
        $informacoes =  $informacoes->paginate(10);

        return view('informacoes.index', compact('informacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('informacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInformacaoRequest $request)
    {
        Informacao::create($request->all());
        return redirect()->route('informacoes.index')->with('success', 'Cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('informacoes.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInformacaoRequest $request, Informacao $informacao)
    {
        $informacao->update($request->all());
        return redirect()->route('informacoes.index')->with('success', 'Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informacao $informacao)
    {
        Informacao::destroy($informacao);
        return redirect()->route('informacoes.index')->with('success', 'Cadastrado excluído com sucesso!');
    }
}
