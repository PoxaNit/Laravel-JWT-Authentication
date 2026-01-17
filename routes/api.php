<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\UserController;

Route::post('/auth/token', [JWTAuthController::class, 'createToken']);

Route::middleware('jwt.auth')->get('/user', [UserController::class, 'get']);
