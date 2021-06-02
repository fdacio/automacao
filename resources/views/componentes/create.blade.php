@extends('layouts.default')
@section('title', 'Cadastrar Componente')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Cadastro de Componente</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('fontes-recursos.index') }}">Voltar</a>
            </div>
            <div class="clearfix"></div>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable ''">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span
                            aria-hidden="true">&times;</span></button>
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
            @include('componentes.form')
        </div>
        <div class="card-footer">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
