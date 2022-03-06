@extends('layouts.app')
@section('content')
    <h3 class="text text-center">DS Automação</h3>
    <hr>
    <div class="marketing">
        <div class="row">
            @foreach ($componentes as $componente)
                <div class="col-md-4 text-center">
                    <div class="btn btn-power" data-id="{{ $componente->id }}"
                        data-clicked="false">
                        <div class="btn-rect">
                            <div class="fa-ico">
                                <i class="fa fa-power-off"></i>
                            </div>
                            <div class="text-power float-right">
                                <small class="text-on-off badge badge-danger">OFF</small>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <h3>{{ $componente->nome }}</h3>
                    </div>
                </div>                
            @endforeach
            <div class="col-md-4 text-center">
                <div class="btn btn-sensor">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-street-view"></i>
                        </div>
                        <div class="text-power float-right">
                            <small class="text-on-off badge badge-success valor-leitura">0.00 cm</small>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <h3>Aproximação</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
