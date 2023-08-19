<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="API SASS Futebol",
 *     ),
 *     @OA\Server(
 *         description="API server",
 *         url="http://localhost:8000/",
 *     ),
 * )
 */
class Controller extends BaseController
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
