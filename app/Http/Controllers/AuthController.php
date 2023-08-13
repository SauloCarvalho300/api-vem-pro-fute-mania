<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Nome da Sua API",
 *      version="1.0.0",
 *      description="Descrição da sua API"
 * )
 */
class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @OA\Post(
     *     path="/users/register",
     *     @OA\Response(response="200", description="An example resource")
     * )
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'permission' => 'required|string',
            'document_identifier' => 'required|string',
            'birthday' => 'date',
            'picture' => 'string',
        ]);


        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->permission = $request->input('permission');
            $user->document_identifier = $request->input('document_identifier');
            $user->birthday = $request->input('birthday');
            $user->picture = $request->input('picture');

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }
}
