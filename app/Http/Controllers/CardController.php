<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class CardController extends Controller
{

    /**
     * @OA\Get(
     *     path="/card",
     *     operationId="getAllCards",
     *     tags={"Card"},
     *     summary="Get all cards",
     *     description="Retrieve a list of all cards",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with a list of cards",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Card")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *     schema="Card",
     *     title="Card",
     *     @OA\Property(property="id", type="integer", format="int64", example=1),
     *     @OA\Property(property="player_id", type="integer", format="int64", example=1),
     *     @OA\Property(property="game_id", type="integer", format="int64", example=1),
     *     @OA\Property(property="time", type="string", example="15:30"),
     *     @OA\Property(property="card_type", type="string", enum={"Y", "R"}, example="Y"),
     *     @OA\Property(property="card_step", type="string", enum={"G", "O", "Q", "S", "F"}, example="G"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time"),
     * )
     */
    public function index()
    {
        $cards = Card::all();
        return response()->json($cards);
    }

    /**
     * @OA\Post(
     *   path="/card",
     *   @OA\Response(
     *     response=200,
     *     description="A list with cards"
     *   ),
     * )
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
