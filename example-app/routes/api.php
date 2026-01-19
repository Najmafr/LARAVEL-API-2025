<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
// use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function(){
    Route::prefix('auth')->group(function () {
        Route::post('signup', [AuthController::class, 'register']);
        Route::post('signin', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });

    Route::resource('/product-categories',CategoryProductController::class);
    Route::resource('/product-variant',ProductVariantController::class); 
    Route::resource('/product',ProductController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
