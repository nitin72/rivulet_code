<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Post\Http\Controllers\PostController;

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix'=>'api/post'],function () {
        Route::get('{id?}', [PostController::class, 'getPosts']);
        Route::post('store', [PostController::class, 'store']);
        Route::post('comment/store/{post}', [PostController::class, 'storeComment']);
        Route::get('comment/{post}', [PostController::class, 'getComments']);
    });
});