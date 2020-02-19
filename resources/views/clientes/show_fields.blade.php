<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{{ $cliente->nome }}</p>
</div>

<!-- Cpf Field -->
<div class="form-group">
    {!! Form::label('cpf', 'Cpf:') !!}
    <p>{{ $cliente->cpf }}</p>
</div>

<!-- Rg Field -->
<div class="form-group">
    {!! Form::label('rg', 'Rg:') !!}
    <p>{{ $cliente->rg }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{{ $cliente->created_at->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{{ $cliente->updated_at->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Criado por:') !!}
    <p>{{ \App\User::find($cliente->created_by)->name }}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', 'Atualizado por:') !!}
    @if($cliente->updated_by != null)
    <p>{{ \App\User::find($cliente->updated_by)->name }}</p>
    @else
    <p></p>
    @endif
</div>

<!-- Data Nascimento Field -->
<div class="form-group">
    {!! Form::label('data_nascimento', 'Data Nascimento:') !!}
    <p>{{ $cliente->data_nascimento->format('d/m/Y') }}</p>
</div>

<!-- Telefone Field -->
<div class="form-group">
    {!! Form::label('telefone', 'Telefone:') !!}
    <p>{{ $cliente->telefone }}</p>
</div>

<!-- Local Nascimento Field -->
<div class="form-group">
    {!! Form::label('local_nascimento', 'Local Nascimento:') !!}
    @if($cliente->local_nascimento == 1)
        <p>SP</p>
    @else
        <p>BA</p>
    @endif
</div>
