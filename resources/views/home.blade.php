@extends('layouts.app')
@section('content')

    <div class="marketing">
        <div class="row">
            <div class="col-lg-4 text-center">
                <div class="btn-rect">
                    <button class="btn btn-power">
                        <i class="fa fa-power-off btn-power-red"></i>
                    </button>
                </div>
                <h2>Componente 1</h2>
                <p><a class="btn btn-secondary" href="#">Informar Componente</a></p>
            </div>

            <div class="col-lg-4 text-center">
                <div class="btn-rect">
                    <button class="btn btn-power">
                        <i class="fa fa-power-off btn-power-yellow"></i>
                    </button>
                </div>
                <h2>Componente 2</h2>
                <p><a class="btn btn-secondary" href="#">Informar Componente</a></p>
            </div>

            <div class="col-lg-4 text-center">

                <div class="btn-rect">
                    <button class="btn btn-power">
                        <i class="fa fa-power-off btn-power-green"></i>
                    </button>
                </div>
                <h2>Componente 3</h2>
                <p><a class="btn btn-secondary" href="#">Informar Componente</a></p>
            </div>
        </div>
        <hr class="featurette-divider">

    </div>

@endsection
