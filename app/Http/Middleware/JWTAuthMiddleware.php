<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization header missing',
                "data" => null
            ], 401);
        }

        if (!str_starts_with($authHeader, 'Bearer ')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid authorization format',
                "data" => null
            ], 401);
        }

        $token = substr($authHeader, 7);

        try {
            $key = config('jwt.secret');

            if (!$key) {
                return response()->json([
                  "message" => "Server Error",
		  "data" => null,
		  "success" => false
                ], 500);
            }

            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            if (isset($decoded->exp) && $decoded->exp < time()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token expired',
                    "data" => null
                ], 401);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                "data" => null
            ], 401);
        }

        return $next($request);
    }
}
