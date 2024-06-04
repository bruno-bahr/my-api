<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::post('/reset', [AccountController::class, 'reset']);
Route::get('/balance', [AccountController::class, 'getBalance']);
Route::post('/event', [AccountController::class, 'handleEvent']);
Route::get('/accounts', [AccountController::class, 'getAllAccounts']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
