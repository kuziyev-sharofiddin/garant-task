<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
Route::apiResource('products', \App\Http\Controllers\ProductController::class);
Route::apiResource('branches', \App\Http\Controllers\BranchController::class);
Route::apiResource('stores', \App\Http\Controllers\StoreController::class);
Route::get('get-branch-by-name', [\App\Http\Controllers\StatisticController::class, 'index']);

