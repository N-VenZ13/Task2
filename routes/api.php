<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("auth")->group(function(){
    Route::post("login", [AuthController::class, 'login']);
    Route::post("register", [AuthController::class, 'register']);


});


Route::prefix("produk")->group(function(){
    Route::get("/", [ProductController::class, 'index']);
    Route::post('/store', [ProductController::class, 'create']);
 
});