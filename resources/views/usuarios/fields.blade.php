<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','id'=>'name', 'required' => 'required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','id'=>'email', 'required' => 'required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Senha:') !!}
    {{ Form::password('password', ['class'=>'form-control']) }}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('usuarios.index') }}" class="btn btn-default">Cancelar</a>
</div>
