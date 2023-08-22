<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Client\Request;

class ExampleController extends Controller
{

    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }

    public function show($id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => 'Jogador não encontrado'], 404);
        }

        return response()->json($player);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'position' => 'required|in:GOL,ZAG,LD,LE,VOL,MC,MD,ME,MEI,PE,PD,SA,ATA',
            'player_number' => 'required|integer',
            'birthday' => 'nullable|date',
            'picture' => 'nullable|string',
        ]);

        $player = Player::create($data);

        return response()->json($player, 201);
    }

    public function update(Request $request, $id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => 'Jogador não encontrado'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'position' => 'required|in:GOL,ZAG,LD,LE,VOL,MC,MD,ME,MEI,PE,PD,SA,ATA',
            'player_number' => 'required|integer',
            'birthday' => 'nullable|date',
            'picture' => 'nullable|string',
        ]);

        $player->update($data);

        return response()->json($player);
    }

    public function destroy($id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => 'Jogador não encontrado'], 404);
        }

        $player->delete();

        return response()->json(['message' => 'Jogador deletado com sucesso']);
    }
}
