<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Category\Http\Controllers\CategoryController;


Route::group(['prefix'=>'admin/category'], function() {
	Route::get('', [CategoryController::class, 'list']);
	Route::get('create', [CategoryController::class, 'create']);
});
