<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use DateTime;

class JWTAuthController extends Controller
{
    public function createToken(Request $request)
    {
        // Em um projeto real, aqui você validaria usuário/senha
        // Aqui é só demonstração de JWT funcionando

        $key = config('jwt.secret');

        if (!$key) {
            return response()->json([
                'success' => false,
                'message' => 'JWT secret not configured',
                "data" => null
            ], 500);
        }

        $now = new DateTime();
        $now->modify('+3 minutes');

        $payload = [
            "app" => "laravel-jwt-authentication",
            'iat' => time(),
            'exp' => $now->getTimestamp()
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ],
            'message' => 'User authenticated'
        ], 200);
    }
}
