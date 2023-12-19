<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Recebe as credenciais do request
        $credentials = $request->only('email', 'password');

        try {
            // Tenta autenticar as credenciais e obter um token JWT
            if (!$token = Auth::guard('api')->attempt($credentials)) {
                // Se as credenciais não forem autenticadas, retorna erro 401
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            // Se algo der errado na criação do token, retorna erro 500
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // Se as credenciais forem autenticadas, retorna o token
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // Você pode adicionar mais informações do usuário aqui se necessário
        ]);
    }

}
