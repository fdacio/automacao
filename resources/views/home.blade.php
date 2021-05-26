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
                <p><a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal"
                        data-btn="btn-power-red">Informar Componente</a></p>
            </div>

            <div class="col-lg-4 text-center">
                <div class="btn-rect">
                    <button class="btn btn-power">
                        <i class="fa fa-power-off btn-power-yellow"></i>
                    </button>
                </div>
                <h2>Componente 2</h2>
                <p><a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal"
                        data-btn="btn-power-yellow">Informar Componente</a></p>
            </div>

            <div class="col-lg-4 text-center">

                <div class="btn-rect">
                    <button class="btn btn-power">
                        <i class="fa fa-power-off btn-power-green"></i>
                    </button>
                </div>
                <h2>Componente 3</h2>
                <p><a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#componentesModal"
                        data-btn="btn-power-green">Informar Componente</a></p>
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
                var button = $(event.relatedTarget) // Button that triggered the modal
                var dataBtn = button.data('btn') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Componente para ' + dataBtn)
                //modal.find('.modal-body input').val(recipient)
            })
        
        });

    </script>
@endsection
