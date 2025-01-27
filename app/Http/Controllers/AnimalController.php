<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    // Métodos similares ao ClienteController (index, store, show, update, destroy)
    public function index()
    {
        $animais = Animal::all();
        return response()->json($animais);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'raca' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id', // Verifica se o cliente existe
        ]);

        $animal = Animal::create($request->all());
        return response()->json($animal, 201);
    }

    public function show(Animal $animal)
    {
        return response()->json($animal);
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'nome' => 'string|max:255',
            'raca' => 'string|max:255',
            'especie' => 'string|max:255',
            'data_nascimento' => 'nullable|date',
            'cliente_id' => 'exists:clientes,id',
        ]);

        $animal->update($request->all());
        return response()->json($animal);
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return response()->json(['message' => 'Animal excluído com sucesso!']);
    }
}
