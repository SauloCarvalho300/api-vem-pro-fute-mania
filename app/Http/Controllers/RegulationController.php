<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
    public function index()
    {
        $regulations = Regulation::all();
        return response()->json($regulations);
    }

    public function show($id)
    {
        $regulation = Regulation::find($id);

        if (!$regulation) {
            return response()->json(['message' => 'Regulamento não encontrado'], 404);
        }

        return response()->json($regulation);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'document_url' => 'nullable|string',
        ]);

        $regulation = Regulation::create($data);

        return response()->json($regulation, 201);
    }


    public function update(Request $request, $id)
    {
        $regulation = Regulation::find($id);

        if (!$regulation) {
            return response()->json(['message' => 'Regulamento não encontrado'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'document_url' => 'nullable|string',
        ]);

        $regulation->update($data);

        return response()->json($regulation);
    }

    public function destroy($id)
    {
        $regulation = Regulation::find($id);

        if (!$regulation) {
            return response()->json(['message' => 'Regulamento não encontrado'], 404);
        }

        $regulation->delete();

        return response()->json(['message' => 'Regulamento deletado com sucesso']);
    }
}
