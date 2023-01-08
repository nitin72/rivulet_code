<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Modules\Category\Http\Controllers\CategoryController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('name', function(){return 'test';});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
