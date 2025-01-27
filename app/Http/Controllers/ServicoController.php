<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    // Métodos similares (index, store, show, update, destroy)
    public function index()
    {
        $servicos = Servico::all();
        return response()->json($servicos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
        ]);
        $servico = Servico::create($request->all());
        return response()->json($servico, 201);
    }

    public function show(Servico $servico)
    {
        return response()->json($servico);
    }

    public function update(Request $request, Servico $servico)
    {
        $request->validate([
            'nome' => 'string|max:255',
            'preco' => 'numeric|min:0',
            'descricao' => 'nullable|string',
        ]);
        $servico->update($request->all());
        return response()->json($servico);
    }

    public function destroy(Servico $servico)
    {
        $servico->delete();
        return response()->json(['message' => 'Serviço excluído com sucesso!']);
    }
}
