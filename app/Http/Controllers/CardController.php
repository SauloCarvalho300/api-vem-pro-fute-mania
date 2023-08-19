<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

require_once app_path('Documentation/Cards/GetAllCards.php');
require_once app_path('Documentation/Cards/StoreCard.php');
class CardController extends Controller
{

    /**
     * @GetAllCards // Use a anotação definida no arquivo correspondente
     */
    public function index()
    {
        try {
            $cards = Card::all();
            return response()->json($cards);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @StoreCard // Use a anotação definida no arquivo correspondente
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'player_id' => 'required|exists:players,id',
            'game_id' => 'required|exists:games,id',
            'time' => 'required|string',
            'card_type' => 'required|in:Y,R',
            'card_step' => 'required|in:G,O,Q,S,F',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $card = Card::create($request->all());
        return response()->json($card, 201);
    }

    public function show($id)
    {
        $card = Card::findOrFail($id);
        return response()->json($card);
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'player_id' => 'required|exists:players,id',
            'game_id' => 'required|exists:games,id',
            'time' => 'required|string',
            'card_type' => 'required|in:Y,R',
            'card_step' => 'required|in:G,O,Q,S,F',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $card->update($request->all());
        return response()->json($card, 200);
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return response()->json(null, 204);
    }
}
