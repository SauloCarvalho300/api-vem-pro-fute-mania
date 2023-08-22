<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function index()
    {
        $classifications = Classification::all();
        return response()->json($classifications);
    }

    public function show($id)
    {
        $classification = Classification::find($id);

        if (!$classification) {
            return response()->json(['message' => 'Classificação não encontrada'], 404);
        }

        return response()->json($classification);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id' => 'nullable|exists:teams,id',
            'score' => 'nullable|integer',
            'matches_played' => 'nullable|integer',
            // Adicione as validações para os outros campos aqui...
        ]);

        $classification = Classification::create($data);

        return response()->json($classification, 201);
    }

    public function update(Request $request, $id)
    {
        $classification = Classification::find($id);

        if (!$classification) {
            return response()->json(['message' => 'Classificação não encontrada'], 404);
        }

        $data = $request->validate([
            'team_id' => 'nullable|exists:teams,id',
            'score' => 'nullable|integer',
            'matches_played' => 'nullable|integer',
            // Adicione as validações para os outros campos aqui...
        ]);

        $classification->update($data);

        return response()->json($classification);
    }

    public function destroy($id)
    {
        $classification = Classification::find($id);

        if (!$classification) {
            return response()->json(['message' => 'Classificação não encontrada'], 404);
        }

        $classification->delete();

        return response()->json(['message' => 'Classificação deletada com sucesso']);
    }
}
