<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Post\Http\Controllers\PostController;


Route::group(['prefix'=>'admin/post'], function() {
	Route::get('', [PostController::class, 'list']);
	Route::get('create', [PostController::class, 'create']);
	Route::get('edit/{id}', [PostController::class, 'edit']);
	Route::get('view/{id}', [PostController::class, 'view']);
});
