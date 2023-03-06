<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/companies', [CompaniesController::class, 'index']);
Route::get('/companies/{id}', [CompaniesController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/companies', [CompaniesController::class, 'store']);
    Route::post('/companies/{id}', [CompaniesController::class, 'update']);
    Route::post('/companies/{id}', [CompaniesController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});