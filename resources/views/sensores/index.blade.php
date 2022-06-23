@extends('layouts.app')
@section('content')
    <h3 class="text text-center">Sensores</h3>
    <hr>
    <div class="marketing">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="btn btn-sensor" data-toggle="modal" data-target="#presencaModal">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-street-view"></i>
                        </div>
                        <div class="text-power text-center">
                            <small class="text-on-off badge badge-success valor-leitura">Não há movimento</small>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <h3>Presença</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="btn btn-temperatura" data-toggle="modal" data-target="#temperaturaModal">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-thermometer-full mb-3" style="font-size: 64px"></i>
                        </div>
                        <h1 class="valor-temperatura mb-1" style="font-size: 60px"> 0°C</h1>
                        <div class="text-sm t-max text-danger">Máx:0.00 °C - 00:00</div>
                        <div class="text-sm t-min text-primary">Min:00.0 °C - 00:00</div>
                        <div class="clearfix"></div>
                    </div>
                    <h4>Temperatura</h4>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="btn btn-humidade" data-toggle="modal" data-target="#humidadeModal">
                    <div class="btn-rect">
                        <div class="fa-ico">
                            <i class="fa fa-tint mb-3" style="font-size: 64px"></i>
                        </div>
                        <h1 class="valor-humidade" style="font-size: 60px">0%</h1>
                        <div class="text-sm h-max text-danger">Máx:0% - 00:00</div>
                        <div class="text-sm h-min text-primary">Min:0% - 00:00</div>
                        <div class="clearfix"></div>
                    </div>
                    <h4>Humidade</h4>
                </div>
            </div>
        </div>
        <hr class="featurette-divider">
    </div>

    <!-- Presenca Modal -->
    <div class="modal fade" id="presencaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sensor de Presença</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border text-center">
                        <i class="fa fa-spinner fa-spin mt-4" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Temperatura Modal -->
    <div class="modal fade" id="temperaturaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Temperatura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border text-center">
                        <canvas id="chat">
                            <i class="fa fa-spinner fa-spin mt-4" aria-hidden="true"></i>
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Humidade Modal -->
    <div class="modal fade" id="humidadeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Umidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border text-center">
                        <i class="fa fa-spinner fa-spin mt-4" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            var spinner = "<div class=\"spinner-border spinner-grow\" role=\"status\">" +
                "<span class=\"sr-only\">Loading...</span>" +
                "</div>";

            var spinnerSm = "<div class=\"spinner-border spinner-border-sm\" role=\"status\">" +
                "<span class=\"sr-only\">Loading...</span>" +
                "</div>";

            $('.valor-leitura').html(spinnerSm);
            $('.btn-temperatura .valor-temperatura').html(spinner);
            $('.btn-humidade .valor-humidade').html(spinner);
            $('.btn-temperatura .t-max').html(spinnerSm);
            $('.btn-temperatura .t-min').html(spinnerSm);
            $('.btn-humidade .h-max').html(spinnerSm);
            $('.btn-humidade .h-min').html(spinnerSm);

            var carregaTemperatura = false;
            var carregaPresenca = true;

            /*
             * Sensor de Presença
             */
            var lastItemId = 0;
            setInterval(function() {
                if (carregaPresenca) {
                    $.get("{{ route('api.presenca.show') }}", function(dados) {
                        var presenca = dados.presenca;
                        if (dados.presenca != undefined) {
                            if (dados.presenca) {
                                $('.valor-leitura').addClass('badge-danger').removeClass(
                                    'badge-success');
                                $('.valor-leitura').html("Presença de Movimento");
                            } else {
                                $('.valor-leitura').addClass('badge-success').removeClass(
                                    'badge-danger');
                                $('.valor-leitura').html("Não há movimento");
                            }
                        }

                        if (lastItemId != dados.id) {
                            carregaPresencas();
                            lastItemId = dados.id;
                        }

                        carregaTemperatura = true;
                        carregaPresenca = false;
                    });
                }

            }, 3000);
            // **** Fim carga de Presença *****//

            // ***** Tela para carregar presenças ****//
            var carregaPresencas = function() {
                $.ajax({
                    url: " {{ route('api.presenca.index') }} ",
                    dataType: 'json',
                    type: 'GET',
                    success: function(presencas) {
                        lastItem = presencas[0].id;
                        updateListDados(presencas);
                    }
                });
            }

            $("#presencaModal").on("shown.bs.modal", function() {
                carregaPresencas();
            });

            var updateListDados = function(presencas) {

                var lista = $(
                    '<ul class="list-group list-group-flush text-monospace" style="max-height:250px; overflow:auto">'
                );
                $.each(presencas, function(key, item) {
                    var acao = (item.presenca == 1) ? 'Entrou:' : 'Saiu:';
                    var li = $('<li class="list-group-item">');
                    var dataHora = item.created_at;
                    var row = '<div class="row">' +
                        '<div class="col-md-3 col-sm-3 col-xs-3">' + acao + '</div>' +
                        '<div class="col-md-9 col-sm-9 col-xs-9">' + dataHora.substring(11) + '</div>' +
                        '</div>';
                    li.html(row);
                    lista.append(li);
                });
                $("#presencaModal .modal-body").html(lista);
            }
            // ***** FIM da Tela de Listar Presenças *****//

            // ***** Carrega temperatura ******//
            setInterval(function() {

                if (carregaTemperatura) {
                    $.get("{{ route('api.temperatura.show') }}", function(dados) {
                        var temperatura = dados.temperatura;
                        var humidade = dados.humidade;

                        var t_max = dados.t_max;
                        var t_hr_max = dados.t_hr_max;
                        var t_min = dados.t_min;
                        var t_hr_min = dados.t_hr_min;

                        var h_max = dados.h_max;
                        var h_hr_max = dados.h_hr_max;
                        var h_min = dados.h_min;
                        var h_hr_min = dados.h_hr_min;

                        $('.btn-temperatura .valor-temperatura').html(temperatura + "°C");
                        $('.btn-humidade .valor-humidade').html(humidade + "%");
                        $('.btn-temperatura .t-max').html("Max: " + t_max + " °C - " + t_hr_max);
                        $('.btn-temperatura .t-min').html("Min: " + t_min + " °C - " + t_hr_min);
                        $('.btn-humidade .h-max').html("Max: " + h_max + "% - " + h_hr_max);
                        $('.btn-humidade .h-min').html("Min: " + h_min + "% - " + h_hr_min);
                    });

                    carregaTemperatura = false;
                    carregaPresenca = true;
                }

            }, 10000); //Carrega as medições de temperara e humidade a cada 10 segundos

            $("#temperaturaModal").on("shown.bs.modal", function() {

                $.get("{{ route('api.temperatura.index') }}").done(function(dados) {
                    var horas = [];
                    var temperaturas = [];
                    var index = 0;
                    dados.forEach(dado => {
                        horas[index] = dado.created_at.substring(5, 11);
                        temperaturas[index] = dado.temperatura;
                        index++;
                    });

                    const data = {
                        labels: horas,
                        datasets: [{
                            label: 'Temperatura',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data:temperaturas,
                        }]
                    };

                    const config = {
                        type: 'line',
                        data: data,
                        options: {}
                    };

                    new Chart(document.getElementById('chat'), config);


                });

            });



        }); // fim documento jquery
    </script>
@endsection
