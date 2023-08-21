<?php

/**
 * @OA\Post(
 *     path="/cards",
 *     operationId="storeCard",
 *     tags={"Cartões"},
 *     summary="Create a new card",
 *     description="Create a new card entry",
 *     properties={
 *       {
 *          title: "Teste",
 *          format: "string"
 *       } 
 *     }
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CardRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Card created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Card")
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
 *     schema="CardRequest",
 *     title="CardRequest",
 *     @OA\Property(property="player_id", type="integer", format="int64", example=1),
 *     @OA\Property(property="game_id", type="integer", format="int64", example=1),
 *     @OA\Property(property="time", type="string", example="15:30"),
 *     @OA\Property(property="card_type", type="string", enum={"Y", "R"}, example="Y"),
 *     @OA\Property(property="card_step", type="string", enum={"G", "O", "Q", "S", "F"}, example="G"),
 * )
 */
