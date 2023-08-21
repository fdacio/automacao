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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Temperatura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border text-center">
                        <div class="chartTemp"></div>
                        <canvas id="chartTemp"></canvas>
                        <canvas id="chartTemp2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Humidade Modal -->
    <div class="modal fade" id="humidadeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Humidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border text-center">
                        <div class="chartHumid"></div>
                        <canvas id="chartHumid"></canvas>
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

            /*
             * Sensor de Presença
             */
            function loadPresenca() {

                $.get("{{ route('api.presenca.show') }}", function(dados, status, jqXHR) {
                    if (dados.presenca) {
                        $('.valor-leitura').addClass('badge-danger').removeClass(
                            'badge-success');
                        $('.valor-leitura').html("Presença de Movimento");
                    } else {
                        $('.valor-leitura').addClass('badge-success').removeClass(
                            'badge-danger');
                        $('.valor-leitura').html("Não há movimento");
                    }
                 }).fail(function(jqXHR) {
                        $('.valor-leitura').html("Sem Informação");
                });

            }

            function updateListDados(presencas) {

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

            function carregaListaPresencas() {
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

            var timeLoadPresenca;
            var timeLoadListaPresensa;

            function setLoadPresenca() {
                
                timeLoadPresenca = setInterval(function() {
                    loadPresenca();
                }, 5000);
                
                //loadPresenca();
            }

            function clearLoadPresenca() {
                clearInterval(timeLoadPresenca);
            }

            function setLoadListPresencas() {
                carregaListaPresencas();
                /*
                timeLoadListaPresensa = setInterval(function() {
                    carregaListaPresencas();
                }, 3000);
                */
            }

            function clearLoadListPresencas() {
                clearInterval(timeLoadListaPresensa);
            }


            $("#presencaModal").on("shown.bs.modal", function() {
                clearLoadPresenca();
                setLoadListPresencas();
            });


            $("#presencaModal").on("hidden.bs.modal", function() {
                clearLoadListPresencas();
                setLoadPresenca();
            });


            function loadTemperatura() {

                clearInterval(timeLoadPresenca);

                $.get("{{ route('api.temperatura.show') }}", function(dados) {

                    if (dados.temperatura == undefined) return;

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
                }).done(function() {
                    setLoadPresenca();
                }).fail(function(jqXHR) {
                    $('.btn-temperatura .valor-temperatura').html(0 + "°C");
                    $('.btn-humidade .valor-humidade').html(0 + "%");
                    $('.btn-temperatura .t-max').html("Max: " + 0 + " °C - " + 0);
                    $('.btn-temperatura .t-min').html("Min: " + 0 + " °C - " + 0);
                    $('.btn-humidade .h-max').html("Max: " + 0 + "% - " + 0);
                    $('.btn-humidade .h-min').html("Min: " + 0 + "% - " + 0);
                });
            }


            var delayTemperatura = 1000 * 60 * 5; // 5 minutos

            setInterval(function() {
                loadTemperatura();
            }, delayTemperatura);


            loadTemperatura();

            /*
             * Gráficos Chart
             */
            $("#temperaturaModal").on("shown.bs.modal", function() {

                var spinner = "<div class=\"spinner-border spinner-grow\" role=\"status\">" +
                    "<span class=\"sr-only\">Loading...</span>" +
                    "</div>";
                $('.chartTemp').html(spinner);
                $('#chartTemp').hide();
                $('#chartTemp2').hide();

                $.get("{{ route('api.temperatura.chart2') }}").done(function(dados) {
                    console.log(dados);
                    var horas1 = [];
                    var horas2 = [];
                    var temperaturas1 = [];
                    var temperaturas2 = [];
                    var index = 0;

                    dados.hoje.forEach(dado => {
                        horas1[index] = dado.created_at.substring(11, 16);
                        temperaturas1[index] = dado.temperatura;
                        index++;
                    });

                    index = 0;
                    dados.ontem.forEach(dado => {
                        horas2[index] = dado.created_at.substring(11, 16);
                        temperaturas2[index] = dado.temperatura;
                        index++;
                    });

                    const dataChartHoje = {
                        labels: horas1,
                        datasets: [{
                            label: 'Temperatura em °C - Hoje',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data:temperaturas1
                        }]
                    };

                    const dataChartOntem = {
                        labels: horas2,
                        datasets: [{
                            label: 'Temperatura em °C - Ontem',
                            backgroundColor: 'rgb(255, 20, 30)',
                            borderColor: 'rgb(255, 20, 30)',
                            data:temperaturas2
                        }]
                    };

                    const config1 = {
                        type: 'line',
                        data: dataChartHoje,
                        options: {}
                    };

                    const config2 = {
                        type: 'line',
                        data: dataChartOntem,
                        options: {}
                    };

                    var chartTemp = new Chart($('#chartTemp'), config1);
                    var chartTemp2 = new Chart($('#chartTemp2'), config2);
                    $('#chartTemp').show();
                    $('#chartTemp2').show();
                    $('.chartTemp').html('');

                });

            });

            $('#temperaturaModal').on('hidden.bs.modal', function() {
                let chartStatus = Chart.getChart("chartTemp");
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
            });

            $("#humidadeModal").on("shown.bs.modal", function() {

                var spinner = "<div class=\"spinner-border spinner-grow\" role=\"status\">" +
                    "<span class=\"sr-only\">Loading...</span>" +
                    "</div>";
                $('.chartHumid').html(spinner);
                $('#chartHumid').hide();

                $.get("{{ route('api.temperatura.chart') }}").done(function(dados) {
                    var horas = [];
                    var humidades = [];
                    var index = 0;
                    dados.forEach(dado => {
                        horas[index] = dado.created_at.substring(11, 16);
                        humidades[index] = dado.humidade;
                        index++;
                    });

                    const data = {
                        labels: horas,
                        datasets: [{
                            label: 'Humidade %',
                            backgroundColor: 'rgb(255, 132, 99)',
                            borderColor: 'rgb(255, 132,  99)',
                            data: humidades,
                        }]
                    };

                    const config = {
                        type: 'line',
                        data: data,
                        options: {}
                    };
                    var chartHumid = new Chart($('#chartHumid'), config);
                    $('#chartHumid').show();
                    $('.chartHumid').html('');
                });

            });

            $('#humidadeModal').on('hidden.bs.modal', function() {
                let chartStatus = Chart.getChart("chartHumid");
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
            });

        });
    </script>
@endsection
