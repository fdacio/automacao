<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="nome">Nome:</label>
            {!! Form::text('nome', isset($componente) ? $componente->nome : null, ['placeholder' => 'Nome', 'class' => 'form-control', 'id' => 'nome']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="pino">Pino:</label>
            {!! Form::select('pino', $pinos, isset($componente) ? $componente->pino : null, ['placeholder' => 'Selecione um Pino', 'class' => 'form-control', 'id' => 'pino']) !!}
        </div>
    </div>
</div>
