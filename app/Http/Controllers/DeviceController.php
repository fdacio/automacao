<?php

namespace Automacao\Http\Controllers;

use Automacao\Http\Controllers\Controller;
use Automacao\Models\Devices;
use Exception;
use Gestor\Http\Requests\DevicesRequest;

class DevicesController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Devices::orderBy('nome', 'asc');
        $nome = request()->get('nome');
        if (!empty($nome)) {
            $devices =  $devices->where('nome', 'LIKE', '%' . $nome . '%');
        }
        $devices = $devices->paginate(10);
        return view('devives.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DevicesRequest $request)
    {
        Devices::create($request->all());

        return redirect()->route('devices.index')->with('success', 'Device cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Devices $device)
    {
        return view('devices.show', compact('banco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Devices $device)
    {
        return view('devices.edit', compact('banco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DevicesRequest $request, Devices $device)
    {
        $dados = [];
        if (!empty($request->file('file-logo'))) {
            $dados['logo'] = $request->file('file-logo')->store('devices');
        }

        $dados = array_merge($dados, $request->all());
        $device->update($dados);
        return redirect()->route('devices.index')->with('success', 'Cadastro de banco alterado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devices $device)
    {
        try {
            $device->delete();
            return redirect()->route('devices.index')->with('success', 'Cadastro de banco excluído com sucesso.');
        } catch (Exception $e) {
            return redirect()->route('devices.index')->with('danger', 'Não é possível excluir banco. Há vínculos');
        }
    }


    // public function logoView(Devices $device)
    // {
    //     $path = storage_path('app').'/'.$device->logo;
    //     if (File::exists($path)) {
    //         return response()->download($path, 'imagem', [], 'inline');
    //     }
    // }
}
