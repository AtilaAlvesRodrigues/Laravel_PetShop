<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importe para usar transações

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::all();
        return response()->json($agendamentos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animais,id',
            'servico_id' => 'required|exists:servicos,id',
            'data_hora' => 'required|date',
            'observacoes' => 'nullable|string',
            'status' => 'nullable|in:agendado,concluido,cancelado',
        ]);

        // Usando transação para garantir a integridade do banco de dados
        DB::beginTransaction();
        try {
            $agendamento = Agendamento::create($request->all());
            DB::commit();
            return response()->json($agendamento, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Erro ao criar agendamento: ' . $e->getMessage()], 500);
        }
    }

    public function show(Agendamento $agendamento)
    {
        return response()->json($agendamento);
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $request->validate([
            'animal_id' => 'exists:animais,id',
            'servico_id' => 'exists:servicos,id',
            'data_hora' => 'date',
            'observacoes' => 'nullable|string',
            'status' => 'in:agendado,concluido,cancelado',
        ]);

        DB::beginTransaction();
        try {
            $agendamento->update($request->all());
            DB::commit();
            return response()->json($agendamento);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Erro ao atualizar agendamento: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Agendamento $agendamento)
    {
        DB::beginTransaction();
        try {
            $agendamento->delete();
            DB::commit();
            return response()->json(['message' => 'Agendamento excluído com sucesso!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Erro ao excluir agendamento: ' . $e->getMessage()], 500);
        }
    }

    // Método para obter agendamentos por data (exemplo)
    public function agendamentosPorData(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
        ]);

        $data = $request->input('data');

        $agendamentos = Agendamento::whereDate('data_hora', $data)->get();

        return response()->json($agendamentos);
    }

    //Método para obter agendamentos com informações do animal e serviço
    public function agendamentosComRelacoes()
    {
        $agendamentos = Agendamento::with(['animal', 'servico'])->get();
        return response()->json($agendamentos);
    }
}