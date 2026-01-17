<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'user'
            ]
        ], 200);
    }
}
