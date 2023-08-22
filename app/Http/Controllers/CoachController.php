<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return response()->json($coaches);
    }

    public function show($id)
    {
        $coach = Coach::find($id);

        if (!$coach) {
            return response()->json(['message' => 'Treinador não encontrado'], 404);
        }

        return response()->json($coach);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $coach = Coach::create($data);

        return response()->json($coach, 201);
    }

    public function update(Request $request, $id)
    {
        $coach = Coach::find($id);

        if (!$coach) {
            return response()->json(['message' => 'Treinador não encontrado'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $coach->update($data);

        return response()->json($coach);
    }

    public function destroy($id)
    {
        $coach = Coach::find($id);

        if (!$coach) {
            return response()->json(['message' => 'Treinador não encontrado'], 404);
        }

        $coach->delete();

        return response()->json(['message' => 'Treinador deletado com sucesso']);
    }
}
