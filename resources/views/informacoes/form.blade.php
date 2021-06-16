<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="texto">Texto</label>
            {!! Form::textarea('texto', isset($informacao) ? $informacao->texto : null, ['placeholder' => 'Texto', 'class' => 'form-control', 'id' => 'texto']) !!}
        </div>
    </div>
</div>

