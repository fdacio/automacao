@extends('layouts.app')
@section('title', 'Componentes')

@section('content')
<div class="card mb-2">
    <div class="card-header">
        <h3>Componentes</h3>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="card-body">
        <form action="{{ route('componentes.index') }}" method="get" class="form-filter">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ request('nome') }}" />
                        <div class="input-group-append">
                            <button class="btn btn-success"><i class="fa fa-search mr-2"></i><span>Pesquisar</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Pino</th>
            <th>Sinal</th>
            <th>Token</th>
        </thead>
        <tbody>
            @if($componentes->total() == 0)
            <tr>
                <th class="text-center" colspan="5">Nenhum componente encontrado</th>
            </tr>
            @else
            @foreach ($componentes as $componente)
            <tr>
                <td>{{ $componente->id }}</td>
                <td>{{ $componente->nome }}</td>
                <td>{{ $componente->pino }}</td>
                <td>{{ ($componente->sinal) ? 'Ligado' : 'Desligado' }}</td>
                <td>{{ $componente->token }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</section>

<section class="text-center">
    {{ $componentes->render("pagination::bootstrap-4") }}
    <h6><b>{{ $componentes->total() }}</b> {{ $componentes->total() == 1 ? 'registro' : 'registros' }} no total</h6>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

    });

</script>
@endsection
