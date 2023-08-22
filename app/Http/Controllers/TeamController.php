<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    public function show($id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['message' => 'Time não encontrado'], 404);
        }

        return response()->json($team);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $team = Team::create($data);

        return response()->json($team, 201);
    }

    public function update(Request $request, $id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['message' => 'Time não encontrado'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $team->update($data);

        return response()->json($team);
    }

    public function destroy($id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['message' => 'Time não encontrado'], 404);
        }

        $team->delete();

        return response()->json(['message' => 'Time deletado com sucesso']);
    }
}
