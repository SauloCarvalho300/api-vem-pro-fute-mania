<?php

namespace App\Http\Controllers;

use App\Models\Award;

use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::all();
        return response()->json($awards);
    }

    public function show($id)
    {
        $award = Award::find($id);

        if (!$award) {
            return response()->json(['message' => 'Prêmio não encontrado'], 404);
        }

        return response()->json($award);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $award = Award::create($data);

        return response()->json($award, 201);
    }

    public function update(Request $request, $id)
    {
        $award = Award::find($id);

        if (!$award) {
            return response()->json(['message' => 'Prêmio não encontrado'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $award->update($data);

        return response()->json($award);
    }

    public function destroy($id)
    {
        $award = Award::find($id);

        if (!$award) {
            return response()->json(['message' => 'Prêmio não encontrado'], 404);
        }

        $award->delete();

        return response()->json(['message' => 'Prêmio deletado com sucesso']);
    }
}
