@extends('layouts.app')
@section('title', 'Informações')

@section('content')
    <div class="card mb-2">
        <div class="card-header">
            <h4>Informações</h4>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('devices.index') }}" method="get" class="form-filter">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="nome">Nome</label>
                        <div class="input-group">
                            <input type="text" name="nome" id="nome" class="form-control"
                                value="{{ request('nome') }}" />
                            <div class="input-group-append">
                                <button class="btn btn-success"><i
                                        class="fa fa-search mr-2"></i><span>Pesquisar</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="text-left mb-2">
                <a href="{{ route('devices.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus mr-2"></i>Cadastrar</a>
            </div>
        </div>
    </div>

    <section class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th></th>
            </thead>
            <tbody>
                @if ($devices->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhuma informação encontrado</th>
                    </tr>
                @else
                    @foreach ($devices as $informacao)
                        <tr>
                            <td>{{ $informacao->id }}</td>
                            <td style="white-space: pre-line">
                                {{ $informacao->nome }}
                            </td>
                            <td class="text-right text-nowrap">
                                <a href="{{ route('devices.edit', $informacao->id) }}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i></a>
                                <a href="{{ route('devices.destroy', $informacao->id) }}" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                    @endforeach
                @endif
            </tbody>
        </table>
    </section>

    <section class="text-center">
        {{ $devices->render('pagination::bootstrap-4') }}
        <h6><b>{{ $devices->total() }}</b> {{ $devices->total() == 1 ? 'registro' : 'registros' }} no total
        </h6>
    </section>

    <div class="mb-5" style="background-color: red; height: 200px;"></div>
    <div class="mb-5" style="background-color: green; height: 200px;"></div>
    <div class="mb-5" style="background-color: blue; height: 200px;"></div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        });

    </script>
@endsection
