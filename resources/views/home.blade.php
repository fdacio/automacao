@extends('layouts.app')
@section('content')

    <div class="marketing">
        <div class="row">
            <div class="btn-power-red  btn-power col-lg-4 text-center" data-token="btn-power-red">
                <div class="btn-rect">
                    <button class="btn">
                        <i class="fa fa-power-off"></i>
                    </button>
                </div>
                <h2>Componente 1</h2>
                <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal">Informar Componente</a>
            </div>
            <div class="btn-power-yellow btn-power col-lg-4 text-center" data-token="btn-power-yellow">
                <div class="btn-rect">
                    <button class="btn">
                        <i class="fa fa-power-off"></i>
                    </button>
                </div>
                <h2>Componente 2</h2>
                <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal">Informar Componente</a>
            </div>
            <div class="btn-power-green btn-power col-lg-4 text-center" data-token="btn-power-green">
                <div class="btn-rect">
                    <button class="btn">
                        <i class="fa fa-power-off"></i>
                    </button>
                </div>
                <h2>Componente 3</h2>
                <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal">Informar Componente</a>
            </div>
        </div>
        <hr class="featurette-divider">
    </div>


    <!-- Modal -->
    <div class="modal fade" id="componentesModal" tabindex="-1" role="dialog" aria-labelledby="componentesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="componentesModalLabel">Componentes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Aqui lista de componentes --}}                    
                    <ul class="lista-componentes list-group">                        
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            
            $('#componentesModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var modal = $(this);
                modal.find('.modal-title').text('Infomar Componente');
                var listaComponentes = modal.find('.lista-componentes');

                var url = "{{ route('api.componentes') }}";
                    $.get(url)
                    .always(function() {
                        var loading = '<i class="fa fa-spin fa-spinner"></i>';
                        listaComponentes.html(loading);
                    }).done(function(data) {      
                        console.log(data);
                        listaComponentes.empty();
                        $.each(data, function(key, componente){
                            console.log(componente);
                            var token =  button.parent('.btn-power').attr('data-token');
                            var li = $('<li>').html(componente.nome).attr('class','list-group-item btn').attr('data-token', token);
                            listaComponentes.append(li);
                        });
                    }); 
            });

            var loadComponente = function() {
                var loading = '<i class="fa fa-spin fa-spinner"></i>';
                var componentes = [$('.btn-power-red'), $('.btn-power-yellow'), $('.btn-power-green')];                
                $.each(componentes, function( key, btn ) {
                    var token = btn.attr('data-token');
                    var target = btn.find('h2');
                    var html = target.html();
                    var url = "{{ route('api.componente.token', '_token_') }}".replace('_token_', token);
                    $.get(url)
                    .always(function() {
                        target.html(loading);
                    }).done(function(data) {                        
                        if(data.length == 0) {
                            target.html(html);
                        } else {
                            target.html(data.nome);
                        }
                    });                    
                });                
            }

            loadComponente();
        
        });

    </script>
@endsection
