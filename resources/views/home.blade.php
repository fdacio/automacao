@extends('layouts.app')
@section('content')

    <div class="marketing">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="btn btn-power-red btn-power" data-token="btn-power-red" data-clicked="false">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-power-off"></i>
                        </div>
                        <div class="text-power float-right">
                            <small class="text-on-off badge badge-danger">OFF</small>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <h3>Componente 1</h3>
                    <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal">Vincular
                        Componente</a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="btn btn-power-yellow btn-power" data-token="btn-power-yellow" data-clicked="false">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-power-off"></i>
                        </div>
                        <div class="text-power float-right">
                            <small class="text-on-off badge badge-danger">OFF</small>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <h3>Componente 2</h3>
                    <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal">Vincular
                        Componente</a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="btn btn-power-green btn-power" data-token="btn-power-green" data-clicked="false">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-power-off"></i>
                        </div>
                        <div class="text-power float-right">
                            <small class="text-on-off badge badge-danger">OFF</small>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <h3>Componente 3</h3>
                    <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal">Vincular
                        Componente</a>
                </div>
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
                <div class="modal-alert"></div>
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

            var loadComponente = function() {

                var loading = '<i class="fa fa-spin fa-spinner"></i>';

                var componentes = [$('.btn-power-red'), $('.btn-power-yellow'), $('.btn-power-green')];

                $.each(componentes, function(key, btn) {
                    var token = btn.attr('data-token');
                    var target = btn.find('h3');
                    var html = target.html();
                    var url = "{{ route('api.componente.token', '_token_') }}".replace('_token_',
                        token);
                    $.get(url, function() {
                        target.html(loading);
                    }).done(function(data) {
                        if (data) {
                            target.html(data.nome);
                            var sinal = (data.sinal == 1) ? true : false;
                            btn.attr('data-clicked', sinal);
                            if (sinal) {
                                btn.find('.text-on-off').html('ON').removeClass('badge-danger')
                                    .addClass('badge-success');
                            } else {
                                btn.find('.text-on-off').html('OFF').removeClass(
                                    'badge-success').addClass('badge-danger');
                            }
                        } else {
                            target.html(html);
                        }
                    });
                });
            }

            loadComponente();

            $('.btn-power .btn-rect').on('click', function() {

                var button = $(this).parent('.btn-power');
                var _token = button.attr('data-token');
                var dados = {
                    'token': _token,
                    '_token': "{{ csrf_token() }}"
                };
                var icon = button.find('.btn-rect .fa-ico');
                icon.html('<i class="fa fa-spin fa-spinner"></i>');

                $.ajax({
                    url: " {{ route('api.componente.sinal.update') }} ",
                    data: dados,
                    dataType: 'json',
                    type: 'PUT',
                    success: function(response) {
                        if (response.success) {
                            icon.html('<i class="fa fa-power-off"></i>');
                            var url = "{{ route('api.componente.token', '_token_') }}"
                                .replace('_token_', _token);
                            $.get(url).done(function(data) {
                                if (data) {
                                    var sinal = (data.sinal == 1) ? true : false;
                                    button.attr('data-clicked', sinal);
                                    if (sinal) {
                                        button.find('.text-on-off').html('ON')
                                            .removeClass('badge-danger').addClass(
                                                'badge-success');
                                    } else {
                                        button.find('.text-on-off').html('OFF')
                                            .removeClass('badge-success').addClass(
                                                'badge-danger');
                                    }
                                }
                            });
                        }
                    }
                });
            });




            $('#componentesModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var modal = $(this);
                modal.find('.modal-title').text('Infomar Componente');
                modal.find('.modal-alert').html('');
                var listaComponentes = modal.find('.lista-componentes');

                var url = "{{ route('api.componentes.all') }}";
                $.get(url)
                    .always(function() {
                        var loading = '<i class="fa fa-spin fa-spinner"></i>';
                        listaComponentes.html(loading);
                    }).done(function(data) {
                        listaComponentes.empty();
                        $.each(data, function(key, componente) {
                            var token = button.parent('.btn-power').attr('data-token');
                            var li = $('<li>').html(componente.nome).attr('class',
                                'list-group-item btn item-componente').attr('data-token',
                                token).attr(
                                'data-id', componente.id);
                            listaComponentes.append(li);
                        });
                    });
            });


            $('.lista-componentes').on('click', '.item-componente', function() {
                var item = $(this);
                var _token = item.attr('data-token');
                var _id = item.attr('data-id');
                var dados = {
                    'id': _id,
                    'token': _token,
                    '_token': "{{ csrf_token() }}"
                };
                $.ajax({
                    url: " {{ route('api.componente.token.update') }} ",
                    data: dados,
                    dataType: 'json',
                    type: 'PUT',
                    success: function(response) {
                        if (response.success) {
                            loadComponente();
                            $('#componentesModal').modal('hide');
                        } else {
                            $('.modal-alert').html('<div class="alert alert-danger">' + response
                                .message + '</div>');
                        }
                    }
                });

            });

        }); // fim documento jquery

    </script>
@endsection
