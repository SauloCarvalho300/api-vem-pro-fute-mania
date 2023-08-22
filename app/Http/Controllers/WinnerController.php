<?php

namespace App\Http\Controllers;

use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $winners = Winner::all();
        return response()->json($winners);
    }

    public function show($id)
    {
        $winner = Winner::find($id);

        if (!$winner) {
            return response()->json(['message' => 'Vencedor não encontrado'], 404);
        }

        return response()->json($winner);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'championship_id' => 'required|exists:championships,id',
        ]);

        $winner = Winner::create($data);

        return response()->json($winner, 201);
    }

    public function update(Request $request, $id)
    {
        $winner = Winner::find($id);

        if (!$winner) {
            return response()->json(['message' => 'Vencedor não encontrado'], 404);
        }

        $data = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'championship_id' => 'required|exists:championships,id',
        ]);

        $winner->update($data);

        return response()->json($winner);
    }

    public function destroy($id)
    {
        $winner = Winner::find($id);

        if (!$winner) {
            return response()->json(['message' => 'Vencedor não encontrado'], 404);
        }

        $winner->delete();

        return response()->json(['message' => 'Vencedor deletado com sucesso']);
    }
}
