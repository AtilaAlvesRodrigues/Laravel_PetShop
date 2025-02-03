@extends('layouts.app')
 
@section('content')
<h1>Criar Novo Cliente</h1>
 
    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection