<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Category\Http\Controllers\CategoryController;

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix'=>'api/category'],function () {
        Route::get('', [CategoryController::class, 'getCategories']);
        Route::post('store', [CategoryController::class, 'store']);
    });
});