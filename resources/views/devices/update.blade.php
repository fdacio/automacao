@extends('layouts.app')
@section('title', 'Altrar Device')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <a class="mr-2 h4" href="{{ route('devices.index') }}"><i class="fa fa-arrow-left"></i></a>
            </div>
            <h4 class="float-left">Alterar Device</h4>
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
        {!! Form::open(['id' => 'form_informacao', 'method' => 'patch', 'route' => ['devices.update', $device->id]]) !!}
        <div class="card-body">
            @include('devices.form')
        </div>
        <div class="card-footer">
            {!! Form::submit('Alterar', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
