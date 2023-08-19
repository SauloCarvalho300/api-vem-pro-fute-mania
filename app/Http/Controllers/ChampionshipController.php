<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Championship;

class ChampionshipController extends Controller
{
    public function index()
    {
        $championships = Championship::all();
        return response()->json($championships);
    }

    public function show($id)
    {
        $championship = Championship::findOrFail($id);
        return response()->json($championship);
    }

    public function store(Request $request)
    {
        // Validação dos dados $request

        $championship = new Championship();
        $championship->title = $request->input('title');
        $championship->year = $request->input('year');
        $championship->position = $request->input('position');
        $championship->award_id = $request->input('award_id');
        $championship->regulation_id = $request->input('regulation_id');
        $championship->save();

        return response()->json(['message' => 'Championship created successfully']);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados $request

        $championship = Championship::findOrFail($id);
        $championship->title = $request->input('title');
        $championship->year = $request->input('year');
        $championship->position = $request->input('position');
        $championship->award_id = $request->input('award_id');
        $championship->regulation_id = $request->input('regulation_id');
        $championship->save();

        return response()->json(['message' => 'Championship updated successfully']);
    }

    public function destroy($id)
    {
        $championship = Championship::findOrFail($id);
        $championship->delete();

        return response()->json(['message' => 'Championship deleted successfully']);
    }
}
