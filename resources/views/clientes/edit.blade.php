@extends('layouts.app')
 
@section('content')
<h1>Editar Cliente</h1>
 
    <form method="POST" action="{{ route('clientes.update', $cliente) }}">
        @csrf
        @method('PUT')
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection