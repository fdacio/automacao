@extends('layouts.app')
@section('content')
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
        </div>
        <hr class="featurette-divider">
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            var updateComponente = function(componente) {
                    var id = componente.attr('data-id');
                    var icon = componente.find('.btn-rect .fa-ico');
                    var url = "{{ route('api.componente.show', '_id_') }}".replace('_id_', id);
                    $.get(url, function() {
                        icon.html('<i class="fa fa-spin fa-spinner"></i>');
                    }).done(function(data) {
                        if (data) {
                            var sinal = (data.sinal == 1) ? true : false;
                            $(componente).attr('data-clicked', sinal);
                            if (sinal) {
                                $(componente).find('.text-on-off').html('ON').removeClass('badge-danger')
                                    .addClass('badge-success');
                            } else {
                                $(componente).find('.text-on-off').html('OFF').removeClass(
                                    'badge-success').addClass('badge-danger');
                            }
                            icon.html('<i class="fa fa-power-off"></i>');
                            icon.css('color', data.cor);
                        } 
                    });
            }

            var loadComponente = function() {
                var componentes = $(".btn-power");
                $.each(componentes, function(key, componente) {                    
                    updateComponente($(componente));
                });
            }

            loadComponente();

            $('.btn-power .btn-rect').on('click', function() {

                var button = $(this).parent('.btn-power');
                var _id = button.attr('data-id');
                var dados = {
                    'id': _id,
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
                           updateComponente(button);     
                        }
                    }
                });
            });
            

        }); // fim documento jquery

    </script>
@endsection
