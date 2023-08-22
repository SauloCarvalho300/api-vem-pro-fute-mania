<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        $games = Game::all();
        return response()->json($games);
    }


    public function show($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        return response()->json($game);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'team_one_id' => 'nullable|exists:teams,id',
            'team_two_id' => 'nullable|exists:teams,id',
            'score_team_one' => 'required|integer',
            'score_team_two' => 'required|integer',
            // Adicione as validações para os outros campos aqui...
        ]);

        $game = Game::create($data);

        return response()->json($game, 201);
    }

    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        $data = $request->validate([
            'team_one_id' => 'nullable|exists:teams,id',
            'team_two_id' => 'nullable|exists:teams,id',
            'score_team_one' => 'required|integer',
            'score_team_two' => 'required|integer',
            // Adicione as validações para os outros campos aqui...
        ]);

        $game->update($data);

        return response()->json($game);
    }

    public function destroy($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        $game->delete();

        return response()->json(['message' => 'Jogo deletado com sucesso']);
    }
}
