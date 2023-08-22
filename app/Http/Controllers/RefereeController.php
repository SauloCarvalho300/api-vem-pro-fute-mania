<?php

namespace App\Http\Controllers;

use App\Models\Referee;
use Illuminate\Http\Request;

class RefereeController extends Controller
{
    public function index()
    {
        $referees = Referee::all();
        return response()->json($referees);
    }

    public function show($id)
    {
        $referee = Referee::find($id);

        if (!$referee) {
            return response()->json(['message' => 'Árbitro não encontrado'], 404);
        }

        return response()->json($referee);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $referee = Referee::create($data);

        return response()->json($referee, 201);
    }

    public function update(Request $request, $id)
    {
        $referee = Referee::find($id);

        if (!$referee) {
            return response()->json(['message' => 'Árbitro não encontrado'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $referee->update($data);

        return response()->json($referee);
    }

    public function destroy($id)
    {
        $referee = Referee::find($id);

        if (!$referee) {
            return response()->json(['message' => 'Árbitro não encontrado'], 404);
        }

        $referee->delete();

        return response()->json(['message' => 'Árbitro deletado com sucesso']);
    }
}
