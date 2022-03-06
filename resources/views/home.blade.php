@extends('layouts.app')
@section('content')
    <h3 class="text text-center">DS Automação</h3>
    <hr>
    <div class="marketing">
        <div class="row">
            <div class="col-md-4 text-center col-offset-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Painel de
                            Controle</a>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" aria-current="page"
                            href="{{ route('componentes.index') }}">Componentes</a>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" aria-current="page"
                            href="{{ route('informacoes.index') }}">Informações</a>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" aria-current="page" href="{{ route('iot.index') }}">IoT</a>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" aria-current="page"
                            href="{{ route('sensores.index') }}">Sensores</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
