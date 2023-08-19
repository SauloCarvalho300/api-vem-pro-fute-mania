<?php

/**
 * @OA\Get(
 *     path="/cards",
 *     operationId="getAllCards",
 *     tags={"Cartões"},
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
