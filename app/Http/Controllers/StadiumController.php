<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;

class StadiumController extends Controller
{
    public function index()
    {
        $stadiums = Stadium::all();
        return response()->json($stadiums);
    }

    public function show($id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            return response()->json(['message' => 'Estádio não encontrado'], 404);
        }

        return response()->json($stadium);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $stadium = Stadium::create($data);

        return response()->json($stadium, 201);
    }

    public function update(Request $request, $id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            return response()->json(['message' => 'Estádio não encontrado'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $stadium->update($data);

        return response()->json($stadium);
    }

    public function destroy($id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            return response()->json(['message' => 'Estádio não encontrado'], 404);
        }

        $stadium->delete();

        return response()->json(['message' => 'Estádio deletado com sucesso']);
    }
}
