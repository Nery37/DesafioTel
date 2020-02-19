<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control','id'=>'nome', 'required' => 'required', 'onkeypress' => 'return filtroTeclasLetras(event)']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('cpf', 'CPF:') !!}
    {!! Form::text('cpf', null, ['class' => 'form-control','id'=>'cpf']) !!}
    @push('scripts')
    <script type="text/javascript">
       jQuery(function ($) {
        $("#cpf").mask("999.999.999-99");
        });
    </script>
@endpush
</div>

<div class="form-group col-sm-6">
    {!! Form::label('rg', 'RG:') !!}
    {!! Form::text('rg', null, ['class' => 'form-control','id'=>'rg']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('local_nascimento[]', 'Local de Nascimento') !!}
    {!! Form::select('local_nascimento[]', [1 => 'SP', 2 => 'BA'], null, ['placeholder' => 'Selecione...','id' => 'local_nascimento', 'tabindex' => '2', 'class' => 'form-control', 'onchange' => 'verificarLocalNascimento()', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control','id'=>'telefone']) !!}
</div>
<!-- Data Nascimento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_nascimento', 'Data de Nascimento:') !!}
    {!! Form::date('data_nascimento', null, ['class' => 'form-control','id'=>'data_nascimento']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>
</div>


