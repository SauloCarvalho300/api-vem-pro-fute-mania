<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::all();
        return response()->json($workspaces);
    }

    public function show($id)
    {
        $workspace = Workspace::findOrFail($id);
        return response()->json($workspace);
    }

    public function store(Request $request)
    {
        $workspace = new Workspace();
        $workspace->title = $request->input('title');
        $workspace->tournament_type = $request->input('tournament_type');
        $workspace->picture_url = $request->input('picture_url');
        $workspace->owner_id = $request->input('owner_id');
        $workspace->save();

        return response()->json($workspace, 201);
    }

    public function update(Request $request, $id)
    {
        $workspace = Workspace::findOrFail($id);
        $workspace->title = $request->input('title');
        $workspace->tournament_type = $request->input('tournament_type');
        $workspace->picture_url = $request->input('picture_url');
        $workspace->owner_id = $request->input('owner_id');
        $workspace->save();

        return response()->json($workspace);
    }

    public function destroy($id)
    {
        $workspace = Workspace::findOrFail($id);
        $workspace->delete();

        return response()->json(['message' => 'Workspace deleted']);
    }
}
