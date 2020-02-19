<div class="table-responsive">
    <table class="table" id="clientes-table">
        <thead>
            <tr>
                <th>Nome</th>
        <th>Cpf</th>
        <th>Rg</th>
        <th>Criado em</th>
        <th>Atualizado em</th>
        <th>Criado por</th>
        <th>Atualizado por</th>
        <th>Data Nascimento</th>
        <th>Telefone</th>
        <th>Local Nascimento</th>
                <th colspan="3">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->cpf }}</td>
            <td>{{ $cliente->rg }}</td>
            <td>{{ $cliente->created_at->format('d/m/Y H:i:s') }}</td>
            <td>{{ $cliente->updated_at->format('d/m/Y H:i:s') }}</td>
            @if($cliente->created_by != null && \App\User::find($cliente->created_by) != null)
            <td>{{ \App\User::find($cliente->created_by)->name }}</td>
            @else
            <td></td>
            @endif
            @if($cliente->updated_by != null && \App\User::find($cliente->updated_by) != null)
            <td>{{ \App\User::find($cliente->updated_by)->name }}</td>
            @else
            <td></td>
            @endif
            @if($cliente->data_nascimento != null)
            <td>{{ $cliente->data_nascimento->format('d/m/Y') }}</td>
            @else
            <td></td>
            @endif
            <td>{{ $cliente->telefone }}</td>
            @if($cliente->local_nascimento == 1)
            <td>SP</td>
            @else
            <td>BA</td>
            @endif
  
                <td>
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('clientes.show', [$cliente->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('clientes.edit', [$cliente->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza que deseja deletar este cadastro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
