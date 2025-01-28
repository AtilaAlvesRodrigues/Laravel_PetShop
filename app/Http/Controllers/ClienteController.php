<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Rules\Cpf;

class ClienteController extends Controller
{
    /*
        Função para chamada global de todos os clientes e seus dados
    */
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }

    /*
        Função para criar e armazenar um cliente na base de dados
    */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:200',
            'cpf' => ['required', 'string', 'max:14', 'unique:clientes', new Cpf],
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string',
        ]);

        $cliente = Cliente::create($request->all());

        return response()->json($cliente, 201);
    }

    /**
     * Função para mostrar um cliente especifico
     */
    public function show(Cliente $cliente)
    {
        return response()->json($cliente);
        // return view('clientes.show', compact('cliente'));

    }

    /**
     * Função que altera os dados do cliente
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'string|max:200',
            'cpf' => ['string', 'max:14', 'unique:clientes,cpf,' . $cliente->id, new Cpf],
            'telefone' => 'string|max:20',
            'endereco' => 'string',
        ]);

        $cliente->update($request->all());
        return response()->json($cliente);
    }

    /**
     * Função para excluir um cliente especifico
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(['message' => 'Cliente excluído com sucesso!']);
    }
}
