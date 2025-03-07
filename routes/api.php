<?php

use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\OrdersController;
use App\Http\Controllers\api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/docs', function () {
    return redirect('/api/documentation');
});

Route::apiResource("products", ProductsController::class);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/orders', [OrdersController::class, 'store']);
});