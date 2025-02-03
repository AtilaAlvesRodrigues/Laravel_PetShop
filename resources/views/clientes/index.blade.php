@extends('layouts.app')

@section('content')
<h1>Lista de Clientes</h1>
<table class="table">
  <thead>
    <tr>
      <th>Nome</th>
      <th>CPF</th>
      <th>Telefone</th>
      <th>Endereço</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($clientes as $cliente)
    <tr>
      <td>{{ $cliente->nome }}</td>
      <td>{{ $cliente->cpf }}</td>
      <td>{{ $cliente->telefone }}</td>
      <td>{{ $cliente->endereco }}</td>
      <td>
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">Editar</a>
        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Excluir</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection 