<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PassageiroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViagemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/users', UserController::class)->except('store');
    Route::apiResource('/motoristas', MotoristaController::class);
    Route::apiResource('/passageiros', PassageiroController::class);
    Route::apiResource('/viagens', ViagemController::class);
});
