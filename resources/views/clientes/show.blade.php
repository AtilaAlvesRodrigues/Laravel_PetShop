@extends('layouts.app')
 
@section('content')
<h1>Detalhes do Cliente</h1>
<p>Nome: {{ $cliente->nome }}</p>
    @endsection