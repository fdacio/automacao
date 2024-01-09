@extends('layouts.app')
@section('title', 'Cadastrar Componente')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="float-left">
            <a class="mr-2 h4" href="{{ route('componentes.index') }}"><i class="fa fa-arrow-left"></i></a>
        </div>
        <h4 class="float-left">Cadastrar Componente</h4>
        <div class="clearfix"></div>
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable ''">
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            <strong>Ops!</strong> Verifique os erros.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    {!! Form::open(['id' => 'form_componente', 'method' => 'post', 'route' => 'componentes.store']) !!}
    <div class="card-body">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="pino">Tipo</label>
                    {!! Form::select('pino', [], isset($componente) ? $componente->pino : null, ['placeholder' => 'Selecione um Tipo', 'class' => 'form-control', 'id' => 'pino']) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="nome">Descricao</label>
                {!! Form::text('nome', isset($componente) ? $componente->nome : null, ['placeholder' => 'Descricao', 'class' => 'form-control', 'id' => 'nome']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="nome">Assunto</label>
                {!! Form::text('nome', isset($componente) ? $componente->nome : null, ['placeholder' => 'Assunto', 'class' => 'form-control', 'id' => 'nome']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="nome">Assunto</label>
                {!! Form::textarea('nome', isset($componente) ? $componente->nome : null, ['placeholder' => 'Assunto', 'class' => 'form-control', 'id' => 'nome', row='10']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection