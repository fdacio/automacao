<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="nome">Nome</label>
            {!! Form::text('nome', isset($device) ? $device->nome : null, ['placeholder' => 'Nome', 'class' => 'form-control', 'id' => 'nome']) !!}
        </div>
    </div>
</div>

